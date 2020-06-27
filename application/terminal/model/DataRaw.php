<?php
namespace app\terminal\model;

use think\Model;

use app\terminal\model\Info;

class DataRaw extends Model
{
  protected $pk = 'id';
  // 设置json类型字段
  protected $json = ['data'];
  // protected $append = ['module_info'];
    
  //字段status的获取器，状态码转为文字
  public function getDataAttr($value)
  {
    return $value->param;
    // return $this->getData('data')->module;
  }

  //获取器定义数据表中不存在的字段
  public function getModuleInfoAttr($value,$data)
  {
   
    return $data['data']->module;
  }

  // 获取器定义数据表中不存在的字段
  // public function getTerminalSnAttr($value,$data)
  // {
  //   $list=Info::where('id',$data['info_id'])->find();
  //   return count($list)?$list->sn:'无';
  // }
    
}
