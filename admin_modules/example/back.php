<?php
class MM_Module_Example
{
	public function staticPageUpdate()
	{
		$request['breadcrumbs'] = MM_Module_Two_Input::getData('breadcrumbs');
		$request['menu'] = MM_Module_Two_Input::getData('menu');
		$request['main_content'] = MM_Module_Rich_Text::getData('main_content');
		$request['title_cyr_to_lat'] = MM_Module_Cyr_To_Lat::getData('title');
		$request['permalink_cyr_to_lat'] = MM_Module_Cyr_To_Lat::getData('permalink');
		$request['title'] = MM_Module_Textarea::getData('title');
		$request['description'] = MM_Module_Textarea::getData('description');
		$request['permalink'] = MM_Module_Textarea::getData('permalink');
		$request['keywords'] = MM_Module_Textarea::getData('keywords');
		$request['thumbnail'] = MM_Module_Image::getData('thumbnail');
		$request['support_img'] = MM_Module_Image::getData('support_img');
		$request['second_text'] = MM_Module_Rich_Text::getData('second_text');
		$request['data_publick'] = MM_Module_Textarea::getData('data_publick');
		$request['data_change'] = MM_Module_Textarea::getData('data_change');
		$request['multiple_image'] = MM_Module_Multiple_Image::getData('multiple_image');
		$request['multiple_image_and_text'] = MM_Module_Multiple_Image_And_Text::getData('multiple_image_and_text');
		$request['relative_posts'] = MM_Module_Relative::getData('relative_posts');
//---------------------//

		$data['title'] = $request['title'];
		$data['permalink'] = $request['permalink'];
		$data['keywords'] = $request['keywords'];
		$data['description'] = $request['description'];
		$data['data_publick'] = $request['data_publick'];
		$data['data_change'] = $request['data_change'];
		$data['content'] = [
			'text' => $request['main_content'],
			'breadcrumbs' => $request['breadcrumbs'],
			'menu' => $request['menu'],
			'support_img' => $request['support_img'],
			'second_text' => $request['second_text'],
			'multiple_img' => $request['multiple_image'],
			'multiple_image_and_text' => $request['multiple_image_and_text'],
			'relative' => $request['relative_posts'],
		];

		$data['thumbnail'] = json_encode($request['thumbnail'], JSON_UNESCAPED_UNICODE);
		$data['content'] = json_encode($data['content'], JSON_UNESCAPED_UNICODE);

		$this->static_page->updateDateById(1, $data);
		redirect('/admin/static-page/1', 'location', 301);
	}
}