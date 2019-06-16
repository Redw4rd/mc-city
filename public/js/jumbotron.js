$(function() {
	var uniqueRandoms = [];
	function makeUniqueRandom(numRandoms) {
		if (!uniqueRandoms.length) {
			for (var i = 0; i < numRandoms; i++) {
				uniqueRandoms.push(i);
			}
		}
		var index = Math.floor(Math.random() * uniqueRandoms.length);
		var val = uniqueRandoms[index];

		uniqueRandoms.splice(index, 1);

		return val;
	}
	
	var jumbotronBackground = $('.jumbotron-background');
	var jumbotronOverlay = $('.jumbotron-overlay');
	var overlayFadeOutTime = 2000;
	var overlayFadeInTime = 2000;
	var imageShowTime = 3000;
	
	function slideShow(n) {
		var imageNumber = makeUniqueRandom(n) + 1;
		
		var imgSrc = '../images/jumbotrons/jumbotron-' + imageNumber + '.png';
		
		var img = new Image();
		img.onload = function() {
			jumbotronBackground.css('background', 'url(' + imgSrc + ')');
			jumbotronBackground.css('background-repeat', 'no-repeat');
			jumbotronBackground.css('background-position', 'center center');
			jumbotronBackground.css('-webkit-background-size', 'cover');
			jumbotronBackground.css('-moz-background-size', 'cover');
			jumbotronBackground.css('-o-background-size', 'cover');
			jumbotronBackground.css('background-size', 'cover');
			jumbotronOverlay.fadeOut(overlayFadeOutTime);
			
			setTimeout(function() {
				jumbotronOverlay.fadeIn(overlayFadeInTime);
			}, overlayFadeOutTime + imageShowTime);
			
			setTimeout(function() {
				slideShow(n);
			}, overlayFadeOutTime + imageShowTime + overlayFadeInTime);
		}
		img.src = imgSrc;
	}
	
	slideShow(12);
});