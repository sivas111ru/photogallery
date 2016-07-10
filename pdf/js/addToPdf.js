
function getImgElementFromSpan(spanElem)
{
	var parentLiElem;
	if (spanElem.parentElement.tagName == 'LI')
		parentLiElem = spanElem.parentElement;
	if (spanElem.parentElement.parentElement.tagName == 'LI')
		parentLiElem = spanElem.parentElement.parentElement;
	if (spanElem.parentElement.parentElement.parentElement.tagName == 'LI')
		parentLiElem = spanElem.parentElement.parentElement.parentElement;

	return parentLiElem.children[1].children[0]; //������� ����
}
function getSpanElementFromNeighbor(elem) 
{
	/*var parentLiElem;
	if (spanElem.parentElement.tagName == 'LI')
		parentLiElem = spanElem.parentElement;
	if (spanElem.parentElement.parentElement.tagName == 'LI')
		parentLiElem = spanElem.parentElement.parentElement;
	if (spanElem.parentElement.parentElement.parentElement.tagName == 'LI')
		parentLiElem = spanElem.parentElement.parentElement.parentElement;
	*/
	//console.log(elem.parentElement.children[0]);
	return elem.parentElement.children[0]; //������� ����
}
function getImgElementFromSpanInChooser(elem) 
{
	//console.log('1233333-'+elem);
	return elem.parentElement.children[1]; //������� ����
}

var cookieName = "picsList";
var minLengthForLink = 3; // ���� ����� ������ ����� ���-�� �� �� ������� �� ������ � ����������

function hasClass(elem, cls) {
    return (' ' + elem.className + ' ').indexOf(' ' + cls + ' ') > -1;
}
function checkIfUrlExistsInCookie(elem) // ������� ��� IMG � � ���� ����� �� � ������ �� ������� � PDF ��� ���)
{
	//console.log(elem);
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
	document.getElementById('staticCounterDivId').style.display='block';
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
	{
		counterDiv.innerHTML='<p style="margin: 0px 0 0 0 ;">YOUR PDF<br>SELECTION<br>('+result.resultCount+')</p>';
		if (result.resultCount == 0)
			counterDiv.style.display='none';
	}
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

window.addEventListener('DOMContentLoaded', bodyLoad, false);

function bodyLoad() {
	
	/*var staticDiv = document.createElement('div');
	staticDiv.setAttribute("onclick","location.href='../pdf/pdf.html'");
	staticDiv.className = "staticCounter";
	staticDiv.id= 'staticCounterDivId';
	*/

	/*var navBar = document.getElementById('site-navigation');
	navBar.appendChild(staticDiv);*/
	var counterDiv = document.getElementById('staticCounterDivId');
	var myCookie = getCookie(cookieName);
	var count = 0;
	if (myCookie != undefined)
		count = myCookie.split(',').length;
		
	if (count>0)
	{
		counterDiv.innerHTML='<p style="margin: 0px 0 0 0 ;">YOUR PDF<br>SELECTION<br>('+getCookie(cookieName).split(',').length+')</p>';
		document.getElementById('staticCounterDivId').style.display='block';	
		
	}	
		var childs = document.getElementById('og-grid').children;  
		for (var i = 0; i < childs.length ; i++)    
		{			
			var addToPadfSpan  = childs[i].children[0];
			if (checkIfUrlExistsInCookie(getImgElementFromSpan(addToPadfSpan)) == 1)
			{
				addToPadfSpan.className  = 'addPdf added';
			}
			else
			{
				addToPadfSpan.className  = 'addPdf';
			}
		}
	
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

