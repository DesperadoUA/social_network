export const initial = function() {
	const API_URL = '/api/contacts'
	const formContacts = document.getElementById('form_contacts')
	const LANG = window.location.pathname.startsWith('/ru') ? 'ru' : 'ua'
	const PAGE_REDIRECT = {
		'ru': 'https://'+document.domain+'/ru/thx',
		'ua': 'https://'+document.domain+'/thx-ua'
	}
	if(formContacts) {
		formContacts.addEventListener('submit', (event)=>{
			event.preventDefault()
			const data = {
				form: 'contacts',
				name: document.getElementById('name_contacts').value,
				phone: document.getElementById('phone_contacts').value,
				city: document.getElementById('city_contacts').value,
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