<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\WeatherInfo;

class IndexController extends Controller {

    /**
     * @var \Home\Controller\MsgController 消息控制器
     */
    private $MsgController;

    public function __construct(){
        $this->MsgController = new MsgController();
    }

    public function index(){
        /*
        $weatherinfo = new WeatherInfo(30.438515,114.264999);

        $infoArr = $weatherinfo->getWeatherInfo();

        $Content = "当前大致天气情况如下：\n";
        $Content .= '体感温度：'.$infoArr['current']['feelsLike']['value'].$infoArr['current']['feelsLike']['unit']."\n";
        $Content .= '相对湿度：'.$infoArr['current']['humidity']['value'].$infoArr['current']['humidity']['unit']."\n";
        $Content .= '气压：'.$infoArr['current']['pressure']['value'].$infoArr['current']['pressure']['unit']."\n";
        $Content .= '温度：'.$infoArr['current']['temperature']['value'].$infoArr['current']['temperature']['unit']."\n";
        $Content .= '天气：'.$weatherinfo->getWeather($infoArr['current']['weather'])."\n";
        $Content .= '风向：'.$infoArr['current']['wind']['direction']['value'].$infoArr['current']['wind']['direction']['unit']."\n";
        $Content .= '风速：'.$infoArr['current']['wind']['speed']['value'].$infoArr['current']['wind']['speed']['unit']."\n";
        $Content .= '往后五天降雨概率：';
        for ($i = 0 ; $i < 4 ;$i++){
            $Content .= $infoArr['forecastDaily']['precipitationProbability']['value'][$i].'%,';
        }
        $Content .= $infoArr['forecastDaily']['precipitationProbability']['value'][4]."%\n";
        dump($Content);*/
    }
    public function tokenCheck()
    {
        $echostr = $_GET['echostr'];

        if ($echostr) {
            if ($this->checkSignature()){
                echo $echostr;
            }else {
                exit(0);
            }
        } else {
            if ($this->checkSignature()){
                $this->msgProc();
            }else {
                exit(0);
            }
        }
    }

    private function checkSignature(){
        $signature = $_GET['signature'];

        $timestamp = $_GET['timestamp'];

        $nonce = $_GET['nonce'];
        $tmpArr = array(C('TOKEN'), $timestamp, $nonce);

        sort($tmpArr, SORT_STRING);

        $tmpStr = implode($tmpArr);

        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    private function msgProc(){
        //接受xml数据
        $postStr = $GLOBALS['HTTP_RAW_POST_DATA'];
        //转换为XML对象
        $postObj = simplexml_load_string($postStr);
        //初始化消息控制器消息源
        $this->MsgController->setMsgSource($postObj);
        //消息处理器处理
        $this->MsgController->process();
    }
}
