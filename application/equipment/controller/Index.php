<?php

namespace app\equipment\controller;

use think\Controller;
use think\Request;
use think\Collection;

use app\common\model\terminal\DataRaw;
use app\common\model\terminal\Info;


class Index extends Controller
{
    //
    const API = ['info', 'brief', 'create', 'group', 'chart'];
    //定义要引用的数据表/模型名
    const MDLNAME = ['info', 'data_raw'];

    //字符串
    private $api = '';
    //对象
    private $req = null;

    //使用数据模型进行查询的参数
    //模型名称
    private $mdlName = '';
    //结果集字段
    private $fields = [
        'res' => [],
        'origin' => [],
        'append' => [],
    ];
    //查询参数
    private $query = [
        //where接受数组形式的查询条件
        //[['id','>','0'],['type','like','镁%']]
        'where' => [],
        'page' => '',
        'limit' => '',
        'order' => '',
        'group' => ''
    ];
    //返回数据
    private $items = [];


    private $mdlParam = [
        'tbName' => '',
        'fields' => [
            'res' => [],
            'origin' => [],
            'append' => [],
        ],
        'query' => [
            'where' => [],
            'page' => '',
            'limit' => '',
            'order' => '',
            'group' => ''
        ]
    ];

    //返回前端的数据
    private $res = [
        'fields' => [],
        'items' => [],
        'err' => ''
    ];

    //重构控制器的初始化方法，在其他方法之前调用，无须返回值。
    // protected function initialize()
    // {
    //     // echo 'init<br/>';
    // }

    private function _getQueryObj()
    {
        $query = $this->query;
        $fields = $this->fields['origin'];
        // $name=array_keys($query);
        if (!count($query)) {
            //得到查询结果集中前1000项
            return $this->_getMdl()->order('create_time', 'desc')->limit(1000)->select();
        }

        $mdl = $this->_getMdl();

        //构造查询，利用链式查询生成模型对象

        //是否定义fields
        if (count($fields)) {
            $mdl = $mdl->field($fields);
        }

        //数组形式的where查询条件
        if (count($query['where'])) {
            $mdl = $mdl->where($query['where']);
        }

        //数组形式的order条件
        if (count($query['order'])) {
            $mdl = $mdl->order($query['order']);
        }

        //group只能是字符串
        if (strlen($query['group'])) {
            $mdl = $mdl->group($query['group']);
        }

        //得到查询结果集
        // $clct = $mdl->select();

        // $mdl = null;
        // return $clct;



        return $mdl;
    }

    private function _getMdl($name = null)
    {
        $mdl = null;
        $mdlName = $name == null ? $this->mdlName : $name;

        if (in_array($mdlName, self::MDLNAME)) {
            switch ($mdlName) {
                case 'info':
                    $mdl = new Info();
                    break;
                case 'data_raw':
                    $mdl = new DataRaw();
                    break;
                    // case 'summary':

                    //     break;
                    // default:

                    //     break;
            }
        }

        return $mdl;
    }

    private function _setRes()
    {

        $this->res['fields'] = $this->fields['res'];
        $this->res['items'] = $this->items;
        $this->res['err'] = '';
    }
    //fields处理
    public function setFields($reqfields)
    {
        //模型对象
        $mdl = $this->_getMdl();
        $fields = $this->fields;
        if (count($reqfields)) {
            $fields['res'] = array_intersect($reqfields, $mdl->getFieldsName());
            $fields['origin'] = array_intersect($reqfields, $mdl->getFieldsName('origin'));
            $fields['append'] = array_intersect($reqfields, $mdl->getFieldsName('append'));
        } else {
            $fields['res'] = $mdl->getFieldsName('origin');
            $fields['origin'] = $mdl->getFieldsName('origin');
            $fields['append'] = [];
        }

        //清除模型对象
        $mdl = null;
        $this->fields = $fields;
    }

    public function apiHandlerInfo()
    {
        $req = $this->req;

        //处理fields
        if ($req->has('fields')) {
            $this->setFields($req->param('fields'));
        }

        //处理query
        if ($req->has('query')) {
            $this->query = array_merge($this->query, $req->param('query'));
            //得到结果集
            $this->items = $this->_getQueryObj()->select();
        }
    }

    public function apiHandlerBrief()
    {
        $req = $this->req;
        //处理fields
        if ($req->has('fields')) {
            $this->setFields($req->param('fields'));
        }

        //处理query，得到结果集
        if ($req->has('query')) {
            $query = $req->param('query');

            if (count($query)) {

                foreach ($query as $key => $subQuery) {
                    $originVal = array_merge([], $this->query);

                    $this->query = array_merge($originVal, $subQuery);
                    //得到查询结果数据集对象
                    $clct = $this->_getQueryObj();
                    switch ($key) {
                        case 'totalNum':
                            $this->items[$key] = $clct->count();
                            break;
                            // case 'items':
                            //     $this->items = $clct->select();
                            //     break;
                        default:
                            $valArr = $clct->column($key);
                            $txtArr = $valArr;

                            //$valrr与$txtArr一一对应
                            if ($key == 'status') {
                                //status字段定义有获取器，要经过select()才会触发获取器
                                $clctStatus = new Collection($clct->select()->toArray());
                                $txtArr = $clctStatus->column($key);
                            }

                            for ($i = 0; $i < count($txtArr); $i++) {
                                //准备查询条件
                                $this->query = array_merge($originVal, ['where' => [$key => ['=', $valArr[$i]]]]);

                                // $this->items[$i] = ['txt' => $txtArr[$i], 'value' => $valArr[$i], 'idArr' => $this->_getQueryObj()->column('id')];

                                $this->items[$key][$i] = ['txt' => $txtArr[$i], 'value' => $valArr[$i], 'idArr' => $this->_getQueryObj()->column('id')];
                            }
                            break;
                    }
                }
            }
        }
    }

    public function apiHandlerCreate()
    {

        $reqData = $this->req->param();
        //模型对象
        $mdl = $this->_getMdl();

        //写入data_raw表，返回写入的结果(bool值)
        $result = $mdl->allowField(true)->save($reqData);

        if ($result) {
            // $this->items=$mdl->id;
            $this->items = $mdl->get($mdl->id);
        } else {
            $this->items = [$reqData];
        }
        //销毁对象。
        $mdl = null;
    }

    public function apiHandlerGroup()
    {

        $req = $this->req;
        // $this->items =$req->param();

        //处理fields
        if ($req->has('fields')) {
            $this->setFields($req->param('fields'));
        }
        //得到结果集
        $this->items = $this->_getMdl()->getGroup();

        //处理query
        // if ($req->has('query')) {
        //     $this->query = array_merge($this->query, $req->param('query'));
        //     //得到结果集
        //     $this->items = $this->_getQueryObj()->select();
        // }

    }

    public function apiHandlerChart()
    {

        $req = $this->req;
        $this->items = $req->param();
        // 处理query
        if ($req->has('query')) {
            $this->query = array_merge($this->query, $req->param('query'));
            //得到结果集
            // $this->items = $this->_getQueryObj()->column('data');
            //清空
            $this->items = [];
            $col=$this->_getQueryObj();

            //组装params
            $params=[
                'rh'=> ['name'=>'rh','txt'=>'相对湿度（%）','timestamp'=>[],'value'=>[]],
                'amp'=>['name'=>'amp','txt'=>'电流（A）','timestamp'=>[],'value'=>[]],
                'temp'=>['name'=>'temp','txt'=>'温度（C）','timestamp'=>[],'value'=>[]],
                'vol'=> ['name'=>'vol','txt'=>'电压（V）','timestamp'=>[],'value'=>[]],
            ];
            //data字段值是json类型
            foreach($col->column('data') as $key=>$val){
                //将json字符串解码为数组形式
                $arr=json_decode($val,true);
                
                foreach($arr['param'] as $name=>$v){
                    $params[$name]['value'][$key]=$v;
                    $params[$name]['timestamp'][$key]=$arr['timestamp'];
                }
            }
           

            // $this->items['rawData'] = $rawData;
            $this->items['data'] =$col->select();
            $this->items['info']= $this->_getMdl('info')->get($col->group('info_id')->column('info_id'));
            $this->items['params']= array_values($params);
        }
    }

    private function _getApiHandler()
    {
        $apiHandler='apiHandler'.ucfirst($this->api) ;
        //根据字符串调用方法
        return $this->{$apiHandler}();
        // return $this->$apiHandler();
        // return call_user_func(array($this,$apiHandler));

        // switch ($this->api) {
        //     case 'info':
        //         $this->apiHandlerInfo();
        //         break;
        //     case 'brief':
        //         $this->apiHandlerBrief();
        //         break;
        //     case 'create':
        //         $this->apiHandlerCreate();
        //         break;
        //     case 'group':
        //         $this->apiHandlerGroup();
        //         break;
        //     case 'chart':
        //         $this->apiHandlerChart();
        //         break;
        // }
    }

    private function _checkParams()
    {
        $hasApi=in_array($this->api, self::API);
        $hasTblName=in_array($this->req->param('tblName'),self::MDLNAME);
        
        if($hasTblName){
            $this->mdlName = $this->req->param('tblName');
        }
        return $hasApi && $hasTblName;
    }

    public function index(Request $req, $api)
    {
        $this->api = $api;
        $this->req = $req;

        if($this->_checkParams()){
            $this->_getApiHandler();
        }

        $this->_setRes();

        return json_encode($this->res);

        // $this->_setMdlParam($req);
        // return json_encode($this->query);

    }
}
