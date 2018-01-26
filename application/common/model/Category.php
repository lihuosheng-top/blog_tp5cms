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



    //处理所属分类
    public function getCateDate($cate_id)
    {
//        halt(db('cate')->select());
//        var_dump(db('cate')->select());
        //1、首先找到$cate_id子集
     $cate_ids =   $this->getSon(db('cate')->select(),$cate_id);

//     halt($cate_ids);
        //2、将自己追加进去
        $cate_ids[] = $cate_id;
        //3、找到除了他们之外的数据
       $field = db('cate')->whereNotIn('cate_id',$cate_ids)->select();
//       halt($field);

    }

    //找子集
    public function getSon($data,$cate_id)
    {
        static  $temp =[];
        foreach ($data as $k=>$v)
        {
            if($cate_id==$v['cate_pid']){
                $temp[] = $v['cate_id'];
                $this->getSon($data,$v['cate_id']);
            }

        }
        return $temp;
    }

    //编辑栏目
    public function edit($data)
    {
        //cate_id=10
       $result =  $this->validate(true)->save($data,[$this->pk=>$data['cate_id']]);
        if($result) {
            //执行成功
            return ['valid'=>1,'msg'=>'编辑成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }
}
