export const initial = function() {
	const API_URL = '/api/clinics'
	const LANG = window.location.pathname.startsWith('/ru') ? 'ru' : 'ua'
	const btnSearch = document.querySelector('.js_search_clinic')
	const container = document.querySelector('.clinic_loop_wrapper')
	const numberClinic = document.querySelector('.js_search_clinic_total')
	const EMPTY_REQUEST = {
		ru: 'Ничего не найдено',
		ua: 'Нічого не знайдено'
	}
	
	const TRANSLATE = {
		city: {
			ru: 'Город',
			ua: 'Город'
		},
		adress: {
			ru: 'Адрес',
			ua: 'Адреса'
		},
		researchers: {
			ru: 'Исследователи',
			ua: 'Дослідники'
		},
		current_ci: {
			ru: 'Текущих КИ',
			ua: 'Поточних КД'
		},
		all_ci: {
			ru: 'Всего КИ',
			ua: 'Всього КД'
		}
	}
	if(btnSearch) {
		btnSearch.addEventListener('click', ()=>{
			const TDO = {
				lang: LANG,
				region: document.querySelector('.js_search_clinic_region').value,
				city: document.querySelector('.js_search_clinic_city').value,
				therapeutic_area: document.querySelector('.js_search_clinic_therapeutic_area').value,
				keyword: document.querySelector('.js_search_clinic_keyword').value,
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
						if(data.data.length !==0){
							container.innerHTML = createClinicsItem(data.data)
						}
						else createEmptyRequest()
						removePagination()
						updateNumberClinic(data.data.length)
					} else {
						alert('Error')
					}
				});
		})
	}

	function createEmptyRequest() {
		container.innerHTML = `<div class="container">
                                    <p class="empty_result">${EMPTY_REQUEST[LANG]}</p>
                               </div>`
	}
	function removePagination(){
		const pagination = document.querySelector('.pagination')
		if(pagination) pagination.remove()
	}
	function createClinicsItem(data) {
		let strHTML = ''
		data.forEach(item => {
			strHTML += `<div class="clinic_loop_row">
                    <div class="container">
                        <div class="clinic_loop_item">
                            <div class="clinic_loop_item_title">
                                <a href="${item.permalink}">
                                ${item.full_name}
                                </a>
                            </div>
                            <div class="clinic_loop_item_characters">
                                <div class="clinic_loop_item_characters_left">${TRANSLATE.city[LANG]}</div>
                                <div class="clinic_loop_item_characters_right">${item.city}</div>
                            </div>
                            <div class="clinic_loop_item_characters">
                                <div class="clinic_loop_item_characters_left">${TRANSLATE.adress[LANG]}</div>
                                <div class="clinic_loop_item_characters_right">${item.address}</div>
                            </div>
                            <div class="clinic_loop_item_characters">
                                <div class="clinic_loop_item_characters_left">${TRANSLATE.researchers[LANG]}</div>
                                <div class="clinic_loop_item_characters_right">${item.researchers}</div>
                            </div>
                            <div class="clinic_loop_item_characters">
                                <div class="clinic_loop_item_characters_left">${TRANSLATE.current_ci[LANG]}</div>
                                <div class="clinic_loop_item_characters_right">${item.total_active_research}</div>
                            </div>
                            <div class="clinic_loop_item_characters">
                                <div class="clinic_loop_item_characters_left">${TRANSLATE.all_ci[LANG]}</div>
                                <div class="clinic_loop_item_characters_right">${item.total_research}</div>
                            </div>
                        </div>
                    </div>
                </div>`
		})
		return strHTML
	}
	function updateNumberClinic(count) {
		numberClinic.innerHTML = count
	}
}