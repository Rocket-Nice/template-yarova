<?php

$about = get_field( 'about', 'user_' . get_current_user_id() );
$about = strip_tags( $about );

?>


<div class="profile-form__block profile-settings__about">
	<div class="profile-form__block-title">Информация о себе и опыт</div>
	<div class="profile-form__block-grid">
		<div class="input">
			<div class="input__wrapper">
				<textarea type="text" name="about" class="input__cell"><?= $about; ?></textarea>
			</div>
		</div>
	</div>
</div>