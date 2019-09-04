<?php

namespace app\index\model;

use think\Model;


class User extends Model
{
    //ps：如果自己定义的表名和Tp5规定的不一样，则可以自己设置一个
    //方式一：
    //public $table = '表名（需要写前缀）'；
    //方式二：
    //public $name = '表名（不需要写前缀）'；

    public function profile(){
        //第一个参数：代表关联哪个模型
        //第二个：代表关联的外键（其他表的哪个字段和当前表产生关联）
        //第三个：代表当前模型的主键，默认是id
        return $this->hasOne('app\index\model\Profile','user_id','id');
    }


}
