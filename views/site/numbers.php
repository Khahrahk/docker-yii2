<?php
/** @var app\models\GroupForm $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<br>
<div class="row">
    <div class="panel-heading col-3">ФИО</div>
    <div class="panel-heading col-2">Дата рождения</div>
    <div class="panel-heading col-2">Местонахождение</div>
    <div class="panel-heading col-3">Номер телефона</div>
    <div class="dropdown col-2">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Сгруппировать по
        </button>
        <ul class="dropdown-menu">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'groupby')->radioList([0 => ' Имени', 1 => ' Дате рождения', 2 => ' Локации'],
                [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $return = '<label class="modal-radio">';
                        $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                        $return .= '<i></i>';
                        $return .= '<span>' . ucwords($label) . '</span>';
                        $return .= '</label><br>';

                        return $return;
                    }
                ])->label(false); ?>
            <br>
            <li><?= Html::submitButton('Сгруппировать', ['class' => 'dropdown-item btn btn-primary', 'name' => 'login-button']) ?></li>
            <?php ActiveForm::end(); ?>
        </ul>
    </div>
</div>
<br>
<hr class="hr_product"><br>
<?php foreach ($posts as $post): ?>
    <div class="panel panel-default row" id="content">
        <div class="panel-heading col-3"><?= $post->Full_name ?></div>
        <div class="panel-heading col-2"><?= substr($post->DOB, 0, 10); ?></div>
        <div class="panel-heading col-2"><?= $post->Location ?></div>
        <div class="panel-heading col-3">
            <?php
            foreach ($post->number as $n) {
                echo $res = $n->number; ?> <br> <?php
            }
            ?>
        </div>
    </div>
    <br><br>
    <hr style="opacity: 10%" class="hr_product">
<?php endforeach; ?>
<?php
//$request = Yii::$app->request;
//$res2 = $request->get('res_model');
?>
<br><br>
<div class="row">
    <div class="col-4"></div>
    <div class="col-4">
        <?php
        // Тут я не совсем понял как сделать переменную текущей "группировки" статичной, поэтому пагинацию решил пока убрать.
        //echo yii\widgets\LinkPager::widget([
        //    'pagination' => $pages,
        //    'hideOnSinglePage' => true,
        //    'prevPageLabel' => '&laquo; назад',
        //    'nextPageLabel' => 'далее &raquo;',
        //    'maxButtonCount' => 3,
        //
        //    // Настройки контейнера пагинации
        //    'options' => [
        //        'tag' => 'nav',
        //        'class' => 'pagination',
        //        'id' => 'pager-container',
        //    ],
        //
        //    // Настройки классов css для ссылок
        //    'linkOptions' => ['class' => 'page-link'],
        //    'activePageCssClass' => 'active',
        //    'disabledPageCssClass' => 'page-link',
        //
        //]);
        ?>
    </div>
    <div class="col-4"></div>
</div>
