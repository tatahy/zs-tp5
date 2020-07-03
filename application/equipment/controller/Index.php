<?php

namespace app\equipment\controller;

use think\Controller;
use think\Request;
use think\Collection;
//数据库链式查询中的where对象，用于where条件数组
use think\db\Where;

use app\common\model\DataRaw;
use app\common\model\Info;


class Index extends Controller
{
    //
    const API = ['info', 'brief'];
    //定义要引用的数据表/模型名
    const MDLNAME = ['info'];

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
        // $name=array_keys($param);
        if (!count($param)) {
            //得到查询结果集中前1000项
            return $this->_getMdl()->order('create_time', 'desc')->limit(1000)->select();
        }

        $mdl = $this->_getMdl();

        //构造查询，利用链式查询生成模型对象
        //数组形式的where查询条件
        if (count($param['where'])) {
            $mdl = $mdl->where(new Where($param['where']));
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
                    $mdl = new Info;
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
    public function setResFields($reqfields)
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

    public function setResItems()
    {
        $fields = $this->fields;
        //得到查询结果集
        $clct = $this->_getQueryObj()->select();
     
        $this->items = count($fields['append']) ? $clct->append($fields['append']) : $clct;
    }

    public function apiHandlerInfo()
    {
        $req = $this->req;

        //处理fields
        if ($req->has('fields')) {
            $this->setResFields($req->param('fields'));
        }

        //处理query，
        if ($req->has('query')) {
            $this->query = array_merge($this->query,$req->param('query'));
            //得到结果集
            $this->setResItems();

        }

    }

    public function apiHandlerBrief()
    {
        $req = $this->req;
        //处理fields
        if ($req->has('fields')) {
            $this->setResFields($req->param('fields'));
        }

        //处理query，得到结果集
        if ($req->has('query')) {
            $query = $req->param('query');

            if(count($query)){
                foreach($query as $key=>$subQuery){
                    $originVal=$this->query;
                    $this->query= array_merge($originVal,$subQuery);
                    if($key=='totalNum'){
                        $this->items[$key]=$this->_getQueryObj()->count();
                    }else if($key=='status'){
                        //有使用获取器
                        $clct=new Collection($this->_getQueryObj()->select()->toArray());
                        $this->items[$key]=$clct->column($key);
                    }else{
                        $this->items[$key]=$this->_getQueryObj()->column($key);
                    }
                               
                }
            }
        }
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
