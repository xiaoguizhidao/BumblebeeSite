jQuery(document).ready(function(){
	//Right Click Protection
	//$(document).bind("contextmenu",function(e){ return false;});
	
	//Content Area Mods
	$(".pagecontainer > table:eq(1) tr:first td:first").addClass("estore-background");
	$(".estore-background table:eq(1)").addClass("estore-content");
	
	//Getting and Setting Store Categories
	if($("#estore-categories").length > 0) {
		if($("#LeftPanel .lcat").length > 0) {
			$("#estore-categories").html($("#LeftPanel .lcat").html());
		}
		$("#estore-categories ul[class=lev1]").find("li:last").addClass("estore-lastitem");
	}
	
	//Search Box
	var stxt = $("#estore-search #estore-input").find("input[class=v4sbox]").val();
	$("#estore-search #estore-input").find("input[class=v4sbox]").focus(function(){
		if($("#estore-search #estore-input").find("input[class=v4sbox]").val() == stxt) {
			$("#estore-search #estore-input").find("input[class=v4sbox]").val("");
		}
	});
	$("#estore-search #estore-input").find("input[class=v4sbox]").blur(function(){
		if($("#estore-search #estore-input").find("input[class=v4sbox]").val() == "") {
			$("#estore-search #estore-input").find("input[class=v4sbox]").val(stxt);
		}
	});
	$("#estore-search #estore-submit").find("input").click(function(){
		if($("#estore-search #estore-input").find("input[class=v4sbox]").val() == stxt) {
			$("#estore-search #estore-input").find("input[class=v4sbox]").val("");
		}
	});
	
	
	//Footer
	var d = new Date();
	var footer = "\n\r<div class=\"estore-wrapcen\"><div id=\"estore-footer\"><div id=\"footer_container\"><div id=\"footer_container2\"><div class=\"footer_menu\"><a href=\"http://stores.ebay.com/bumblebee-wireless/About-Us\">About Us</a>|<a href=\"http://stores.ebay.com/bumblebee-wireless/Contact-Us\">Contact Us</a>|<a href=\"http://feedback.ebay.com/ws/eBayISAPI.dll?ViewFeedback2&userid=bumblebee-wireless&ftab=AllFeedback\">Feedback</a>|<a href=\"http://stores.ebay.com/bumblebee-wireless/Returns\">Returns</a>|<a href=\"http://stores.ebay.com/bumblebee-wireless/Store-Hours\">Store Hours</a>|<a href=\"http://stores.ebay.com/bumblebee-wireless/Shipping\">Shipping</a>|<a href=\"http://my.ebay.com/ws/eBayISAPI.dll?AcceptSavedSeller&sellerid=bumblebee-wireless&ssPageName=STRK:MEFS:ADDSTR&rt=nc\">Newsletter</a>|<a href=\"http://stores.ebay.com/bumblebee-wireless/Store-Policies\">Store Policies</a>|<a href=\"http://stores.ebay.com/bumblebee-wireless/FAQ\">FAQ's</a><\/div><\/div><div class=\"copy_rights\">Bumblebee Wireless is a Trademarked Name all Right Reserved 2011-2013<\/div><\/div><\/div><\/div>";
	if(pageName != "PageAboutMeViewStore") {
		if($(".estore-content").length > 0) {
			$(".estore-content").after(footer);			
		}
	}
});