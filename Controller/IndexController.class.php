<?php
namespace sc\Controller;

use Think\Controller;

class IndexController extends Controller
{


    public function index()
    {
        $dbData = D('bet_level')->select();
        foreach ($dbData as $k => $v){
            $dbData[$k]['bet_total'] = floatval($v['bet_total']);
            $dbData[$k]['grade_gift'] = floatval($v['grade_gift']);
            $dbData[$k]['week_gift'] = floatval($v['week_gift']);
            $dbData[$k]['month_gift'] = floatval($v['month_gift']);
        }
        $this->assign('list', $dbData);
        $this->display();
    }

    public function ajaxFun(){
        $data['user_name'] = $_POST['user_name'];
        $sum_bet = 0;
        $dbData = D('user_bet')->where($data)->select();
        foreach ($dbData as $k => $v){
            $sum_bet+= $v['bet'];
        }
        if($dbData){
            $whereData['bet_total'] = ['ELT', $sum_bet];
            $whereData['bet_total_max'] = ['egt', $sum_bet];
            $result = D('bet_level')->where($whereData)->select();
            foreach ($result as $k => $v){
                $result[$k]['bet_total'] = floatval($v['bet_total']);
                $result[$k]['grade_gift'] = floatval($v['grade_gift']);
                $result[$k]['week_gift'] = floatval($v['week_gift']);
                $result[$k]['month_gift'] = floatval($v['month_gift']);
            }
            if($result){
                $ret['code'] = 200;
                $ret['msg'] = '请求成功';
                $ret['data'] = $result;
            }else{
                $ret['code'] = 422;
                $ret['msg'] = '操作失败';
            }
        }else{
            $ret['code'] = 422;
            $ret['msg'] = '没有数据';
        }
        $this->ajaxReturn($ret);
    }
}
