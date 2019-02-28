<?php
/**
 * Created by PhpStorm.
 * User: Sylar
 * Date: 2018/7/15
 * Time: 14:12
 */

/**
 * @param string $time
 * @return false|int
 * 将Y-m-d H:i:s 格式字符串时间转换成UNIX时间戳
 */
function timeStampStringToUNIXStamp($time){
    return strtotime($time);
}

/**
 * @param string $time
 * @return false|string
 * 将UNIX时间戳转换成Y-m-d H:i:s 格式字符串时间
 */
function UNIXStampToString($time){
    return date("Y-m-d H:i:s",$time);
}