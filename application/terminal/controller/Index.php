<?php

namespace app\terminal\controller;

use think\Controller;

use think\Request;

use app\terminal\model\Info;
use app\terminal\model\DataRaw;

class Index extends Controller
{
    // const dbModel=['info'=>Info,'data_raw'=>DataRaw];
    const TBLNAME = ['info', 'data_raw'];
    const TBLFIELDS = [
        'info' => ['id', 'sn', 'name', 'type', 'status', 'location', 'create_time'],
        'data_raw' => ['id', 'info_id', 'data', 'customer_id', 'create_time']
    ];

    private $res = [
        'fields' => [],
        'items' => [],
        'err' => ''
    ];
    //使用数据模型进行查询的参数
    private $mdlParam=[
        'tblName'=>'',
        'fields'=>[
            'origin'=>[],
            'append'=>[],
        ],
        'where'=>'',
        'page'=>'',
        'order'=>''
    ];

    // PHP获取当前类名、方法名
    // __CLASS__ 获取当前类名，输出：命名空间的写法
    // __FUNCTION__ 当前函数名
    // __METHOD__ 当前方法名 输出：类名::方法名
    // 取得当前时间的毫秒时间戳：round(microtime(true)*1000);

    // PHP获取mysql数据表的字段名称和详细信息的一些列命令

    // SHOW DATABASES                                //列出 MySQL Server 数据库。
    // SHOW TABLES [FROM db_name]                    //列出数据库数据表。
    // SHOW CREATE TABLES tbl_name                    //导出数据表结构。
    // SHOW TABLE STATUS [FROM db_name]              //列出数据表及表状态信息。
    // SHOW COLUMNS FROM tbl_name [FROM db_name]     //列出资料表字段
    // SHOW FIELDS FROM tbl_name [FROM db_name]，DESCRIBE tbl_name [col_name]。
    // SHOW FULL COLUMNS FROM tbl_name [FROM db_name]//列出字段及详情
    // SHOW FULL FIELDS FROM tbl_name [FROM db_name] //列出字段完整属性
    // SHOW INDEX FROM tbl_name [FROM db_name]       //列出表索引。
    // SHOW STATUS                                  //列出 DB Server 状态。
    // SHOW VARIABLES                               //列出 MySQL 系统环境变量。
    // SHOW PROCESSLIST                             //列出执行命令。
    // SHOW GRANTS FOR user                         //列出某用户权限
    //  
    public function index(Request $req)
    {
        //where查询条件
        $id=$req->has('info_id')?$req->param('info_id'):0;
      
        $whereArr=!$id?[['id', '>', 0]]:[['info_id', '=', $id]];
        
        //选择数据表
        $tblName = $req->has('tblName') ? $req->param('tblName') : 'info';
        if (!in_array($tblName, self::TBLNAME)) {
            $this->res['items'] = $req->param();
            $this->res['err'] = 'wrong [tbName] value!';
            return json_encode($this->res);
        }


        //字段处理，传入的字段与self::TBLFIELDS[$tblName]取交集
        $fields = [];
        if ($req->has('fields')) {
             $fields = array_intersect($req->param('fields'), self::TBLFIELDS[$tblName]);
            if (count($fields) == 0) {
                $fields = self::TBLFIELDS[$tblName];
            }
        }
        
        //处理limit
        $limit = $req->has('limit') ? $req->param('limit') : 0;
        if ($limit > 10000) {
            $limit = 10000;
        }

         //选择数据模型
         switch ($tblName) {
            case 'info':
                $mdl = new Info;
                break;

            case 'data_raw':
                $mdl = new DataRaw;
                break;
        };

        //得到数据集
        $items = $mdl->where($whereArr)
            ->field($fields)
            // ->page(2, 10)
            // ->limit($limit)
            ->select()
            //调用模型获取器追加字段
            // ->append(['module_info','terminal_sn'])
            ;
           
        $this->res['items'] = $items;
        //所有查询到的字段名
        $this->res['fields'] = count($items)?array_keys($items[0]->toArray()):$mdl->getFieldsName();
        $this->res['err'] = '';
        //获取表中所有字段名
        $this->res['allFields']=$mdl->getFieldsName();

        return json_encode($this->res);
    }
    
}
