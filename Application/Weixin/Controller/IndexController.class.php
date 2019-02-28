<?php

namespace Weixin\Controller;

use Think\Controller;

class IndexController extends Controller
{

    public function index()
    {

        /*$at_obj = M('AccessToken.class');

        dump($at_obj);*/

    }

    public function tokenCheck()
    {
        $echostr = $_GET['echostr'];

        if ($echostr) {
            if ($this->checkSignature()){
                echo $echostr;
            }else {
                exit(0);
            }
        } else {
            if ($this->checkSignature()){
                $this->msgProc();
            }else {
                exit(0);
            }
        }

    }

    private function checkSignature(){
        $signature = $_GET['signature'];

        $timestamp = $_GET['timestamp'];

        $nonce = $_GET['nonce'];
        $tmpArr = array(C('TOKEN'), $timestamp, $nonce);

        sort($tmpArr, SORT_STRING);

        $tmpStr = implode($tmpArr);

        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    private function msgProc(){

        //1.接受数据
        $postArr = $GLOBALS['HTTP_RAW_POST_DATA']; //接受xml数据
        //2.处理消息类型,推送消息
        $postObj = simplexml_load_string($postArr); //将xml数据转化为对象
        if (strtolower($postObj->MsgType) == 'event') {
            //关注公众号事件
            if (strtolower($postObj->Event) == 'subscribe') {
                $toUser = $postObj->FromUserName;
                $fromUser = $postObj->ToUserName;
                $time = time();
                $msgType = 'text';
                $content = '欢迎关注阿磊风云间！';
                $template = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <Content><![CDATA[%s]]></Content>
                               </xml>";
                echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
            }
        }
        //回复文本信息
        if (strtolower($postObj->MsgType) == 'text') {
            $toUser = $postObj->FromUserName;
            $fromUser = $postObj->ToUserName;
            $time = time();
            $msgType = 'text';
            $content = $postObj->Content;
            $template = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <Content><![CDATA[%s]]></Content>
                               </xml>";
            echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);

        }
    }


}

