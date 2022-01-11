export const initial = function() {
	const paidCheckbox = document.querySelectorAll('.js_search_checkbox_paid')
	if(paidCheckbox.length !== 0) {
		paidCheckbox.forEach(item => {
			item.addEventListener('click', (event)=>{
				paidCheckbox.forEach(item => {
					item.classList.remove('js_paid_research')
					item.classList.remove('active_checkbox')
				})
				event.target.classList.add('js_paid_research')
				event.target.classList.add('active_checkbox')

			})
		})
	}
	const API_URL = '/api/research'
	const LANG = window.location.pathname.startsWith('/ru') ? 'ru' : 'ua'
	const btnSearch = document.querySelector('.js_search_research')
	const container = document.querySelector('.research_loop')
	const numberResearch = document.querySelector('.js_search_research_total')
	const clearFilters = document.querySelector('.clear_filters')
	const EMPTY_REQUEST = {
		ru: 'Ничего не найдено',
		ua: 'Нічого не знайдено'
	}
	const TRANSLATE = {
		    PROTOCOL_NAME: {
			    'ru': 'Название протокола',
			    'ua': 'Назва протоколу'
            },
		    THERAPEUTIC_AREA: {
			    'ru': 'Терапевтическая область',
			    'ua': 'Терапевтична область'
            },
		    START_END_DATE: {
		    	'ru': 'Дата начала и окончания КИ',
		        'ua': 'Дата початку і закінчення КІ'
			},
		    NAME_ORGANIZATION_CONDUCTING: {
				'ru': 'Название организации проводящей КИ',
		        'ua': 'Назва організації провідної КІ'
			},
			WANT_PARTICIPATE: {
				'ru': 'Хочу участвовать',
		        'ua': 'Хочу брати участь'
            },
	        WRITE_RESEARCHERS: {
		        'ru': 'Написать исследователям',
		        'ua': 'Написати дослідникам'
		    },
		    DISEASE: {
				'ru': 'Заболевание',
				'ua': 'Захворювання'
			},
			PAID: {
				'ru': 'Платное',
				'ua': 'Платне'
			},
			FREE: {
				ru: 'Бесплатное',
				ua: 'Безкоштовне'
			},
			YES: {
		    	ru: 'Да',
				ua: 'Так'
			},
			NO: {
				ru: 'Нет',
				ua: 'Ні'
			}
	}

	if(btnSearch) {
		btnSearch.addEventListener('click', ()=>{
			const TDO = {
				lang: LANG,
				region: document.querySelector('.js_search_research_region').value,
				city: document.querySelector('.js_search_research_city').value,
				keyword: document.querySelector('.js_search_research_keyword').value,
				disease: document.querySelector('.js_search_research_disease').value,
				therapeutic_area: document.querySelector('.js_search_research_therapeutic_area').value,
				clinic: document.querySelector('.js_search_research_clinic').value,
				paid: document.querySelector('.js_paid_research').dataset.value
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
							console.log(container)
							container.innerHTML = createResearchItem(data.data)
						}
						else createEmptyRequest()
						removePagination()
						updateNumberResearch(data.data.length)
					}
					else {
						alert('Error')
					}
				})
		})
		if(clearFilters){
			clearFilters.addEventListener('click', () => {
				const optionsRegion = document.querySelectorAll('.js_search_research_region option');
				for (let i = 0, l = optionsRegion.length; i < l; i++) {
					optionsRegion[i].selected = optionsRegion[i].defaultSelected
				}
	
				const optionsCity = document.querySelectorAll('.js_search_research_city option');
				for (let i = 0, l = optionsCity.length; i < l; i++) {
					optionsCity[i].selected = optionsCity[i].defaultSelected
				}
				document.querySelector('.js_search_research_keyword').value = ''
	
				const optionsDisease = document.querySelectorAll('.js_search_research_disease option');
				for (let i = 0, l = optionsDisease.length; i < l; i++) {
					optionsDisease[i].selected = optionsDisease[i].defaultSelected
				}
	
				const therapeuticArea = document.querySelectorAll('.js_search_research_therapeutic_area option');
				for (let i = 0, l = therapeuticArea.length; i < l; i++) {
					therapeuticArea[i].selected = therapeuticArea[i].defaultSelected
				}
	
				const optionsClinic = document.querySelectorAll('.js_search_research_clinic option');
				for (let i = 0, l = optionsClinic.length; i < l; i++) {
					optionsClinic[i].selected = optionsClinic[i].defaultSelected
				}
	
				paidCheckbox[0].classList.add('js_paid_research')
				paidCheckbox[0].classList.add('active_checkbox')
	
				paidCheckbox[1].classList.remove('js_paid_research')
				paidCheckbox[1].classList.remove('active_checkbox')
				
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
	function createResearchItem(data) {
		let strHTML = ''
		data.forEach(item => {
			strHTML += `<div class="research_loop_item">
							<div class="container">
								<div class="research_loop_item_title">
									<a href="${item.permalink}">${item.title}</a>
								</div>
								<div class="research_loop_item_row">
									<div class="research_loop_item_left">${TRANSLATE.PROTOCOL_NAME[LANG]}</div>
									<div class="research_loop_item_right">${item.protocol_name}</div>
									<div class="research_line"></div>
								</div>
								<div class="research_loop_item_row">
									<div class="research_loop_item_left">${TRANSLATE.DISEASE[LANG]}</div>
									<div class="research_loop_item_right">${item.disease}</div>
									<div class="research_line"></div>
								</div>
								<div class="research_loop_item_row">
									<div class="research_loop_item_left">${TRANSLATE.THERAPEUTIC_AREA[LANG]}</div>
									<div class="research_loop_item_right">${item.therapeutic_area}</div>
									<div class="research_line"></div>
								</div>
								<div class="research_loop_item_row">
									<div class="research_loop_item_left">${TRANSLATE.PAID[LANG]}</div>
									<div class="research_loop_item_right">
                                        ${item.paid === "1" ? TRANSLATE.YES[LANG] : TRANSLATE.NO[LANG]}
                                    </div>
									<div class="research_line"></div>
								</div>
								<div class="research_loop_item_row">
									<div class="research_loop_item_left">${TRANSLATE.START_END_DATE[LANG]}</div>
									<div class="research_loop_item_right">${item.data_start} - ${item.data_finish}</div>
									<div class="research_line"></div>
								</div>
								<div class="research_loop_item_row">
									<div class="research_loop_item_left">${TRANSLATE.NAME_ORGANIZATION_CONDUCTING[LANG]}</div>
									<div class="research_loop_item_right">${item.name_organization}</div>
									<div class="research_line"></div>
								</div>
								<div class="research_loop_item_row_btn">
									<button class="research_loop_btn research_participate border_gradient" data-id="${item.id}">
									${TRANSLATE.WANT_PARTICIPATE[LANG]}
									</button>
									<button class="research_loop_btn research_active border_gradient" data-id="${item.id}">
									${TRANSLATE.WRITE_RESEARCHERS[LANG]}
									</button>
								</div>
							</div>
						</div>`
		})
		return strHTML
	}
	function updateNumberResearch(count) {
		numberResearch.innerHTML = count
	}
}