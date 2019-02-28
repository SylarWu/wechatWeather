<?php
/**
 * @author Sylar Daemon
 * @version 1.0
 */

namespace Home\Model;

class WeatherInfo
{
    /**
     * @var string $remoteURL 获取天气的远程地址接口
     */
    private $remoteURL = 'https://weatherapi.market.xiaomi.com/wtr-v3/weather/all?latitude=%s&longitude=%s&locale=zh_cn&isGlobal=false&appKey=weather20151024&sign=zUFJoAR2ZVrDy1vF3D07';
    /**
     * @var double $locationX 纬度
     */
    private $locationX;

    /**
     * @var double $locationY 经度
     */
    private $locationY;

    private static $weatherMap = array(
        0 => '晴天',
        1 => '多云',
        2 => '阴天',
        3 => '阵雨',
        4 => '雷阵雨',
        5 => '雷阵雨并伴有冰雹',
        6 => '雨夹雪',
        7 => '小雨',
        8 => '中雨',
        9 => '大雨',
        10 => '暴雨',
        11 => '大暴雨',
        12 => '特大暴雨',
        13 => '阵雪',
        14 => '小雪',
        15 => '中雪',
        16 => '大雪',
        17 => '暴雪',
        18 => '雾',
        19 => '冻雨',
        20 => '沙尘暴',
        21 => '小雨-中雨',
        22 => '中雨-大雨',
        23 => '大雨-暴雨',
        24 => '暴雨-大暴雨',
        25 => '大暴雨-特大暴雨',
        26 => '小雪-中雪',
        27 => '中雪-大雪',
        28 => '大雪-暴雪',
        29 => '浮沉',
        30 => '扬沙',
        31 => '强沙尘暴',
        32 => '飑',
        33 => '龙卷风',
        34 => '若高吹雪',
        35 => '轻雾',
        53 => '霾',
        99 => '未知',
    );

    public function __construct($locationX, $locationY){
        //构造器获取地址信息：经纬度
        $this->locationX = $locationX;
        $this->locationY = $locationY;
    }

    private function completeRemoteURL(){
        return sprintf($this->remoteURL, $this->locationX, $this->locationY);
    }

    public function getWeatherInfo()
    {
        $curl_obj = curl_init();

        curl_setopt($curl_obj, CURLOPT_URL, $this->completeRemoteURL());
        curl_setopt($curl_obj, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl_obj);

        return json_decode($result, true);
    }
    public function getWeather($code){
        return self::$weatherMap[$code];
    }

}