<?php
    $this->title = 'Список видов';

    use yii\helpers\Html;
    use yii\helpers\Url;
//    TODO: добавить свит алерт при удалении
?>
<div class="row mb-4">
    <a href="<?=Url::toRoute(['bird/create-bird'])?>" class="btn btn-success btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
        </span>
        <span class="text">Добавить вид</span>
    </a>
</div>
<div class="row">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Отряд</th>
                        <th>Семейство</th>
                        <th>Род</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=1;
                            foreach ($birds as $bird):
                                ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?= Html::a(Html::encode ("{$bird->name} - {$bird->name_lat}"), Url::toRoute(['bird/bird-details', 'id' => $bird->id ])) ?></td>
                                    <td><?= Html::encode ("{$bird->squad->name} - {$bird->squad->name_lat}") ?> </td>
                                    <td><?= Html::encode ("{$bird->family->name} - {$bird->family->name_lat}") ?> </td>
                                    <td><?= Html::encode ("{$bird->kind->name} - {$bird->kind->name_lat}") ?> </td>
                                    <td>
                                        <a href="<?=Url::toRoute(['bird/update-bird', 'id' => $bird->id])?>" title="Update">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="<?=Url::toRoute(['bird/delete-bird', 'id' => $bird->id])?>" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>