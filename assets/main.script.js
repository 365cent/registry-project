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

let usernamevalid = false;

window.addEventListener("DOMContentLoaded", () => {
	const username = document.getElementById("username");
	username.addEventListener("blur", () => { //add event listener for blur
	var errMsg = document.getElementById("error");
	if(errMsg){ //if there is an error message already, remove it
		errMsg.remove();
	}
	fetch('api.php?username=' + username.value) //fetch the data from the api
		//.then(response => response.json())
		.then(response => response.text())
		.then(response => {
			if(response == 'false' || response == 'error') { // if the response is false or error, show the error message
				var errMsg = document.createElement('span');
				errMsg.classList.add('error');
				errMsg.setAttribute('id', 'error');
				errMsg.innerText = 'username already taken';
				emailInput.parentNode.insertBefore(errMsg, username.nextSibling);
				emailvalid = false;
			}
			else {
				emailvalid = true;
			}
		}
	);
});
})
