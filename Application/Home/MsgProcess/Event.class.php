<?php
/**
 * @author Sylar Daemon
 * @version 1.0
 */
namespace Home\MsgProcess;

class Event{
    /**
     * @var \Home\Model\MsgBean\EventMsg $RecvMsg 接收消息
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

    public function __construct(\Home\Model\MsgBean\EventMsg $RecvMsg){
        $this->RecvMsg = $RecvMsg;
        $this->SendMsg = new \Home\Model\MsgBean\TextMsg();
    }
    public function process(){
        $this->SendMsg->setToUserName($this->RecvMsg->getFromUserName());
        $this->SendMsg->setFromUserName($this->RecvMsg->getToUserName());
        if ($this->RecvMsg->getEvent() == 'subscribe'){

            $this->SendMsg->setContent('欢迎关注阿磊风云间！');

            return $this->initSendMsg();

        }else if($this->RecvMsg->getEvent() == 'unsubscribe'){
            return 'success';
        }
    }
    private function initSendMsg(){
        return sprintf(self::$Template,$this->SendMsg->getToUserName(),$this->SendMsg->getFromUserName(),time(),$this->SendMsg->getContent());
    }
}