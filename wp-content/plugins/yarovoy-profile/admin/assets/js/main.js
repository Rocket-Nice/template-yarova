window.addEventListener( 'DOMContentLoaded', () => {
    const sendAjax = ( action, data = {}, callback = '' ) => {
        const formData = new FormData();

        if ( ! data ){
            return;
        }

        data.action = action;

        for ( const item in data ){
            formData.append( item, data[item] );
        }

        fetch( '/wp-admin/admin-ajax.php', {
            method: "POST",
            body: formData,
        } )
            .then( response => {
                return response.json();
            } )
            .then( ( result ) => {
                if ( result.data && result.data.errors ) {
                    //errors.add( result.data.errors );
                }

                if ( typeof ( callback ) == 'function' ) {
                    callback( result );
                }
            } );
    }

    const updateProfile = document.querySelector( '.admin-user--update' );
    if ( updateProfile ){
        updateProfile.addEventListener( 'click', ( event ) => {
            event.preventDefault();

            const user_id = updateProfile.dataset.id;
            const _nonce = updateProfile.dataset.nonce;

            sendAjax( 'yar_admin_update_user', {
                user_id: user_id,
                _nonce: _nonce
            }, ( result ) => {
                if ( result.success === true ){
                    window.location.reload();
                }
            } );
        } );
    }

    const userServiceUpdate = document.querySelector( '.yar-admin--service' );
    if ( userServiceUpdate ){
        userServiceUpdate.addEventListener( 'click', ( event ) => {
            event.preventDefault();

            const _nonce = userServiceUpdate.dataset.nonce;
            if ( ! _nonce ){
                return;
            }

            userServiceUpdate.disabled = true;

            sendAjax( 'yar_admin_service_migrate', {
                _nonce: _nonce
            }, ( result ) => {
                userServiceUpdate.disabled = false;
            } );
        } );
    }
} );
