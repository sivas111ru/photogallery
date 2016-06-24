function getImgElementFromSpan(spanElem)
{
	return spanElem.parentElement.children[1].children[0]; //������� ����
}
function getSpanElementFromNeighbor(elem) 
{
	return elem.parentElement.children[0]; //������� ����
}
function getImgElementFromSpanInChooser(elem) 
{
	
	return elem.parentElement.children[1]; //������� ����
}

var cookieName = "picsList";
var minLengthForLink = 3; // ���� ����� ������ ����� ���-�� �� �� ������� �� ������ � ����������

function hasClass(elem, cls) {
    return (' ' + elem.className + ' ').indexOf(' ' + cls + ' ') > -1;
}
function checkIfUrlExistsInCookie(elem) // ������� ��� IMG � � ���� ����� �� � ������ �� ������� � PDF ��� ���)
{
	var elemUrl = elem.src;

	var currentCookie = getCookie(cookieName);

	if (currentCookie == undefined)
		return 0;

	if (currentCookie.length<minLengthForLink)
		return 0;

	if (currentCookie.indexOf(elemUrl) == -1)
		return 0;
	return 1;
}
function unsetImageSmoothDelete(elem)
{

	var picElem = getImgElementFromSpanInChooser(elem);
		
	elem.parentElement.parentElement.removeChild(elem.parentElement);
	setUnsetPicture(picElem);
	var inputWithLinks = document.getElementById('inputWithLinksId');
	inputWithLinks.value=getCookie(cookieName);
}
function setUnsetButton(elem) // ��������� ������� �� ������ addToPdf
{
	var picElem = getImgElementFromSpan(elem);
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
	if (counterDiv!=null)
		counterDiv.innerHTML=result.resultCount;
	return result.added;
}
function addDelCookie (elem) { // ������ 0 ���� ������� // ������ 1 ���� ��������	
	var newUrl = elem.src; // ����� ������	
	var currentCookie = getCookie(cookieName); // ��� ��� � �����
	if (currentCookie == undefined)
	{
		//writeCookie(cookieName, newUrl,'','\/');
		setCookie(cookieName,newUrl,{path:'\/'});//���� ����� ����� ����� ������
		return {added:true , resultCount:1};
	}
	if (currentCookie.length<minLengthForLink || currentCookie == undefined) // ���� ���� ������
	{
		//writeCookie(cookieName, newUrl,'','\/');
		setCookie(cookieName,newUrl,{path:'\/'});//���� ����� ����� ����� ������
		return {added:true , resultCount:1}; 
	}
	// � ��� ��� ���� ��������� �����
	var index = currentCookie.indexOf(newUrl);
	if (index == -1) // ���� ����� ������ ��� �� ���������
	{
		//writeCookie(cookieName, currentCookie+","+newUrl,'','\/');
		setCookie(cookieName,currentCookie+","+newUrl,{path:'\/'}); // ��������� ����� ������
		return {added:true , resultCount:currentCookie.split(',').length+1};
	}
	//����� ������ ��� ����, ���� �������
	var picsArray = currentCookie.split(','); // �������� ������ �� ���� ������
	for (var i=0; i< picsArray.length;i++) // �������� �� ������
	{
		if (picsArray[i] == newUrl || picsArray[i].length<minLengthForLink)
		{
			if (picsArray.length==1) // � ��� ���� ������ � �� ���� �������
			{
				deleteCookie(cookieName);
				return {added:false , resultCount:0};
			}
			else
			{
				picsArray.splice(i, 1);// ������� ��� ������
			}
		}
	}
	//writeCookie(cookieName, picsArray.join(',') ,'','\/');
	setCookie(cookieName,picsArray.join(','),{path:'\/'});// ���������� ��� ��� ��������
	return {added:false , resultCount:picsArray.length};
}
function bodyLoad() {
	var counterDiv = document.getElementById('staticCounterDivId');
	counterDiv.innerHTML = getCookie(cookieName).split(',').length;
}
function showHideAddToPdfSpan(elem,show)	  
{
	var addToPadfSpan = getSpanElementFromNeighbor(elem);
	if (show==1)
	{
		addToPadfSpan.style.display='block';		
		setTimeout(function() {addToPadfSpan.style.opacity='1'; }, 20);
		//setTimeout('', 1000)			
	}
	else
	{
		
		addToPadfSpan.style.opacity='0';
		//setTimeout(function() {addToPadfSpan.style.display='none'; }, 500);		
	}
	
	if (checkIfUrlExistsInCookie(getImgElementFromSpan(addToPadfSpan)) == 1)
	{
		addToPadfSpan.className  = 'addPdf added';
	}
	else
	{
		addToPadfSpan.className  = 'addPdf';
	}
}

