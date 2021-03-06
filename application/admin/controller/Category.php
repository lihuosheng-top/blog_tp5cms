<?php
/**
 * Created by PhpStorm.
 * User: huosheng
 * Date: 2018/1/25
 * Time: 15:46
 */

namespace app\admin\controller;
use think\Controller;

class Category extends Controller
{
    protected $db;
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->db =new \app\common\model\Category();
    }

    //首页
    public function index()
    {
        //获取栏目数据
        $field =db('cate')->select();
//        halt($field);
        //分配到网页上面
        $this->assign('field',$field);
        return $this->fetch();
    }
    //添加子栏目
    public function store()
    {
        if(request()->isPost())
        {
//            halt(input('post.'));
            //交给模型处理
            $res =$this->db->store(input('post.'));
            if($res['valid'])
            {
                //操作成功
                $this->success($res['msg'],'index');exit;
            }else{
                $this->error($res['msg']);exit;
            }

        }
        return $this->fetch();
    }


    //添加子集
    public function addSon()
    {
        if(request()->isPost())
        {
            $res =$this->db->store(input('post.'));
            if($res['valid'])
            {
                //操作成功
                $this->success($res['msg'],'index');exit;
            }else{
                $this->error($res['msg']);exit;
            }
        }
        $cate_id =input('param.cate_id');
//        halt($cate_id);
        $data =$this->db->where('cate_id',$cate_id)->find();
//        halt($data);
        $this->assign('data',$data);
        return $this->fetch();
    }

    //编辑栏目
    public function edit()
    {
        if(request()->isPost())
        {
//            halt($_POST);
            $res =$this->db->edit(input('post.'));
            if($res['valid'])
            {
                //执行成功
                $this->success($res['msg'],'index');exit;
            }else
            {
                $this->error($res['msg']);exit;
            }
        }

        //接收cate_id
        $cate_id = input('param.cate_id');
//        halt($cate_id);
        //获取旧数据
        $oldData =$this->db->find($cate_id);
//        halt($oldData);
        $this->assign('oldData',$oldData);
        //处理所属分类不能包含子集和自己
        $cateData = $this->db->getCateDate($cate_id);
        $this->assign('cateData',$cateData);
        return $this->fetch();
    }


}