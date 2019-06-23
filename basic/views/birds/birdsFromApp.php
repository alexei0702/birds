<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<div class="row">
<?php
$i=0;
foreach ($birds as $bird): 
if($i%3==0):
?>
</div>
<br>
<div class="row">
<?php endif; ?>
<div class="col-md-4" style="font-size: 16px;">
            <img src="<?='/basic/upload/coordsImages/'.$bird->image?>" width="200" height="200" class="img-rounded" alt="111">
            <br>
            <?= Html::encode ("Название: {$bird->bird_name}") ?><br>
            <?= Html::encode ("x: {$bird->x}") ?><br>
            <?= Html::encode ("y: {$bird->y}") ?> <br>
            <button class="btn btn-success">Принять</button>
            <button class="btn btn-danger">Отклонить</button>
            <button class="btn btn-warning">Подробнее</button>
</div>
<?php 
$i++;
 endforeach;
 ?>
 </div>

<!-- <a href="/basic/web/index.php?r=birds%2Fupdate-bird&amp;id=1&amp;name=Bird" title="Update" aria-label="Update" data-pjax="0"><button class="bttn-float bttn-md bttn-primary">Обновить</button></a>

 <a href="/basic/web/index.php?r=birds%2Fdelete-bird&amp;id=1&amp;name=Bird" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"><button class="bttn-float bttn-md bttn-danger">Удалить</button></a>  -->