<?php

$videos = yar_get_part_arg( $args, 'data', [] );
if ( empty( $videos ) ) {
	return '';
} ?>

<div class="profile-report__videos">
	<?php foreach ( $videos as $key => $video ) { ?>
		<div class="profile-report__video">
			<video src="<?= $video['url'] ?>" preload="metadata"></video>
			<button class="profile-report__video-play" data-popup="popup-video" data-url="<?= $video['url'] ?>" data-type="<?= $video['mime_type'] ?>">

			</button>
		</div>
	<?php } ?>
</div>

<div class="popup popup-code popup--profile" id="popup-video">
	<div class="popup__wrapper">
		<div class="popup__content">
			<div class="popup-code__content">
				<div class="popup-video__wrapper">
					<video class="popup-video__init" playsinline controls>
						<source src="" type="">
					</video>
				</div>
				<button class="popup__close popup--close">
					<svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.5 1.48828L27.5 27.4883" stroke="#252525" stroke-width="2" stroke-linecap="round"></path>
						<path d="M27.5 1.48828L1.5 27.4883" stroke="#252525" stroke-width="2" stroke-linecap="round"></path>
					</svg>
				</button>
			</div>
		</div>
	</div>
	<div class="popup__bg"></div>
</div>