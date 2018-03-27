<style type="text/css">
#menu
{
	position: absolute; 
	z-index: 1000;
    width: 300px;
}
.nav > li > a:hover,
.nav > li > a:focus {
  background-color: #f5f5f5;
}
.menu
{
    font-family: segoe print;
}
</style>

<button class="bttn-material-circle bttn-md bttn-primary" id="menu-btn"><span class="glyphicon glyphicon-th-list"></span></button>
<div class="well sidebar-nav" style="display: none;" id="menu">
    <h3 align="center" class="menu">Меню</h3>
    <ul class="nav nav-list">
        <li><a href="index.php?r=birds/views-birds"><button class="bttn-minimal bttn-sm bttn-primary">Показать всех птиц</button></a></li>
        <li><a href="index.php?r=birds/create-bird"><button class="bttn-minimal bttn-sm bttn-primary">Добавить птицу</button></a></li>
    </ul>
    <h4 align="center">Добавить/изменить</h4>
    <ul class="nav nav-list">
        <li><a href="index.php?r=birds/create-edit&modelName=Family"><button class="bttn-minimal bttn-sm bttn-primary">Семейство</button></a></li>
        <li><a href="index.php?r=birds/create-edit&modelName=Kind"><button class="bttn-minimal bttn-sm bttn-primary">Род</button></a></li>
        <li><a href="index.php?r=birds/create-edit&modelName=Squad"><button class="bttn-minimal bttn-sm bttn-primary">Отряд</button></a></li>
        <li><a href="index.php?r=birds/create-edit&modelName=Status"><button class="bttn-minimal bttn-sm bttn-primary">Статус</button></a></li>
        <li><a href="index.php?r=birds/create-edit&modelName=Place"><button class="bttn-minimal bttn-sm bttn-primary">Место</button></a></li>
        <li><a href="index.php?r=birds/create-edit&modelName=Population"><button class="bttn-minimal bttn-sm bttn-primary">Численность</button></a></li>
      </ul>
</div><!-- /.well -->