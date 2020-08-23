<?php
    $this->load->view('components/admin_header/view.php'); ?>
	<div class="container-fluid">
		<div class="row background_gray">
			<?php
			$this->load->view('components/admin_sidebar/view.php');
			?>
			<div class="col-lg-10 admin_edit_container bg-gray">
                <form action="/admin/static-page/update" method="post" enctype="multipart/form-data" class="mm_modules_container">
				<?php
					$this->load->view('components/admin_title/view.php');
				    $this->load->view('admin/edit_template/common_meta.php');
                    MM_Module_Cyr_To_Lat::create('title','permalink', 'title', 'permalink',
						$value = [
							'title' => 'value Title 1',
							'permalink' => 'value Permalink 1'
						]);

                    $settings = [
                            'title' => 'Хлебные крошки',
                            'label_1' => 'Ссылка',
                            'label_2' => 'Анкор'
                    ];
				    MM_Module_Two_Input::create(
				            'breadcrumbs',
                            $settings,
                            $content['breadcrumbs']);

				    $settings = [
					'title' => 'Меню',
					'label_1' => 'Ссылка',
					'label_2' => 'Анкор'
				];
				    MM_Module_Two_Input::create(
				            'menu',
                            $settings,
                            $content['menu']);

				    MM_Module_Image::create('thumbnail',
                        array(
                                'class_wrapper' => 'class_wrapper',
                                'class_input'   => 'class_input',
                                'title'         => 'Модуль изображения'
                            ),
						$thumbnail);

				    MM_Module_Image::create('support_img',
					array(
						'class_wrapper' => 'class_wrapper',
						'class_input'   => 'class_input',
						'title'         => 'Новое изображение'
					),
                        $content['support_img']);

				    $settings = [
				        'title' => 'Второе описание'
                    ];
				    MM_Module_Rich_Text::create('second_text', $settings , $content['second_text']);

                    $settings = [
                        'title' => 'Множество изображений'
                    ];
				    MM_Module_Multiple_Image::create('multiple_image', $settings, $content['multiple_img']);
				    echo "<button>Update</button>"
				?>
                </form>
			</div>
		</div>
	</div>
<?php $this->load->view('components/admin_footer/view.php'); ?>