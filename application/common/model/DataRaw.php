<?php

namespace app\common\model;

use think\Model;
use think\Collection;
use think\Db;

use app\common\model\Info;

class DataRaw extends Model
{
  protected $pk = 'id';
  // 设置json类型字段
  protected $json = ['data'];
  protected $append = ['module_info', 'terminal_sn'];
  //覆盖框架Model类的属性值，因为默认的值都是小写，不会有下划线
  protected $name = 'data_raw';

  // 模型初始化
  protected static function init()
  {
    //TODO:初始化内容

    // $obj=new self;


  }

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

  //得到数据表中的字段名称
  public function getFieldsName($type = '')
  {
    //获取当前类名，__CLASS__ 获取当前类名，输出：命名空间的写法
    // $name = app_com_uncamelize(array_pop(explode('\\', __CLASS__)));
    //使用原生查询获取所有字段信息数组，转换为数据集对象。
    $arr = new Collection(Db::query("show COLUMNS FROM " . $this->name));
    // $arr = new Collection(Db::query("show COLUMNS FROM data_raw" ));
    $origin = $arr->column('Field');
    $append = $this->append;

    switch ($type) {
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
