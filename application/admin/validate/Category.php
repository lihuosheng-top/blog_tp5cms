<?php
/**
 * Created by PhpStorm.
 * User: huosheng
 * Date: 2018/1/25
 * Time: 16:39
 */

namespace app\admin\validate;
use think\Validate;

class Category extends Validate
{
    //声明验证规则
    protected $rule =[
      'cate_name'=>'require',
      'cate_sort'=>'require|number|between:1,9999'
    ];
    protected $message = [
        'cate_name'=>'请填写栏目名称',
        'cate_sort'=>'请填写排序',
        'cate_sort.number'=>'排序必须为数字',
        'cate_sort.between'=>'排序需要在1-9999之间'
    ];
}