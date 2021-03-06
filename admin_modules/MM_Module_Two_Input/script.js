export const initial = function() {
	const btnTwoInput = document.querySelectorAll('.mm_module_two_input_add')
	if (btnTwoInput) {
		btnTwoInput.forEach(item => {
			const nameModules = item.getAttribute('data-name')
			item.addEventListener('click', function () {
				const label_1 = item.getAttribute('data-label-1')
				const label_2 = item.getAttribute('data-label-2')
				createRowTwoInput(nameModules, label_1, label_2)
			})
		})

		function createRowTwoInput(name, label_1, label_2) {
			const row = document.createElement("div")
			row.classList.add('mm_row')
			row.innerHTML = `<span class='delete_module'>X</span>
						 <span class='up_module'>⇑</span>
						<span class='bottom_module'>⇓</span>
						 <div class="wrapper_input">
						    <label for="description">${label_1}</label>
						    <input type="text" class="mm_input" name="first_input_${name}[]" value="">
				         </div>
					     <div class="wrapper_input">
						    <label for="description">${label_2}</label>
						    <input type="text" class="mm_input" name="second_input_${name}[]" value="">
					     </div>`
			const container = document.querySelector(`[data-type='mm_module_two_input_${name}']`)
			container.append(row)
		}
	}
}