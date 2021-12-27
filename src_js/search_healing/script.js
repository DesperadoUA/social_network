export const initial = function() {
	const searchInput = document.querySelector('.js_search_healing_keyword')
	const API_URL = '/api/healing'
	const LANG = window.location.pathname.startsWith('/ru') ? 'ru' : 'ua'
	const btnSearch = document.querySelector('.js_search_healing')
	const container = document.querySelector('.healing_loop_wrapper')
	const EMPTY_REQUEST = {
		ru: 'Ничего не найдено',
		ua: 'Нічого не знайдено'
	}
	
	if(btnSearch) {
		btnSearch.addEventListener('click', ()=>{
			const TDO = {
				lang: LANG,
				keyword: searchInput.value,
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
						console.log(data)
						if(data.data.length !==0) {
							container.innerHTML = createResearchItem(data.data)
						}
						else createEmptyRequest()
						removePagination()
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
	function createEmptyRequest() {
		container.innerHTML = `<div class="container">
                                    <p class="empty_result">${EMPTY_REQUEST[LANG]}</p>
                               </div>`
	} 
	function createResearchItem(data) {
		let strHTML = ''
		data.forEach(item => {
			strHTML += `<div class='healing_loop_row'>
			<div class='container'>
				<article class='healing_loop_item'>
					<div class='healing_loop_item_title'>
					   ${item['title']}
					</div>`;
			if(item['child'].length !== 0) {
				strHTML += `<div class='row_healing_loop_item_disease'>`;
						item['child'].forEach(child => {
							strHTML += `<div class='item_disease'>
							            <a href='${child['permalink']}'>${child['title']}</a>
						  			  </div>`;
						} )
				strHTML += "</div>";
					}
			strHTML += `</div>
				    </article>
			      </div>
		       </div>`
		})
		return strHTML
	}
}