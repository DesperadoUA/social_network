export const initial = function() {
	const btnMultipleImg = document.querySelectorAll('.mm_module_multiple_image_add')
	if (btnMultipleImg) {
		btnMultipleImg.forEach(item => {
			const nameModules = item.getAttribute('data-name')
			item.addEventListener('click', function () {
				createRowMultipleImg(nameModules)
			})
		})

		function createRowMultipleImg(name) {
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
								       name="mm_module_multiple_image_desctop_${name}[]">
								<input type="hidden" 
								       name="mm_module_multiple_image_desctop_src_${name}[]" 
								       value="">
							</div><div>
				        </div></div>
					     <div class="wrapper_input space_between margin_top_30">
					        <div>
								<label>Mobile</label>
								<input type="file" 
								       class="" 
								       name="mm_module_multiple_image_mobile_${name}[]">
								<input type="hidden" 
								       name="mm_module_multiple_image_mobile_src_${name}[]" 
								       value="">
							</div><div>
						 </div></div>
					     <div class="wrapper_input">
							<label for="description">Title</label>
							<input type="text" 
							       class="mm_input" 
							       name="mm_module_multiple_image_title_${name}[]" 
							       value="">
				    	</div>
				    	 <div class="wrapper_input">
							<label for="description">Alt</label>
							<input type="text" 
							       class="mm_input" 
							       name="mm_module_multiple_image_alt_${name}[]" 
							       value="">
				    	</div>`

			const container = document.querySelector(`[data-type='mm_module_multiple_image_${name}']`)
			container.append(row)
		}
	}
}