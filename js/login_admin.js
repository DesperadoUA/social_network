const API_URL = '/login/api'
btn = document.querySelector('.submit_mm')
const DAL = {
	checkLogin(){
		const login = 'hello'
		const password = 'world'
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
	(async () => {
		const data = await DAL.checkLogin()
	})();
})