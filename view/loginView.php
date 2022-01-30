<?php
require_once './template/template.php';

class loginView{
	public function print($args){
		headerTemplate();
		?>
		<section class="login">
			<div class="container">
				<div class="login__inner">

				<?php loginTemplate($args['isauth']); ?>

				</div>
			</div>
		</section>
		<?php
		footerTemplate();
	}
}
?>
