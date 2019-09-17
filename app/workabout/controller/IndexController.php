<?php
/**
 * Created by PhpStorm.
 * User: wybing
 * Date: 2019/7/25
 * Time: 15:16
 */
namespace app\workabout\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class IndexController extends HomeBaseController
{
    public function index()
    {
        $lists = Db::name('about')->order("about_year DESC")->select();
        $this->assign('lists',  $lists);
        return $this->fetch(':index');
    }
}