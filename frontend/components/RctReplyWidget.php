<?php
/**
 * Created by PhpStorm.
 * User: 睿
 * Date: 2017-04-26
 * Time: 12:23
 */
namespace frontend\components;

use yii\bootstrap\Widget;
use yii\helpers\Html;

class RctReplyWidget extends Widget
{
    public $recentComments;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $commentString = '';

        foreach ($this->recentComments as $comment) {
            $commentString .= '<div class="list-group-item">'.
                '<p style="font-style: italic;color: #777777">'.
                nl2br($comment->content).'</p>'.

                '<p><span class="glyphicon glyphicon-user" aria-hidden="ture">
							</span>'.Html::encode($comment->user->username).'</p>'.

                '<p>《<a href="'.$comment->post->url.'">'.Html::encode($comment->post->title).'</a>》'.'</p>'.
                '</div>';
        }
        return $commentString;
    }
}