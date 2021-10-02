export const initial = function() {
	if(!localStorage.getItem('cookies')) {
		const button = document.getElementById('cookies_button')
		const cookiePopUp = document.getElementById('cookies')
		cookiePopUp.classList.add('pop_up_show')
		button.addEventListener('click', ()=> {
			localStorage.setItem('cookies', "true")
			cookiePopUp.classList.remove('pop_up_show')
		})
	}
}