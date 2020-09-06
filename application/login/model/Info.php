<?php

namespace app\login\model;

use think\Model;

use think\Collection;
use think\Db;

class Info extends Model
{
  protected $pk = 'id';
  // 设置数据库连接，引用预定义的参数
  protected $connection = 'db_staff';

  public function hasStaff($name='',$pwd='')
  {
    $whereArr=[];
    $result=false;
    if($name){
      $whereArr['name']=$name;
    }

    if($pwd){
      $whereArr['password']=$pwd;
    }

    if(count($whereArr)==2){
      $result=count($this->where($whereArr)->select())?true:false;
    }

    return $result;
  }

}
