<?php
$this->load->view('components/admin_header/view.php'); ?>
	<div class="container-fluid">
		<div class="row background_gray">
			<?php
			$this->load->view('components/admin_sidebar/view.php');
			?>
			<div class="col-lg-10 admin_edit_container bg-gray">
				<form action="<?= '/admin/'.$slug.'/update'; ?>" method="post" enctype="multipart/form-data" class="mm_modules_container">
					<?php
					$this->load->view('components/admin_title/view.php');
					$this->load->view('components/settings_templates/'.$template.'.php');
					?>
					<input type='hidden' name="id" value="<?= $id; ?>">
					<input type='hidden' name="template" value="<?= $template; ?>">
					<button class="btn_add mt_30">Update</button>
				</form>
			</div>
		</div>
	</div>
<?php $this->load->view('components/admin_footer/view.php'); ?>