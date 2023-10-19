window.addEventListener('load', function () {

	let clubSelected = document.querySelector('option[selected]');
	let clubCurrent = document.querySelector('select#chessclub_settings');


	if (clubSelected) {
		let button = document.querySelector('input#submit');
		let buttonNameDefault = button.value;

		button.style['backgroundColor'] = 'green';
		button.value = 'Update';

		document.querySelector('select').addEventListener('change', function () {
			clubCurrent = document.querySelector('select#chessclub_settings');
			button.style[['backgroundColor']] = (clubCurrent.value !== clubSelected.value) ? '' : 'green';
			button.value = (clubCurrent.value !== clubSelected.value) ? buttonNameDefault : 'Update';
		});

		document.querySelector('form').addEventListener('submit', function (e) {
			const message = (clubSelected.value !== clubCurrent.value)
				? 'Do you want to change club? All precedent data to be reset.'
				: 'Do you want to update the data club? All precedent data to be updated.';
			var confirmation = confirm(message);
			if (!confirmation) {
				e.preventDefault();
			}
		});
	}


});











