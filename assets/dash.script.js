window.addEventListener('load', function () {
	let userIcon = document.querySelector("nav li:nth-child(4) > a");
	let dropDown = document.getElementsByClassName("dropdown")[0];
	let dropDownOpen = false;

	if(userIcon.innerText.length < 4) {
		userIcon.previousElementSibling.style.width = "6em";
	}

	userIcon.addEventListener('click', function () {
		dropDown.style.display = dropDownOpen ? "none" : "block";
		dropDownOpen = !dropDownOpen;
	});
		
});