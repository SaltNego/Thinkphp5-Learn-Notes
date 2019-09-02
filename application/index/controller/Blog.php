<?php
/**
 * Created by PhpStorm.
 * User: Negoowen
 * Date: 2019/9/1
 * Time: 22:45
 */
namespace app\index\controller;
use think\Controller;

class Blog extends Controller{

    public function index(){
        echo "blog index";
    }

    public function lst($year=0,$month=0){
        echo "year".$year;
        echo "lst test";
        echo "month".$month;
    }

    public function info($id=0){
        echo "info id ====".$id;
    }
}