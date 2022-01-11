<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/helpers/CardBuilder.php';
class API_Controller extends CI_Controller
{
    const DIR_DOWNLOADS_ANALYZES = '/uploads/analyzes/';
	public function __construct() {
		parent::__construct();
		$_POST = !empty($_POST) ? $_POST : json_decode(file_get_contents('php://input'), true);
		$this->load->model('options');
		$this->load->model('research');
		$this->load->model('stories');
		$this->load->model('research_meta');
		$this->load->model('relative_research');
		$this->load->model('post');
		$this->load->model('post_meta');
		$this->load->model('mails');
		$this->load->model('disease');
		$this->load->model('healing');
		$this->load->model('relative_healing');
		$this->load->model('doctors');
		$this->load->model('relative_doctors');
	}
	public function mailer() {
		$mails = json_decode($this->options->getDataByType('mails')[0]['content'], true);
		$mails = $mails['list'];
		$research = $this->research->getDataById($_POST['currentId'])[0];
		$confirm['status'] = 'error';

		$mail_data = [
			'form' => isset($_POST['form']) ? $_POST['form'] : '',
			'name' => isset($_POST['name']) ? $_POST['name'] : '',
			'email' => isset($_POST['email']) ? $_POST['email'] : '',
			'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
			'gender' => isset($_POST['gender']) ? $_POST['gender'] : '',
			'city' => isset($_POST['city']) ? $_POST['city'] : '',
			'age' => isset($_POST['age']) ? $_POST['age'] : '',
			'research' => $research['title']
		];
		$this->mails->insert($mail_data);
		if(!empty($mails)) {
			$subject = "Заявка с формы {$mail_data['form']}";
			$message = "Name: {$mail_data['name']}\n\r";
			$message .= "Email: {$mail_data['email']}\n\r";
			$message .= "Phone: {$mail_data['phone']}\n\r";
			$message .= "Gender: {$mail_data['gender']}\n\r";
			$message .= "City: {$mail_data['city']}\n\r";
			$message .= "Age: {$mail_data['age']}\n\r";
			$message .= "Research: {$research['title']}\n\r";
			foreach ($mails as $item) mail($item['text'], $subject, $message);
			$confirm['status'] = 'ok';
		}
		echo json_encode($confirm);
	}
	public function analyzes(){
		$confirm['status'] = 'error';
		$folderPath = $_SERVER['DOCUMENT_ROOT'].self::DIR_DOWNLOADS_ANALYZES;
		$file_data = $_POST['file'];
		$image_parts = explode(";base64,", $file_data['base64']);
		$image_base64 = base64_decode($image_parts[1]);
		$file_path = time().$_POST['file']['name'];
		$file = $folderPath .$file_path;

		file_put_contents($file, $image_base64);
		$mails = json_decode($this->options->getDataByType('mails')[0]['content'], true);
		$mails = $mails['list'];
		$confirm['status'] = 'error';
		$mail_data = [
			'form' => isset($_POST['form']) ? $_POST['form'] : '',
			'name' => isset($_POST['name']) ? $_POST['name'] : '',
			'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
			'file' => 'https://'.$_SERVER['SERVER_NAME'].self::DIR_DOWNLOADS_ANALYZES.$file_path

		];
		if(!empty($mails)) {
			$subject = "Заявка с формы {$mail_data['form']}";
			$message = "Name: {$mail_data['name']}\n\r";
			$message .= "Phone: {$mail_data['phone']}\n\r";
			$message .= "File: {$mail_data['file']}\n\r";
			foreach ($mails as $item) mail($item['text'], $subject, $message);
			$confirm['status'] = 'ok';
		}
		echo json_encode($confirm);
	}
	public function clinics() {
		/*
		$_POST['lang'] = 'ru';
		$_POST['city'] = 'Киев';
		//$_POST['city'] = 'Выберите город';
		$_POST['region'] = 'Выберите регион';
		//$_POST['region'] = 'Киевский';
		$_POST['therapeutic_area'] = 'Терапевтическая область';
		//$_POST['therapeutic_area'] = 'Кардиология, Пульманология';
		$_POST['keyword'] = '';
        */
		if(isset($_POST)) {
			$confirm['status'] = 'error';

			if($this->input->post('lang') === 'ua') $lang_prefix = '';
			else $lang_prefix = '/ru';

			$strQuery = '';
			if($this->input->post('city') !== TRANSLATE['CHOOSE_CITY'][$this->input->post('lang')]) {
				$strQuery .= " AND t2.key_meta = 'city' AND t2.value='{$this->input->post('city')}' ";
			}
		
			if(empty($strQuery)) {
				if($this->input->post('region') !== TRANSLATE['CHOOSE_REGION'][$this->input->post('lang')]) {
					$strQuery .= " AND t2.key_meta = 'region' AND t2.value='{$this->input->post('region')}' ";
				}
			}
			if(empty($strQuery)) {
				if($this->input->post('therapeutic_area') !== TRANSLATE['THERAPEUTIC_AREA'][$this->input->post('lang')]) {
					$strQuery .= " AND t2.key_meta = 'therapeutic_area' AND t2.value LIKE '%{$this->input->post('therapeutic_area')}%' ";
				}
			}

			$this->db->distinct('t1.id');
			$this->db->select('t1.id')
				 ->from('posts as t1')
				 ->where('t1.post_type', 'clinic')
				 ->where('t1.lang', $_POST['lang'])
				 ->where('t1.status', '1')
				 ->join('post_meta as t2', "t1.id = t2.post_id {$strQuery}");
			$query = $this->db->get();

			if(empty($query->result_array())) {
				$confirm['status'] = 'ok';
				$confirm['data'] = [];
				echo json_encode($confirm);
			} else {
				$arr_id = [];
				$result = $query->result_array();
				$result_data = [];
				foreach ($result as $item) $arr_id[] = $item['id'];
				$data = $this->post->getPublicPostsByArrId($arr_id);

				for($i=0; $i<count($data); $i++) {
					$city = $this->post_meta->getDataByKey($data[$i]['id'], 'city');
					if($this->input->post('city') !== TRANSLATE['CHOOSE_CITY'][$this->input->post('lang')]) {
						if($city !== $this->input->post('city')) continue;
					}

					$region = $this->post_meta->getDataByKey($data[$i]['id'], 'region');
					if($this->input->post('region') !== TRANSLATE['CHOOSE_REGION'][$this->input->post('lang')]) {
						if($region !== $this->input->post('region')) continue;
					}

					$therapeutic_area = $this->post_meta->getDataByKey($data[$i]['id'], 'therapeutic_area');
					if($this->input->post('therapeutic_area') !== TRANSLATE['THERAPEUTIC_AREA'][$this->input->post('lang')]) {
						if(stristr(mb_strtolower($therapeutic_area), mb_strtolower($this->input->post('therapeutic_area'))) === FALSE) continue;
					}

					$full_name = $this->post_meta->getDataByKey($data[$i]['id'], 'full_name');
					if(!empty($this->input->post('keyword'))) {
						if(stristr($full_name, $this->input->post('keyword')) === FALSE) continue;
					}

					$total_research = $this->relative_research->getArrByKeyValue( 'clinic_id', $data[$i]['id']);
					$relative_research_id = [];
					foreach ($total_research as $item) $relative_research_id[] = $item['post_id'];

					$result_data[] = [
						'id' => $data[$i]['id'],
						'thumbnail' => json_decode($data[$i]['thumbnail'], true),
						'full_name' => $full_name,
						'city' => $city,
						'address' => $this->post_meta->getDataByKey($data[$i]['id'], 'address'),
						'researchers' => $this->post_meta->getDataByKey($data[$i]['id'], 'researchers'),
						'permalink' => $lang_prefix.'/'.$data[$i]['slug'].'/'.$data[$i]['permalink'],
						'total_research' => count($total_research),
						'total_active_research' => $this->research->getTotalPublicActivePostsByArrId($relative_research_id)
					];
				}
				$confirm['status'] = 'ok';
				$confirm['data'] = $result_data;
				echo json_encode($confirm);
			}
		}
		else {
			echo "error POST - empty";
		}
	}
	public function research() {
		$confirm['status'] = 'error';
/*
		$_POST['lang'] = 'ru';

		$_POST['region'] = 'Test research 3';
		//$_POST['region'] = 'Выберите регион';


		//$_POST['city'] = 'Москва';
		$_POST['city'] = 'Выберите город';

		//$_POST['disease'] = 'Test research 1';
		$_POST['disease'] = 'Заболевание';


		$_POST['held'] = 'Проводится';
		//$_POST['held'] = 'Проводится';

		//$_POST['clinic'] = '';
		$_POST['clinic'] = 36;

		$_POST['open'] = 'С открытым набором';
		//$_POST['open'] = 'Для здоровых добровольцев';

		$_POST['keyword'] = '';
		//$_POST['keyword'] = 'test';
*/
		if(isset($_POST)){
			if($this->input->post('lang') === 'ua') $lang_prefix = '';
			else $lang_prefix = '/ru';

			$strQuery = '';
			if($this->input->post('city') !== TRANSLATE['CHOOSE_CITY'][$this->input->post('lang')]) {
				$strQuery .= " AND t2.city LIKE '%{$this->input->post('city')}%' ";
			}

			if($this->input->post('region') !== TRANSLATE['CHOOSE_REGION'][$this->input->post('lang')]) {
				$strQuery .= " AND t2.region LIKE '%{$this->input->post('region')}%' ";
			}

			if($this->input->post('disease') !== TRANSLATE['DISEASE'][$this->input->post('lang')]) {
				$strQuery .= " AND t2.disease LIKE '%{$this->input->post('disease')}%' ";
			}

			$strQuery .= " AND t2.paid = '".$this->input->post('paid')."' ";

			if($this->input->post('therapeutic_area') !== TRANSLATE['THERAPEUTIC_AREA'][$this->input->post('lang')]) {
				$strQuery .= " AND t2.therapeutic_area LIKE '%{$this->input->post('therapeutic_area')}%' ";
			}


			$confirm['status'] = 'ok';
			if(empty($_POST['clinic'])) {
				$result = $this->research->getSearchPublicPosts($this->input->post('lang'), $strQuery);

				$response = [];
				if(!empty($_POST['keyword'])) {
					foreach($result as $item) {
						if(stristr($item['title'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['h1'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['content'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['protocol_name'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['therapeutic_area'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['name_organization'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['disease'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['researchers'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['clinic_name'], $_POST['keyword']) !== FALSE) $response[] = $item;
					}
				} else $response = $result;

				for ($i=0; $i<count($response); $i++){
					$response[$i]['permalink'] = $lang_prefix.'/'.$response[$i]['slug'].'/'.$response[$i]['permalink'];
					$response[$i]['data_start'] = mb_substr($response[$i]['data_start'], 0, 10);
					$response[$i]['data_finish'] = mb_substr($response[$i]['data_finish'], 0, 10);
				}
				$confirm['data'] = $response;
				echo json_encode($confirm);

			}
			else {

				$posts = $this->research->getPostsByClinicIdAndQueryParams(
					                    $this->input->post('lang'),
										$this->input->post('clinic'),
										$strQuery);
				$response = [];
				if(!empty($_POST['keyword'])) {
					foreach($posts as $item) {
						if(stristr($item['title'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['h1'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['content'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['protocol_name'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['therapeutic_area'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['name_organization'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['disease'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['researchers'], $_POST['keyword']) !== FALSE) $response[] = $item;
						elseif(stristr($item['clinic_name'], $_POST['keyword']) !== FALSE) $response[] = $item;
					}
				} else $response = $posts;


				for ($i=0; $i<count($response); $i++){
					$response[$i]['permalink'] = $lang_prefix.'/'.$response[$i]['slug'].'/'.$response[$i]['permalink'];
					$response[$i]['data_start'] = mb_substr($response[$i]['data_start'], 0, 10);
					$response[$i]['data_finish'] = mb_substr($response[$i]['data_finish'], 0, 10);
				}

				$confirm['data'] = $response;
				echo json_encode($confirm);
			}
		}
		else {
			echo "error Post - empty";
		}
	}
	public function subscription(){
		$mails = json_decode($this->options->getDataByType('mails')[0]['content'], true);
		$mails = $mails['list'];
		$confirm['status'] = 'error';

		$mail_data = [
			'form' => isset($_POST['form']) ? $_POST['form'] : '',
			'name' => isset($_POST['name']) ? $_POST['name'] : '',
			'email' => isset($_POST['email']) ? $_POST['email'] : '',
			'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
			'gender' => isset($_POST['gender']) ? $_POST['gender'] : '',
			'city' => isset($_POST['city']) ? $_POST['city'] : '',
			'age' => isset($_POST['age']) ? $_POST['age'] : ''
		];
		//$this->mails->insert($mail_data);
		if(!empty($mails)) {
			$subject = "Заявка с формы {$mail_data['form']}";
			$message = "Name: {$mail_data['name']}\n\r";
			$message .= "Email: {$mail_data['email']}\n\r";
			$message .= "Phone: {$mail_data['phone']}\n\r";
			$message .= "Gender: {$mail_data['gender']}\n\r";
			$message .= "City: {$mail_data['city']}\n\r";
			$message .= "Age: {$mail_data['age']}\n\r";
			foreach ($mails as $item) mail($item['text'], $subject, $message);
			$confirm['status'] = 'ok';
		}
		echo json_encode($confirm);
	}
	public function subscriptionMain(){
		$mails = json_decode($this->options->getDataByType('mails')[0]['content'], true);
		$mails = $mails['list'];
		$confirm['status'] = 'error';

		$mail_data = [
			'form' => isset($_POST['form']) ? $_POST['form'] : '',
			'name' => isset($_POST['name']) ? $_POST['name'] : '',
			'email' => isset($_POST['email']) ? $_POST['email'] : '',
			'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
			'gender' => isset($_POST['gender']) ? $_POST['gender'] : '',
			'city' => isset($_POST['city']) ? $_POST['city'] : '',
			'age' => isset($_POST['age']) ? $_POST['age'] : '',
			'diagnosis' => isset($_POST['diagnosis']) ? $_POST['diagnosis'] : '',
			'relocate' => isset($_POST['relocate']) ? $_POST['relocate'] : ''
		];
		//$this->mails->insert($mail_data);
		if(!empty($mails)) {
			$subject = "Заявка с формы {$mail_data['form']}";
			$message = "Name: {$mail_data['name']}\n\r";
			$message .= "Email: {$mail_data['email']}\n\r";
			$message .= "City: {$mail_data['city']}\n\r";
			$message .= "Diagnosis: {$mail_data['diagnosis']}\n\r";
			$message .= "Relocate: {$mail_data['relocate']}\n\r";
			foreach ($mails as $item) mail($item['text'], $subject, $message);
			$confirm['status'] = 'ok';
		}
		echo json_encode($confirm);
	}
	public function contacts() {
		$mails = json_decode($this->options->getDataByType('mails')[0]['content'], true);
		$mails = $mails['list'];
		$confirm['status'] = 'error';

		$mail_data = [
			'form' => isset($_POST['form']) ? $_POST['form'] : '',
			'name' => isset($_POST['name']) ? $_POST['name'] : '',
			'phone' => isset($_POST['phone']) ? $_POST['phone'] : '',
			'city' => isset($_POST['city']) ? $_POST['city'] : '',
		];
		if(!empty($mails)) {
			$subject = "Заявка с формы {$mail_data['form']}";
			$message = "Name: {$mail_data['name']}\n\r";
			$message .= "Phone: {$mail_data['phone']}\n\r";
			$message .= "City: {$mail_data['city']}\n\r";
			foreach ($mails as $item) mail($item['text'], $subject, $message);
			$confirm['status'] = 'ok';
		}
		echo json_encode($confirm);
	}
	public function stories() {
		$confirm['status'] = 'error';
		$lang = $this->input->post('lang');
		$offset = $this->input->post('offset');
		$limit = 10000;
		$posts = $this->stories->getPublicPosts($offset, $limit, $lang);
		if($this->input->post('lang') === 'ua') $lang_prefix = '';
		else $lang_prefix = '/ru';
		if(!empty($posts)) {
			$confirm['data'] = CardBuilder::storiesCard($posts, $lang_prefix);
		}
		$confirm['status'] = 'ok';
		echo json_encode($confirm);
	}
	public function healing() {
		$confirm['status'] = 'error';
		$confirm['data'] = [];
		$lang = $this->input->post('lang');
		$keyword = $this->input->post('keyword');
	
		$posts = $this->disease->getSearchPublicPosts($lang, $keyword);
		if($this->input->post('lang') === 'ua') $lang_prefix = '';
		else $lang_prefix = '/ru';
		if(!empty($posts)) {
			for($i = 0; $i<count($posts); $i++) {
				$confirm['data'][$i]['title'] = $posts[$i]['title'];
				$confirm['data'][$i]['permalink'] = $lang_prefix.'/'.$posts[$i]['slug'].'/'.$posts[$i]['permalink'];
				$confirm['data'][$i]['child'] = [];
				$child = $this->relative_healing->getArrByKeyValue('disease', $posts[$i]['id']);

				if(!empty($child)) {
					$arr_id = [];
					foreach($child as $item) $arr_id[] = $item['post_id'];
					$healings = $this->healing->getPublicPostsByArrId($arr_id);
					if(!empty($healings)) {
						foreach($healings as $item) {
							$confirm['data'][$i]['child'][] = [
								'title' => $item['title'],
								'permalink' => $lang_prefix.'/'.$item['slug'].'/'.$item['permalink']
							];
						}
					}
				}
			}
		}
		$confirm['status'] = 'ok';
		echo json_encode($confirm);
	}
	public function doctors() {
		$confirm['status'] = 'error';
		$lang = $this->input->post('lang');
		$region_form = $this->input->post('region');
		$city_form = $this->input->post('city');
		$name_form = $this->input->post('name');
		$specialization_form = $this->input->post('specialization');
		$clinics_form = $this->input->post('clinics');
		$cr_experience_form = $this->input->post('cr_experience');

		if($this->input->post('lang') === 'ua') $lang_prefix = '';
		else $lang_prefix = '/ru';

		$all_posts = $this->doctors->getPublicPosts(0, 1000, $lang);
		$response = [];
		$post_data = [];
		foreach($all_posts as $item) {
			$city_id = $this->relative_doctors->getDataByKey($item['id'], 'city_id');
			$clinic_id = $this->relative_doctors->getDataByKey($item['id'], 'clinic_id');
			$city_arr = $this->post->getPublicPostsByArrId($city_id);
			$clinic_arr = $this->post->getPublicPostsByArrId($clinic_id);
			$city = empty($city_arr) ? '' : $city_arr[0]['title'];
			$clinic = empty($clinic_arr) ? '' : $clinic_arr[0]['title'];

			$research_arr = $this->relative_research->getArrByKeyValue('doctor_id', $item['id']);
			$research_id = [];
			foreach($research_arr as $id) $research_id[] = $id['post_id'];
			$research = $this->research->getPostsByArrId($research_id);

			$year = ($item['experience_cr'] > 4) 
				        ? $item['experience_cr']." ".TRANSLATE['YEAR_PLURAL'][LANG] 
						: $item['experience_cr']." ".TRANSLATE['YEAR'][LANG];

			$post_data[] = array_merge($item, [
				'permalink' => $lang_prefix.'/'.$item['slug'].'/'.$item['permalink'],
				'city' => $city,
				'clinic' => $clinic,
				'experience_cr' => $year,
				'count_research' => count($research)
			]);
		}
		foreach($post_data as $item) {
			if($region_form !== TRANSLATE['CHOOSE_REGION'][$lang]) {
				if(stristr($item['region'], $region_form, true) === FALSE) continue;
			}
			if($city_form !== TRANSLATE['CHOOSE_CITY'][$lang]) {
				if(stristr($item['city'], $city_form, true) === FALSE) continue;
			}
			if($specialization_form !== TRANSLATE['SPECIALIZATION'][$lang]) {
				if(stristr($item['specialization'], $specialization_form, true) === FALSE) continue;
			}
			if(!empty($name_form)) {
				if(stristr($item['name'], $name_form, true) === FALSE) continue;
			}
			if(!empty($clinics_form)) {
				if(stristr($item['clinic'], $clinics_form, true) === FALSE) continue;
			}
			if(!empty($cr_experience_form)) {
				if($item['experience_cr'] != $cr_experience_form) continue;
			}
			$response[] = $item;
		}
        $confirm['status'] = 'ok';
		$confirm['data'] = $response;
		echo json_encode($confirm);
	}
}

