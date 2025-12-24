<?php

$classes = yar_get_section_classes($args);

$title = $args['title'];
$subtitle = $args['subtitle'];
$background_image = $args['background_image'];

?>

<section class="section <?= $classes; ?>" style="background: url(<?= esc_url($background_image); ?>) center no-repeat; background-size: cover; padding: 80px 0; <?= esc_html($title === "Остались вопросы?") ? 'margin: 0;' : ''; ?>">
    <div class="page-container container text-align-center" style="display: flex; align-items: center; justify-content: center;">
        <div class="blur-bg">
            <h2 class="new-home-h2"><?= esc_html($title); ?></h2>
            <span><?= esc_html($subtitle); ?></span>
            <div class="get-checklist__container">
                <div class="form modal__form">
                    <?php wp_nonce_field('modal_form_nonce'); ?>
                    <div class="form__group">
                        <div class="input">
                            <input class="input__cell" type="text" name="name" placeholder="Ваше имя" required>
                        </div>
                        <div class="input">
                            <input class="input__cell" type="text" name="phone" placeholder="Телефон" required>
                        </div>
                    </div>
                    <button class="btn l-btn btn--accent form__send" id="submit-form--js" type="submit">Оставить заявку</button>
                </div>
            </div>
        </div>
    </div>
</section>