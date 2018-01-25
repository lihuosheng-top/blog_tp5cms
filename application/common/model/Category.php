<?php
/**
 * Created by PhpStorm.
 * User: huosheng
 * Date: 2018/1/25
 * Time: 16:29
 */

namespace app\common\model;

use think\Model;
class Category extends Model
{
    protected $pk = 'cate_id';
    protected $table ='blog_cate';
    //接受store数据
    public function store($data)
    {
        //执行验证
        $result = $this->validate(true)->save($data);
//        dump($result);
        if(false === $result)
        {
//            dump($this->getError());
            return['valid'=>0,'msg'=>$this->getError()];

        }else{
            return['valid'=>1,'msg'=>'添加成功'];
        }

//        执行添加
    }

}