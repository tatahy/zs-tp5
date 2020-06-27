<?php

namespace app\terminal\model;

use think\Model;

class Info extends Model
{
  protected $pk = 'id';

  //字段status的获取器，状态码转为文字
  public function getStatusAttr($value)
  {
    $status = [100 => '', 200 => '正常', 300 => '', 400 => ''];
    return $status[$value];
  }
  
}
