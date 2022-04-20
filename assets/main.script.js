function onSubmit(token) {
	document.getElementsByTagName('form')[0].submit();
}
function validate(event) {
	event.preventDefault();
	let err = document.getElementsByClassName('err')[length-1];
	err.innerText = '';
	if (!document.getElementsByName('username')[0].value || !document.getElementsByName('password')[0].value) {
		err.innerText = 'Please fill in all fields';
	} else {
		hcaptcha.execute();
	}
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
	let valid = false;
	

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
								valid = false;
							}
							else {
								username.parentNode.nextElementSibling.innerText = '';
								valid = true;
							}
						}
						);	
				}else{
					password.parentNode.nextElementSibling.innerText = 'Username is nort valid';
					valid = false;
				}
			});
			//test if the password is valid
			password.addEventListener("blur", () => { 
				//check if the password is valid
				if(passwordIsValid(password.value)){
					valid = true;
					password.parentNode.nextElementSibling.innerText = '';
				}else{
					password.parentNode.nextElementSibling.innerText = 'Password is not valid';
					valid = false;
				}
			});
			//test if the confirmed password is valid
			confirmed.addEventListener("blur", () => { 
				//check if the password is valid
				if(password.value == confirmed.value){
					valid = true;
					confirmed.parentNode.nextElementSibling.innerText = '';
					}else{	
						confirmed.parentNode.nextElementSibling.innerText = 'confirmed password is not valid';
						valid = false;
					}
				
			});
			email.addEventListener("blur", () => { 
				//check if the email is valid
				if(emailisvalid(email.value)){
					email.parentNode.nextElementSibling.innerText = '';
					valid = true;
				}else{
					email.parentNode.nextElementSibling.innerText = 'email is not valid';
					valid = false;
				}
			});
			
		}
	} 
});