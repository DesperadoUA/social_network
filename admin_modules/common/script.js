export const initial = function () {
	const openCloseButton = document.querySelectorAll('.mm_open_close')
	if(openCloseButton){
		openCloseButton.forEach(button => {
			button.addEventListener('click', openCloseContainer)
		})
		function openCloseContainer(event){
			if(event.target.nextElementSibling.classList.contains('hide')) {
				event.target.nextElementSibling.classList.remove('hide')
				event.target.classList.add('rotate_top')
			}
			else {
				event.target.nextElementSibling.classList.add('hide')
				event.target.classList.remove('rotate_top')
			}
		}
	}

	const mainContainer = document.querySelector('.mm_modules_container')
	if(mainContainer) {
		mainContainer.addEventListener('click', function (event) {
			if (event.target.classList.contains('delete_module')) {
				event.target.parentElement.remove()
			}
			else if (event.target.classList.contains('up_module')) {
				if (event.target.parentElement.previousElementSibling) {
					event.target.parentElement.previousElementSibling.before(event.target.parentElement)
				}
			}
			else if (event.target.classList.contains('bottom_module')) {
				if (event.target.parentElement.nextElementSibling) {
					event.target.parentElement.nextElementSibling.after(event.target.parentElement)
				}
			}
		})
	}
}
