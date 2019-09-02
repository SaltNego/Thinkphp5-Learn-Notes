<?php
/**
 * Created by PhpStorm.
 * User: Negoowen
 * Date: 2019/9/1
 * Time: 17:05
 */
//命名空间与文件夹目录一致
namespace app\index\controller;

use think\Controller;

class Goods extends Controller{
    public function index($id = 0){
        echo "Goods-Goods-index~";
        var_dump($id);
        echo "Goods-Goods-index~";
    }

    public function lst(){

        $info = "tp5 version =5";

        $goodsInfo = [
            'goods_name' => 'Huawei',
            'goods_price' => 4988,
        ];

        return view('goods_list',compact('info','goodsInfo'));
    }

    public function info(){
        $info = "我是goods-info-的变量数据";

        $this->assign('info',$info);

        return $this->fetch();

    }

    public function echotest($id=0){
        echo "echo test ".$id;
    }
}




