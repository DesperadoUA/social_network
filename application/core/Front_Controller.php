<?php
class Front_Controller extends CI_Controller {
	protected $data;
	public function __construct() {
		parent::__construct();
		$this->load->model('static_page');
		$this->load->model('settings');
		$this->load->model('options');
		$this->load->model('research');
		$this->load->model('post');
		$this->load->model('post_meta');
		$this->load->model('research_meta');
		$this->load->model('relative_research');
		$this->load->model('relative_static_page');
		$this->load->model('relative_post');
		$this->data_settings = $this->settings->getAllPagesByLang(LANG);
		foreach ($this->data_settings as $setting) {
			$this->data['settings'][$setting['type']] = json_decode($setting['content'], true);
		}
		$this->data_options = $this->options->getAllPages();
		foreach ($this->data_options as $options) {
			$this->data['options'][$options['type']] = json_decode($options['content'], true);
		}

		$this->load->helper('url');
		$currentURL = current_url();
		function endsWith( $haystack, $needle ) {
				$length = strlen( $needle );
			if( !$length ) {
				return true;
			}
			return substr( $haystack, -$length ) === $needle;
		}
		if(endsWith($currentURL, '/page')) {
			$arr = explode ( '/page' , $currentURL);
			redirect($arr[0], 'location', 301);
		}

		/* Redirect */
		if(isset($this->data['options']['redirects'])) {
			$uri = '/'.uri_string().'/';
			$arr_redirects = $this->data['options']['redirects']['menu'];
			foreach ($arr_redirects as $item) {
				if($item['value_1'] === $uri) {
					redirect($item['value_2'], 'location', 301);
				}
			}
		}
	}
	public function show_404(){
		$this->output->set_status_header('404');
		$this->data['body']['meta_title'] = 'Not found 404';
		$this->data['body']['keywords'] = 'Not found 404';
		$this->data['body']['description'] = 'Not found 404';
		$this->data['body']['post_type'] = '404';
		$this->data['body']['content']['h1'] = '404';
		$this->data['body']['short_desc'] = 'Страница не найдена';
		$this->load->view('static_page/404', $this->data);
    }
}