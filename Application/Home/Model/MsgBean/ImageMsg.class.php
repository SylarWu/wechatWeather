<?php
/**
 * @author Sylar Daemon
 * @version 1.0
 */

namespace Home\Model\MsgBean;

class ImageMsg extends Msg{
    /**
     * @var string $PicUrl 图片链接
     */
    private $PicUrl;
    /**
     * @var int $MediaId 图片消息媒体Id
     */
    private $MediaId;

    public function __construct(){
        $this->PicUrl = null;
        $this->MediaId = null;
    }

    /**
     * @return string
     */
    public function getPicUrl()
    {
        return $this->PicUrl;
    }

    /**
     * @param string $PicUrl
     */
    public function setPicUrl($PicUrl)
    {
        $this->PicUrl = $PicUrl;
    }

    /**
     * @return int
     */
    public function getMediaId()
    {
        return $this->MediaId;
    }

    /**
     * @param int $MediaId
     */
    public function setMediaId($MediaId)
    {
        $this->MediaId = $MediaId;
    }

}