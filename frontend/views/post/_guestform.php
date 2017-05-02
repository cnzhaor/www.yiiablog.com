<?php
/**
 * Created by PhpStorm.
 * User: 睿
 * Date: 2017-04-26
 * Time: 22:35
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Commentstatus;

?>
<div class="comment-form">

    <?php $form = ActiveForm::begin([
        'action'=>['post/detail','id'=>$id,'#'=>'comments'],
        'method'=>'post'
    ]); ?>

    <?= $form->field($commentModel, 'content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($commentModel->isNewRecord ? '发布' : '修改', ['class' => $commentModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
