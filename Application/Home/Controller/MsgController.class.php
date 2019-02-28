<?php
namespace Home\Controller;
use Think\Controller;

class MsgController{
    /**
     * @var \Home\MsgBean\Msg $RecvMsg 接收消息
     */
    private $RecvMsg;
    /**
     * @var \SimpleXMLElement $msgSource 消息来源
     */
    private $msgSource;
    /**
     * @var string $msgType 消息来源的消息类型
     */
    private $msgType;


    /**
     * MsgController constructor.
     */
    public function __construct(){
        $this->msgSource = null;

        $this->RecvMsg = null;
    }
    /**
     * @param \SimpleXMLElement $msgSource xml数组对象
     */
    public function setMsgSource($msgSource)
    {
        //消息来源设置
        $this->msgSource = $msgSource;
        //接收的消息类型设置
        $this->getMsgType();
        //初始化接收消息
        $this->initRecvMsgType();
    }

    private function getMsgType(){
        $this->msgType = strtolower((string)$this->msgSource->MsgType);
    }

    private function initRecvMsgType(){
        //new对应的消息类型对象
        $temp = '\Home\Model\MsgBean\\'.ucfirst($this->msgType) . 'Msg';
        $this->RecvMsg = new $temp();

        $this->RecvMsg->setFromUserName((string)$this->msgSource->FromUserName);
        $this->RecvMsg->setToUserName((string)$this->msgSource->ToUserName);
        $this->RecvMsg->setCreateTime((string)$this->msgSource->CreateTime);
        $this->RecvMsg->setMsgType($this->msgType);
        switch ($this->msgType){
            case 'event':
                $this->RecvMsg->setEvent((string)$this->msgSource->Event);
                break;

            case 'text':
                $this->RecvMsg->setContent((string)$this->msgSource->Content);
                break;

            case 'location':
                $this->RecvMsg->setLocationX((double)$this->msgSource->Location_X);
                $this->RecvMsg->setLocationY((double)$this->msgSource->Location_Y);
                $this->RecvMsg->setScale((int)$this->msgSource->Scale);
                $this->RecvMsg->setLabel((string)$this->msgSource->Label);

                break;
            default:

                break;
        }

    }

    public function process(){
        switch ($this->msgType){
            case 'event':
                $e_Proc = new \Home\MsgProcess\Event($this->RecvMsg);
                echo $e_Proc->process();
                break;
            case 'text':
                $t_Proc = new \Home\MsgProcess\Text($this->RecvMsg);
                echo $t_Proc->process();
                break;
            case 'location':
                $l_Proc = new \Home\MsgProcess\Location($this->RecvMsg);
                echo $l_Proc->process();
                break;
            default :
                echo 'success';
                break;
        }
    }

}