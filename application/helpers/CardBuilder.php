<?php
/**
 * Created by PhpStorm.
 * User: Костя
 * Date: 26.09.2021
 * Time: 10:47
 */

class CardBuilder
{
	static function storiesCard($posts, $lang_prefix){
		if(empty($posts)) return [];
		$newPosts = [];
		for($i = 0; $i<count($posts); $i++) {
			$newPosts[$i]['thumbnail'] = json_decode($posts[$i]['thumbnail'], true);
			$newPosts[$i]['permalink'] = $lang_prefix.'/'.$posts[$i]['slug'].'/'.$posts[$i]['permalink'];
			$newPosts[$i]['title'] = $posts[$i]['title'];
			$newPosts[$i]['short_desc'] = $posts[$i]['short_desc'];
		}
		return $newPosts;
	}
	static function researchCard($posts, $lang_prefix){
		if(empty($posts)) return [];
		$newPosts = [];
		foreach($posts as $item) {
			$newPosts[] = [
				'id' => $item['id'],
				'title' => $item['title'],
				'permalink' => $lang_prefix.'/'.$item['slug'].'/'.$item['permalink'],
				'data_start' => substr($item['data_start'], 0, 10),
			    'data_finish' => substr($item['data_finish'], 0, 10),
				'paid' => $item['paid'],
				'protocol_name' => $item['protocol_name'],
				'disease' => $item['disease'],
				'therapeutic_area' => $item['therapeutic_area'],
				'name_organization' => $item['name_organization']
			];
		}
		return $newPosts;
	}
	static function articleDoctorCard($posts) {
		if(empty($posts)) return [];
		$new_posts = [];
		foreach($posts as $item) {
			$lang_prefix = $item['lang'] = 'ua' ? '' : '/ru';
			$year = ($item['experience'] > 4) 
				        ? $item['experience']." ".TRANSLATE['YEAR_PLURAL'][LANG] 
						: $item['experience']." ".TRANSLATE['YEAR'][LANG];
			$new_posts[] = [
				'title' => $item['title'],
				'specialization' => $item['specialization'],
				'permalink' => $lang_prefix.'/'.$item['slug'].'/'.$item['permalink'],
				'experience' => $year,
				'clinic' => $item['clinic'],
				'thumbnail' => json_decode($item['thumbnail'], true)
			];
		}
		return $new_posts;
	}
}