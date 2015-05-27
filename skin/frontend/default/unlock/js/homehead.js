// JavaScript Document
$(document).ready(function() {
var conWid = $('#outerScroll').innerWidth();
var ss = parseInt($('#scroll').children().length);
var sd = 345*ss;
var csf = conWid/2;
csf = csf-130;
var sr = csf-380;
$('#scroll').css('width',sd);
if (conWid < 980) {
$('#scroll').css('left',sr);
}
});