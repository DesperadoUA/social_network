export const initial = function() {
	const cyrToLat = document.querySelector('.mm_module_cyr_to_lat')
	if(cyrToLat){
		const mapSymbol = new Map( [
			['А', 'a'], ['Б', 'b'], ['В', 'v'], ['Г', 'g'], ['Д', 'd'], ['Е', 'e'], ['Ё', 'yo'],
			['Є', 'ye'], ['Ж', 'zh'], ['З', 'z'], ['И', 'i'], ['Й', 'j'], ['Ј', 'j'], ['І', 'i'],
			['Ї', 'yi'], ['К', 'k'], ['Ќ', 'k'], ['Л', 'l'], ['М', 'm'], ['Н', 'n'], ['О', 'o'], ['П', 'p'],
			['Р', 'r'], ['С', 's'], ['Т', 't'], ['У', 'u'], ['Ф', 'f'], ['Х', 'h'], ['Ц', 'ts'], ['Ч', 'ch'],
			['Ш', 'sh'], ['Щ', 'shh'], ['Ъ', ''], ['Ы', 'y'], ['Ь', ''], ['Э', 'e'], ['Ю', 'yu'], ['Я', 'ya'],
			['!', ''], ['"', ''], ['\'', ''], ['@', ''], ['$', ''], ['?', ''], ['%', ''], ['^', ''], [':', ''],
			['*', ''], ['+', ''], ['-', '-'], ['=', ''], ['\/', ''], ['.', ''],[' ', '-'], ["1", "1"], ["2", "2"],
			["3", "3"], ["4", "4"], ["5", "5"], ["6", "6"], ["7", "7"], ["8", "8"], ["9", "9"], ["0", "0"],
			["A", "a"], ["B", "b"], ["C", "c"], ["D", "d"], ["E", "e"], ["F", "f"], ["G", "g"], ["H", "h"],
			["I", "i"],["J", "j"], ["J", "j"], ["K", "k"], ["L", "l"], ["M", "m"], ["N", "n"], ["O", "o"], ["P", "p"],
			["Q", "q"], ["R", "r"], ["S", "s"], ["T", "t"], ["U", "u"], ["V", "v"], ["W", "w"], ["X", "x"], ["Y", "y"],
			["Z", "z"],])
		const cyrToLat = document.querySelector('.mm_module_cyr_to_lat')
		const firstInput = document.querySelector('.mm_module_cyr_to_lat_one')
		const secondInput = document.querySelector('.mm_module_cyr_to_lat_two')
		firstInput.addEventListener('change', updateInput)
		function updateInput() {
			const strCyr = firstInput.value.toUpperCase()
			let strLat = ''
			for(let i=0; i<strCyr.length; i++) strLat += mapSymbol.get(strCyr[i])
			secondInput.value = strLat
		}
	}
}