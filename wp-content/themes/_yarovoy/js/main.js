( function ( $ ) {
    $( document ).ready( function () {
        // FAQ
        $( '.faq-item' ).click( function ( e ) {
            e.preventDefault();

            $( this ).toggleClass( '_active' );
            $( this ).find( '.faq-item__body' ).slideToggle();
        } );

        // Tabs
        $( '.tabs__menu' ).on( 'click', 'a', function ( e ) {
            e.preventDefault();

            let $item = $( this ),
                $tabs = $item.closest( '.tabs' ),
                id = $item.data( 'tab' );

            if ( ! id ) {
                return;
            }

            $( '.tabs__menu a' ).removeClass( '_active' );
            $item.addClass( '_active' );

            $tabs.find( '.tabs__item' ).fadeOut( 100 );
            setTimeout( function () {
                $tabs.find( '.tabs__item[data-tab="' + id + '"]' ).fadeIn( 200 );
            }, 100 );
        } );
    } );
} )( jQuery );