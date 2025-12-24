<?php get_header( null, [ 'classes' => 'body--dark' ] ); /* TEMPLATE NAME: Оплата */ ?>

<div class="page-container container">
	<section class="section section--banner payment--banner">
		<?php get_template_part( 'inc/templates/breadcrumbs' ); ?>
	</section>
</div>

<section class="section payment">
	<div class="container payment__container">
		<h1 class="payment__title title"><?php the_title(); ?></h1>
		<div class="payment__form form">
			<div class="payment__grid">
				<div class="input">
					<label for="first_name" class="input__label">Имя плательщика</label>
					<input type="text" name="first_name" class="input__cell" placeholder="Имя плательщика">
				</div>
				<div class="input">
					<label for="last_name" class="input__label">Фамилия плательщика</label>
					<input type="text" name="last_name" class="input__cell" placeholder="Фамилия плательщика">
				</div>
				<div class="input">
					<label for="phone" class="input__label">Телефон плательщика</label>
					<input type="text" name="phone" class="input__cell" placeholder="Телефон плательщика">
				</div>
				<div class="input">
					<label for="amount" class="input__label">Сумма оплаты, ₽</label>
					<input type="number" name="amount" class="input__cell" placeholder="Сумма оплаты, ₽">
				</div>
			</div>
			<?php wp_nonce_field( 'yar_payment_action' ); ?>
			<button class="btn btn--wide btn--accent btn--huge payment__button">Оплатить</button>
		</div>
	</div>
</section>

<?php get_footer(); ?>
