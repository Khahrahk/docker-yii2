<?php

use app\models\Groups;

?>
    <br><br>
    <div class="row">
        <div class="panel-heading col-3">ФИО</div>
        <div class="panel-heading col-2">Дата рождения</div>
        <div class="panel-heading col-2">Местонахождение</div>
        <div class="panel-heading col-2">Номер</div>
        <div class="panel-heading col-2">Группа</div>
    </div>
    <hr class="hr_numbers"><br>
<?php
echo "<div class='row'>";
echo "<div class='panel-heading col-3'>" . $query->fullName . "</div>";
echo "<div class='panel-heading col-2'>" . substr($query->date, 0, 10) . "</div>";
echo "<div class='panel-heading col-2'>" . $query->location . "</div>";
echo "<div class='panel-heading col-2'>";
foreach ($query->number as $n) {
    echo $n->number . "<br>";
}
echo '</div>';
echo "<div class='panel-heading col-2'>";
if (empty($query1->groups['name'])) {
    echo 'Нету';
} else {
    echo $query1->groups['name'];
}
echo "</div>";
