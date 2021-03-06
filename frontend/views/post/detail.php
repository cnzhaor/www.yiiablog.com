<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use frontend\components\TagCloudWidget;
use frontend\components\RctReplyWidget;
use yii\helpers\HtmlPurifier;
use common\models\Comment;
use common\models\User;
use yii\helpers\Url;
use common\models\Post;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->title;
?>
<div class="container">

    <div class="row">

        <div class="col-md-9">

            <ul class="breadcrumb">
                <li><a href="<?= Yii::$app->homeUrl;?>">首页</a></li>
                <li><a href="<?= Url::to(['post/index'])?>">文章列表</a></li>
                <li><?=$model->title?></li>

            </ul>
            
            <div class="post">

                <div class="title">
                    <h2><a href="<?=$model->url;?>"><?=Html::encode($model->title);?></a></h2>
                </div>
                <br>

                <div class="author">
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                    <em><?= date('Y-m-d H:i:s',$model->create_time)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>

                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <em><?= Html::encode($model->author->nickname);?></em>
                </div>
                <br>

                <div class="content">
                    <?= HtmlPurifier::process($model->content)?>
                </div>
                <br>

                <div class="nav">
                    <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                    <?= implode(', ',$model->tagLinks);?>
                    <br>
                    <?= Html::a("评论 ($model->commentCount)",$model->url.'#comments')?> | 最后修改于 <?= date('Y-m-s H:i:s',$model->update_time);?>
                </div>
                <br>

            </div>

            <div class="comments" id="comments">
                <?php if($added === 1) {?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <h4>谢谢您的回复，我们会尽快审核后发布出来！</h4>

                        <p><?=nl2br($commentModel->content);?></p>

                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                        <em><?= date('Y-m-d H:i:s',$commentModel->create_time)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <em><?= Html::encode($commentModel->user->username);?></em>
                    </div>
                <?php } elseif($added === 0 && !User::findOne(Yii::$app->user->id)){?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <h4>登录后发布评论...</h4>

                    </div>
                <?php }?>

                <?php if($model->commentCount>=1) :?>

                    <h5><?= $model->commentCount.'条评论';?></h5>
                    <?= $this->render('_comment',array(
                        'post'=>$model,
                        'comments'=>$model->activeComments,
                    ));?>
                <?php endif;?><br>

                <h5>发表评论</h5>
                <?php
                $commentModel =new Comment();
                echo $this->render('_guestform',array(
                    'id'=>$model->id,
                    'commentModel'=>$commentModel,
                ));?>
            </div>

        </div>



        <div class="col-md-3">
            <div class="searchbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>查找文章
                        (<?=Post::find()->count()?>)
                    </li>
                    <li class="list-group-item">
<!--                        <form class="form-inline" action="index.php?r=post/index" id="w0" method="get">-->
                        <form class="form-inline" action="<?= Url::home()?>" id="w0" method="get">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="PostSearch[title]" id="w0input" placeholder="按标题">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">搜索</button>
                        </form>
                    </li>
                </ul>
            </div>

            <div class="tagcloudbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>标签云
                    </li>
                    <li class="list-group-item">
                        <?= TagCloudWidget::widget(['tags'=>$tags])?>
                    </li>
                </ul>
            </div>

            <div class="commentbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>最新回复
                    </li>
                        <?= RctReplyWidget::widget(['recentComments'=>$recentComments])?>
                </ul>
            </div>
        </div>

    </div>

</div>
