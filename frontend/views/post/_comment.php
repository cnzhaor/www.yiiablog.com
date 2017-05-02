<?php
/**
 * Created by PhpStorm.
 * User: 睿
 * Date: 2017-04-26
 * Time: 22:36
 */
use yii\helpers\Html;
?>

<? foreach ($comments as $comment) :?>
    <div class="">
        <p class="bg-info">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            <em><?= Html::encode($comment->user->username)?></em><br>
            <?=nl2br($comment->content);?><br>
            <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
            <em><?= date('Y-m-d H:i:s',$comment->create_time)?></em>
        </p>
    </div>
<? endforeach;?>
