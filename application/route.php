<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::rule('test','index/goods/echotest');
Route::rule('abc',function (){
    return "abc call~~~";
});
Route::get('user/lst','index/user/lst');

//用户添加
Route::get('user/add','index/user/add');
Route::post('user/add','index/user/add');



Route::rule('lst/:id',function ($id){
    //通过匿名函数返回视图，需要在public目录下建立view目录，然后建立视图html文件
    $info = "这是匿名函数执行===".$id;
    return view('lst',compact('info'));
});


Route::group('blog',[
    ':year/:month' =>['index/blog/lst',[],['year' => '\d{4}','month' => '\d{2}']],
    ':id' => ['index/blog/info',[],['id' => '\d+']],
],['method' => 'get']);

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

    'goods/[:id]' => 'index/Goods/echotest',

    //'blog/:year/:month' => ['index/blog/lst',['method' => 'get'],['year' => '\d{4}','month' => '\d{2}']],
];


