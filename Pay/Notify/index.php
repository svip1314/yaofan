<?php
/*
 * 支付异步
 * Author：烟雨寒云
 * Mail：admin@yyhy.me
 * Date:2019/10/13
 */

include '../../Core/Common.php';

$data = $_REQUEST;
$pay = new Pay(config('pid'), config('key'),config('api'));
if ($pay->verify($data)) {
    $order = Db('select * from yyhy_order where trade_no="' . $data['out_trade_no'] . '"');
    if (!$order) exit('fail');
    $order = $order[0];
    if ($order['status'] != 1) {
        Db('update yyhy_order set `status`=1,`endtime`="' . date('Y-m-d H:i:s') . '" where trade_no="' . $data['out_trade_no'] . '"');
    }
    echo 'success';
} else {
    echo 'fail';
}