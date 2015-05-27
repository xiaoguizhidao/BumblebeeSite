function showpagelogin(ctlName,page){
	document.getElementById('logs').disabled=true;	
	document.getElementById(ctlName).innerHTML="<table width='67%' border='0' cellpadding='0' cellspacing='0'><tr><td align='center'></td><td align='center'><img src='loader.gif'></td></tr></table>";
	var xmlHttp = GetXmlHttpObject();
	var url = page+"&sid="+Math.random();	
	if (!xmlHttp){
		alert ("Browser does not support HTTP Request");
		return
	}
	xmlHttp.onreadystatechange=function(){	
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 			
			if (xmlHttp.responseText=="true"){
				document.location.replace('index.php');	
			}else{
				document.getElementById('logs').disabled=false;				
				document.getElementById(ctlName).innerHTML="<span>Invalid User Name and Password.</span>";
				document.getElementById('uid').focus();
			}
		}
	}

	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);
}
function openWin(pagename){
	microsite_window=window.open(pagename,'microsite_window','toolbar=no,location=no,borders=no,directories=no,status=no,menubar=no,scrollbars=no,top=0,left=0,resizable=no,width=274,height=438')
}
//////////////////////////////////////     
var xmlHttp
function showpage(ctlName,page){
//	alert(ctlName+"\n"+page);
	var xmlHttp = GetXmlHttpObject();
	var url = page+"&sid="+Math.random();
	if (!xmlHttp){
		alert ("Browser does not support HTTP Request")
		return
	}
	xmlHttp.onreadystatechange=function(){
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
			document.getElementById(ctlName).innerHTML=xmlHttp.responseText;
		}else if(xmlHttp.readyState==3){
			document.getElementById(ctlName).innerHTML="<center><br><br>Loading Data......</center>";
		}
	};
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);
}
function GetXmlHttpObject(){ 
var objXMLHttp=null;

     if (window.XMLHttpRequest){
          objXMLHttp=new XMLHttpRequest();
     }else if (window.ActiveXObject){
          objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP");
     }
     return objXMLHttp;
}
//////////////////////////////////////
<!-- Begin
var win = null;
function newWindow(mypage,myname,w,h,features) {
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  if (winl < 0) winl = 0;
  if (wint < 0) wint = 0;
  var settings = 'height=' + h + ',';
  settings += 'width=' + w + ',';
  settings += 'top=' + wint + ',';
  settings += 'left=' + winl + ',';
  settings += features;
  win = window.open(mypage,myname,settings);
  win.window.focus();
}
//  End -->
////////////////////////////////
function selectAll(x) {
for(var i=0,l=x.form.length; i<l; i++)
	if(x.form[i].type == 'checkbox' && x.form[i].name != 'sAll')
		x.form[i].checked=x.form[i].checked?false:true
}
///////////////////////////////
function test(obj,msg) {
	var regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
	if (regex.test(obj.value)){
		return true;
	}else{
		alert(msg);
		obj.focus();
		return false;
	}
}
function checkempty(obj,msg){
	if(obj.value==""){
		alert(msg);
		obj.focus();
		return false;
	}
}
function checkint(obj,msg){
	if(isNaN(obj.value)){
		alert(msg);
		obj.focus();
		return false;
	}
}
function confirmPassword(obj,obj1,msg){
	if(!(obj.value==obj1.value)){
		alert(msg);
		obj1.focus();
		return false;
	}
}
function isnumber(obj,msg){
	if(isNaN(obj.value)){
		alert(msg);
		obj.focus();
		return false;
	}
}
function isZero(obj,msg){
	if((obj.value)==0){
		alert(msg);
		obj.focus();
		return false;
	}
}
function checkAll(theForm, cName, allNo_stat){
	var n=theForm.elements.length;
	for (var i=0;i<n;i++){
		if (theForm.elements[i].className.indexOf(cName) !=-1){
			if (allNo_stat.checked) {
				theForm.elements[i].checked = true;
			}else{
				theForm.elements[i].checked = false;
			}
		}
	}
}
///////////////////////////
///////Admin Scripts///////
///////////////////////////
function chkLogin(){
	if (checkempty(document.frmLogin.usrname,"Information - Enter Username")==false) return false;
	if (checkempty(document.frmLogin.password,"Information - Enter Password")==false) return false;
	return true;
}
function passcheck(){
	if (checkempty(document.frmChangePass.OPass,"Information - Enter Old Password")==false) return false;
	if (checkempty(document.frmChangePass.NPass,"Information - Enter New Password")==false) return false;
	if (checkempty(document.frmChangePass.CPass,"Information - Enter Confirm Password")==false) return false;
	if (confirmPassword(document.frmChangePass.NPass,document.frmChangePass.CPass,"Information - New and Confirm Password must be same")==false) return false;
	return true;
}
function appointment(){
	if (checkempty(document.frmActions.date_,"Information - Please select the date")==false) return false;
	return true;
}
function checkUTForm(){
	if (checkempty(document.frmUType.TypeName,"Information - Enter Main Category Name")==false) return false;
	return true;
}
function checkMPrjName(){
	if (checkempty(document.frmMainPrj.PrjName,"Information - Enter Project Category Name")==false) return false;
	return true;
}
function ChkAddPrjForm(){
	if (checkempty(document.frmAddPrj.refidd,"Information - Enter Product Reference ID")==false) return false;
	if (checkempty(document.frmAddPrj.pnamee,"Information - Enter Article Name")==false) return false;
	return true;
}
function checkPrjImg(){
	if (checkempty(document.frmPrjImage.ImgName,"Information - Enter Insert Title")==false) return false;
	return true;
}
function checkCCdForm(){
	if (checkempty(document.frmCCode.ccode,"Information - Enter Coupon Code")==false) return false;
	if (checkempty(document.frmCCode.cdiscount,"Information - Enter Discount Percentage")==false) return false;
	return true;
}function login_user(){
	var uid = document.getElementById('uid').value;
	var pwd = document.getElementById('pwd').value;	
	var gourl = "chklogin.php?uid="+uid+"&pwd="+pwd+"";
	showpagelogin('divLogin',gourl);
	return false;
}
function submit_spec(){
	if (checkempty(document.frmSpec.spec_of,"Information - Please select the specification category")==false) return false;
	if (checkempty(document.frmSpec.spec,"Information - Please enter the specification name")==false) return false;	
	return true;
}
function product_gallery(){
	if (checkempty(document.frmSpec.simg,"Information - Please browse the small image")==false) return false;
	if (checkempty(document.frmSpec.limg,"Information - Please browse the large image")==false) return false;
	return true;
}
function add_gen(){
	if (checkempty(document.frmGen.entry,"Information - Please enter Winner No")==false) return false;
		return true;
}
function add_gen(){
	if (checkempty(document.frmGen.entry,"Information - Please enter Winner No")==false) return false;
		return true;
}



function add_gen(){
	if (checkempty(document.frmGen.time,"Information - Please enter Time")==false) return false;
		return true;
}
function add_gen(){
	if (checkempty(document.frmGen.time,"Information - Please enter Time")==false) return false;
		return true;
}




function gen_gallery1(){
	if (checkempty(document.frmSpec.lnk,"Information - Please enter lnk")==false) return false;
	if (checkempty(document.frmSpec.simg,"Information - Please browse the image")==false) return false;	
	return true;
}
function gen_gallery2(){
	if (checkempty(document.frmSpec.lnk,"Information - Please enter the title")==false) return false;
	if (checkempty(document.frmSpec.simg,"Information - Please browse the image")==false) return false;	
	return true;
}
function inquiry_form(){
	if (checkempty(document.frmInquiry.contact_person,"Information - Please enter Contact Person Name")==false) return false;
	if (checkempty(document.frmInquiry.phone,"Information - Please enter Phone No")==false) return false;
	if (test(document.frmInquiry.email,"Information - Please enter your Email Address")==false) return false;	
	return true;	
}
function feedback_form(){
	if (checkempty(document.frmInquiry.fname,"Information - Please enter First Name")==false) return false;
	if (checkempty(document.frmInquiry.company,"Information - Please enter Company Name")==false) return false;
	if (test(document.frmInquiry.email,"Information - Please enter your Email Address")==false) return false;	
	return true;	
}
function reset_form(){
	document.getElementById('uid').value = '';
	document.getElementById('pwd').value = '';	
	document.getElementById('divLogin').innerHTML= '';
	document.getElementById('uid').focus();
}
function pop_up_(url,w,h){
			var l = (screen.width/2)-w/2;
			var t = (screen.height/2)-h/2;
            microsite_window=window.open(url,'microsite_window','toolbar=no,location=no,borders=no,directories=no,status=yes,menubar=no,scrollbars=no,top='+t+',left='+l+',resizable=no,width='+w+',height='+h)
            microsite_window.focus();
    }