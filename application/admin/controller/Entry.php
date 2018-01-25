<?php
/**
 * Created by PhpStorm.
 * User: huosheng
 * Date: 2018/1/23
 * Time: 16:45
 */
namespace  app\admin\controller;

use app\common\model\Admin;

class Entry extends Common
{
    //后台首页
    public function index()
    {

        //加载文档文件
        return $this->fetch();
    }
    //密码管理
    public function pass()
    {
//       检测是否post传交，调用到模型admin use app\common\model\Admin;
        if(request()->isPost())
        {
            $res = (new Admin())->pass(input('post.'));
            if($res['valid'])
            {

                //清除session中的登录信息
                session(null);
                //执行成功
                $this->success($res['msg'],'admin/entry/index');exit;
            }else{
                $this->error($res['msg']);exit;
            }

        }
        return$this->fetch();
    }


}
