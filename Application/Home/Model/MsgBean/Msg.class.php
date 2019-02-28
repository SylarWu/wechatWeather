<?php
/**
 * @author Sylar Daemon
 * @version 1.0
 */
namespace Home\Model\MsgBean;

/**
 * Class Msg
 * @package Home\Model
 */
class Msg{
    /**
     * @var string $ToUserName 消息目的微信号
     */
    private $ToUserName;
    /**
     * @var string $FromUserName 消息来源微信号
     */
    private $FromUserName;

    /**
     * @var int $CreateTime 消息创建时间
     */
    private $CreateTime;

    /**
     * @var string $MsgType 消息类型
     */
    private $MsgType;

    /**
     * @var int $MsgId 消息id
     */
    private $MsgId;

    /**
     * Msg constructor.
     */
    public function __construct(){
        $this->ToUserName = null;
        $this->FromUserName = null;
        $this->CreateTime = null;
        $this->MsgType = null;
        $this->MsgId = null;
    }


    /**
     * @return string
     */
    public function getToUserName()
    {
        return $this->ToUserName;
    }

    /**
     * @param string $ToUserName
     */
    public function setToUserName($ToUserName)
    {
        $this->ToUserName = $ToUserName;
    }

    /**
     * @return string
     */
    public function getFromUserName()
    {
        return $this->FromUserName;
    }

    /**
     * @param string $FromUserName
     */
    public function setFromUserName($FromUserName)
    {
        $this->FromUserName = $FromUserName;
    }

    /**
     * @return int
     */
    public function getCreateTime()
    {
        return $this->CreateTime;
    }

    /**
     * @param int $CreateTime
     */
    public function setCreateTime($CreateTime)
    {
        $this->CreateTime = $CreateTime;
    }

    /**
     * @return string
     */
    public function getMsgType()
    {
        return $this->MsgType;
    }

    /**
     * @param string $MsgType
     */
    public function setMsgType($MsgType)
    {
        $this->MsgType = $MsgType;
    }
    /**
     * @return int
     */
    public function getMsgId()
    {
        return $this->MsgId;
    }

    /**
     * @param int $MsgId
     */
    public function setMsgId($MsgId)
    {
        $this->MsgId = $MsgId;
    }


}