window.addEventListener('load', function () {
	let userIcon = document.querySelector("nav li:nth-child(4) > a");
	let dropDown = document.getElementsByClassName("dropdown")[0];
	let menuOpen = false;
	let dropDownOpen = false;

	if(userIcon.innerText.length < 4) {
		userIcon.previousElementSibling.style.width = "6em";
	}

	document.querySelector('nav details summary').addEventListener('click', function () {
		menuOpen = !menuOpen;
		if (menuOpen) {
			document.querySelector('main').style.marginTop = '6em';
		} else {
			document.querySelector('main').style.marginTop = '4em';
		}
	})

	userIcon.addEventListener('click', function () {
		dropDown.style.display = dropDownOpen ? "none" : "block";
		dropDownOpen = !dropDownOpen;
	});
		
});