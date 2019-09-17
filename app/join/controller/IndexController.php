<?php
/**
 * Created by PhpStorm.
 * User: wybing
 * Date: 2019/7/27
 * Time: 15:48
 */
namespace app\join\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class IndexController extends HomeBaseController
{
    public function index()
    {
        $lists = $result  = Db::name('slideItem')->where('slide_id', 1)->select();
        $this->assign('join', cmf_get_option('join_info'));
        $this->assign('lists',  $lists);
        return $this->fetch();
    }
}