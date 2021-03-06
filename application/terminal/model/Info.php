<?php

namespace app\terminal\model;

use think\Model;

use think\Collection;
use think\Db;

class Info extends Model
{
  protected $pk = 'id';

  //字段status的获取器，状态码转为文字
  public function getStatusAttr($value)
  {
    $status = [100 => '', 200 => '正常', 300 => '', 400 => ''];
    return $status[$value];
  }
  
  //得到数据表中的字段名称
  public function getFieldsName($opt='')
  {
    //使用原生查询获取所有字段信息数组，转换为数据集对象。
    $arr = new Collection(Db::query("show COLUMNS FROM info" ));
    $origin=$arr->column('Field');
    $append=$this->append;

    switch($opt){
      case 'origin':
        $arr=$origin;
      break;
      case 'append':
        $arr=$append;
      break;
      default:
        $arr=array_merge($origin,$append);
      break;
    }
    
    return $arr;
  }
}
