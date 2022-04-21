function onSubmit(token) {
	document.getElementsByTagName('form')[0].submit();
}
function validate(event) {
	event.preventDefault();
	let err = document.getElementsByClassName('err')[document.getElementsByClassName('err').length-1];
	err.innerText = '';
	if (errors.every(val => val === true)) {
		err.innerText = 'Please fill in all fields';
	} else {
		hcaptcha.execute();
	}
}

function printErr(element, bool) {
	if(bool) {
		element.parentNode.nextElementSibling.innerText = '';
	} else {
		element.parentNode.nextElementSibling.innerText = element.parentNode.previousElementSibling.innerText + ' is not valid';
	}
	return bool;
}

function usernameIsValid(username) {
	return /^[0-9a-zA-Z_.-]+$/.test(username);
}

function passwordIsValid(password) {
	return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(password);
}
function emailisvalid(email) {
	return /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/.test(email);
}

window.addEventListener('load', function () {
	let menuOpen = false;
	let errors = [];
	

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
		submit.onclick = validate;
		if(location.pathname.includes('login')) {
			submit.onclick = function() {
				if (!document.getElementsByName('username')[0].value || !document.getElementsByName('password')[0].value) {
					errors[0] = true;
				};
			}
		} else if (location.pathname.includes('signup')) {
			var username = document.getElementsByName("username")[0];
			var password = document.getElementsByName("password")[0];
			var confirmed = document.getElementsByName("password")[1];
			var email = document.getElementsByName("email")[0];


			username.addEventListener("blur", () => { //add event listener for blur
				
				if(usernameIsValid(username.value)){
					fetch('includes/api.php?username=' + username.value) //fetch the data from the api
						//.then(response => response.json())
						.then(response => response.text())
						.then(response => {
							if (response == 'true') { // if the response is false or error, show the error message
								username.parentNode.nextElementSibling.innerText = 'Username already taken';
								errors[0] = true;
							}
							else {
								username.parentNode.nextElementSibling.innerText = '';
								errors[0] = false;
							}
						}
						);	
				}else{
					username.parentNode.nextElementSibling.innerText = 'Username is not valid';
					errors[0] = true;
				}
			});
			//test if the password is valid
			password.addEventListener("blur", () => {
				errors[1] = printErr(password, passwordIsValid(password.value));
			});
			//test if the confirmed password is match
			confirmed.addEventListener("blur", () => {
				errors[2] = printErr(confirmed, password.value == confirmed.value)
			});
			email.addEventListener("blur", () => { 
				//check if the email is valid
				errors[3] = printErr(email, emailisvalid(email.value));
			});
			
		}
	} 
});