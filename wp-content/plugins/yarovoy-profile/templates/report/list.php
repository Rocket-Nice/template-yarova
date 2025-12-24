
<div class="profile profile-reports">
	<div class="container profile__container">
		<?php

		yar_plugin_get_template( 'common/page-header' );

		if ( yar_is_expert() ){
			yar_plugin_get_template( 'report/list/expert' );
		} else {
			yar_plugin_get_template( 'report/list/client' );
		} ?>
	</div>
</div>
