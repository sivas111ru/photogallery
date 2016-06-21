var cookieName = "picsList";
function setUnsetButton(elem)
{
	var picElem = elem.parentElement.children[1].children[0];
	
	var added = setUnsetPicture(picElem);
	if (added) 
	{
		elem.className  = 'addPdf added';
	}
	else
	{
		elem.className  = 'addPdf';
	}
}

function setUnsetPicture (elem){
	var result = addDelCookie(elem);
	var counterDiv = document.getElementById('staticCounterDivId');
	counterDiv.innerHTML=result.resultCount;
	return result.added;
}
function addDelCookie (elem) { // вернем 0 если удалили // вернем 1 если добавили
	var minLengthForLink = 3; // если длина меньше этого кол-ва мы не считаем за ссылку и выкидываем
	var newUrl = elem.src; // новая ссылка	
	var currentCookie = getCookie(cookieName); // все что в куках
	if (currentCookie == undefined)
	{
		setCookie(cookieName,newUrl,{path:"\/"}); //куки равны одной новой ссылке
		return {added:true , resultCount:1};
	}
	if (currentCookie.length<minLengthForLink || currentCookie == undefined) // если куки пустые
	{
		setCookie(cookieName,newUrl,{path:"\/"});//куки равны одной новой ссылке
		return {added:true , resultCount:1}; 
	}
	// у нас уже усть выбранные фотки
	var index = currentCookie.indexOf(newUrl);
	if (index == -1) // если такая ссылка еще не добавлена
	{
		setCookie(cookieName,currentCookie+","+newUrl,{path:"\/"}); // добавляем новую ссылку
		return {added:true , resultCount:currentCookie.split(',').length+1};
	}
	//такая ссылка уже есть, надо удалять
	var picsArray = currentCookie.split(','); // получаем массив из всех ссылок
	for (var i=0; i< picsArray.length;i++) // проходим по каждой
	{
		if (picsArray[i] == newUrl || picsArray[i].length<minLengthForLink)
		{
			if (picsArray.length==1) // у нас одна ссылка и ту надо удалить
			{
				deleteCookie(cookieName);
				return {added:false , resultCount:0};
			}
			else
			{
				picsArray.splice(i, 1);// удаляем эту ссылку
			}
		}
	}
	setCookie(cookieName,picsArray.join(','),{path:"\/"});// объединяем все что осталось
	return {added:false , resultCount:picsArray.length};
}
function bodyLoad() {
	var counterDiv = document.getElementById('staticCounterDivId');
	counterDiv.innerHTML = getCookie(cookieName).split(',').length;
}