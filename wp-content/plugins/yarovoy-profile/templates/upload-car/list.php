<?php

$repository = new YAR_Car_Public_Repository();
$list       = $repository->list();

$is_work = false;

?>


<div class="profile profile-upload__car">
	<div class="container profile__container">
		<?php load_template( YAR_PROFILE_TEMPLATES . '/common/page-header.php' ); ?>

		<?php if ( $is_work ){ ?>
			<a href="create" class="profile-upload__car-add">
				<span>Добавить свой автомобиль</span>
				<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M9.88989 16.2139V5.59061L6.50088 8.97963L4.67603 7.0896L11.1934 0.572266L17.7107 7.0896L15.8858 8.97963L12.4968 5.59061V16.2139H9.88989ZM3.37256 21.4277C2.65565 21.4277 2.04194 21.1725 1.53141 20.6619C1.02089 20.1514 0.765625 19.5377 0.765625 18.8208V14.9104H3.37256V18.8208H19.0142V14.9104H21.6211V18.8208C21.6211 19.5377 21.3658 20.1514 20.8553 20.6619C20.3448 21.1725 19.7311 21.4277 19.0142 21.4277H3.37256Z" fill="white"/>
				</svg>
			</a>

			<div class="profile-upload__car-list">
				<?php foreach ( $list as $item ) { ?>
					<div class="profile-upload__car-block">
						<div class="profile-upload__car-title <?= ( $item['status'] === 'draft' ? '_red' : '' ); ?>">
							<?= $item['title']; ?>
						</div>
						<?php if ( ! empty( $item['posts'] ) ){ ?>
							<div class="profile-upload__car-row">
								<?php foreach ( $item['posts'] as $post ) {
									load_template( YAR_PROFILE_TEMPLATES . '/upload-car/list/card.php', false, $post );
								} ?>
							</div>
						<?php } else {
							echo 'Пока нет добавленных авто';
						}?>
					</div>
				<?php } ?>
			</div>

		<?php } else {
			echo 'Этот раздел будет доступен позже';
		} ?>
	</div>
</div>

<?php load_template( YAR_PROFILE_TEMPLATES . '/modals/message.php' ); ?>