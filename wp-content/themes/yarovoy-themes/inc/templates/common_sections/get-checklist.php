<?php

$classes = yar_get_section_classes($args);

$title = $args['title'];
$subtitle = $args['subtitle'];
$description = $args['description'];
$button_text = $args['button_text'];
$button_link = $args['button_link'];
$background_image = $args['background_image'];

?>

<section class="section <?= $classes; ?>" style="<?= $background_image ? 'background: url(' . esc_url($background_image) . ') center no-repeat; ' : 'background-color: black;'; ?> background-size: cover; padding: 80px 0; <?= esc_html($title) !== 'База проверенных автомобилей' ? 'margin-top: 0 !important;' : ''; ?>">
    <div class="page-container container">
        <h2 class="new-home-h2 text-align-center"><?= esc_html($title); ?></h2>
        <div class="get-checklist__container">
            <span><?= esc_html($subtitle); ?></span>
            <p><?= esc_html($description); ?></p>
            <a class="btn btn--accent" target="_blank" href="<?= esc_url($button_link); ?>"><?= esc_html($button_text); ?></a>
        </div>
    </div>
</section>