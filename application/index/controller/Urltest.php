<?php
/**
 * Created by PhpStorm.
 * User: Negoowen
 * Date: 2019/9/2
 * Time: 12:45
 */
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Url;

class Urltest extends Controller{

    public function test(Request $request){
        //语法 url(’/模块名称/控制器名称/方法名称‘，’get传递的参数‘，’是否开启伪静态‘)

        //生成地址
        echo "ok";
        $url = url('index/urltest/test',['id'=>12,'name'=>'wenwen'],false);
        var_dump($url);

        $url = Url::build('index/urltest/tets','id=1&name=wen','');
        var_dump($url);
    }
}