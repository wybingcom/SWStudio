<?php
/**
 * Created by PhpStorm.
 * User: wybing
 * Date: 2019/7/27
 * Time: 12:08
 */
namespace app\admin\controller;
use cmf\controller\AdminBaseController;
use think\Db;

class JoinController extends AdminBaseController
{
    public function index()
    {
        $lists = Db::name('join')->order("join_id DESC")->paginate(10);
        // 获取分页显示
        $page = $lists->render();
        $this->assign('lists',  $lists);
        $this->assign("page", $page);
        return $this->fetch();
    }
    public function edit()
    {
        if($this->request->isPost()){
            $param = $this->request->post();
            $validate = $this->validate($param,[
                'join_id|ID' => 'integer|require',
//                'join_stuimg|照片' => 'require',
                'join_name|姓名' => 'require',
                'join_college|学号' => 'require',
                'join_stuid|学院' => 'require',
                'join_department|系部' => 'require',
                'join_major|专业' => 'require',
                'join_class|班级' => 'require',
                'join_phone|电话' => 'require',
                'join_qq|QQ' => 'require',
                'join_address|地址' => 'require',
                'join_about|个人简介' => 'require',
                'join_state|录取状态' => 'require',
                'join_teacheropinion|教师意见' => 'require',
                'join_workopinion|工作室意见' => 'require',
            ]);
            if($validate !== true)
                $this->error($validate);

            $param['join_edit_time']=time();

            $result = Db::name('join')->update($param);
            if($result){
                $this->success('编辑成功',url('index'));
            }else{
                $this->error('数据无更改');
            }
        }else {
            $join_id = $this->request->param('join_id', 0, 'intval');
            $info = DB::name('join')->where(["join_id" => $join_id])->find();
            if(!$info){
                $this->error('没有信息');
            }
            $this->assign('info',$info);
            return $this->fetch();
        }
    }
    public function delete()
    {
        $join_id = $this->request->param('join_id', 0, 'intval');

        if (Db::name('join')->delete($join_id) !== false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }
    public function joinadmin()
    {
        $this->assign('join', cmf_get_option('join_info'));
        return $this->fetch();
    }
    public function joinadminedit()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param('join/a');
            $validate = $this->validate($param,[
                'title|标题' => 'require',
                'startTime|开始时间' => 'require|date',
                'endTime|结束时间' => 'require|date',
            ]);
            if($validate !== true)
                $this->error($validate);

            //时间比较
            if(strtotime($param['startTime'])>strtotime($param['endTime'])){
                $this->error("开始时间不能大于结束时间");
            }

            //数据存放在cmf_option  ->  join_info
            $options = $this->request->param('join/a');
            cmf_set_option('join_info', $options);
        }
        $this->assign('join', cmf_get_option('join_info'));
        $this->success("保存成功！", '');
    }
    public function joined()
    {
        $join_id = $this->request->param('join_id', 0, 'intval');
        $join_join_time=time();
        $result=Db::name('join')->where('join_id', $join_id)->update(['join_state' => 1,'join_join_time'=>$join_join_time]);
        if($result){
            $this->success('编辑成功',url('index'));
        }else{
            $this->error('数据无更改');
        }
    }
}