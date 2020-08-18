<?php

namespace app\common\model\terminal;

use think\Model;
use think\Collection;
use think\Db;

use app\common\model\terminal\Info;

class DataRaw extends Model
{
  protected $pk = 'id';
  // 设置数据库连接，引用预定义的参数
  protected $connection = 'db_terminal';

  // 设置json类型字段
  protected $json = ['data'];
  // // 设置JSON数据返回数组
  // protected $jsonAssoc = true;

  protected $append = ['module_info','module_time', 'terminal_sn'];
  //覆盖框架Model类的属性值，因为默认的值都是小写，不会有下划线
  protected $name = 'data_raw';
  // 开启自动写入时间戳字段
  protected $autoWriteTimestamp = 'datetime';

  // 模型初始化
  protected static function init()
  {
    //TODO:初始化内容

    // $obj=new self;


  }

  //字段data的获取器，
  public function getDataAttr($value)
  {
    // return $value->param;
    // return $this->getData('data')->param;
    $arr=['rh'=>'相对湿度（%）','amp'=>'电流（A）','vol'=>'电压（V）','temp'=>'温度（C）'];
    $name=array_keys($arr);
    $param=[];
    foreach($value->param as $key=>$val){
      if(in_array($key,$name)){
        $param[$arr[$key]]=$val;
      }else{
        $param[$key]=$val;
      }
    }

    return $param;
  }

  //获取器定义数据表中不存在的字段
  public function getModuleInfoAttr($value, $data)
  {

    return $data['data']->module;
  }

    //获取器定义数据表中不存在的字段
    public function getModuleTimeAttr($value, $data)
    {
  
      return $data['data']->timestamp;
    }

  // // 获取器定义数据表中不存在的字段
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
  
  public function getGroup($field='info_id')
  {
    // $fields=$this->getFieldsName();
    // $field=in_array($field,$fields)?$field:'info_id';

    $infoMdl=new Info();
    $items=$this->group($field)->select();

    foreach($items as $idx=>$item){
      $arr=$item->toArray();
   
      //将json字段值转为数组
      $arr['data']=[];
      foreach($item->data as $k=>$v){
        array_push($arr['data'],$k);
      }
      $info=$infoMdl->get($item->info_id)->hidden(['id','create_time','update_time']);
      $items[$idx]=array_merge($info->toArray(),$arr);
    }

    $infoMdl=null;
    return $items;
  }
}
