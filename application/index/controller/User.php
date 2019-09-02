<?php
/**
 * Created by PhpStorm.
 * User: Negoowen
 * Date: 2019/9/2
 * Time: 10:07
 */
namespace app\index\controller;
use think\Controller;
use think\Request;

class User extends Controller{

    //@return \think\Response

    public function info(Request $request){

        //方法一
        //$request = Request::instance();
        //$id = $request->param('id');
        //halt($id);

        //方法二：注意此方法需要继承基类控制器
        //$id = $this->request->param('id');
        //echo '方法二'.$id;
        //halt($id);

        //方法三：助手函数，Request里面的实例
        //$id = input('id');
        //echo "方法三".$id;
        //halt($id);

        //方法四：依赖注入
        $id=$request->param('id');
        echo "方法四".$id;
        halt($id);

    }

    public function lst(){
        //响应方式一
        $info = '这是个测试数据';
        //return view('lst',compact('info'));

        //响应方式二
        //$this->assign('info',$info);
        //return $this->fetch('lst');

        //响应方式三：
        //一次性完成视图的载入和赋值
        //PS：需要继承基类控制器
        return $this->fetch('lst',['info'=>$info]);

    }

    public function testjson(){
        $data = [
            "name" => 'wenwen',
            'age' => 19,
            'address' => '山东省济南市'
        ];
        //return $data;//报错呀~~
        //return json_encode($data,JSON_UNESCAPED_UNICODE);

        return json($data); //json() tp5自带的
    }


    public function add(Request $request){
        if($request->isGet()){
            return view('add');

        }else{
            //数据入库
            $data = Request::instance()->post(false);
            //$data = input('post.');
            //echo $data;
            var_dump($data);
            //$this->success('处理成功！',url('@user/lst'),3);

            //$this->error('处理失败！',url('@user/add'),3);

            //重定向
            //$this->redirect('/');
            //$this->redirect('http://baidu.com');

            //ps:如果跳转到自己网站的某个方法里，需要关闭伪静态设置、
            //$this->redirect(url('/user/lst','',false));

            //助手函数
            return redirect(url('/user/lst','',false));
        }
    }


}
