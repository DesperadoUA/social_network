<?php $this->load->view('components/admin_header/view.php'); ?>
<div class="container-fluid">
	<div class="row background_gray">
		<?php
		   $this->load->view('components/admin_sidebar/view.php');
           $this->load->view('components/admin_index/view.php');
        ?>
	</div>
</div>
<?php $this->load->view('components/admin_footer/view.php'); ?>