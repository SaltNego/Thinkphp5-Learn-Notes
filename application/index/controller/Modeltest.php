<?php
/**
 * Created by PhpStorm.
 * User: Negoowen
 * Date: 2019/9/3
 * Time: 14:10
 */
namespace app\index\controller;

use think\Controller;
use app\index\model\User;
use think\Loader;
use think\Request;

class Modeltest extends Controller{

    //model方法学习
    /**
     * @param Request $request
     * @throws \Exception
     */
    public function inserttest(Request $request){


        //1.数据的增加-模型对象的save方法（先对对象设置属性）
        $userModel = new User();
        //id username password email ORM
        $userModel->username='test1';
        $userModel->password=md5('test1');
        $userModel->email = 'test1@aaa.com';
        $status = $userModel->save();
        halt($status);


        //2.模型类的create静态方法，出现的原因主要是由于下面的这种设置过于繁琐

        $insertData = [
            'username' => 'test2',
            'password' => md5('test2'),
            'email' => 'test2@qq.com',
        ];
        //实际肯定是从表单进行接收
        //$data = input('post.');
        $obj = User::create($insertData);
        //返回值是一个模型对象
        var_dump($obj->getLastInsID());
        halt($obj);


        //批量插入数据
        $allData = [
            [
                'username' => 'test31',
                'password' => md5('test31'),
                'email' => 'test31@qq.com',
            ],
            [
                'username' => 'test32',
                'password' => md5('test32'),
                'email' => 'test32@qq.com',
            ],
            [
                'username' => 'test33',
                'password' => md5('test33'),
                'email' => 'test33@qq.com',
            ],
        ];

        $userModel = new User();
        //返回值是一个数组，数组中每一个元素是成功插入后的对象
        $status = $userModel->saveAll($allData);

        halt($status);

    }

    public function selecttest(Request $request){

        //数据查询
        //
        /*
        //1.模型类get静态方法
        $id = ['id' => 11];//主键id id必须为一个数组才可以  id必须为一个数组才可以
        //存在则返回模型对象，如果要获取值，可以使用模型的属性进行获取
        //如果要使用foreach进行遍历，需要转化为数组
        //$obj->toArray();
        $info = User::get($id);//get返回符合条件的第一条数据
        echo "<h2>模型对象的属性获取</h2>";
        var_dump($info->username);
        echo "<hr>";
        echo "<h2>模型对象的遍历操作</h2>";
        $arr = $info->toArray();
        var_dump($arr);
        foreach ($arr as $k=>$v) {
            echo $v."</br>";
        }
        echo "</hr>";
        halt($info);//方法一测试成功，但是只能返回id的第一条数据


        //2.模型类的get方法（传递其他字段为条件）//where方法
        //参数为一个关联数组，
        $info = User::get(['username'=>'test2']);
        var_dump($info->password);
        //var_dump($info);
        //只能查出第一组

        //3.where方法  如果要获取单条数据使用find()
        $info = User::where('username','=','test2')->find();//find指挥查找到符合条件的第一条数据
        $arr = $info->toArray();
        halt($arr);


        //4.根据字段查询
        $userModel = new User();
        //注意getBy是固定的，后面的字段是表中的字段，使用大驼峰表示
        $info = $userModel->getByUsername('test2');
        $info = $userModel->getByEmail('test31@qq.com');
        var_dump($info->toArray());


        //5.select方法 模型类 ，模型对象也可以
        //也可以加limit限制；不需要的话去掉即可
        //$data = User::select();//获取所有数据
        $data = User::where('username','=','test31')->limit(1)->select();//能查找出全部
        var_dump($data);
        */

        //6.获取所有数据
        $data = User::all();//返回的数据是一个数组，但每个元素是一个模型对象
        echo '</pre>';
        //halt($data);

        //ps
        //注意：对应all和select方法返回的数据，是一个数组，数组中的每个元素是一个模型对象，
        //如果我们需要把他们转换为普通的二维数组（数组中的元素也是数组）
        $fix = function ($val){
            return $val->toArray();
        };
        $rs = array_map($fix,$data);
        var_dump($rs);


    }
    public function loadtest(Request $request){

        //便捷方式获取模型实例
        //方法一
        $userModel = model('User');//等价于new User（）；
        $info=$userModel->find(11);
        //var_dump($info->toArray());

        //方法二
        $userModel = Loader::model('User');
        $info = $userModel->find(3);
        halt($info->toArray());

    }

    public function updatetest(Request $request){
        //更新
        /*
        //先get后save
        $id = 3;
        $info = User::get($id);
        //var_dump($info);
        $info->username = 'new_username';
        $info->password = md5($id);
        $ida['id'] = 3;
        $status = $info->save();//失败，求教
        var_dump($status);
        */

        //模型类update方法
        //$id['id'] = 3;
        $data = [
            'id' => 3,
            'username' => 'newusername',
            'password' => md5('aaa'),
            'email' => 'neweamil@qq.com',
        ];

        //$status = User::update($data);//更新id为7的数据 无法更新成功 失败
        $status = User::where('id','=','7')->update($data); //可以使用 成功
        halt($status);

    }

    public function deletetest(){
        //删除
        /*
        //1. 先使用模型类的get()静态方法，然后在使用模型对象的delete()方法
        $id = 8;
        $info = User::get($id);//获取模型对象
        if($info){
            $status = $info->delete();//出错 没有条件不会执行删除操作
            var_dump($status);
        }

        //2.使用destroy同时删除多条数据
        $id = 9;//可以同时删除多条数据 $id=[1,2,3]
        $status = User::destroy($id);//没有条件不会执行删除操作
        */

        //3.模型对象的delete方法进行删除(需要传递删除条件)
        $id = 9;
        $userModel = new User();
        $status = $userModel->where('id','=',$id)->delete();//成功
        halt($status);



    }
}