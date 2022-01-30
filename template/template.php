<?php
require_once './template/blogEditor.php';
require_once './template/roadmap.php';
require_once './template/roadmapEditor.php';

function headerTemplate(){
	?>
	<!DOCTYPE html>
	<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
		<title>bs135</title>
	</head>
	<body>
	<header class="header">
	<div class="container">
	<div class="header__inner">
		<ul class="header__navigation">
				<!--<a href="index.php"><li class="header__item">Главная</li></a>-->
				<a href="roadmap?playlist=34&card=31">
					<li class="header__item">Дорожная карта</li>
				</a>
				<a href="blog"><li class="header__item">Блог</li></a>
				<?php
				global $IsAuthentification;
				if($IsAuthentification != ""){
					echo '<a href="admin"><li class="header__item">Админка</li></a>';
				} else {
					echo '<a href="login"><li class="header__item">Войти</li></a>';
				}
				?>
		</ul>
	</div>
	</div>
	</header>
	<?php
}

function footerTemplate(){
	?>
	<footer class="footer">
		<div class="container"></div>
	</footer>
	</body>
	</html>
	<?php
}

function loginTemplate($name){
	if($name == ''){
		?>
		<form class="login-form" action="/script/login.php" method="post" id="formLogin">
			<div class="lable">Введите имя</div>
			<input type="text" name="name" maxlength="20" pattern="[\w]+" required>
			<div class="lable">Введите пароль</div>
			<input type="text" name="password" maxlength="20" pattern="[\w]+" required>
			<input type="submit" name="submit" value="Войти">
		<?php
			if(!(empty($_GET['wrong'])) && $_GET['wrong'] == 1){
		?>
				<div class="lable-error">Имя или пароль введены не верно</div>
		<?php
			}
			?></form><?php
	} else {
		header("Location: " . SITE_PATH . "admin");
	}
}

function adminTemplate(){
	?>
	<form action="/script/logout.php" method="post" id="formLogin2">
		<input type="submit" name="submit" value="Выйти из аккаунта">
	</form>
<?php
blogEditor();
roadmapEditor();
}

function printPosts($posts){
	foreach($posts as $item){
		?>
		<a class="blog-list__item" href="/blogitem-<?php echo $item->id; ?>">
			<h2 class="blog-list__item-title">
				<?php echo $item->name ?>
			</h2>
			<div class="blog-list__item-content">
				<?php
					if(strlen($item->content) > 500){
						echo substr($item->content,0,500) . "...";
					} else {
						echo $item->content;
					}
				?>
			</div>
		</a>
		<?php
	}
}

function printPost($post){
	?>
	<h2 class="blog-item__title">
		<?php echo $post->name; ?>
	</h2>
	<div class="blog-item__content">
		<?php echo $post->content; ?>
	</div>
	<?php
}

function roadmapTemplate($args){
	roadmap($args);
}

function mainTemplate(){
	echo "mainTemplate";
}
