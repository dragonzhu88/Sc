<?php
namespace sc\Controller;

use Think\Controller;

class IndexController extends Controller
{

    public function index()
    {
        $dbData = D('bet_level')->select();
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
