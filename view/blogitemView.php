<?php
require_once './template/template.php';

class blogitemView{

	public function print($args){
		headerTemplate();?>
		<section class="blog-item">
			<div class="container">
				<div class="blog-item__inner">

				<?php printPost($args['post']);?>

				</div>
			</div>
		</section>
		<?php
		footerTemplate();
	}
}
?>
