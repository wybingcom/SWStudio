<?php
/**
 * Created by PhpStorm.
 * User: wybing
 * Date: 2019/7/25
 * Time: 10:15
 */
namespace app\admin\controller;
use cmf\controller\AdminBaseController;
use think\Db;

class AboutController extends AdminBaseController
{
    public function index()
    {
        $lists = Db::name('about')->order("about_year DESC")->paginate(10);
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
                'about_year|年份' => 'require',
                'about_img|标题图片' => 'require',
                'about_title|标题' => 'require',
                'about_content|信息' => 'require',
            ]);
            if($validate !== true)
                $this->error($validate);
            $param['about_create_time'] = time();
            $result = Db::name('about')->insertGetId($param);
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
                'about_id' => 'integer|require',
                'about_year|年份' => 'require',
                'about_img|标题图片' => 'require',
                'about_title|标题' => 'require',
                'about_content|信息' => 'require',
            ]);
            if($validate !== true)
                $this->error($validate);

            $result = Db::name('about')->update($param);
            if($result){
                $this->success('编辑成功',url('index'));
            }else{
                $this->error('数据无更改');
            }
        }else {
            $about_id = $this->request->param('about_id', 0, 'intval');
            $info = DB::name('about')->where(["about_id" => $about_id])->find();
            if(!$info){
                $this->error('没有信息');
            }
            $this->assign('info',$info);
            return $this->fetch();
        }
    }
    public function delete()
    {
        $about_id = $this->request->param('about_id', 0, 'intval');

        if (Db::name('about')->delete($about_id) !== false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }
}