const API_URL = '/login/api'
const btn = document.querySelector('.submit_mm')

const DAL = {
	checkLogin(login, password){
		return fetch(API_URL, {
				method: 'POST',
				body: JSON.stringify({login, password})
			}
		)
			.then(response => response.json())
			.then( data => data )
	}
}
btn.addEventListener('click', function () {
	const login = document.querySelector('.js_login').value
	const password = document.querySelector('.js_password').value

	;(async () => {
		const data = await DAL.checkLogin(login, password)
		if(data.status === 'success') window.location.href = '/admin'
		else {
			document.querySelector('.error_block').innerHTML = 'Не верный логин или пароль'
		}
	})();
})