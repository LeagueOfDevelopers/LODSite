var Ajax={_init:function(){return this.createXmlHttpRequest()},createXmlHttpRequest:function(){var a;try{a=new ActiveXObject("Microsoft.XMLHTTP")}catch(b){try{a=new ActiveXObject("Msxml2.XMLHTTP")}catch(c){a=!1}}a||"undefined"!=typeof XMLHttpRequest&&(a=new XMLHttpRequest);a||(location.href="http://twosphere.ru/badbrowser");return a},post:function(a,b){var c=this._init();c&&(c.open("POST",a.url,!0),c.setRequestHeader("X-Requested-With","XMLHttpRequest"),c.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),
c.send(Ajax.dataEncode(a.data)),c.onreadystatechange=function(){if(4==c.readyState&&200==c.status){var a=$.parseJSON(c.responseText);b(a)}})},simple_get:function(a,b){var c=this._init();c&&(c.open("GET",a.url+"?"+Ajax.dataEncode(a.data),!0),c.setRequestHeader("X-Requested-With","XMLHttpRequest"),c.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),c.send(),c.onreadystatechange=function(){4==c.readyState&&200==c.status&&b(c.responseText)})},get:function(a,b){var c=this._init();c&&
(c.open("GET",a.url+"?"+Ajax.dataEncode(a.data),!0),c.setRequestHeader("X-Requested-With","XMLHttpRequest"),c.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),c.send(null),c.onreadystatechange=function(){if(4==c.readyState&&200==c.status){var a=$.parseJSON(c.responseText);b(a)}})},dataEncode:function(a){var b="";if(a){for(var c in a)a.hasOwnProperty(c)&&(b+="&"+c.toString()+"="+encodeURIComponent(a[c]));if("&"==b.charAt(0))return b.substring(1,b.length)}return b}};
window.refresh = function(location) {
    window.location.href = location || window.location.href.replace(/(\#\w*)$/gi, '');
};
function gebi(id) { return window.document.getElementById(id); }
function strip_tags(str){ return str.replace(/<\/?[^>]+>/gi, ''); }

$(document).ready(function () {
	$('[data-toggle="offcanvas"]').click(function () { $('.row-offcanvas').toggleClass('active') });
	$('body').tooltip({ selector: '[data-toggle="tooltip"]' });
    var items = $('.item-limit');
    if (items) {
        setTimeout(function() {
            items.animate({maxHeight: '344px', opacity: 1}, 200);
        }, 300);
    }
});

