export const initial = function() {
	const API_URL = '/api/mailer'
	const body = document.getElementsByTagName('body')[0]
	const popUpResearch = document.getElementById('pop_up_active')
	const formResearch = document.getElementById('form_active')
	const LANG = window.location.pathname.startsWith('/ua/') ? 'ua' : 'ru'
	const PAGE_REDIRECT = {
		'ru': 'thx',
		'ua': '/ua/thx'
	}
	let currentId = 0

	body.addEventListener('click', (event)=>{
		if(event.target.classList.contains('research_active')) {
			popUpResearch.classList.add('pop_up_show')
			currentId = event.target.dataset.id
		}
	})

	formResearch.addEventListener('submit', (event)=>{
		event.preventDefault()
		const data = {
			form: 'research',
			name: document.getElementById('name_research').value,
			phone: document.getElementById('phone_research').value,
			city: document.getElementById('city_research').value,
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
		document.getElementById('name_research').value = ''
		document.getElementById('phone_research').value = ''
		document.getElementById('city_research').value = ''
	}
	popUpResearch.addEventListener('click', (event) => {
		if(event.target.classList.contains('pop_up')) {
			popUpResearch.classList.remove('pop_up_show')
			currentId = 0
		}
	})
}