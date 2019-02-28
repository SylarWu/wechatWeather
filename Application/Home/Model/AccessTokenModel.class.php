<?php
/**
 * Created by PhpStorm.
 * User: Sylar
 * Date: 2018/7/12
 * Time: 20:17
 *
 * 获取远程
 *
 */
namespace Home\Model;
use Think\Model;

class AccessTokenModel extends Model{

    /**
     * @var string
     * 获取全局AccessToken微信后台地址
     */
    private $url_request = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=%s&appid=%s&secret=%s';

    /**
     * @var string
     * grant_type
     */
    private $grant_type = 'client_credential';

    /**
     * @var string
     * 我的公众号appid
     */
    private $appid = 'wx6be29eeb0e5990b8';

    /**
     * @var string
     * 我的公众号安全码
     */
    private $appsecret = '8643d161f669c2776d4f6ef80cf905ab';
    /**
     * @var AccessToken
     * 全局AccessToken
     */
    private $AccessToken;

    /**
     * AccessTokenModel constructor.
     */
    public function __construct(){
        parent::__construct();
        $this->AccessToken = \Home\Model\AccessToken::getInstance();
    }

    /**
     * @return string
     * 返回AccessToken
     */
    public function getAccessToken(){
        //首先从本地数据库中获取AccessToken
        $this->getAccessTokenFromDB();

        if ($this->AccessToken->getAccessToken() != null){
            //数据库中不为null
            //检测消亡时间
            if ($this->checkTime()){

                return $this->AccessToken->getAccessToken();

            }else {

                $this->updateAccessToken();

                return $this->AccessToken->getAccessToken();

            }
        }else {
            //数据库中为null从远程获取并加载到内存保存到数据库
            $this->updateAccessToken();

            return $this->AccessToken->getAccessToken();
        }
    }

    /**
     * @return bool
     * 检测AccessToken销毁时间
     */
    private function checkTime(){
        $now = time();

        $elapse = $this->AccessToken->getEndTime() - $now;

        //该AccessToken距离消亡时间五分钟需要重新获取
        if ($elapse <= 3000){
            return false;
        }else {
            return true;
        }
    }

    private function completeURL(){
        return sprintf($this->url_request,$this->grant_type,$this->appid,$this->appsecret);
    }

    private function updateAccessToken(){
        $this->getAccessTokenFromRemote();
        $this->saveToDB();
    }

    //从数据库中获取AccessToken
    private function getAccessTokenFromDB(){
        $result = $this->limit(1)->find();
        //加载到内存中
        $this->AccessToken->setId($result['id']);
        $this->AccessToken->setAccessToken($result['access_token']);
        $this->AccessToken->setEndTime(timeStampStringToUNIXStamp($result['end_time']));
    }

    //获取微信后台端口AccessToken
    private function getAccessTokenFromRemote(){
        //初始化远程地址
        $remote_url = $this->completeURL();
        //初始化curl句柄
        $curl_obj = curl_init();
        //设置curl参数
        curl_setopt($curl_obj,CURLOPT_URL,$remote_url);
        curl_setopt($curl_obj,CURLOPT_RETURNTRANSFER,1);
        //得到结果
        $result = curl_exec($curl_obj);
        //关闭curl句柄
        curl_close($curl_obj);
        //json解码
        $json_info = json_decode($result,TRUE);
        //加载到内存中
        $this->AccessToken->setId(1);
        $this->AccessToken->setAccessToken($json_info['access_token']);
        $this->AccessToken->setEndTime(time()+$json_info['expires_in']);
    }
    //将内存中AccessToken保存到数据库中
    private function saveToDB(){
        $data = array();

        $data['id'] = 1;
        $data['access_token'] = $this->AccessToken->getAccessToken();
        $data['end_time'] = UNIXStampToString($this->AccessToken->getEndTime());

        $this->data($data)->save();
    }



}
