<?php

?>

<div class="profile profile-settings">
	<div class="container profile__container">
		<?php
		yar_plugin_get_template( 'common/page-header' );

		if ( yar_is_expert() ) {
			yar_plugin_get_template( 'settings/expert' );
		} else {
			yar_plugin_get_template( 'settings/client' );
		}

		?>
	</div>
</div>

<?php yar_plugin_get_template( 'modals/message' ); ?>
