<?php
$this->load->view('components/admin_header/view.php'); ?>
	<div class="container-fluid">
		<div class="row background_gray">
			<?php
			$this->load->view('components/admin_sidebar/view.php');
			?>
			<div class="col-lg-10 admin_edit_container bg-gray">
				<form action="/admin/post/add-post" method="post" enctype="multipart/form-data" class="mm_modules_container">
					<input type="hidden" name="post_type" value="<?= $post_type; ?>">
					<?php
					$this->load->view('components/admin_title/view.php');
					$this->load->view('admin/add_template/common_field_post.php');
					?>
					<button class="btn_add mt_30">Add</button>
				</form>
			</div>
		</div>
	</div>
<?php $this->load->view('components/admin_footer/view.php'); ?>