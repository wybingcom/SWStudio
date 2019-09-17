<?php
/**
 * Created by PhpStorm.
 * User: wybing
 * Date: 2019/7/25
 * Time: 15:15
 */
namespace app\teachermes\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class IndexController extends HomeBaseController
{
    public function index()
    {
        $lists = Db::name('teacher')->order("teacher_id ASC")->select();
        $this->assign('lists',  $lists);
        return $this->fetch(':index');
    }
}