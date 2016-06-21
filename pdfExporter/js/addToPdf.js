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
function addDelCookie (elem) { // ������ 0 ���� ������� // ������ 1 ���� ��������
	var minLengthForLink = 3; // ���� ����� ������ ����� ���-�� �� �� ������� �� ������ � ����������
	var newUrl = elem.src; // ����� ������	
	var currentCookie = getCookie(cookieName); // ��� ��� � �����
	if (currentCookie == undefined)
	{
		setCookie(cookieName,newUrl,{path:"\/"}); //���� ����� ����� ����� ������
		return {added:true , resultCount:1};
	}
	if (currentCookie.length<minLengthForLink || currentCookie == undefined) // ���� ���� ������
	{
		setCookie(cookieName,newUrl,{path:"\/"});//���� ����� ����� ����� ������
		return {added:true , resultCount:1}; 
	}
	// � ��� ��� ���� ��������� �����
	var index = currentCookie.indexOf(newUrl);
	if (index == -1) // ���� ����� ������ ��� �� ���������
	{
		setCookie(cookieName,currentCookie+","+newUrl,{path:"\/"}); // ��������� ����� ������
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
	setCookie(cookieName,picsArray.join(','),{path:"\/"});// ���������� ��� ��� ��������
	return {added:false , resultCount:picsArray.length};
}
function bodyLoad() {
	var counterDiv = document.getElementById('staticCounterDivId');
	counterDiv.innerHTML = getCookie(cookieName).split(',').length;
}