function validate(event) {
	event.preventDefault();
	if (!document.getElementById('field').value) {
		alert('You must add text to the required field');
	} else {
	  hcaptcha.execute();
	}
  }

  function onload() {
	var element = document.getElementById('submit');
	element.onclick = validate;
  }

function onSubmit(token) {
}
window.addEventListener('load', function () {
	let menuOpen = false;
	document.querySelector('nav details summary').addEventListener('click', function() {
		menuOpen = !menuOpen;
		if (menuOpen) {
			document.querySelector('main').style.marginTop = '6em';
		} else {
			document.querySelector('main').style.marginTop = '4em';
		}
	})
	
	let swiper = new Swiper("#explore", {
		mousewheel: true,
		slidesPerView: "auto",
		spaceBetween: 30,
		scrollbar: {
			el: ".swiper-scrollbar",
		},
		autoplay: {
			delay: 5000,
		},
	});
});
