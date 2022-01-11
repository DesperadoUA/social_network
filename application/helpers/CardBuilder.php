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
}