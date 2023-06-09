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
        <?= Html::a('Создать', ['postcreate'], ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="col-4 pt-2">
        Сгруппировать по: <?php echo $sort->link('fullName') . ' | ' . $sort->link('date'); ?>
    </div>
    <div class="col-3"></div>
    <div class="col-3 pt-2">
        <form method="get" class="input-group" action="<?= \yii\helpers\Url::to(['site/search']) ?>">
            <input type="search" class="form-control rounded" placeholder="Введите имя" name="q" aria-label="Search"
                   aria-describedby="search-addon" width="auto"/>
            <button type="submit" class="btn btn-outline-primary">Поиск</button>
        </form>
    </div>
</div>
<br><br>
<div class="row">
    <div class="panel-heading col-3">ФИО</div>
    <div class="panel-heading col-2">Дата рождения</div>
    <div class="panel-heading col-6">Действия</div>
</div>
<hr class="hr_numbers"><br>
<?php
foreach ($model as $item) {
    echo "<br>";
    echo '<div class="row">';
    echo "<div class='panel-heading col-3'>" . $item->fullName . "</div>";
    echo "<div class='panel-heading col-2'>" . substr($item->date, 0, 10) . "</div>";
    echo "<div class='col-6'>";
    echo '<span>' . Html::a('Просмотреть', ['postview', 'id' => $item->id], ['class' => 'btn btn-primary', 'style' => 'margin-left: 5px']) . '</span>';
    echo '<span>' . Html::a('Редактировать', ['postedit', 'id' => $item->id], ['class' => 'btn btn-secondary', 'style' => 'margin-left: 5px']) . '</span>';
    echo '<span>' . Html::a('Удалить', ['postdelete', 'id' => $item->id], ['class' => 'btn btn-danger', 'style' => 'margin-left: 5px']) . '</span>';
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
