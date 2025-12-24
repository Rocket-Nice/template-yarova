<?php

$repository = new YAR_User_Repository();

?>

<div class="profile__title h1"><?= $repository->get_page_title(); ?></div>

<ul class="profile__menu">
	<?php foreach ( $repository->get_menu() as $menu ) {
		$active = false;
		if ( $menu['link'] === $_SERVER['REQUEST_URI'] ) {
			$active = true;
		} ?>
		<li>
			<a href="<?= $menu['link']; ?>" <?= ( $active ? 'class="_active"' : '' ); ?>>
				<?= $menu['title']; ?>
			</a>
		</li>
	<?php } ?>
</ul>