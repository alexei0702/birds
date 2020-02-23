<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    $this->title = $title;
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $this->title?></h1>
</div>

<div class="row mb-4">
    <a href="<?= Url::toRoute(['dictionary/create-dictionary', 'modelName' => $modelName])?>" class="btn btn-success btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
        </span>
        <span class="text">Добавить</span>
    </a>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Имя</th>
                            <?= $withLatName ? '<th>Имя на латинском</th>' : '' ?>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            foreach ($list as $item):
                        ?>
                            <tr>
                                <th><?= $i ?></th>
                                <th>
                                    <?= Html::encode ("{$item->name}") ?>
                                </th>
                                <?= $withLatName ?
                                    '<th>'
                                        .Html::encode ("{$item->name_lat}").
                                    '</th>'
                                    : ''
                                ?>
                                <th>
                                    <a href="<?= Url::toRoute(['dictionary/update-dictionary', 'id' => $item->id, 'modelName' => $modelName]) ?>" title="Обновить" aria-label="Update">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="<?= Url::toRoute(['dictionary/delete-dictionary', 'id' => $item->id, 'modelName' => $modelName]) ?>" title="Удалить">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </th>
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
</div>