var cookie_alert = $('#cookie_alert');
var accept_button = $("#cookie_alert button.btn");

function setCookie(name, value, expire) {
	var date = new Date();
	date.setTime(date.getTime() + (604800 * expire));

	var expires = "expires="+date.toUTCString();

	document.cookie = name + "=" + value + "; " + expires;
}

function getCookie(name) {
	var cname = name+"=";
	var cookies = document.cookie.split(";");

	for (var i=0;i<cookies.length; i++) {

		var c = cookies[i];

		while (c.charAt(0)==' ') c = c.substring(1);
		if (c.indexOf(cname) == 0) return c.substring(cname.length,c.length);
	}

	return "";
}

$(accept_button).on('click', function(){
	setCookie('acceptedCookie', true, 604800);
	cookie_alert.css('display', 'none');
});

if (getCookie('acceptedCookie') != "") {
	cookie_alert.css('display', 'none');
}

window.profileImage = function() {

	var skin = $('img.thumbnail');

	if (skin.length == 0) {
		return;
	}

	if (skin.attr('src').indexOf('skin') !== -1) {
		skin.hide();
		var image = new Image();
		image.src = skin.attr('src');

		image.onload  = function() {
			canvas = document.createElement('canvas');
			canvas.setAttribute('class', 'profile-image thumbnail');
			canvas.setAttribute('width', 80);
			canvas.setAttribute('height', 80);

			$(skin).parent().append(canvas);

			ctx = canvas.getContext('2d');

			ctx.imageSmoothingEnabled = false;
			ctx.webkitImageSmoothingEnabled = false;
			ctx.mozImageSmoothingEnabled = false;
			ctx.drawImage(image, 8, 8, 8, 8, 0, 0, 80, 80);
		}
	}
};

$(function() {

	profileImage();
	
});