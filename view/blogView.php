<?php
require_once './template/template.php';

class blogView{

	public function print($args){
		headerTemplate();?>
		<section class="blog-list">
			<div class="container">
				<div class="blog-list__inner">

				<?php printPosts($args['posts']);?>

				</div>
			</div>
		</section>
		<?php
		footerTemplate();
	}
}
?>
