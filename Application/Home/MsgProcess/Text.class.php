<?php
/**
 * @author Sylar Daemon
 * @version 1.0
 */
namespace Home\MsgProcess;

class Text{
    /**
     * @var \Home\Model\MsgBean\TextMsg $RecvMsg 接收消息
     */
    private $RecvMsg;
    /**
     * @var \Home\Model\MsgBean\Msg $SendMsg 接收消息
     */
    private $SendMsg;
    /**
     * @var string
     */
    private static $Template = '<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>';

    public function __construct(\Home\Model\MsgBean\TextMsg $RecvMsg){
        $this->RecvMsg = $RecvMsg;
        $this->SendMsg = new \Home\Model\MsgBean\TextMsg();
    }
    public function process(){
        $this->SendMsg->setToUserName($this->RecvMsg->getFromUserName());
        $this->SendMsg->setFromUserName($this->RecvMsg->getToUserName());
        $this->SendMsg->setContent($this->RecvMsg->getContent());
        
        return $this->initSendMsg();
    }
    private function initSendMsg(){
        return sprintf(self::$Template,$this->SendMsg->getToUserName(),$this->SendMsg->getFromUserName(),time(),$this->SendMsg->getContent());
    }
}