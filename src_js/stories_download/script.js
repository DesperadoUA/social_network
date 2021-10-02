export const initial = function() {
	const btnLoad = document.querySelector('.js_stories_download')
	if(btnLoad) {
		const containerPosts = document.querySelector('.stories_main_loop_row')
		const containerBtn = document.querySelector('.stories_main_loop_btn_wrapper')
		const API_URL = '/api/stories'
		const LANG = window.location.pathname.startsWith('/ru') ? 'ru' : 'ua'
		const postsOnPage = btnLoad.dataset.posts
		const TDO = { lang: LANG, offset: postsOnPage}
		let currentPage = 0
		let posts = []
		const TRANSLATE = {
			readMore: {
				ru: 'Читать',
				ua: 'Читати'
			}
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
					posts = data.data
				}
				else {
					alert('Error')
				}
			})


		btnLoad.addEventListener('click', ()=> {
			const sliceNumberPage = currentPage*postsOnPage === 0 ? 0 : currentPage*postsOnPage -1
			const currentPosts = posts.slice(sliceNumberPage, postsOnPage)
			containerPosts.insertAdjacentHTML('beforeend', cardBuilder(currentPosts))
			currentPage++
			hideBtnLoad(currentPage)
		})

		function cardBuilder(posts) {
			let strHtml = ''
			posts.forEach(item => {
				strHtml += `<div class="stories_main_loop_item">
                            <div class="stories_main_loop_card_img">
                                <img src="${item.thumbnail.src}">
                                <div class="card_img_line"></div>
                            </div>
                            <div class="stories_main_loop_card_desc">
                                <div>
                                    <a href="${item.permalink}" class="stories_main_loop_card_permalink">
                                        ${item.title}
                                    </a>
                                    <p>${item.short_desc}</p>
                                </div>
                                <div class="stories_main_loop_action">
                                    <a href="${item.permalink}" 
                                    class="stories_main_loop_card_permalink_button">
                                       ${TRANSLATE.readMore[LANG]}
                                    </a>
                                </div>
                            </div>
                        </div>`
			})
			return strHtml
		}
		function hideBtnLoad(currentPage) {
			const downloadPosts = currentPage*postsOnPage
			if(downloadPosts >= posts.length) {
				containerBtn.remove()
			}
		}
	}
}