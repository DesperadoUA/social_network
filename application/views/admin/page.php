<?php $this->load->view('components/admin_header/view.php'); ?>
	<div class="container-fluid">
		<div class="row">
			<?php
			$this->load->view('components/admin_sidebar/view.php');
			?>
            <div class="col-lg-10 admin_edit_container bg-gray">
                <?php
                 $this->load->view('components/admin_title/view.php');
                 $this->load->view('components/admin_loop_category/view.php');
                ?>
            </div>
		</div>
	</div>
<?php $this->load->view('components/admin_footer/view.php'); ?>