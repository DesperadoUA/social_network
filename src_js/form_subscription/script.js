export const initial = function() {
	const API_URL = '/api/subscription'
	const LANG = window.location.pathname.startsWith('/ru') ? 'ru' : 'ua'
	const formSubscription = document.getElementById('subscription_form')
	const PAGE_REDIRECT = {
		'ru': 'https://'+document.domain+'/ru/thx',
		'ua': 'https://'+document.domain+'/thx-ua'
	}
	if(formSubscription){
		formSubscription.addEventListener('submit', (event)=>{
			event.preventDefault()

			const data = {
				form: 'subscription',
				name: document.getElementById('subscription_form_fio').value,
				phone: document.getElementById('subscription_form_phone').value,
				email: document.getElementById('subscription_form_email').value,
				city: document.getElementById('subscription_form_city').value,
				age: document.getElementById('subscription_form_age').value,
				gender: document.querySelector('.js_gender').dataset.gender,
			}

			fetch(API_URL, {
				method: 'POST',
				body: JSON.stringify(data)
			})
				.then((response) => {
					return response.json();
				})
				.then((data) => {
					if(data.status === 'ok') window.location = PAGE_REDIRECT[LANG]
					else alert('Error')
				});
		})
	}
}