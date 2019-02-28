<?php
/**
 * @author Sylar Daemon
 * @version 1.0
 */

namespace Home\Model\MsgBean;

/**
 * Class LocationMsg
 * @package Home\Model
 */
class LocationMsg extends Msg {
    /**
     * @var double $Location_X 地理位置纬度 latitude
     */
    private $Location_X;
    /**
     * @var double $Location_Y 地理位置经度 longitude
     */
    private $Location_Y;
    /**
     * @var int $Scale 地图缩放大小
     */
    private $Scale;
    /**
     * @var string 地图位置信息
     */
    private $Label;

    public function __construct(){
        $this->Location_X = null;
        $this->Location_Y = null;
        $this->Scale = null;
        $this->Label = null;
    }

    /**
     * @return float
     */
    public function getLocationX()
    {
        return $this->Location_X;
    }

    /**
     * @param float $Location_X
     */
    public function setLocationX($Location_X)
    {
        $this->Location_X = $Location_X;
    }

    /**
     * @return float
     */
    public function getLocationY()
    {
        return $this->Location_Y;
    }

    /**
     * @param float $Location_Y
     */
    public function setLocationY($Location_Y)
    {
        $this->Location_Y = $Location_Y;
    }

    /**
     * @return int
     */
    public function getScale()
    {
        return $this->Scale;
    }

    /**
     * @param int $Scale
     */
    public function setScale($Scale)
    {
        $this->Scale = $Scale;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->Label;
    }

    /**
     * @param string $Label
     */
    public function setLabel($Label)
    {
        $this->Label = $Label;
    }

}