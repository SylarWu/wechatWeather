<?php
/**
 * @author Sylar Daemon
 * @version 1.0
 */

namespace Home\Model\MsgBean;
class EventMsg extends Msg{
    /**
     * @var string $Event 事件
     */
    private $Event;

    /**
     * EventMsg constructor.
     * @param string $Event
     */
    public function __construct()
    {
        $this->Event = null;
    }


    /**
     * @return string
     */
    public function getEvent()
    {
        return $this->Event;
    }

    /**
     * @param string $Event
     */
    public function setEvent($Event)
    {
        $this->Event = $Event;
    }

}