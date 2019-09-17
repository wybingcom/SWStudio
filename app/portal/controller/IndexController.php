<?php
/**
 * Created by PhpStorm.
 * User: wybing
 * Date: 2019/7/25
 * Time: 14:34
 */
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class IndexController extends HomeBaseController
{
    public function index()
    {
        //轮播图数据
        $lists = Db::name('banner')->where('banner_status',1)->order("banner_id ASC")->select();
        //友情链接数据
        $content = hook_one('admin_link_index_view');
        if (!empty($content)) {
            return $content;
        }
//        $linkModel = new LinkModel();
//        $links     = $linkModel->where('status', 1)
//                                ->order('list_order', 'asc')
//                                ->select();
        $links= Db::name('link')->where('status',1)->order("list_order ASC")->select();
        //菜单数据
        $navs= Db::name('nav_menu')->where('status',1)->order("list_order ASC")->select();

        $this->assign('lists',  $lists);
        $this->assign('links', $links);
        $this->assign('navs', $navs);

        if (request()->isMobile()) {
            return $this->fetch(':m');
        }else{

            return $this->fetch(':index');
        }
    }
}