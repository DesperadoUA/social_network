export const initial = function() {
	const API_URL = '/api/analyzes'
	const body = document.getElementsByTagName('body')[0]
	const popUpAnalyzes = document.getElementById('pop_up_analyzes')
	const formAnalyzes = document.getElementById('form_analyzes')
	const LANG = window.location.pathname.startsWith('/ru') ? 'ru' : 'ua'
	const btnClosePopUp = document.querySelector('.close_analyzes')
	const fileLoad = document.getElementById('file_analyzes')
	const fileForm = { name:'', base64: ''}
	const PAGE_REDIRECT = {
		'ru': 'https://'+document.domain+'/ru/thx',
		'ua': 'https://'+document.domain+'/thx-ua'
	}

	body.addEventListener('click', (event)=>{
		if(event.target.classList.contains('js_form_analyzes')) {
			popUpAnalyzes.classList.add('pop_up_show')
		}
	})

	fileLoad.addEventListener('change', ()=>{
		const file = document.getElementById('file_analyzes').files[0]
		if(file) {
			const reader = new FileReader()
			reader.readAsDataURL(file)
			reader.onload = function() {
				fileForm.base64 = reader.result
				fileForm.name = file.name
			}
		}
	})

	formAnalyzes.addEventListener('submit', (event)=> {
		event.preventDefault()
		if(fileForm.name !== '') {
			const data = {
				form: 'analyzes',
				name: document.getElementById('name_analyzes').value,
				comment: document.getElementById('comment_analyzes').value,
				phone: document.getElementById('phone_analyzes').value,
				file: fileForm
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
		}
		else {
			alert('File empty')
		}
    })
	popUpAnalyzes.addEventListener('click', (event) => {
		if(event.target.classList.contains('pop_up')) {
			popUpAnalyzes.classList.remove('pop_up_show')
		}
	})
	btnClosePopUp.addEventListener('click', () => {
		popUpAnalyzes.classList.remove('pop_up_show')
	})
}