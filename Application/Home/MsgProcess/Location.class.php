<?php
/**
 * @author Sylar Daemon
 * @version 1.0
 */
namespace Home\MsgProcess;

class Location{
    /**
     * @var \Home\Model\MsgBean\LocationMsg $RecvMsg 接收消息
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

    public function __construct(\Home\Model\MsgBean\LocationMsg $RecvMsg){
        $this->RecvMsg = $RecvMsg;
        $this->SendMsg = new \Home\Model\MsgBean\TextMsg();
    }
    public function process(){
        $this->SendMsg->setToUserName($this->RecvMsg->getFromUserName());
        $this->SendMsg->setFromUserName($this->RecvMsg->getToUserName());
        $Content = "你所在的经纬度是：\n（".$this->RecvMsg->getLocationX().','.$this->RecvMsg->getLocationY().")。\n你的地址信息是：\n".$this->RecvMsg->getLabel()."\n";

        $weatherInfo = new \Home\Model\WeatherInfo($this->RecvMsg->getLocationX(),$this->RecvMsg->getLocationY());

        $infoArr = $weatherInfo->getWeatherInfo();

        $Content .= "当前大致天气情况如下：\n";
        $Content .= '体感温度：'.$infoArr['current']['feelsLike']['value'].$infoArr['current']['feelsLike']['unit']."\n";
        $Content .= '相对湿度：'.$infoArr['current']['humidity']['value'].$infoArr['current']['humidity']['unit']."\n";
        $Content .= '气压：'.$infoArr['current']['pressure']['value'].$infoArr['current']['pressure']['unit']."\n";
        $Content .= '温度：'.$infoArr['current']['temperature']['value'].$infoArr['current']['temperature']['unit']."\n";
        $Content .= '天气：'.$weatherInfo->getWeather($infoArr['current']['weather'])."\n";
        $Content .= '风向：'.$infoArr['current']['wind']['direction']['value'].$infoArr['current']['wind']['direction']['unit']."\n";
        $Content .= '风速：'.$infoArr['current']['wind']['speed']['value'].$infoArr['current']['wind']['speed']['unit']."\n";
        $Content .= '往后五天降雨概率：';
        for ($i = 0 ; $i < 4 ;$i++){
            $Content .= $infoArr['forecastDaily']['precipitationProbability']['value'][$i].'%,';
        }
        $Content .= $infoArr['forecastDaily']['precipitationProbability']['value'][4]."%\n";

        $this->SendMsg->setContent($Content);

        return $this->initSendMsg();
    }
    private function initSendMsg(){
        return sprintf(self::$Template,$this->SendMsg->getToUserName(),$this->SendMsg->getFromUserName(),time(),$this->SendMsg->getContent());
    }
}