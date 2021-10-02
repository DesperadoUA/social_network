export const initial = function() {
	const API_URL = '/api/subscription-main'
	const LANG = window.location.pathname.startsWith('/ru') ? 'ru' : 'ua'
	const formSubscriptionMain = document.getElementById('subscription_form_main')
	const checkBoxConfirm = document.querySelectorAll('.form_checkbox_confirm')
	const currentCheckBoxConfirm = document.getElementById('subscription_form_main_confirm')
	const PAGE_REDIRECT = {
		'ru': 'https://'+document.domain+'/ru/thx',
		'ua': 'https://'+document.domain+'/thx-ua'
	}

	if(checkBoxConfirm.length !== 0) {
		checkBoxConfirm.forEach(item => {
			item.addEventListener('click', (event)=>{
				if(event.target.classList.contains('active_checkbox')) {
					event.target.classList.remove('active_checkbox')
				}
				else {
					event.target.classList.add('active_checkbox')
				}
			})
		})
	}

	if(formSubscriptionMain){
		formSubscriptionMain.addEventListener('submit', (event)=>{
			event.preventDefault()

			const data = {
				form: 'subscription-main',
				name: document.getElementById('subscription_form_main_fio').value,
				email: document.getElementById('subscription_form_main_email').value,
				city: document.getElementById('subscription_form_main_city').value,
				age: document.getElementById('subscription_form_main_age').value,
				diagnosis: document.getElementById('subscription_form_main_diagnosis').value,
				relocate: document.getElementById('subscription_form_main_relocate').value,
			}

			if(currentCheckBoxConfirm) {
				if(!currentCheckBoxConfirm.classList.contains('active_checkbox')) {
					return
				}
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