<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
require_once ('menu.php');
?>
<h1>Место</h1>
<br>
<p>	
	<a href='index.php?r=birds/create&name=<?= $name?>'> <button class="bttn-unite bttn-md bttn-danger">Добавить место</button></a>        
    </p>
<table class="table table-striped table-bordered">
<thead>
<tr>
<th>#</th>
<th>Имя</th>
<th>Действие</th>
</tr>
</thead>
<tbody>
<?php $i=1;
foreach ($edit as $key): 
?>
	    <tr>
            <th><?=$i?></th>
            <th><h3><?= Html::encode ("{$key->place_name}") ?></h3> </th>
            <th>
            <a href="/basic/web/index.php?r=birds%2Fupdate&amp;id=<?=$key->place_id?>&amp;name=Place" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="/basic/web/index.php?r=birds%2Fdelete&amp;id=<?=$key->place_id?>&amp;name=Place" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
            </th>
        </tr>
<?php $i++;
 endforeach;
 ?>
</tbody>
</table>
</div>
