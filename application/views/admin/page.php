<?php $this->load->view('components/admin_header/view.php'); ?>
	<div class="container-fluid">
		<div class="row">
			<?php
			$this->load->view('components/admin_sidebar/view.php');
			$this->load->view('components/admin_index/view.php');
			echo "Page";
			?>
		</div>
	</div>
<?php $this->load->view('components/admin_footer/view.php'); ?>