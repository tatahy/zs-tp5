<?php

namespace app\common\model;

use think\Model;

use think\Collection;
use think\Db;

class Info extends Model
{
  protected $pk = 'id';
  protected $append = [];

  const STATUS= [100 => '未知', 200 => '正常', 300 => '', 400 => '异常',500=>'离线'];

  //字段status的修改器，文字转为状态码输入
  public function setStatusAttr($value)
  {
    $index = array_search($value,self::STATUS);
    return $index?self::STATUS[$index]:self::STATUS['100'];
  }

  //字段status的获取器，状态码转为文字输出
  public function getStatusAttr($value)
  {
    
    return self::STATUS[$value];
  }
  
  //得到数据表中的字段名称
  public function getFieldsName($opt='')
  {
    //获取当前类名，__CLASS__ 获取当前类名，输出：命名空间的写法
    // $name = array_pop(explode('\\', __CLASS__));
    // $name = $this->name;
    //使用原生查询获取所有字段信息数组，转换为数据集对象。
    $arr = new Collection(Db::query("show COLUMNS FROM " . $this->name));
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
