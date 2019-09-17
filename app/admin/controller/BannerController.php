<?php
/**
 * Created by PhpStorm.
 * User: wybing
 * Date: 2019/7/24
 * Time: 9:31
 */
namespace app\admin\controller;
use cmf\controller\AdminBaseController;
use think\Db;

class BannerController extends AdminBaseController
{
    public function index()
    {
        $lists = Db::name('banner')->order("banner_id DESC")->paginate(10);
        // 获取分页显示
        $page = $lists->render();
        $this->assign('lists',  $lists);
        $this->assign("page", $page);
        return $this->fetch();
    }
    public function add()
    {
        if($this->request->isPost()){
            $param = $this->request->post();
            $validate = $this->validate($param,[
                'banner_name|名称' => 'require',
                'banner_img|图片' => 'require',
                'banner_link|链接' => 'require',
                'banner_content|显示文本' => 'require',
            ]);
            if($validate !== true)
                $this->error($validate);
            $param['banner_add_time'] = time();
            $result = Db::name('banner')->insertGetId($param);
            if($result){
                $this->success('添加成功',url('index'));
            }else{
                $this->error('添加失败');
            }
        }else{
            return $this->fetch();
        }
    }
    public function edit()
    {
        if($this->request->isPost()){
            $param = $this->request->post();
            $validate = $this->validate($param,[
                'banner_id' => 'integer|require',
                'banner_name' => 'require',
                'banner_img' => 'require',
                'banner_link' => 'require',
                'banner_content|显示文本' => 'require',
            ]);
            if($validate !== true)
                $this->error($validate);

            $result = Db::name('banner')->update($param);
            if($result){
                $this->success('编辑成功',url('index'));
            }else{
                $this->error('数据无更改');
            }
        }else {
            $banner_id = $this->request->param('banner_id', 0, 'intval');
            $info = DB::name('banner')->where(["banner_id" => $banner_id])->find();
            if(!$info){
                $this->error('没有信息');
            }
            $this->assign('info',$info);
            return $this->fetch();
        }
    }
    public function delete()
    {
        $banner_id = $this->request->param('banner_id', 0, 'intval');

        if (Db::name('banner')->delete($banner_id) !== false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }
}