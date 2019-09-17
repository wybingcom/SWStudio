<?php
/**
 * Created by PhpStorm.
 * User: wybing
 * Date: 2019/7/25
 * Time: 9:28
 */
namespace app\admin\controller;
use cmf\controller\AdminBaseController;
use think\Db;

class TeacherController extends AdminBaseController
{
    public function index()
    {
        $lists = Db::name('teacher')->order("teacher_id DESC")->paginate(10);
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
                'teacher_name|姓名' => 'require',
                'teacher_img|图片' => 'require',
                'teacher_position|职位' => 'require',
                'teacher_desc|简介信息' => 'require',
                'teacher_color|背景颜色' => 'require',

            ]);
            if($validate !== true)
                $this->error($validate);
            $param['teacher_create_time'] = time();
            $result = Db::name('teacher')->insertGetId($param);
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
                'teacher_id' => 'integer|require',
                'teacher_name' => 'require',
                'teacher_img' => 'require',
                'teacher_position|职位' => 'require',
                'teacher_desc|简介信息' => 'require',
                'teacher_color|背景颜色' => 'require',
            ]);
            if($validate !== true)
                $this->error($validate);

            $result = Db::name('teacher')->update($param);
            if($result){
                $this->success('编辑成功',url('index'));
            }else{
                $this->error('数据无更改');
            }
        }else {
            $teacher_id = $this->request->param('teacher_id', 0, 'intval');
            $info = DB::name('teacher')->where(["teacher_id" => $teacher_id])->find();
            if(!$info){
                $this->error('没有信息');
            }
            $this->assign('info',$info);
            return $this->fetch();
        }
    }
    public function delete()
    {
        $teacher_id = $this->request->param('teacher_id', 0, 'intval');

        if (Db::name('teacher')->delete($teacher_id) !== false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }
}