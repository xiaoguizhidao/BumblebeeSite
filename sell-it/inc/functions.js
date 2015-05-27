// JavaScript Document
var xmlHttp
var xmlcurImg
function showcurImg(poll)
{ 
xmlcurImg=GetXmlHttpObject()
if (xmlcurImg==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="inc/ajax_link.php"
url=url+"?category_id="+poll
xmlcurImg.onreadystatechange=stateChangedcurImg
xmlcurImg.open("GET",url,true)
xmlcurImg.send(null)
}
function stateChangedcurImg() 
{ 
if (xmlcurImg.readyState==4 || xmlcurImg.readyState=="complete")
 { 
 document.getElementById("divcurImg").innerHTML=xmlcurImg.responseText 
 } 
}

function GetXmlHttpObject()
{
var xmlcurImg=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlcurImg=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlcurImg=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlcurImg=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlcurImg;
}
//--------------------------------------------------------------------------------------
var xmlHttp
var xmlPhotos
function showPhotos(np)
{ 
xmlPhotos=GetXmlHttpObject()
if (xmlPhotos==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="includes/ajax_show.php"
url=url+"?category_id="+np
 
xmlPhotos.onreadystatechange=stateChangedPhotos
xmlPhotos.open("GET",url,true)
xmlPhotos.send(null)
}
function stateChangedPhotos() 
{ 
if (xmlPhotos.readyState==4 || xmlPhotos.readyState=="complete")
 { 
 document.getElementById("divStrip").innerHTML=xmlPhotos.responseText 
 } 
}

function GetXmlHttpObject()
{
var xmlPhotos=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlPhotos=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlPhotos=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlPhotos=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlPhotos;
}
//--------------------------------------------------------------------------------------
var xmlHttp
var xmlMenu
function showMenu(np, lastid, section_id)
{ 
xmlMenu=GetXmlHttpObject()
if (xmlMenu==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="includes/ajax.php"
url=url+"?np="+np
url=url+"&lastid="+lastid
url=url+"&section_id="+section_id
url=url+"&action=stripmenu"
url=url+"&sid="+Math.random()
xmlMenu.onreadystatechange=stateChangedMenu
xmlMenu.open("GET",url,true)
xmlMenu.send(null)
}
function stateChangedMenu() 
{ 
if (xmlMenu.readyState==4 || xmlMenu.readyState=="complete")
 { 
 document.getElementById("divMenu").innerHTML=xmlMenu.responseText 
 } 
}

function GetXmlHttpObject()
{
var xmlMenu=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlMenu=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlMenu=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlMenu=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlMenu;
}

//--------------------------------------------------------------------------------------
var xmlHttp
var xmlMenu
function showCrousel(id,cid)
{ 
xmlMenu=GetXmlHttpObject()
if (xmlMenu==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="includes/ajax_whole.php"
url=url+"?np="+id
url=url+"&cid="+cid
xmlMenu.onreadystatechange=stateChangedMenu
xmlMenu.open("GET",url,true)
xmlMenu.send(null)
}
function stateChangedMenu() 
{ 
if (xmlMenu.readyState==4 || xmlMenu.readyState=="complete")
 { 
 document.getElementById("divCrousel").innerHTML=xmlMenu.responseText 
 } 
}

function GetXmlHttpObject()
{
var xmlMenu=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlMenu=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlMenu=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlMenu=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlMenu;
}
////////////////////////
//--------------------------------------------------------------------------------------
var xmlHttp
var xmlw
function showW(w)
{ 
xmlw=GetXmlHttpObject()
if (xmlw==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="includes/ajax_wish.php"
url=url+"?w="+w
xmlw.onreadystatechange=stateChangedw
xmlw.open("GET",url,true)
xmlw.send(null)
}
function stateChangedw() 
{ 
if (xmlw.readyState==4 || xmlw.readyState=="complete")
 { 
 document.getElementById("divSh").innerHTML=xmlw.responseText 
 } 
}

function GetXmlHttpObject()
{
var xmlw=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlw=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlw=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlw=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlw;
}