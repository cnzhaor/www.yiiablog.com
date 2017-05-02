<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Poststatus;
use common\models\Adminuser;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

    <?php
    /* 
    1.
    $psObjs = Poststatus::find()->all();
    $allStatus = ArrayHelper::map($psObjs,'id','name');
    2.
    $allStatus = (new \yii\db\query())
    			->select(['name','id'])
    			->from('poststatus')
    			->indexBy('id')
    			->column();
	3.推荐
	$allStatus = Poststatus::find()
    			->select(['name','id'])
    			->orderby('position')
    			->indexby('id')
    			->column();
    */    
    ?>
    <?= $form->field($model, 'status')
    ->dropDownList(Poststatus::find()
	    			->select(['name','id'])
	    			->orderby('position')
	    			->indexby('id')
	    			->column(),
	    			['prompt'=>'请选择']); ?>
    
    <?= $form->field($model, 'author_id')
    ->dropDownList(adminuser::find()
	    			->select(['nickname','id'])
	    			->indexby('id')
	    			->column(),
	    			['prompt'=>'请选择']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
