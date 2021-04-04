export const initial = function() {
	const API_URL = '/api/mailer'
	const body = document.getElementsByTagName('body')[0]
	const popUpParticipate = document.getElementById('pop_up_participate')
	const formParticipate = document.getElementById('form_participate')
	const LANG = window.location.pathname.startsWith('/ua') ? 'ua' : 'ru'
	const PAGE_REDIRECT = {
		'ru': 'thx',
		'ua': '/ua/thx-ua'
	}
	let currentId = 0

	body.addEventListener('click', (event)=>{
		if(event.target.classList.contains('research_participate')) {
			popUpParticipate.classList.add('pop_up_show')
			currentId = event.target.dataset.id
		}
	})
	const genderCheckbox = document.querySelectorAll('.form_checkbox_gender')
	if(genderCheckbox.length !== 0) {
		genderCheckbox.forEach(item => {
			item.addEventListener('click', (event)=>{
				genderCheckbox.forEach(item => {
					item.classList.remove('js_gender')
					item.classList.remove('active_checkbox')
				})
				event.target.classList.add('js_gender')
				event.target.classList.add('active_checkbox')

			})
		})
	}

	formParticipate.addEventListener('submit', (event)=>{
		event.preventDefault()
		const data = {
			form: 'participate',
			name: document.getElementById('name_participate').value,
			phone: document.getElementById('phone_participate').value,
			city: document.getElementById('city_participate').value,
			age: document.getElementById('age_participate').value,
			email: document.getElementById('email_participate').value,
			gender: document.querySelector('.js_gender').dataset.gender,
			currentId: currentId
		}
		clearFields()

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

	function clearFields() {
		document.getElementById('name_participate').value = ''
		document.getElementById('phone_participate').value = ''
		document.getElementById('city_participate').value = ''
		document.getElementById('age_participate').value = ''
		document.getElementById('email_participate').value = ''
	}

	popUpParticipate.addEventListener('click', (event) => {
		if(event.target.classList.contains('pop_up')) {
			popUpParticipate.classList.remove('pop_up_show')
			currentId = 0
		}
	})
}