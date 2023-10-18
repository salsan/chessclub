// Add event if page is full loaded
window.addEventListener("load", function () {

	let selected = document.querySelector("option[selected]");
	let current = document.querySelector("select#chessclub_settings");
	let form = document.querySelector("form");

	let button = document.querySelector("input#submit");
	let buttonName = button.value;

	if (selected) {
		button.style['backgroundColor'] = 'green';
		button.value = "Update";

		document.querySelector("select").addEventListener("change", function (value) {
			current = document.querySelector("select#chessclub_settings");
			button.style[['backgroundColor']] = (current.value !== selected.value) ? '' : 'green';
			button.value = (current.value !== selected.value) ? buttonName : 'Update';
		});

		form.addEventListener("submit", function (e) {
			const message = (selected.value !== current.value)
				? 'Do you want to change club? All precedent data to be reset.'
				: 'Do you want to update the data club? All precedent data to be updated.';
			var confirmation = confirm(message);
			if (!confirmation) {
				e.preventDefault();
			}
		});
	}


});











