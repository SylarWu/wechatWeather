<?php
/**
 * @author Sylar Daemon
 * @version 1.0
 */

namespace Home\Model\MsgBean;
/**
 * Class TextMsg
 * @package Home\Model
 */
class TextMsg extends Msg {
    /**
     * @var string $Content 消息内容
     */
    private $Content;

    /**
     * TextMsg constructor.
     */
    public function __construct(){
        $this->Content = null;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->Content;
    }

    /**
     * @param string $Content
     */
    public function setContent($Content)
    {
        $this->Content = $Content;
    }

}
