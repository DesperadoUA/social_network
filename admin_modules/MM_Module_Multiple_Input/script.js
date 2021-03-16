export const initial = function() {
	const btnMultipleInput = document.querySelectorAll('.mm_module_multiple_input_add')
	if (btnMultipleInput) {
		btnMultipleInput.forEach(item => {
			const nameModules = item.getAttribute('data-name')
			item.addEventListener('click', function () {
				createRowMultipleInput(nameModules)
			})
		})
	}

	function createRowMultipleInput(name) {
			const row = document.createElement("div")
			row.classList.add('mm_row')
			row.innerHTML = `<span class="delete_module">X</span>
							      <span class="up_module">⇑</span>
							      <span class="bottom_module">⇓</span><div class="wrapper_input full_size">
						          <label for="description">Text</label>
						          <input type="text" 
						                 class="mm_input" 
						                 name="mm_module_multiple_input_${name}[]" 
						                 value="">
					         `

			const container = document.querySelector(`[data-type='mm_module_multiple_input_${name}']`)
			container.append(row)
		}
}