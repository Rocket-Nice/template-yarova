<div class="profile profile-contacts">
	<div class="container profile__container">
		<?php
		yar_plugin_get_template( 'common/page-header' );

		if ( yar_is_expert() ) {
			yar_plugin_get_template( 'contracts/expert' );
		} else {
			yar_plugin_get_template( 'contracts/client' );
		}

		?>
	</div>
</div>

<?php yar_plugin_get_template( 'modals/message' ); ?>