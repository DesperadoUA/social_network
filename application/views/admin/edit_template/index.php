<?php
$this->load->view('components/admin_header/view.php'); ?>
	<div class="container-fluid">
		<div class="row background_gray">
			<?php
			$this->load->view('components/admin_sidebar/view.php');
			?>
			<div class="col-lg-10 admin_edit_container bg-gray">
				<form action="/admin/post/update" method="post" enctype="multipart/form-data" class="mm_modules_container">
					<?php
					$this->load->view('components/admin_title/view.php');
					$this->load->view('admin/edit_template/common_field_post.php');
					$this->load->view('admin/edit_template/'.$post_type.'_meta.php');
					?>
					<input type='hidden' name="id" value="<?= $id; ?>">
					<button class="btn_add mt_30">Update</button>
				</form>
				<form action="/admin/post/delete" method="post">
					<input type='hidden' name="id" value="<?= $id; ?>">
					<button class="btn_add mt_30">Delete</button>
				</form>
			</div>
		</div>
	</div>
<?php
$this->load->view('components/admin_footer/view.php'); ?>