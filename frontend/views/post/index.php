<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use frontend\components\TagCloudWidget;
use frontend\components\RctReplyWidget;
use common\models\Post;
use yii\caching\DbDependency;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '首页-文章列表';
?>
<div class="container">

    <div class="row">

        <div class="col-md-9">

            <ul class="breadcrumb">
                <li><a href="<?= Yii::$app->homeUrl;?>">首页</a></li>
                <li>文章列表</li>

            </ul>

            <?= ListView::widget([
                'id'=>'postList',
                'dataProvider'=>$dataProvider,
                'itemView'=>'_listitem',//子视图,显示一篇文章的标题等内容.
                'layout'=>'{items} {pager}',
                'pager'=>[
                    'maxButtonCount'=>10,
                    //'nextPageLabel'=>Yii::t('app','下一页'),
                    //'prevPageLabel'=>Yii::t('app','上一页'),
                ],
            ])?>
        </div>

        <div class="col-md-3">
            <div class="searchbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>查找文章
                        (<?php
                        //测试缓存
                        /*$data = Yii::$app->cache->get('postCount');
                        if (!$data)
                        {
                            $dependency = new DbDependency(
                                ['sql'=>'SELECT COUNT(id) FROM post']);
                            $data = Post::find()->count(); sleep(5);
                            Yii::$app->cache->set('postCount',$data,600, $dependency);
                        }
                        echo $data;*/
                        ?><?=Post::find()->count()?>)
                    </li>
                    <li class="list-group-item">
                        <form class="form-inline" action="index.php?r=post/index" id="w0" method="get">
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
                        <?/*测试片段缓存
                            $dependency = new DbDependency(
                            ['sql'=>'SELECT COUNT(id) FROM post']);

                            if ($this->beginCache('cache',['duration'=>600], ['dependency'=>$dependency]))
                            {
                                echo TagCloudWidget::widget(['tags'=>$tags]);
                                $this->endCache();
                            }*/
                        ?>
                        <?= TagCloudWidget::widget(['tags'=>$tags]);?>
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
