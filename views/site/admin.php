<?php
/**
 * @var \yii\data\Pagination $pagination
 */

/** @var yii\bootstrap5\ActiveForm $form */

use yii\bootstrap5\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\grid\CheckboxColumn;
use yii\grid\GridView;
use yii\helpers\Html;

?>
<br>

<div class="row">
    <div class="col-1">
        <?= Html::a('Создать', ['groupcreate'], ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="col-4 pt-2">
        Сгруппировать по: <?php echo $sort->link('id') . ' | ' . $sort->link('name'); ?>

    </div>
</div>
<br><br>
<div class="row">
    <div class="panel-heading col-1">id</div>
    <div class="panel-heading col-2">Группа</div>
</div>
<hr class="hr_numbers"><br>
<?php
foreach ($model as $item) {
    echo "<br>";
    echo '<div class="row">';
    echo "<div class='panel-heading col-1'>" . $item->id . "</div>";
    echo "<div class='panel-heading col-2'>" . $item->name . "</div>";
    echo "<div class='col-4'>";
    echo '<span>' . Html::a('Редактировать', ['groupedit', 'id' => $item->id], ['class' => 'btn btn-secondary', 'style' => 'margin-left: 5px']) . '</span>';
    echo '<span>' . Html::a('Удалить', ['groupdelete', 'id' => $item->id], ['class' => 'btn btn-danger', 'style' => 'margin-left: 5px']) . '</span>';
    echo "</div>";
    echo "</div>";
    echo '<br>';
    echo '<hr class="hr_numbers" style="opacity: 10%">';
}
?>
<br><br>
<div class="row">
    <div class="col-4"></div>
    <div class="col-4">
        <?php
        echo \yii\widgets\LinkPager::widget([
            'pagination' => $pagination,
            'hideOnSinglePage' => true,
            'prevPageLabel' => '&laquo; назад',
            'nextPageLabel' => 'далее &raquo;',
            'maxButtonCount' => 3,

            // Настройки контейнера пагинации
            'options' => [
                'tag' => 'nav',
                'class' => 'pagination',
                'id' => 'pager-container',
            ],

            // Настройки классов css для ссылок
            'linkOptions' => ['class' => 'page-link'],
            'activePageCssClass' => 'active',
            'disabledPageCssClass' => 'page-link',
        ])
        ?>
    </div>
    <div class="col-4"></div>
</div>