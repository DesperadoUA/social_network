<?php
    $this->load->view('components/admin_header/view.php'); ?>
	<div class="container-fluid">
		<div class="row background_gray">
			<?php
			$this->load->view('components/admin_sidebar/view.php');
			?>
			<div class="col-lg-10 admin_edit_container bg-gray">
                <form action="/admin/static-page/update" method="post">
				<?php
					$this->load->view('components/admin_title/view.php');
				    $this->load->view('admin/edit_template/common_meta.php');
                    MM_Module_Cyr_To_Lat::create();
				    MM_Module_Two_Input::create($content['breadcrumbs'],
				            'breadcrumbs',
                              'Хлебные крошки',
                           'Ссылка',
                           'Анкор'
                        );
				    MM_Module_Two_Input::create($content['menu'],
				            'menu',
                            'Меню',
						  'Ссылка',
						  'Анкор');
				    echo "<button>Update</button>"
				?>
                </form>
			</div>
		</div>
	</div>
<?php $this->load->view('components/admin_footer/view.php'); ?>