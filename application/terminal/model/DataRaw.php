<?php

namespace app\terminal\model;

use think\Model;

use app\terminal\model\Info;
use think\Collection;
use think\Db;

class DataRaw extends Model
{
  protected $pk = 'id';
  // 设置json类型字段
  protected $json = ['data'];
  protected $append = ['module_info', 'terminal_sn'];
  //覆盖框架Model类的属性值，因为默认的值都是小写
  protected $name='data_raw';

  //字段status的获取器，状态码转为文字
  public function getDataAttr($value)
  {
    return $value->param;
    // return $this->getData('data')->module;
  }

  //获取器定义数据表中不存在的字段
  public function getModuleInfoAttr($value, $data)
  {

    return $data['data']->module;
  }

  // 获取器定义数据表中不存在的字段
  public function getTerminalSnAttr($value, $data)
  {
    $list = Info::where('id', $data['info_id'])->find();
    return count($list) ? $list->sn : '无';
  }

  public function getAppendItems()
  {
    return $this->append;
  }

  //得到数据表中的字段名称
  public function getFieldsName($opt = '')
  {
    //使用原生查询获取所有字段信息数组，转换为数据集对象。
    // $arr = new Collection(Db::query("show COLUMNS FROM data_raw" ));
    $arr = new Collection(Db::query("show COLUMNS FROM ".$this->name ));

    $origin = $arr->column('Field');
    $append = $this->append;

    switch ($opt) {
      case 'origin':
        $arr = $origin;
        break;
      case 'append':
        $arr = $append;
        break;
      default:
        $arr = array_merge($origin, $append);
        break;
    }

    return $arr;
  }
}
