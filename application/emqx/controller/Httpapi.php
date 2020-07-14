<?php
namespace app\emqx\controller;

use think\Controller;

use think\Request;
//使用http客户端
use GuzzleHttp\Client;

class Httpapi extends Controller
{
    const REQMETHODS=['GET','POST','DELETE','PUT'];
    // const EMQXHOST='http://localhost:8081/';
    //远程服务器
    const EMQXHOST='http://120.79.25.121:8081/';
    private $route='';
    private $method='';
    private $authBasic=['auth' => ['admin', 'public']];
    private $connectTimeout=2;
    private $apiData=[];
    private $result=['xx'=>0];


    private function _getApiResponseData()
    {
        $client = new Client(['base_uri'=>self::EMQXHOST,'timeout'=>$this->connectTimeout]);

//         $url = "http://www.baidu.com";
//         $response = $client->request('GET', $url);
// //        echo $response->getReasonPhrase();//获取响应结果
// //        echo $response->getStatusCode();//获取状态码
// //        echo $response->getHeaders();//获取响应头信息
// //        echo $response->getHeader('Content-Typt')[0];//获取响应头的某一项
//         $body = $response->getBody();//获取响应体
//         $html = $body->getContents();//获取目标页面
        $response = $client->request(
            $this->method, 
            $this->route,
            $this->authBasic,
            ['json'=>$this->apiData]
        );
        //获取响应结果
        if( $response->getReasonPhrase()){
            //获取响应体，响应体是json字符串，要转成数组Data
            $body = json_decode($response->getBody(),true);
            
            //
            $this->result=array_merge(['apiData'=>$this->apiData], $body);
            // $this->result=$this->data;
            
        } 
        return;
    }

    private function _methodGet()
    {
        return $this->_getApiResponseData();
    }

    private function _methodPost()
    {
        return;
    }

    // 接收前端传来的EMQX-rest-api参数
    // 向远程服务器发送request, {api:'api/v4/clients',method:'GET'}
    // 返回远程服务器的response给前端
    public function index(Request $req)
    {
        $this->route=$req->has('route')?$req->param('route'):'';
        $this->method=$req->has('method')?$req->param('method'):'';
        $this->apiData=$req->has('data')?$req->param('data'):[];
        
        switch($this->method){
			case 'GET':
				$this->_methodGet();
                break;
			case 'POST':
				$this->_methodPost();
                break;
			default:
                break;
        }
        
        return json_encode($this->result);
        // return dump($this->result);
    }
    
}
