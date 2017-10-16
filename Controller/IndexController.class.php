<?php
namespace sc\Controller;

use Think\Controller;

class IndexController extends Controller
{


    public function index()
    {
        $dbData = D('bet_level')->select();
        foreach ($dbData as $k => $v){
            if(floatval($v['bet_total'] > 10000)){
                $dbData[$k]['bet_total'] = strval(floatval($v['bet_total'])/10000).'万';
            } else{
                $dbData[$k]['bet_total'] = floatval($v['bet_total']);
            }

            if(floatval($v['bet_total_max'] > 10000)){
                $dbData[$k]['bet_total_max'] = strval(floatval($v['bet_total_max'])/10000).'万';
            } else{
                $dbData[$k]['bet_total_max'] = floatval($v['bet_total_max']);
            }

            if(floatval($v['grade_gift'] > 10000)){
                $dbData[$k]['grade_gift'] = strval(floatval($v['grade_gift'])/10000).'万';
            } else{
                $dbData[$k]['grade_gift'] = floatval($v['grade_gift']);
            }

            if(floatval($v['week_gift'] > 10000)){
                $dbData[$k]['week_gift'] = strval(floatval($v['week_gift'])/10000).'万';
            } else{
                $dbData[$k]['week_gift'] = floatval($v['week_gift']);
            }

            if(floatval($v['month_gift'] > 10000)){
                $dbData[$k]['month_gift'] = strval(floatval($v['month_gift'])/10000).'万';
            } else{
                $dbData[$k]['month_gift'] = floatval($v['month_gift']);
            }
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
                if(floatval($v['bet_total'] > 10000)){
                    $dbData[$k]['bet_total'] = strval(floatval($v['bet_total'])/10000).'万';
                } else{
                    $dbData[$k]['bet_total'] = floatval($v['bet_total']);
                }

                if(floatval($v['bet_total_max'] > 10000)){
                    $dbData[$k]['bet_total_max'] = strval(floatval($v['bet_total_max'])/10000).'万';
                } else{
                    $dbData[$k]['bet_total_max'] = floatval($v['bet_total_max']);
                }

                if(floatval($v['grade_gift'] > 10000)){
                    $dbData[$k]['grade_gift'] = strval(floatval($v['grade_gift'])/10000).'万';
                } else{
                    $dbData[$k]['grade_gift'] = floatval($v['grade_gift']);
                }

                if(floatval($v['week_gift'] > 10000)){
                    $dbData[$k]['week_gift'] = strval(floatval($v['week_gift'])/10000).'万';
                } else{
                    $dbData[$k]['week_gift'] = floatval($v['week_gift']);
                }

                if(floatval($v['month_gift'] > 10000)){
                    $dbData[$k]['month_gift'] = strval(floatval($v['month_gift'])/10000).'万';
                } else{
                    $dbData[$k]['month_gift'] = floatval($v['month_gift']);
                }
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
