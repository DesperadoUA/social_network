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
}