export const initial = function() {
	const genderCheckbox = document.querySelectorAll('.js_search_checkbox_open')
	if(genderCheckbox.length !== 0) {
		genderCheckbox.forEach(item => {
			item.addEventListener('click', (event)=>{
				genderCheckbox.forEach(item => {
					item.classList.remove('js_open_research')
					item.classList.remove('active_checkbox')
				})
				event.target.classList.add('js_open_research')
				event.target.classList.add('active_checkbox')

			})
		})
	}
	const API_URL = '/api/research'
	const LANG = window.location.pathname.startsWith('/ua/') ? 'ua' : 'ru'
	const btnSearch = document.querySelector('.js_search_research')
	const container = document.querySelector('.research_loop')
	const numberResearch = document.querySelector('.js_search_research_total')

	if(btnSearch) {
		btnSearch.addEventListener('click', ()=>{
			const TDO = {
				lang: LANG,
				region: document.querySelector('.js_search_research_region').value,
				city: document.querySelector('.js_search_research_city').value,
				keyword: document.querySelector('.js_search_research_keyword').value,
				disease: document.querySelector('.js_search_research_disease').value,
				held: document.querySelector('.js_search_research_held').value,
				clinic: document.querySelector('.js_search_research_clinic').value,
				open: document.querySelector('.js_open_research').dataset.value
			}
			console.log(TDO)
			fetch(API_URL, {
				method: 'POST',
				body: JSON.stringify(TDO)
			})
				.then((response) => {
					return response.json();
				})
				.then((data) => {
					console.log(data)
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
	}
	function removePagination(){
		const pagination = document.querySelector('.pagination')
		if(pagination) pagination.remove()
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
									<div class="research_loop_item_left">Название протокола</div>
									<div class="research_loop_item_right">${item.protocol_name}</div>
									<div class="research_line"></div>
								</div>
								<div class="research_loop_item_row">
									<div class="research_loop_item_left">Терапевтическая область</div>
									<div class="research_loop_item_right">${item.therapeutic_area}</div>
									<div class="research_line"></div>
								</div>
								<div class="research_loop_item_row">
									<div class="research_loop_item_left">Дата начала и окончания КИ</div>
									<div class="research_loop_item_right">${item.data_start} - ${item.data_finish}</div>
									<div class="research_line"></div>
								</div>
								<div class="research_loop_item_row">
									<div class="research_loop_item_left">Название организации проводящей КИ</div>
									<div class="research_loop_item_right">${item.name_organization}</div>
									<div class="research_line"></div>
								</div>
								<div class="research_loop_item_row_btn">
									<button class="research_loop_btn research_participate border_gradient" data-id="${item.id}">
									Хочу участвовать
									</button>
									<button class="research_loop_btn research_active border_gradient" data-id="${item.id}">
									Написать исследователям
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