export default function startTimer( duration, display, callback = '' ) {
	let timer = duration, hours, minutes, seconds;

	const authRepeater = document.querySelector( '.code__repeat' );

	if ( authRepeater ){
		authRepeater.innerHTML = '';
	}

	display.style.display = 'block';
	let interval = setInterval( function () {
		minutes = parseInt( timer / 60, 10 );
		seconds = parseInt( timer % 60, 10 );

		minutes = minutes < 10 ? "0" + minutes : minutes;
		seconds = seconds < 10 ? "0" + seconds : seconds;

		display.innerText = minutes + ":" + seconds;

		if ( --timer < 0 ) {
			clearInterval( interval );
			display.style.display = 'none';

			if ( authRepeater ){
				authRepeater.innerHTML = 'Не пришёл код? <button>Отправить снова</button>';
			}

			if ( typeof ( callback ) == 'function' ) {
				callback();
			}
		}
	}, 1000 );
}
