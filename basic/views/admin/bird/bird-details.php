<?php

    use app\models\Bird;
    use yii\helpers\Html;
    use yii\helpers\Url;

    $this->title = $bird->name;
?>

<h1 style="text-align: center;"><?= Html::encode ("{$bird->name} - {$bird->name_lat}")?></h1>
<br>

<div class="row">
    <div class="col-lg-4">
        <img src="<?= Yii::getAlias('@img') . Bird::IMAGE_PATH . $bird->link?>" width="400" class="img-rounded img-responsive" alt="<?=$bird->name?>">
    </div>
    <div class="col-lg-8">
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <th>Имя</th>
                    <td><?=Html::encode ("{$bird->name} - {$bird->name_lat}")?></td>
                </tr>
                <tr>
                    <th>Отряд</th>
                    <td>
                        <?= Html::encode ("{$bird->squad->name} - {$bird->squad->name_lat}") ?>
                    </td>
                </tr>
                <tr>
                    <th>Семейство</th>
                    <td>
                        <?= Html::encode ("{$bird->family->name} - {$bird->family->name_lat}") ?>
                    </td>
                </tr>
                <tr>
                    <th>Род</th>
                    <td>
                        <?= Html::encode ("{$bird->kind->name} - {$bird->kind->name_lat}") ?>
                    </td>
                </tr>
                <tr>
                    <th>Распространение</th>
                    <td><?= Html::encode ("{$bird->propagation}") ?> </td>
                </tr>
                <tr>
                    <th>Миграция</th>
                    <td><?= Html::encode ("{$bird->migration}") ?> </td>
                </tr>
                <tr>
                    <th>Место обитания</th>
                    <td><?= Html::encode ("{$bird->habitat}") ?> </td>
                </tr>
                <tr>
                    <th>Статус</th>
                    <td>
                        <?php foreach ($bird->statuses as $status): ?>
                            <?= Html::encode ("{$status->name}") ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <th>Численность</th>
                    <td>
                        <?php for ($i = 0; $i < count($bird->population); $i++): ?>
                            <?= Html::encode ("{$bird->population[$i]->population} ({$bird->population[$i]->description}) - {$bird->places[$i]->name}") ?>
                        <?php endfor; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<a href="<?=Url::toRoute(['bird/update-bird', 'id' => $bird->id])?>">
    <button class="btn btn-primary">Обновить</button>
</a>

<a href="<?=Url::toRoute(['bird/delete-bird', 'id' => $bird->id])?>">
    <button class="btn btn-warning">Удалить</button>
</a>
<!--TODO: add map?-->