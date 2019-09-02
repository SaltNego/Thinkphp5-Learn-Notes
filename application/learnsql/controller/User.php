<?php
/**
 * Created by PhpStorm.
 * User: Negoowen
 * Date: 2019/9/2
 * Time: 15:31
 */
namespace app\learnsql\controller;

use think\Controller;
use think\Request;
use think\Url;
use think\Db;

class User extends Controller{

    public function alst(){
        echo "ok";

        //数据库的使用
        //$sql = "select * from sh_admin";
        //$data = Db::query($sql);
        //var_dump($data);

        //占位符
        //$sql = 'select * from sh_admin where id = ?';
        //echo $sql;
        //$info = Db::query($sql,[1]);
        //var_dump($info);

        //$sql = 'select * from sh_admin where id = :id';
        //$info = Db::query($sql,['id'=>2]);
        //halt($info);


        //增
        $password = md5('admin');
        echo $password;

        //方式一：原生sql
        //$sql ="insert into sh_admin(id,username,password) value (null,'wenwen','$password')";
        //$status = Db::execute($sql);
        //var_dump($status);

        //方式二：占位符
        //$sql ="insert into sh_admin(id,username,password) value (?,?,?)";
        //$status = Db::execute($sql,[1,'adndy',$password]);

        $sql ="insert into sh_admin(id,username,password) value (:id,:username,:password)";
        $status = Db::execute($sql,['id'=>3,'username'=>'luffy','password'=>$password]);


    }

    public function blst(){
        //构造器-查询
        //$query = Db::table('sh_admin');//有表前缀时使用
        //$data = $query->select();
        //var_dump($data);

        //$id = 3;
        //$info = Db::table('sh_admin')->find($id);
        //var_dump($info);
        /*
        $query = Db::table('sh_admin');
        $username = 'luffy';
        $id = '0';
        //$data = $query->where('username','=',$username)->select();
        $data = $query->where('id','>',$id)->select();
        var_dump($data);
        */
        /*
        //构造器-添加
        $query = Db::table('sh_admin');
        $data = [
            'username' => 'ruby',
            'password' => md5('admin'),
        ];

        $status = $query->insert($data);
        halt($status);
        */
        /*
        //构造器-更新
        $query = Db::table('sh_admin');
        $data = ['username' => 'wen'];
        $pass = ['password' => 'passtest'];
        $status = $query->where('username','=','wen')->update($data);
        $status = $query->where('username','=','wen')->update($pass);
        halt($status);
        */
        //构造器-删除

        $query = Db::table('sh_admin');
        //$where = ['username' => 'wenwen'];
        //$status = $query->where($where)->delete();

        //报错还是使用foreach吧
        //$id = [1,2];
        //$status = $query->delete($id);

        /*
        //没有表前缀时使用
        $query = Db::table('admins');
        $data = [
            'id'=> 39,
            'username' => 'wen',
            'password' => md5('admins'),
        ];

        $status = $query->insert($data);

        halt($status);
        */


        //**db($dbname)**
        //**$dabname必须要有前缀但是不加前缀**
        $data = db('admin')->select(function ($query){
            $query->where('id','>=',3)->order('id desc');
        });

        halt($data);

    }
}