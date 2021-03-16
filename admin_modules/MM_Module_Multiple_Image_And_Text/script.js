export const initial = function() {
	const btnMultipleImgText = document.querySelectorAll('.mm_module_multiple_image_and_text_add')
	if (btnMultipleImgText) {
		btnMultipleImgText.forEach(item => {
			const nameModules = item.getAttribute('data-name')
			item.addEventListener('click', function () {
				createRowMultipleImgText(nameModules)
			})
		})

		function createRowMultipleImgText(name) {
			const row = document.createElement("div")
			row.classList.add('mm_row')
			row.innerHTML = `<span class='delete_module'>X</span>
							 <span class='up_module'>⇑</span>
							 <span class='bottom_module'>⇓</span>
						 <div class="wrapper_input space_between margin_top_30">
						    <div>
								<label>Desctop</label>
								<input type="file" 
								       class="" 
								       name="mm_module_multiple_image_and_text_desctop_${name}[]">
								<input type="hidden" 
								       name="mm_module_multiple_image_and_text_src_${name}[]" 
								       value="">
							</div>
						<div>
				        </div></div>
					     <div class="wrapper_input space_between margin_top_30">
					        <div>
								<label>Mobile</label>
								<input type="file" 
								       class="" 
								       name="mm_module_multiple_image_and_text_mobile_${name}[]">
								<input type="hidden" 
								       name="mm_module_multiple_image_and_text_src_${name}[]" 
								       value="">
							</div>
						<div>
						 </div></div>
					     <div class="wrapper_input">
							<label for="description">Title</label>
							<input type="text" 
							       class="mm_input" 
							       name="mm_module_multiple_image_and_text_title_${name}[]" 
							       value="">
				    	</div>
				    	 <div class="wrapper_input">
							<label for="description">Alt</label>
							<input type="text" 
							       class="mm_input" 
							       name="mm_module_multiple_image_and_text_alt_${name}[]" 
							       value="">
				    	</div>
                         <div class="wrapper_input full_size">
						    <label for="description">Description</label>
						    <input type="text" class="mm_input " name="mm_module_multiple_image_and_text_description_${name}[]" 
						    value="">
					     </div>`

			const container = document.querySelector(`[data-type='mm_module_multiple_image_and_text_${name}']`)
			container.append(row)
		}
	}
}