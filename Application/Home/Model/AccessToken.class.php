<?php
/**
 * @author Sylar Daemon
 * @version 1.0
 *
 */

namespace Home\Model;


/**
 * Class AccessToken
 * @package Home\Model
 */
class AccessToken
{
    /**
     * @var string $id 在数据库中id
     */
    private $id ;

    /**
     * @var string $access_token 获取到的access_token
     */
    private $access_token;

    /**
     * @var string $end_time 销毁时间UNIX时间戳格式
     */
    private $end_time;

    /**
     * @var AccessToken $instance 这里使用单例模式
     */
    private static $instance = null;

    /**
     * @return AccessToken
     */
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new AccessToken();
        }
        return self::$instance;
    }

    /**
     * AccessToken constructor.
     */
    private function __construct(){
        $this->id = null;
        $this->access_token = null;
        $this->end_time = null;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * @return string
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @param string $end_time
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
    }
}