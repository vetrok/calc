<!DOCTYPE html>
<html>
<head>
	<title>Эскиз</title>
	<meta charset='utf-8'>
	<link rel='stylesheet' type='text/css' href='<?php echo \application\controllers\Def::getStyles();?>root.css'>
	<link href='http://fonts.googleapis.com/css?family=Noto+Sans:700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:600&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<script type='text/javascript' src='<?php echo \application\controllers\Def::getViews();?>jquery-2.1.3.js'></script>
	<script type='text/javascript' src='<?php echo \application\controllers\Def::getViews();?>animate.js'></script>
</head>
<body>
	<div class="container">
		<div class='wrap'>
			<ul class='menu'>
				<li class='item1'>
					<a class='top' href="<?php echo \application\controllers\Def::getIndex()?>" ><span>Главная</span></a>
				</li>
				<li class='item2'>
					<a class='top' href="<?php echo \application\controllers\Def::getSmena()?>"><span>Смены</span></a>
					<ul class='swing1'>
						<li><a href='#'>Новый расчёт</a></li>
						<li><a href='#'>Старый расчёт</a></li>
					</ul>
				</li>
				<li class='item3'>
					<a class='top' href="<?php echo \application\controllers\Def::getSeans()?>"><span>Сеансы</span></a>
					<ul class='swing2'>
						<li><a href='#'>Новый расчёт</a></li>
						<li><a href='#'>Старый расчёт</a></li>
					</ul>
				</li>
				<li class='item4'>
					<a href="#"><span>Здравствуй <br> Гость</span></a>
				</li>
			</ul>
			
			<div class='content'>
			<center>
				САМИ ЛУЧИ КУЛЬКЛЯТР!<?php echo $this->name;?>
			</center>
			</div>
			<div class='img'>
				
				
			</div>
		</div>
	</div>
</body>
</html>