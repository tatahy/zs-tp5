<?php
namespace app\login\controller;

use think\Controller;

use think\Request;

use app\login\model\Info;

class Index extends Controller
{
    public function index(Request $req)
    {
        $param=$req->param();
        $mdl=new Info();
        $res=['reged'=>$mdl->hasStaff($param['name'],$param['pwd'])];
        // return json_encode($req->param());
        return json_encode($res);
        // return json_encode($req);
    }
}
