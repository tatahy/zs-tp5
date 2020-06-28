<?php

namespace app\equipment\controller;

use think\Controller;
use think\Request;
// use think\Collection;

use app\common\model\DataRaw;
use app\common\model\Info;


class Index extends Controller
{
    //
    const TBNAMEARR = ['info', 'data_raw'];
    //使用数据模型进行查询的参数
    private $mdlParam = [
        'tbName' => '',
        'fields' => [
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

    private function _setMdlParam($req)
    {
        $param = $this->mdlParam;

        //tbName
        if ($req->has('tbName') && in_array($req->param('tbName'), self::TBNAMEARR)) {
            $param['tbName'] = $req->param('tbName');
        } else {
            $this->res['err'] = 'wrong "tbName".';
            return false;
        }

        //fields
        if ($req->has('fields')) {
            $fields =  $req->param('fields');
            //模型对象
            $mdl = $this->_getMdl($param['tbName']);
            if (count($fields)) {
                $param['fields']['origin'] = array_intersect($fields, $mdl->getFieldsName('origin'));
                $param['fields']['append'] = array_intersect($fields, $mdl->getFieldsName('append'));
            } else {
                $param['fields']['origin'] = $mdl->getFieldsName('origin');
            }
            //清除模型对象
            $mdl = null;
        }

        //query


        return true;
    }

    private function _getMdl($name)
    {
        $name = in_array($name, self::TBNAMEARR) ? $name : '';
        switch ($name) {
            case 'info':
                $mdl = new Info;
                break;
            case 'data_raw':
                $mdl = new DataRaw;
                break;
            default:
                $mdl = null;
                break;
        }

        return $mdl;
    }

    private function _setRes($api)
    {
        $param = $this->mdlParam;
        $mdl = $this->_getMdl($api);
        if ($mdl == null) {
            return;
        }


        // $mdl=new Collection($mdl->field($param['fields']['origin'])->select());
        $mdl = $mdl->field($param['fields']['origin'])->select();
        if (count($param['fields']['append'])) {
            $this->res['items'] = $mdl->append($param['fields']['append']);
            // $this->res['items'] = $this->_getMdl($api)->field($param['fields']['origin'])->select()->append($param['fields']['append']);
        } else {
            $this->res['items'] = $mdl;
        }
        $mdl = null;

        $this->res['fields'] = $this->_getMdl($api)->getFieldsName();
        $this->res['err'] = '';
    }

    public function index(Request $req, $api)
    {
        if ($this->_setMdlParam($req)) {
            $this->_setRes($api);
        }

        return json_encode($this->res);
        // return json_encode($api);
    }
}
