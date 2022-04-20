function onSubmit(token) {
	document.getElementsByTagName('form')[0].submit();
}
function validate(event) {
	event.preventDefault();
	let err = document.getElementsByClassName('err')[0];
	err.innerText = '';
	if (!document.getElementsByName('username')[0].value || !document.getElementsByName('password')[0].value) {
		err.innerText = 'Please fill in all fields';
	} else {
		hcaptcha.execute();
	}
}
window.addEventListener('load', function () {
	let menuOpen = false;
	let usernameValid = false;
	document.querySelector('nav details summary').addEventListener('click', function () {
		menuOpen = !menuOpen;
		if (menuOpen) {
			document.querySelector('main').style.marginTop = '6em';
		} else {
			document.querySelector('main').style.marginTop = '4em';
		}
	})
	if (location.pathname == '/') {
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
	} else {
		let submit = document.querySelector('form button');
		let err = document.getElementsByClassName('err')[0];
		submit.onclick = validate;
		if (location.pathname.includes('signup')) {
			const username = document.getElementsByName("username")[0];
			username.addEventListener("blur", () => { //add event listener for blur
				err.innerText = '';
				fetch('includes/api.php?username=' + username.value) //fetch the data from the api
					//.then(response => response.json())
					.then(response => response.text())
					.then(response => {
						if (response == 'true') { // if the response is false or error, show the error message
							err.innerText = 'Username already taken';
							usernameValid = false;
						}
						else {
							usernameValid = true;
						}
					}
					);
			});
		}
	} 
});