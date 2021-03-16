(async()=>{
	const mobileMenu = await import('/src_js/header/script.js')
	mobileMenu.initial()
	const formResearch = await import('/src_js/form_research/script.js')
	formResearch.initial()
	const formParticipate = await import('/src_js/form_participate/script.js')
	formParticipate.initial()
	const searchClinic = await import('/src_js/search_clinic/script.js')
	searchClinic.initial()
	const searchResearch = await import('/src_js/search_research/script.js')
	searchResearch.initial()
})()