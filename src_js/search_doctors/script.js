export const initial = function() {
	const API_URL = '/api/doctors'
	const LANG = window.location.pathname.startsWith('/ru') ? 'ru' : 'ua'
	const btnSearch = document.querySelector('.js_search_doctors')
	const container = document.querySelector('.doctors_loop')
	const numberPosts = document.querySelector('.js_search_doctors_total')
	const clearFilters = document.querySelector('.js_search_doctors_clear_filters')
	const EMPTY_REQUEST = {
		ru: 'Ничего не найдено',
		ua: 'Нічого не знайдено'
	}
	const TRANSLATE = {
		CHOOSE_REGION: {
			ru: 'Выберите регион',
		    ua: 'Виберіть регіон'
        },
		NAME_RESEARCH: {
			ru: 'ФИО исследователя',
		    ua: 'ПІБ дослідника'
		},
		SPECIALIZATION: {
			ru: 'Специализация',
		    ua: 'Спеціалізація'
		},
		NAME_MEDICAL_INSTITUTION: {
			ru: 'Название мед учереждения',
		    ua: 'Назва мед установи'
		},
		CR_EXPERIENCE: {
			ru: 'Стаж в КИ',
		    ua: 'Стаж у КД'
		},
		CITY: {
			ru: 'Выберите город',
		    ua: 'Виберіть місто'
		},
		MEDICAL_INSTITUT: {
			ru: 'Название мед учереждения',
		    ua: 'Назва мед установи'
		},
		CR_COUNT: {
			ru: 'Кол-во проведенных КИ',
		    ua: 'Кількість проведених КД'
		}
			
	}

	if(btnSearch) {
		btnSearch.addEventListener('click', ()=>{
			const TDO = {
				lang: LANG,
				region: document.querySelector('.js_search_doctors_region').value,
				city: document.querySelector('.js_search_doctors_city').value,
				name: document.querySelector('.js_search_doctors_name').value,
				specialization: document.querySelector('.js_search_doctors_specialization').value,
				clinics: document.querySelector('.js_search_doctors_clinics').value,
				cr_experience: document.querySelector('.js_search_doctors_cr_experience').value
			}

			fetch(API_URL, {
				method: 'POST',
				body: JSON.stringify(TDO)
			})
				.then((response) => {
					return response.json();
				})
				.then((data) => {
					if(data.status === 'ok') {
						if(data.data.length !==0) {
							container.innerHTML = createItem(data.data)
						}
						else createEmptyRequest()
						removePagination()
						updateNumberPosts(data.data.length)
					}
					else {
						alert('Error')
					}
				})
		})
		
		if(clearFilters){
			clearFilters.addEventListener('click', () => {
				const optionsRegion = document.querySelectorAll('.js_search_doctors_region option')
				for (let i = 0, l = optionsRegion.length; i < l; i++) {
					optionsRegion[i].selected = optionsRegion[i].defaultSelected
				}
	
				const optionsCity = document.querySelectorAll('.js_search_doctors_city option')
				for (let i = 0, l = optionsCity.length; i < l; i++) {
					optionsCity[i].selected = optionsCity[i].defaultSelected
				}

				const optionsSpecialization = document.querySelectorAll('.js_search_doctors_specialization option')
				for (let i = 0, l = optionsSpecialization.length; i < l; i++) {
					optionsSpecialization[i].selected = optionsSpecialization[i].defaultSelected
				}

				document.querySelector('.js_search_doctors_name').value = ''
				document.querySelector('.js_search_doctors_clinics').value = ''
				document.querySelector('.js_search_doctors_cr_experience').value = ''				
			})
		}
	}
	function removePagination(){
		const pagination = document.querySelector('.pagination')
		if(pagination) pagination.remove()
	}
	function createEmptyRequest() {
		container.innerHTML = `<div class="container">
                                    <p class="empty_result">${EMPTY_REQUEST[LANG]}</p>
                               </div>`
	} 
	function createItem(data) {
		let strHTML = ''
		data.forEach(item => {
			strHTML += `<div class='doctors_row'>
							<div class='container'>
								<article class='doctors_loop_item'>
									<div class='doctors_loop_title'>
										<a href='${item['permalink']}'>${item['title']}</a>
									</div>
									<div class='doctors_loop_item_row'>
										<div class='doctors_loop_item_left'>${TRANSLATE['CITY'][LANG]}</div>
										<div class='doctors_loop_item_right'>${item['city']}</div>
										<div class='gradient_line'></div>
									</div>
									<div class='doctors_loop_item_row'>
										<div class='doctors_loop_item_left'>${TRANSLATE['MEDICAL_INSTITUT'][LANG]}</div>
										<div class='doctors_loop_item_right'>${item['clinic']}</div>
										<div class='gradient_line'></div>
									</div>
									<div class='doctors_loop_item_row'>
										<div class='doctors_loop_item_left'>${TRANSLATE['CR_EXPERIENCE'][LANG]}</div>
										<div class='doctors_loop_item_right'>${item['experience_cr']}</div>
										<div class='gradient_line'></div>
									</div>
									<div class='doctors_loop_item_row'>
										<div class='doctors_loop_item_left'>${TRANSLATE['CR_COUNT'][LANG]}</div>
										<div class='doctors_loop_item_right'>${item['count_research']}</div>
										<div class='gradient_line'></div>
									</div>
								</article>
								</div>
							</div>`
		})
		return strHTML
	}
	function updateNumberPosts(count) {
		numberPosts.innerHTML = count
	}

}