<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \app\models\PostForm $model */

use app\models\Groups;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Post Create';
?>
<div class="site-login">
    <h1>Создание поста</h1>

    <p>Пожалуйста, заполните поля для создания:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($model, 'fullName') ?>

    <?= $form->field($model, 'date') ?>
    <?= $form->field($model, 'location') ?>
    <?= $form->field($model, 'number') ?>
    <?php
    $items = [];
    $model3 = Groups::find()->all();
    foreach ($model3 as $n) {
        array_push($items, $n->name);
    }
    ?>
    <?= $form->field($model, 'personGroup')->dropDownList($items, ['prompt' => 'Выберите']) ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
