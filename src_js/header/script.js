export const initial = function() {
	const burger = document.querySelector('.burger')
	if(burger){
		const mobileMenu = document.querySelector('.mobile_menu')
		mobileMenu.style.height = document.getElementsByTagName('html')[0].offsetHeight + 'px'
		const header = document.querySelector('.header')
		const burgerImg = document.querySelector('.burger_img')
		const SRC_CLOSE = '/uploads/burger_close.png'
		const SRC_OPEN = '/uploads/burger_open.png'
		burger.addEventListener('click', ()=>{
			if(burger.classList.contains('active')) {
				burgerImg.src = SRC_CLOSE
				burger.classList.remove('active')
				mobileMenu.classList.remove('show_menu')
				setTimeout(()=>{
					header.classList.add('overflow_hidden')
				}, 700)
			}
			else {
				burgerImg.src = SRC_OPEN
				burger.classList.add('active')
				mobileMenu.classList.add('show_menu')
				header.classList.remove('overflow_hidden')
			}
		})
	}
}