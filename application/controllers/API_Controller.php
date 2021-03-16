<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API_Controller extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$_POST = !empty($_POST) ? $_POST : json_decode(file_get_contents('php://input'), true);
		$this->load->model('options');
		$this->load->model('research');
		$this->load->model('research_meta');
		$this->load->model('post');
		$this->load->model('post_meta');
		$this->load->model('mails');
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
	public function clinics() {
/*
		$_POST['lang'] = 'ru';
		$_POST['city'] = 'New city';
		//$_POST['city'] = 'Выберите город';
		$_POST['region'] = 'Выберите регион';
		//$_POST['region'] = 'Киевский';
		$_POST['therapeutic_area'] = 'Терапевтическая область';
		//$_POST['therapeutic_area'] = 'Кардиология, Пульманология';
		$_POST['keyword'] = '';
*/
		if(isset($_POST)) {
			$confirm['status'] = 'error';

			if($_POST['lang'] === 'ru') $lang_prefix = '';
			else $lang_prefix = '/ua';

			$strQuery = '';
			if($_POST['city'] !== TRANSLATE['CHOOSE_CITY'][$_POST['lang']]) {
				$strQuery .= " AND t2.key_meta = 'city' AND t2.value='{$_POST['city']}' ";
			}
			if(empty($strQuery)) {
				if($_POST['region'] !== TRANSLATE['CHOOSE_REGION'][$_POST['lang']]) {
					$strQuery .= " AND t2.key_meta = 'region' AND t2.value='{$_POST['region']}' ";
				}
			}
			if(empty($strQuery)) {
				if($_POST['therapeutic_area'] !== TRANSLATE['THERAPEUTIC_AREA'][$_POST['lang']]) {
					$strQuery .= " AND t2.key_meta = 'therapeutic_area' AND t2.value='{$_POST['therapeutic_area']}' ";
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
					if($_POST['city'] !== TRANSLATE['CHOOSE_CITY'][$_POST['lang']]) {
						if($city !== $_POST['city']) continue;
					}

					$region = $this->post_meta->getDataByKey($data[$i]['id'], 'region');
					if($_POST['region'] !== TRANSLATE['CHOOSE_REGION'][$_POST['lang']]) {
						if($region !== $_POST['region']) continue;
					}

					$therapeutic_area = $this->post_meta->getDataByKey($data[$i]['id'], 'therapeutic_area');
					if($_POST['therapeutic_area'] !== TRANSLATE['THERAPEUTIC_AREA'][$_POST['lang']]) {
						if($therapeutic_area !== $_POST['therapeutic_area']) continue;
					}

					$full_name = $this->post_meta->getDataByKey($data[$i]['id'], 'full_name');
					if(!empty($_POST['keyword'])) {
						if(stristr($full_name, $_POST['keyword']) === FALSE) continue;
					}

					$total_research = $this->research_meta->getArrByKeyValue( 'clinic_id', $data[$i]['id']);
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

		//$_POST['region'] = 'Московский';
		$_POST['region'] = 'Выберите регион';


		//$_POST['city'] = 'Москва';
		$_POST['city'] = 'Выберите город';

		//$_POST['disease'] = 'Заболевание 1';
		$_POST['disease'] = 'Заболевание';


		$_POST['held'] = 'Проводится';
		//$_POST['held'] = 'Проводится';

		$_POST['clinic'] = '';
		//$_POST['clinic'] = 4;

		$_POST['open'] = 'С открытым набором';
		//$_POST['open'] = 'Для здоровых добровольцев';

		$_POST['keyword'] = '';
		//$_POST['keyword'] = 'test';
*/
		if(isset($_POST)){
			if($_POST['lang'] === 'ru') $lang_prefix = '';
			else $lang_prefix = '/ua';

			$arrQuery = [
				'lang' => $_POST['lang'],
				'status' => 1
			];
			if($_POST['city'] !== TRANSLATE['CHOOSE_CITY'][$_POST['lang']]) {
				$arrQuery['city'] = $_POST['city'];
			}

			if($_POST['region'] !== TRANSLATE['CHOOSE_REGION'][$_POST['lang']]) {
				$arrQuery['region'] = $_POST['region'];
			}

			if($_POST['disease'] !== TRANSLATE['DISEASE'][$_POST['lang']]) {
				$arrQuery['disease'] = $_POST['disease'];
			}

			if($_POST['open'] === TRANSLATE['OPEN_SET'][$_POST['lang']]) {
				$arrQuery['open_set'] = 1;
			}
			else {
				$arrQuery['for_volunteers'] = 1;
			}

			if($_POST['held'] === TRANSLATE['HELD'][$_POST['lang']]) {
				$arrQuery['active'] = 1;
			}
			else {
				$arrQuery['active'] = 0;
			}
			$confirm['status'] = 'ok';
			if(empty($_POST['clinic'])) {
				$result = $this->research->getSearchPublicPosts($arrQuery);
				$response = [];
				if(!empty($_POST['keyword'])) {
					foreach($result as $item) {
						$str = json_encode($item);
						if(stristr($str, $_POST['keyword']) !== FALSE) $response[] = $item;
					}
				} else $response = $result;

				for ($i=0; $i<count($response); $i++){
					$response[$i]['permalink'] = $lang_prefix.'/'.$response[$i]['slug'].'/'.$response[$i]['permalink'];
					$response[$i]['data_start'] = mb_substr($response[$i]['data_start'], 0, 10);
					$response[$i]['data_finish'] = mb_substr($response[$i]['data_finish'], 0, 10);
				}
				$confirm['data'] = $response;
				echo json_encode($confirm);

			} else {
				$query = [];
				foreach ($arrQuery as $key => $value) $query['t1.'.$key] = $value;

				$this->db->distinct('t1.id');
				$this->db->select('t1.id')
					->from('research as t1')
					->where($query)
					->join('research_meta as t2', "t1.id = t2.post_id AND t2.key_meta = 'clinic_id' AND t2.value = '{$_POST['clinic']}'");
				$query = $this->db->get();
				$ids = $query->result_array();
				$research_ids = [];
				foreach ($ids as $item) $research_ids[] = $item['id'];
				$posts = $this->research->getPostsByArrId($research_ids);
				$response = [];
				if(!empty($_POST['keyword'])) {
					foreach($posts as $item) {
						$str = json_encode($item);
						if(stristr($str, $_POST['keyword']) !== FALSE) $response[] = $item;
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
}