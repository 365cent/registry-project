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
function errmsg(err, msg) {
	var errMsg = document.createElement('span');
	errMsg.classList.add('error');
	errMsg.setAttribute('id', 'error');
	errMsg.innerText = msg;
	err.parentNode.insertBefore(errMsg, err.nextSibling);
}
function onSubmit(token) {
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
	if (window.location.pathname.includes('signup')) {
		const username = document.getElementById("username");
		const password = document.getElementByname("password");

		function usernameIsValid(username) {
			return /^[0-9a-zA-Z_.-]+$/.test(username);
		}
		//https://www.jianshu.com/p/c35d78385feb
		function passwordIsValid(password) {
			return /^(?![0-9]+$)(?![a-z]+$)(?![A-Z]+$)(?!([^(0-9a-zA-Z)])+$).{6,20}$/.test(password);
		}

		username.addEventListener("blur", () => { //add event listener for blur

			var errMsg = document.getElementById("error");
			if (errMsg) { //if there is an error message already, remove it
				errMsg.remove();
			}
			if (usernameIsValid(username.value)) {
				fetch('includes/api.php?username=' + username.value) //fetch the data from the api
					//.then(response => response.json())
					.then(response => response.text())
					.then(response => {
						if (response == 'false' || response == 'error') {
							errmsg(username, "username already taken"); // if the response is false or error, show the error message
							// var errMsg = document.createElement('span');
							// errMsg.classList.add('error');
							// errMsg.setAttribute('id', 'error');
							// errMsg.innerText = 'username already taken';
							// username.parentNode.insertBefore(errMsg, username.nextSibling);
							usernameValid = false;
						}
						else {
							usernameValid = true;
						}
					}
					);
			} else {
				errmsg(username, "invalid username");
			}
			if(passwordIsValid(password[0].value)){
				if(password[1].value != password[0].value){
					errmsg(password[1], "confirmed password is not the same");
				}
			}else{
				errmsg(password[0], "invalid password");
			}
		});
	}
});