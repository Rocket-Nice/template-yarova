( function ( $ ) {
    $( document ).ready( function () {
        if ( $( '.portfolio-gallery__swiper' ).length ) {
            new Swiper( '.portfolio-gallery__swiper', {
                slidesPerView: 1,
                pagination: {
                    el: ".portfolio-gallery__pagination",
                    clickable: true
                },
            } );
        }

        if ( $( '.portfolio-related__swiper' ).length ) {
            new Swiper( '.portfolio-related__swiper', {
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    1199: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                }
            } );
        }

        if ( $( '.expert__portfolio-swiper' ).length ) {
            new Swiper( '.expert__portfolio-swiper', {
                navigation: {
                    nextEl: ".expert__portfolio-next",
                    prevEl: ".expert__portfolio-prev",
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    1199: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                }
            } );
        }

        $( 'body' ).on( 'click', '.expert__get--phone', function ( e ) {
            e.preventDefault();

            let $button = $( this ),
                postID = $button.data( 'id' );

            if ( ! postID ) {
                return;
            }

            $.ajax( {
                url: '/wp-admin/admin-ajax.php',
                data: {
                    action: 'yar_get_phone',
                    post_id: postID
                },
                type: 'POST',
            } ).done( function ( result ) {
                if ( result.success === true && result.data.phone ) {
                    $button.text( result.data.phone );
                }
            } );
        } );

        // Popup
        // function resizePopups() {
        //     if ( $( window ).width() < 767 ) {
        //         $( '.popup' ).each( function () {
        //             let $item = $( this );
        //
        //             //if ( $item.height() >  )
        //         } );
        //     }
        // }

        function openPopup( target, action = '' ) {
            closePopup();

            let $popup = $( '#' + target );
            $popup.fadeIn( 200 );

            if ( $( '.popup__content', $popup )[0].getBoundingClientRect().height > window.innerHeight ) {
                $popup.addClass( '_scrollable' );
            } else {
                $popup.removeClass( '_scrollable' );
            }

            if ( action ) {
                $( '#' + target ).find( 'input[name="popup_action"]' ).val( action );
            }
            $( 'body' ).css( { 'overflow': 'hidden' } );
        }

        window.openPopup = openPopup;

        function closePopup() {
            $( '.popup' ).fadeOut( 200 );
            $( 'body' ).css( { 'overflow-y': 'auto', 'overflow-x': 'hidden' } );
        }

        $( 'body' ).on( 'click', '[data-popup]', function ( e ) {
            e.preventDefault();

            var data = $( this ).data( 'popup' ),
                action = $( this ).data( 'popup-action' );

            if ( data ) {
                closePopup();
                openPopup( data, action );
            }
        } );

        $( '.popup--close, .popup__bg' ).click( function ( e ) {
            e.preventDefault();

            closePopup();
        } );

        // Select rating
        $( '.rating-select__star' ).click( function ( e ) {
            e.preventDefault();

            let $stars = $( '.rating-select__star' ),
                $star = $( this );

            $stars.removeClass( '_active' );
            $star.addClass( '_active' ).nextAll().addClass( '_active' );

            $( 'input[name="_rating"]' ).val( $stars.parent().find( '._active' ).length );
        } );

        // Send feedback form
        $( '.feedback__form' ).on( 'click', '.btn', function ( e ) {
            sendAjax( e, 'yar_feedback_form', function ( result ) {
                if ( result.success === true ) {
                    window.location = '/thanks';
                }
            } );
        } );

        // Send payment form
        $( '.payment__form' ).on( 'click', '.btn', function ( e ) {
            sendAjax( e, 'yar_payment_form', function ( result ) {
                if ( result.success === true && result.data.link ) {
                    // let url = window.open( result.data.link, '_blank' );
                    // url.focus();
                    window.location = result.data.link;
                }
            } );
        } );

        // Filter blog / vlog
        $( '.vlog__menu' ).on( 'click', 'button', function ( e ) {
            e.preventDefault();

            let $button = $( this ),
                $menu = $button.closest( '.vlog__menu' ),
                term_id = $button.data( 'id' ),
                taxonomy = $menu.data( 'taxonomy' ) || 'vlog_category',
                type = $menu.data( 'type' ) || 'vlog',
                $body = $( '.vlog__body' );

            if ( type === 'blog' ) {
                $body = $( '.blog__body' );
            }

            let data = { term_id: term_id, taxonomy: taxonomy, type: type };

            $( '.vlog__menu button' ).removeClass( '_active' );
            $button.addClass( '_active' );

            sendAjax( e, 'yar_filter_bv', function ( result ) {
                if ( result ) {
                    $body.html( result );
                }
            }, data );
        } );

        // Get model / generation
        $( '.feedback__form' ).on( 'change', 'select', function ( e ) {
            e.preventDefault();

            let $option = $( this ),
                $select = $option.closest( 'select' ),
                name = $select.attr( 'name' ),
                value = $option.val(),
                nextType = $select.data( 'next-type' ),
                _nonce = $select.data( 'nonce' );

            if ( ! nextType || ! value || ! _nonce ){
                return;
            }

            let $nextSelect = $( 'select[name="' + nextType + '"]' );

            $nextSelect.find( 'option:not(:first-child)' ).remove();
            $nextSelect.find( 'option:first-child' ).prop( 'selected', true );

            if ( name === 'mark' ){
                let $allSelects = $( 'select[name="model"], select[name="generation"]' );
                $allSelects.find( 'option:not(:first-child)' ).remove();
                $allSelects.find( 'option:first-child' ).prop( 'selected', true );
            }

            let data = { option_id: value, next_type: nextType, _nonce: _nonce };

            sendAjax( e, 'yar_get_bmg', function ( result ) {
                if ( result.success === true && result.data.options ) {
                    $nextSelect.append( result.data.options );
                }
            }, data );
        } );

        // Send payment form
        $( '.base-single__phone' ).on( 'click', '.btn', function ( e ) {
            let $button = $( e.currentTarget );
            let post_id = $button.data( 'id' );
            let _nonce = $button.data( 'nonce' );

            sendAjax( e, 'yar_base_get_phone', function ( result ) {
                if ( result.success === true ) {
                    $button.text( result.data.phone );
                }
            }, {
                post_id: post_id,
                _nonce: _nonce
            } );
        } );

        $( '.header__nav-arrow' ).on( 'click', function ( e ) {
            e.preventDefault();

            $( this ).parents( '.header__nav-item' ).toggleClass( '_active' );
        } );

        Fancybox.bind( "[data-fancybox]" );
    } );
} )( jQuery );