(async()=>{
	const cyrToLat = await import('./../MM_Module_Cyr_To_Lat/script.js')
	cyrToLat.initial()
	const twoInput = await import('./../MM_Module_Two_Input/script.js')
	twoInput.initial()
	const multipleImg = await import('./../MM_Module_Multiple_Image/script.js')
	multipleImg.initial()
	const multipleImgAndText = await import('./../MM_Module_Multiple_Image_And_Text/script.js')
	multipleImgAndText.initial()
	const multipleInput = await import('./../MM_Module_Multiple_Input/script.js')
	multipleInput.initial()
	const common = await import('./../common/script.js')
	common.initial()
})()