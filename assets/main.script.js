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
function usernameIsValid(username) {
	return /^[0-9a-zA-Z_.-]+$/.test(username);
}
//https://www.jianshu.com/p/c35d78385feb
function passwordIsValid(password) {
	return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(password);
}
function emailisvalid(email) {
	return /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/.test(email);
}

window.addEventListener('load', function () {
	let menuOpen = false;
	let usernameValid = false;
	let passwordValid = false;
	let confirmedvalid = false;
	let emailValid = false;

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
				var pre = err.innerText;
				err.innerText = '';
				if(usernameIsValid(username.value)){
					fetch('includes/api.php?username=' + username.value) //fetch the data from the api
						//.then(response => response.json())
						.then(response => response.text())
						.then(response => {
							if (response == 'true') { // if the response is false or error, show the error message
								err.innerText = 'Username already taken';
								usernameValid = false;
							}
							else {
								if(pre == 'Username already taken'|| pre == 'Username is nort valid'){
									err.innerText = '';
								}else{
									err.innerText = pre;
								}
								usernameValid = true;
							}
						}
						);	
				}else{
					err.innerText = 'Username is nort valid';
					usernameValid = false;
				}
			});
			//test if the password is valid
			password.addEventListener("blur", () => { 
				var pre = err.innerText;
				err.innerText = '';
				//check if the password is valid
				if(passwordIsValid(password.value)){
					passwordValid = true;
					if(pre == 'Password is not valid'){
						err.innerText = '';
					}else{
						err.innerText = pre;
					}
				}else{
					err.innerText = 'password is not valid';
					passwordValid = false;
				}
			});
			//test if the confirmed password is valid
			confirmed.addEventListener("blur", () => { 
				var pre = err.innerText;
				err.innerText = '';
				//check if the password is valid
				if(passwordIsValid(confirmed.value)){
					if(password.value == confirmed.value){
						confirmedvalid = true;
						if(pre == 'password confirmation is not valid'){
							err.innerText = '';
						}else{	
							err.innerText = pre;
						}
					}else{
						err.innerText = 'password confirmation is not valid';
						confirmedvalid = false;
					}
				}else{
					err.innerText = 'password is not valid';
					confirmedvalid = false;
				}
			});
			email.addEventListener("blur", () => { 
				var pre = err.innerText;
				err.innerText = '';
				//check if the email is valid
				if(emailisvalid(email.value)){
					emailValid = true;
					if(pre == 'email is not valid'){
						err.innerText = '';
					}else{
						err.innerText = pre;
					}
				}else{
					err.innerText = 'email is not valid';
					emailValid = false;
				}
			});
			
		}
	} 
});