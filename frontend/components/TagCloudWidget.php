<?php
/**
 * Created by PhpStorm.
 * User: 睿
 * Date: 2017-04-26
 * Time: 12:23
 */
namespace frontend\components;

use yii\bootstrap\Widget;
use Yii;
use yii\helpers\Url;

class TagCloudWidget extends Widget
{
    public $tags;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $tagString = '';
        //每个级别的样式,用来构建标签字符串
        $fontStyle = array("6" => "danger",
            "5" => "info",
            "4" => "warning",
            "3" => "primary",
            "2" => "success",
        );

        foreach ($this->tags as $tag => $weight) {
            //定义标签显示的样式,连接地址,display:inline-block样式效果:各个标签纵向交错显示
            $url = Url::to(['post/index','PostSearch[tags]'=>$tag]);
            //$url = Yii::$app->urlManager->createUrl(['post/index','PostSearch[tags]'=>$tag]);
            $tagString .= '<a href="'. $url .'">' .
                ' <h' . $weight . ' style="display:inline-block;"><span class="label label-'
                . $fontStyle[$weight] . '">' . $tag . '</span></h' . $weight . '></a>';
        }
        //sleep(3);
        return $tagString;
    }
}