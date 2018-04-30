<?php

header("Content-type:text/html;charset=utf-8");

/**
 * 生成二维码 吴智彬
 * @param  string  $url  url连接
 * @param  integer $size 尺寸 纯数字
 */
function qrcode($url,$size=4){
    Vendor('Phpqrcode.phpqrcode');
    QRcode::png($url,false,QR_ECLEVEL_L,$size,2,false,0xFFFFFF,0x000000);
}


/**
 * 价格/100   用于页面显示
 * @param $num
 * @return string
 */
function html_price($num){
    return number_format(intval(trim($num), 10)/100,2);
}