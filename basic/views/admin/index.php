<?php
    $this->title = 'Режим редактирования';
?>
<div class="site-index">
    <div class="body-content">
<!--        <div class="row">-->
<!--            <div class="col-lg-4 col-lg-offset-4 alert alert-info">-->
<!--                <h3>Добавить статическую страницу</h3><br>-->
<!--                <a href="index.php?r=birds/create-static-page">-->
<!--                    <button class="bttn-jelly bttn-md bttn-success">Нажми</button>-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
        <br>
        <div class="row">
            <div class="col-lg-3 col-lg-offset-3 alert alert-success">
                <h3>Показать всех птиц</h3><br>
                <a href="index.php?r=birds/views-birds"><button class="bttn-jelly bttn-md bttn-success">Нажми</button></a>
            </div>
            <div class="col-lg-3 alert alert-success">
                <h3>Добавить птицу</h3><br>
                <a href="index.php?r=birds/create-bird"><button class="bttn-jelly bttn-md bttn-success">Нажми</button></a>
            </div>
        </div>
        <h2 align="center">Добавить/изменить</h2>
        <div class="row">
            <div class="col-lg-4 alert alert-warning">
                <h3>Семейство</h3><br>
                <a href="index.php?r=birds/create-edit&modelName=Family"><button class="bttn-jelly bttn-md bttn-warning">Нажми</button></a>
            </div>
            <div class="col-lg-4 alert alert-warning">
                <h3>Род</h3><br>
                <a href="index.php?r=birds/create-edit&modelName=Kind"><button class="bttn-jelly bttn-md bttn-warning">Нажми</button></a>
            </div>
            <div class="col-lg-4 alert alert-warning">
                <h3>Отряд</h3><br>
                <a href="index.php?r=birds/create-edit&modelName=Squad"><button class="bttn-jelly bttn-md bttn-warning">Нажми</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 alert alert-info">
                <h3>Статус</h3><br>
                <a href="index.php?r=birds/create-edit&modelName=Status"><button class="bttn-jelly bttn-md bttn-primary">Нажми</button></a>
            </div>
            <div class="col-lg-4 alert alert-info">
                <h3>Место</h3><br>
                <a href="index.php?r=birds/create-edit&modelName=Place"><button class="bttn-jelly bttn-md bttn-primary">Нажми</button></a>
            </div>
            <div class="col-lg-4 alert alert-info">
                <h3>Численность</h3><br>
                <a href="index.php?r=birds/create-edit&modelName=Population"><button class="bttn-jelly bttn-md bttn-primary">Нажми</button></a>
            </div>
        </div>
    </div>
</div>