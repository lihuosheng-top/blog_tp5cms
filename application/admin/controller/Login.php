<?php
/**
 * Created by PhpStorm.
 * User: huosheng
 * Date: 2018/1/23
 * Time: 17:06
 */

namespace app\admin\controller;
use app\common\model\Admin;
use think\Controller;
class Login extends Controller
{
    public function login()
    {
//
//        echo decrypt('admin888');

//        //测试数据库连接
//        $data = db('admin')->find();
//        dump($data);
        if(request()->isPost())
        {
            //验证法
//            halt($_POST);
            //接收数据
            $res = (new Admin())->login(input('post.'));
            if($res['valid'])
            {
                $this->success($res['msg'],'admin/entry/index');
                //说明登录成功

            }else{
                //说明登录失败
                $this->error($res['msg']);
            }

        }
//        //加载我们登录的页面
        return $this->fetch('index');



    }

}