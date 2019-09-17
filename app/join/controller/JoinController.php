<?php
/**
 * Created by PhpStorm.
 * User: wybing
 * Date: 2019/7/27
 * Time: 17:25
 */
namespace app\join\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class JoinController extends HomeBaseController
{
    public function index()
    {
        $lists = $result  = Db::name('slideItem')->where('slide_id', 1)->select();
        $this->assign('join', cmf_get_option('join_info'));
        $this->assign('lists',  $lists);
        return $this->fetch();
    }
    public function add()
    {
        //返回数据
        $status=0;
        $msg='Error';
        //如果不在时间段内
        $joindata=cmf_get_option('join_info');
        $nowTime=time();
        $startdate=strtotime($joindata['startTime']);
        $enddate=strtotime($joindata['endTime']);
        if(($nowTime < $startdate || $nowTime > $enddate)){
            $msg='非法提交[不在报名时间段内]';
            return json(['status'=>$status,'msg'=>$msg]);
        }
        //获取数据
        if($this->request->isPost()){
            $param = $this->request->post();
            //验证码
            $captcha = $param['captcha'];
            if (!cmf_captcha_check($captcha)) {
                $msg='验证码不正确';
                return json(['status'=>$status,'msg'=>$msg]);
            }

            $info = DB::name('join')->where(["join_stuid" => $param['join_stuid']])->count();
            if($info>=1){
                $msg="数据已存在，请联系工作室【网站管理员】进行删除";
            }else {
                $validate = $this->validate($param, [
                    'join_name|姓名' => 'require|max:20',
                    'join_college|学院' => 'require|max:20',
                    'join_stuid|学号' => 'require|max:20',
                    'join_department|系部' => 'require|max:20',
                    'join_major|专业' => 'require|max:20',
                    'join_class|班级' => 'require|max:20',
                    'join_phone|电话' => 'require|regex:1[2-9]{1}[0-9]{9}',
                    'join_qq|QQ' => 'require|max:20',
                    'join_address|地址' => 'require|max:100',
                    'join_about|个人简介' => 'require|max:200'
                ]);
                if ($validate !== true)
                    $this->error($validate);

                $data['join_name']=$param['join_name'];
                $data['join_gender']=$param['join_gender'];
                $data['join_college']=$param['join_college'];
                $data['join_stuid']=$param['join_stuid'];
                $data['join_department']=$param['join_department'];
                $data['join_major']=$param['join_major'];
                $data['join_class']=$param['join_class'];
                $data['join_phone']=$param['join_phone'];
                $data['join_qq']=$param['join_qq'];
                $data['join_address']=$param['join_address'];
                $data['join_about']=$param['join_about'];
                $data['join_create_time'] = time();

                $result = Db::name('join')->insertGetId($data);
                if ($result) {
                    $status = 1;
                    $msg = "提交成功";
                } else {
                    $msg = "提交失败";
                }
            }
        }else {
            $msg="获取数据失败";
        }
        return json(['status'=>$status,'msg'=>$msg]);
    }
}