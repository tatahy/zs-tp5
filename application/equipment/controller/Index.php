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
    const API = ['info', 'brief','data'];
    //定义要引用的数据表/模型名
    const MDLNAME = ['info','data_raw'];

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
        $param = $this->query;
        $fields = $this->fields['origin'];
        // $name=array_keys($param);
        if (!count($param)) {
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
        if (count($param['where'])) {
            $mdl = $mdl->where($param['where']);
        }

        //数组形式的order条件
        if (count($param['order'])) {
            $mdl = $mdl->order($param['order']);
        }

        //group只能是字符串
        if (strlen($param['group'])) {
            $mdl = $mdl->group($param['group']);
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
                                // if ($key == 'items') {
                                //     $this->items[$i] = ['txt' => $txtArr[$i], 'value' => $valArr[$i], 'idArr' => $this->_getQueryObj()->column('id')];
                                // } else {
                                //     $this->items[$key][$i] = ['txt' => $txtArr[$i], 'value' => $valArr[$i], 'idArr' => $this->_getQueryObj()->column('id')];
                                // }
                                $this->items[$i] = ['txt' => $txtArr[$i], 'value' => $valArr[$i], 'idArr' => $this->_getQueryObj()->column('id')];

                                // $this->items[$key][$i] = ['txt' => $txtArr[$i], 'value' => $valArr[$i], 'idArr' => $this->_getQueryObj()->column('id')];
                            }
                            break;
                    }
                }
            }
        }
    }

    public function apiHandlerData()
    {
        
        $reqData = $this->req->param();
        //模型对象
        $mdl = $this->_getMdl();
        
        //写入data_raw表，返回写入结果(bool值)
        $result=$mdl->allowField(true)->save($reqData);
        
        if ($result){
            // $this->items=$mdl->id;
            $this->items=$mdl->get($mdl->id);
        }else{
            $this->items=[$reqData ];
        }
        //销毁对象。
        $mdl=null;
    }

    public function index(Request $req, $api)
    {
        if (in_array($api, self::API) && in_array($req->param('tblName'), self::MDLNAME)) {
            $this->api = $api;
            $this->mdlName = $req->param('tblName');
            $this->req = $req;
            switch ($api) {
                case 'info':
                    $this->apiHandlerInfo();
                    break;
                case 'brief':
                    $this->apiHandlerBrief();
                    break;
                case 'data':
                    $this->apiHandlerData();
                    break;
                    // default:

                    //     break;
            }
        }
        $this->_setRes();

        return json_encode($this->res);

        // $this->_setMdlParam($req);
        // return json_encode($this->query);

    }
}
