const getDuration = async ( file ) => {
	const url = URL.createObjectURL( file );

	return new Promise( ( resolve ) => {
		const video = document.createElement( "video" );
		video.muted = true;
		const source = document.createElement( "source" );
		source.src = url; //--> blob URL
		video.preload = "metadata";
		video.appendChild( source );
		video.onloadedmetadata = function () {
			resolve( video.duration )
		};
	} );
}


export default async ( field, file, rules = {}, name = '', files = [] ) => {
	if ( ! rules ) {
		rules = {
			ext: [ 'jpg', 'jpeg', 'png' ],
			maxsize: 1024
		};
	} else {
		rules = JSON.parse( rules );
	}

	const error = field.querySelector( '.file__field-error' );
	if ( error ) {
		error.remove();
	}

	const round = ( num ) => Math.round( num * 100 ) / 100;

	const element = document.createElement( 'div' );
	element.classList.add( 'file__field-error' );

	if ( rules.hasOwnProperty( 'ext' ) ) {
		let pattern = '(';
		rules.ext.forEach( ( ext, index ) => {
			pattern += '\\' + ext;
			if ( rules.ext.length !== ( index + 1 ) ) {
				pattern += '|'
			}
		} );
		pattern += ')$';

		const regex = new RegExp( pattern, "i" );
		if ( ! regex.test( file.name ) ) {
			element.innerText = 'Возможно загрузить только типы: ' + rules.ext.join( ',' );
			field.append( element );

			return false;
		}
	}

	if ( rules.hasOwnProperty( 'maxsize' ) ) {
		const size = ( file.size / 1024 );
		if ( size > rules.maxsize ) {
			element.innerText += 'Размер файла слишком большой, максимум ' + round( rules.maxsize / 1024, 2 ) + ' мб';
			field.append( element );

			return false;
		}
	}

	if ( rules.hasOwnProperty( 'max' ) ) {
		if (
			files.hasOwnProperty( name )
			&& files[name]
			&& ( files[name].length + 1 ) > rules.max
		) {
			element.innerText += 'Можно загрузить не более ' + rules.max + ' файлов';
			field.append( element );

			return false;
		}
	}

	if (
		rules.hasOwnProperty( 'type' )
		&& rules.type === 'video'
		&& rules.hasOwnProperty( 'maxtime' )
	) {
		const duration = await getDuration( file );
		if ( duration > rules.maxtime ){
			element.innerText += 'Можно загрузить видео продолжительностью не более ' + ( rules.maxtime / 60 ) + ' минуты';
			field.append( element );

			return false;
		}
	}

	return true;
}
