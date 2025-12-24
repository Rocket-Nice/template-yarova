function sendAjax ( event, action, callback = '', data = {} ) {
    event.preventDefault();

    if ( ! action ) {
        return;
    }

    let $ = jQuery;

    let $form;
    let $button = $( event.currentTarget );

    if ( Object.keys( data ).length === 0 ) {
        $form = $button.closest( '.form' );

        $form.find(
            'input[type="hidden"], input[type="text"], input[type="number"], input[type="radio"]:checked, textarea, select'
        ).each( function () {
            let $input = $( this );
            let name = $input.attr( 'name' );
            let value = $input.val();

            if ( name === 'mark' || name === 'model' || name === 'generation' ) {
                value = $input.find( 'option[value="' + value + '"]' ).text();
            }

            data[name] = value;
        } );

        $form.find( '._error' ).removeClass( '_error' );
        $form.find( '.form__error' ).remove();
    }

    $button.prop( 'disabled', true ).addClass( '_loading' );

    data.action = action;

    $.ajax( {
        url: '/wp-admin/admin-ajax.php',
        data: data,
        type: 'POST',
    } ).done( function ( result ) {
        if ( result.success === true ) {
            if ( $form ) {
                $form
                    .find( 'input:not([type="hidden"], [type="radio"]), textarea' )
                    .val( '' );
            }
        } else {
            if ( result.data && result.data.errors ) {
                $.each( result.data.errors, function ( e, index ) {
                    $form.find( 'input[name="' + e + '"], textarea[name="' + e + '"]' ).addClass( '_error' );
                    $form.find( 'input[name="' + e + '"], textarea[name="' + e + '"]' ).parent().append( '<div class="form__error">' + index[0] + '</div>' );
                } );
            }
        }

        if ( typeof ( callback ) == 'function' ) {
            callback( result );
        }

        $button.prop( 'disabled', false ).removeClass( '_loading' );
    } );
}