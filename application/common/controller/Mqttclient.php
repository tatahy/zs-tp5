<?php

namespace app\common\controller;

use think\Model;

use think\Collection;
use think\Db;

//TODO: 1 连接指定的mqtt server
//TODO: 2 订阅指定的topic
//TODO: 3 将接收到的信息写入指定的数据库，指定的数据表 
class Mqttclient extends Model
{

  protected $server = 'localhost';     // change if necessary
  protected $port = 1883;                     // change if necessary
  protected $username = '';                   // set your username
  protected $password = '';                   // set your password
  protected $client_id = '';
  //md5('phpMQTT-subscriber'.time()); // make sure this is unique for connecting to sever - you could use uniqid()

  
  public function connectServer()
  {

  }

  public function subscribeTopic()
  {

  }

  public function insertData()
  {

  }
}
