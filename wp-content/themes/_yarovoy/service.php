<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Разовый осмотр автомобиля</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/css/style.css">
</head>
<body>

<header class="header">
    <div class="container">
        <div class="header__main">
            <button class="header__mobile-menu">
                <span></span><span></span><span></span>
            </button>
            <a href="/" class="header__logo logo">
                <img src="<?= get_template_directory_uri(); ?>/img/logo.svg" alt="">
            </a>
            <div class="header__main-right">
                <div class="header__phone">
                    <a href="tel:+7 (495) 159-39-20">+7 (495) 159-39-20</a>
                    <p>ПЕРЕЗВОНИТЕ МНЕ</p>
                </div>
                <div class="header__socials socials">
                    <a href="#" class="socials__item _vk item--center">
                        <svg width="21" height="13" viewBox="0 0 21 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.3597 12.625C4.78271 12.625 1.03131 8.02665 0.875 0.375H4.1695C4.27772 5.99112 6.70651 8.36999 8.63031 8.86048V0.375H11.7324V5.21859C13.6322 5.01013 15.6281 2.80293 16.3015 0.375H19.4036C19.1498 1.63419 18.6441 2.82645 17.9179 3.87719C17.1917 4.92793 16.2608 5.81455 15.1832 6.48161C16.386 7.09111 17.4484 7.95381 18.3002 9.01278C19.152 10.0717 19.774 11.3029 20.125 12.625H16.7103C16.3952 11.4767 15.7547 10.4487 14.8692 9.66997C13.9837 8.89124 12.8925 8.39636 11.7324 8.24737V12.625H11.3597V12.625Z" fill="white"/>
                        </svg>
                    </a>
                    <a href="#" class="socials__item _telegram item--center">
                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5 1.02695L14.8703 14.7557C14.8703 14.7557 14.5023 15.7076 13.4915 15.2511L7.424 10.4335L7.39587 10.4193C8.21545 9.65722 14.5708 3.73983 14.8486 3.47161C15.2786 3.05619 15.0117 2.80889 14.5124 3.12269L5.12469 9.29635L1.50293 8.03442C1.50293 8.03442 0.932975 7.82447 0.878144 7.36797C0.822591 6.91072 1.52169 6.66341 1.52169 6.66341L16.2865 0.665329C16.2865 0.665329 17.5 0.113189 17.5 1.02695V1.02695Z" fill="#FEFEFE"/>
                        </svg>
                    </a>
                    <a href="#" class="socials__item _whatsapp item--center">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.436 3.55469C14.7073 1.83203 12.4024 0.875 9.96951 0.875C4.91158 0.875 0.814023 4.95833 0.814023 9.9987C0.814023 11.5938 1.2622 13.1888 2.03049 14.5286L0.75 19.25L5.61586 17.974C6.96037 18.6758 8.43293 19.0586 9.96951 19.0586C15.0274 19.0586 19.125 14.9753 19.125 9.9349C19.061 7.57422 18.1646 5.27734 16.436 3.55469ZM14.3872 13.2526C14.1951 13.763 13.2988 14.2734 12.8506 14.3372C12.4665 14.401 11.9543 14.401 11.4421 14.2734C11.122 14.1458 10.6738 14.0182 10.1616 13.763C7.85671 12.806 6.38415 10.5091 6.2561 10.3177C6.12805 10.1901 5.29573 9.10547 5.29573 7.95703C5.29573 6.80859 5.87195 6.29818 6.06402 6.04297C6.2561 5.78776 6.51219 5.78776 6.70427 5.78776C6.83232 5.78776 7.02439 5.78776 7.15244 5.78776C7.28049 5.78776 7.47256 5.72396 7.66463 6.17057C7.85671 6.61719 8.30488 7.76563 8.3689 7.82943C8.43293 7.95703 8.43293 8.08464 8.3689 8.21224C8.30488 8.33984 8.24085 8.46745 8.1128 8.59505C7.98475 8.72266 7.8567 8.91406 7.79268 8.97786C7.66463 9.10547 7.53658 9.23307 7.66463 9.42448C7.79268 9.67969 8.24085 10.3815 8.94512 11.0195C9.84146 11.7852 10.5457 12.0404 10.8018 12.168C11.0579 12.2956 11.186 12.2318 11.314 12.1042C11.4421 11.9766 11.8902 11.4661 12.0183 11.2109C12.1463 10.9557 12.3384 11.0195 12.5305 11.0833C12.7226 11.1471 13.875 11.7214 14.0671 11.849C14.3232 11.9766 14.4512 12.0404 14.5152 12.1042C14.5793 12.2956 14.5793 12.7422 14.3872 13.2526Z" fill="white"/>
                        </svg>
                    </a>
                </div>
                <a href="#" class="header__auth">
                    <p>Войти в личный<br> кабинет клиента</p>
                    <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23.5156 9.84375C23.2476 13.4579 20.5078 16.4062 17.5 16.4062C14.4922 16.4062 11.7476 13.4586 11.4844 9.84375C11.2109 6.08398 13.8769 3.28125 17.5 3.28125C21.123 3.28125 23.7891 6.15234 23.5156 9.84375Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17.4999 20.7812C11.5527 20.7812 5.51652 24.0625 4.39953 30.2559C4.26486 31.0023 4.68732 31.7188 5.46867 31.7188H29.5312C30.3132 31.7188 30.7357 31.0023 30.601 30.2559C29.4833 24.0625 23.4472 20.7812 17.4999 20.7812Z" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                    </svg>
                </a>
            </div>
        </div>
        <div class="header__menu">
            <button class="header__mobile-menu">
                <span></span><span></span><span></span>
            </button>
            <ul class="menu">
                <li class="menu__item"><a href="#" class="menu__link">О компании</a></li>
                <li class="menu__item"><a href="#" class="menu__link">Услуги</a></li>
                <li class="menu__item"><a href="#" class="menu__link">Контакты</a></li>
                <li class="menu__item"><a href="#" class="menu__link">Наши работы</a></li>
                <li class="menu__item"><a href="#" class="menu__link _selected">База проверенных автомобилей</a></li>
            </ul>
            <div class="header__buttons">
                <a href="#" class="btn _border">Выбрать эксперта</a>
                <a href="#" class="btn">Получить консультацию</a>
            </div>
        </div>
    </div>
</header>

<section class="hero">
    <div class="container">
        <div class="breadcrumbs">
            <a href="#">Главная</a>
            <a href="#">Услуги</a>
            <span>Разовый осмотр автомобилей</span>
        </div>
        <div class="hero__content">
            <h1 class="hero__title block__title">Разовый осмотр автомобилей</h1>
            <div class="hero__subtitle">Выезд эксперта для осмотра<br> выбранного вами автомобиля.</div>
            <ul class="hero__list">
                <li>Юридическая проверка</li>
                <li>Техническая проверка</li>
                <li>Криминалистическая проверка</li>
                <li>Помощь в заключении<br> Договора купли-продажи</li>
                <li>Диагностический лист<br> на фирменном бланке</li>
            </ul>
            <div class="hero__action">
                <a href="#" class="btn">Оставить заявку</a>
                <div class="hero__price">7 000 Р</div>
            </div>
        </div>
    </div>
    <img src="<?= get_template_directory_uri(); ?>/img/hero-image.jpg" class="hero__image" alt="">
</section>

<section class="worried section">
    <div class="container">
        <div class="worried__title block__title">Беспокоимся о вашем комфорте и безопасности</div>
        <div class="worried__text grid">
            <p>Перед покупкой автомобиля необходимо провести выездную проверку,<br> чтобы быть уверенным в его безопасности и надежности. Это важно для<br> комфортного использования автомобиля в двадцать первом веке.<br> Внимательное тестирование перед покупкой поможет избежать<br> потенциальных проблем, которые могут привести к авариям. </p>
            <p>Предварительное ознакомление с динамикой машины<br> предупреждает опасные ситуации в будущих поездках. Наша<br> компания осуществляет полный осмотр автомобиля в Москве. Мы<br> всегда готовы предоставить клиенту более подробную информацию<br> на эту тему, чтобы обеспечить его максимальный комфорт</p>
        </div>
        <div class="worried__grid grid">
            <div class="worried-item">
                <div class="worried-item__title">Гарантия по договору от ЯПОDБОР</div>
                <div class="worried-item__text">
                    Гарантия распространяется на мотор и коробку передач. При поломке составляющего автомобиля сделаем возврат стоимости услуги автоподбора. Сумма гарантии не превышает стоимость автоподбора, поэтому клиент ничего не теряет.
                </div>
            </div>
            <div class="worried-item">
                <div class="worried-item__title">Техническая гарантия от партнёра Karso</div>
                <div class="worried-item__text">
                    Платная гарантия на год с покрытием до 500 тысяч рублей. Специалисты отремонтируют автомобиль в любом регионе России.
                </div>
            </div>
            <div class="worried-item _red">
                <div class="worried-item__text">
                    Мы не скрываем важную информацию за мелким шрифтом под звёздочкой и тщательно разбираем каждый гарантийный случай.
                </div>
                <div>
                    <div class="worried-item__title">Возникли вопросы?</div>
                    <div class="worried-item__text">Оставьте заявку, мы свяжемся<br> с вами и ответим на все вопросы</div>
                    <a href="#" class="worried-item__btn btn _white">Оставить заявку</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section about">
    <div class="container">
        <div class="about__title block__title">О компании ЯПОDБОР</div>
        <div class="about__main grid">
            <div class="about__main-col">
                <div class="about__text">
                    <p>Занимаемся подбором автомобилей с 2012 года. Делаем полную юридическую, техническую и криминалистическую проверку. География подбора не ограничивается Россией. Специалисты также ищут автомобили в странах СНГ, Европе и США.</p>
                    <p>Наша задача — сделать процесс подбора максимально качественным и комфортным для клиента. После оформления заявки и обсуждения ваших пожеланий мы берём всю работу на себя — поиск автомобиля, полную проверку и сопровождение сделки, включая составление Договора купли-продажи.</p>
                    <p>В компании работает команда опытных экспертов-криминалистов, которые используют новое высокотехнологичное оборудование для отбора автомобилей для клиентов.</p>
                </div>
            </div>
            <div class="about__main-col">
                <div class="about__text">
                    <p>С момента основания компании мы подобрали более 9000 автомобилей, чётко следуя критериям клиентов. Доверьте нам поиск своего автомобиля — сэкономьте время, деньги и сохраните нервы.</p>
                </div>
                <div class="about-advantages grid">
                    <div class="about-advantages__item">
                        <div class="about-advantages__title">Выгодный торг</div>
                        <div class="about-advantages__text">
                            В 99% случаях оплата за услуги автоподбора окупается торгом с&nbsp;владельцем машины.
                        </div>
                    </div>
                    <div class="about-advantages__item">
                        <div class="about-advantages__title">Экономим ваше время</div>
                        <div class="about-advantages__text">
                            Проведём осмотр авто в течение нескольких часов<br> после получения заявки.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about__image">
            <img src="<?= get_template_directory_uri(); ?>/img/about-image.jpg" alt="">
        </div>
    </div>
</section>

<div class="section how">
    <div class="container">
        <div class="how__title block__title">Как мы проверяем автомобиль</div>
        <div class="how__grid grid tabs">
            <div class="how__tabs tabs__menu">
                <a href="#" data-tab="tab_1" class="_active">
                    <span>Двигатель</span>
                    <svg width="27" height="16" viewBox="0 0 27 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.7071 8.70711C27.0976 8.31658 27.0976 7.68342 26.7071 7.29289L20.3431 0.928932C19.9526 0.538408 19.3195 0.538408 18.9289 0.928932C18.5384 1.31946 18.5384 1.95262 18.9289 2.34315L24.5858 8L18.9289 13.6569C18.5384 14.0474 18.5384 14.6805 18.9289 15.0711C19.3195 15.4616 19.9526 15.4616 20.3431 15.0711L26.7071 8.70711ZM0 9H26V7H0V9Z" fill="#252525"/>
                    </svg>
                </a>
                <a href="#" data-tab="tab_2">
                    <span>Кузов</span>
                    <svg width="27" height="16" viewBox="0 0 27 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.7071 8.70711C27.0976 8.31658 27.0976 7.68342 26.7071 7.29289L20.3431 0.928932C19.9526 0.538408 19.3195 0.538408 18.9289 0.928932C18.5384 1.31946 18.5384 1.95262 18.9289 2.34315L24.5858 8L18.9289 13.6569C18.5384 14.0474 18.5384 14.6805 18.9289 15.0711C19.3195 15.4616 19.9526 15.4616 20.3431 15.0711L26.7071 8.70711ZM0 9H26V7H0V9Z" fill="#252525"/>
                    </svg>
                </a>
                <a href="#" data-tab="tab_3">
                    <span>Салон</span>
                    <svg width="27" height="16" viewBox="0 0 27 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.7071 8.70711C27.0976 8.31658 27.0976 7.68342 26.7071 7.29289L20.3431 0.928932C19.9526 0.538408 19.3195 0.538408 18.9289 0.928932C18.5384 1.31946 18.5384 1.95262 18.9289 2.34315L24.5858 8L18.9289 13.6569C18.5384 14.0474 18.5384 14.6805 18.9289 15.0711C19.3195 15.4616 19.9526 15.4616 20.3431 15.0711L26.7071 8.70711ZM0 9H26V7H0V9Z" fill="#252525"/>
                    </svg>
                </a>
                <a href="#" data-tab="tab_4">
                    <span>Ходовая</span>
                    <svg width="27" height="16" viewBox="0 0 27 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.7071 8.70711C27.0976 8.31658 27.0976 7.68342 26.7071 7.29289L20.3431 0.928932C19.9526 0.538408 19.3195 0.538408 18.9289 0.928932C18.5384 1.31946 18.5384 1.95262 18.9289 2.34315L24.5858 8L18.9289 13.6569C18.5384 14.0474 18.5384 14.6805 18.9289 15.0711C19.3195 15.4616 19.9526 15.4616 20.3431 15.0711L26.7071 8.70711ZM0 9H26V7H0V9Z" fill="#252525"/>
                    </svg>
                </a>
                <a href="#" data-tab="tab_5">
                    <span>Диагностика</span>
                    <svg width="27" height="16" viewBox="0 0 27 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.7071 8.70711C27.0976 8.31658 27.0976 7.68342 26.7071 7.29289L20.3431 0.928932C19.9526 0.538408 19.3195 0.538408 18.9289 0.928932C18.5384 1.31946 18.5384 1.95262 18.9289 2.34315L24.5858 8L18.9289 13.6569C18.5384 14.0474 18.5384 14.6805 18.9289 15.0711C19.3195 15.4616 19.9526 15.4616 20.3431 15.0711L26.7071 8.70711ZM0 9H26V7H0V9Z" fill="#252525"/>
                    </svg>
                </a>
            </div>
            <div class="tabs__content">
                <div class="tabs__item how-tab" data-tab="tab_1">
                    <div class="how-tab__image">
                        <img src="<?= get_template_directory_uri(); ?>/img/how/tab-1.png" alt="">
                    </div>
                    <div class="how-tab__content">
                        <div class="how-tab__title">Двигатель</div>
                        <div class="how-tab__text">
                            Проверяем общее состояние двигателя, наличие посторонних шумов и вибраций при запуске. Оцениваем работоспособность датчиков. Выявляем течи и износ. Ищем повреждения цилиндра при помощи эндоскопа. Делаем замер компрессии.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="how__button">
            <a href="#" class="btn _big">Оставить заявку</a>
        </div>
    </div>
</div>

<section class="section appreciate">
    <div class="container">
        <div class="appreciate__title block__title">Цените свое<br> время и деньги</div>
        <div class="appreciate__grid grid">
            <div class="appreciate-item">
                <div class="appreciate-item__title">Если вы ищете автомобиль самостоятельно</div>
                <div class="appreciate-item__list appreciate-list">
                    <div class="appreciate-list__item">
                        <div class="appreciate-list__icon">
                            <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect y="24.6685" width="34.8865" height="4.36082" transform="rotate(-45 0 24.6685)" fill="#252525"/>
                                <rect x="3.48877" y="0.248047" width="34.8865" height="4.36082" transform="rotate(45 3.48877 0.248047)" fill="#252525"/>
                            </svg>
                        </div>
                        <div class="appreciate-list__contnet">
                            <div class="appreciate-list__title">Тратите больше денег</div>
                            <div class="appreciate-list__text">Покупаете автомобиль выше<br> рыночной стоимости</div>
                        </div>
                    </div>
                    <div class="appreciate-list__item">
                        <div class="appreciate-list__icon">
                            <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect y="24.6685" width="34.8865" height="4.36082" transform="rotate(-45 0 24.6685)" fill="#252525"/>
                                <rect x="3.48877" y="0.248047" width="34.8865" height="4.36082" transform="rotate(45 3.48877 0.248047)" fill="#252525"/>
                            </svg>
                        </div>
                        <div class="appreciate-list__contnet">
                            <div class="appreciate-list__title">Попадаете на<br> недобросовестных продавцов</div>
                            <div class="appreciate-list__text">Через месяц автомобилю требуется ремонт по цене трети от его общей стоимости</div>
                        </div>
                    </div>
                    <div class="appreciate-list__item">
                        <div class="appreciate-list__icon">
                            <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect y="24.6685" width="34.8865" height="4.36082" transform="rotate(-45 0 24.6685)" fill="#252525"/>
                                <rect x="3.48877" y="0.248047" width="34.8865" height="4.36082" transform="rotate(45 3.48877 0.248047)" fill="#252525"/>
                            </svg>
                        </div>
                        <div class="appreciate-list__contnet">
                            <div class="appreciate-list__title">Тратите свое драгоценное время</div>
                            <div class="appreciate-list__text">В итоге видите автомобиль, не<br> соответствующий описанию в&nbsp;объявлении</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="appreciate-item _dark">
                <div class="appreciate-item__title">Если вы воспользовались<br> услугами <span>Яподбор</span></div>
                <div class="appreciate-item__list appreciate-list">
                    <div class="appreciate-list__item">
                        <div class="appreciate-list__icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="17.6672" y="37.499" width="34.8865" height="4.36082" transform="rotate(-90 17.6672 37.499)" fill="#E20E00"/>
                                <rect x="2.86621" y="17.7642" width="34.8865" height="4.36082" fill="#E20E00"/>
                            </svg>
                        </div>
                        <div class="appreciate-list__contnet">
                            <div class="appreciate-list__title">Не потратили деньги зря</div>
                            <div class="appreciate-list__text">Профессионально и аргументированно сторгуем стоимость автомобиля к рыночной цене или ниже. Услуга подбора окупится полностью.</div>
                        </div>
                    </div>
                    <div class="appreciate-list__item">
                        <div class="appreciate-list__icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="17.6672" y="37.499" width="34.8865" height="4.36082" transform="rotate(-90 17.6672 37.499)" fill="#E20E00"/>
                                <rect x="2.86621" y="17.7642" width="34.8865" height="4.36082" fill="#E20E00"/>
                            </svg>
                        </div>
                        <div class="appreciate-list__contnet">
                            <div class="appreciate-list__title">Получили тот автомобиль,<br> который хотели</div>
                            <div class="appreciate-list__text">Подберём автомобиль именно по вашим пожеланиям. Он будет полностью технически исправен и юридически чист.</div>
                        </div>
                    </div>
                    <div class="appreciate-list__item">
                        <div class="appreciate-list__icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="17.6672" y="37.499" width="34.8865" height="4.36082" transform="rotate(-90 17.6672 37.499)" fill="#E20E00"/>
                                <rect x="2.86621" y="17.7642" width="34.8865" height="4.36082" fill="#E20E00"/>
                            </svg>
                        </div>
                        <div class="appreciate-list__contnet">
                            <div class="appreciate-list__title">Получили отчёт от&nbsp;эксперта</div>
                            <div class="appreciate-list__text">Предоставим в нём всю информацию об&nbsp;автомобиле</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="section value">
    <div class="container">
        <div class="value__title block__title">Как устроена услуга автоподбора?</div>
        <div class="value__grid grid tabs">
            <div class="value-item">
                <div class="value-item__number">01</div>
                <div class="value-item__title">Онлайн-заявка на<br> подбор автомобиля</div>
                <div class="value-item__text">
                    Через форму на сайте, по телефону<br> или через мессенджеры.
                </div>
            </div>
            <div class="value-item">
                <div class="value-item__number">02</div>
                <div class="value-item__title">Бесплатная консультация со&nbsp;специалистом</div>
                <div class="value-item__text">
                    Определяем требования к автомобилю, обсуждаем ваши пожелания, после чего заключаем договор. Вы вносите<br> предоплату.
                </div>
            </div>
            <div class="value-item">
                <div class="value-item__number">03</div>
                <div class="value-item__title">Поиск и проверка<br> автомобиля</div>
                <div class="value-item__text">
                    Анализируем рынок. Проверяем историю автомобиля, проводим техническую, юридическую и криминалистическую проверку. Предоставляем отчёт и заключение эксперта о состоянии автомобиля.
                </div>
            </div>
            <div class="value-item">
                <div class="value-item__number">04</div>
                <div class="value-item__title">Проверка автомобиля</div>
                <div class="value-item__text">
                    Проверяем на СТО. Предоставляем отчёт и заключение эксперта о состоянии автомобиля. Торгуемся с продавцом.
                </div>
            </div>
            <div class="value-item">
                <div class="value-item__number">05</div>
                <div class="value-item__title">Заключение сделки<br> купли-продажи</div>
                <div class="value-item__text">
                    Сопровождаем сделку, включая составление Договора купли-продажи, помогаем при постановке в ГАИ
                </div>
            </div>
            <div class="value-item">
                <div class="value-item__number">06</div>
                <div class="value-item__title">Доставка автомобиля<br> и оплата услуг подбора</div>
                <div class="value-item__text">
                    При необходимости доставляем автомобиль, если он приобретен в удаленном регионе или другой стране. Выдаём пакет документов. Вы оплачиваете&nbsp;услугу подбора и доставку.
                </div>
            </div>
        </div>
        <div class="value__button">
            <a href="#" class="btn _big">Оставить заявку</a>
        </div>
    </div>
</div>

<div class="section call">
    <div class="container">
        <div class="call__content">
            <div class="call__title block__title">Свяжитесь с нами</div>
            <div class="call__text">
                Заполните заявку, чтобы мы точно поняли ваш запрос. Мы перезвоним и ответим на все ваши вопросы.
            </div>
            <form method="post" class="call__form">
                <div class="form__row call__row">
                    <label>Как вас зовут?</label>
                    <input type="text" name="name" placeholder="Ваше имя">
                </div>
                <div class="form__row call__row">
                    <label>Ваш телефон</label>
                    <input type="text" name="phone" placeholder="Номер телефона">
                </div>
                <div class="form__row call__row">
                    <label>Ваш регион</label>
                    <div class="select">
                        <div class="select__result">
                            <span>Выберите регион</span>
                            <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L8.5 8.5L16 1" stroke="#262626" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="select__list">
                            <div class="select__item">Москва</div>
                            <div class="select__item">Москва</div>
                            <div class="select__item">Москва</div>
                        </div>
                    </div>
                </div>
                <div class="call__button">
                    <button class="btn _big">Оставить заявку</button>
                </div>
            </form>
        </div>
    </div>
</div>

<section class="section about _why">
    <div class="container">
        <div class="about__title block__title">Почему важен осмотр<br> автомобиля перед покупкой?</div>
        <div class="about__main grid">
            <div class="about__main-col">
                <div class="about__text">
                    <p>
                        Каждый автолюбитель должен понимать, что своевременное устранение неполадок не только обеспечивает безопасность в настоящий момент, но и предотвращает их усугубление в будущем. Многие владельцы, размещающие объявления о продаже транспортных средств, иногда скрывают информацию о прежних авариях и неисправностях, которые были устранены без помощи официальных органов. Только профессионал сможет обнаружить такие повреждения. Онлайн-проверка подтвердит подлинность документов, а личное участие эксперта поспособствует своевременному обнаружению скрытых неисправности и спасёт от неудачной сделки. Выездной осмотр автомобиля - это тщательно спланированный набор мероприятий, направленных на обеспечение дальнейшей безопасности. Выездной осмотр в Москве помогает сэкономить время, усилия и деньги, избежав дорогостоящего ремонта или повторного приобретения.
                    </p>
                </div>
            </div>
            <div class="about__main-col">
                <div class="about__text">
                    <p>Удобство покупателя в это время находится на первом месте,<br> сотрудник фирмы руководствуется требованиями и пожеланиями клиента, чтобы гарантировать успешную покупку.</p>
                    <p>Рекомендуется заказывать осмотр автомобиля перед покупкой,<br> если вы беспокоитесь, что недобросовестные продавцы могут вас обмануть или у вас недостаточно опыта для обнаружения скрытых неисправностей. Безопасность и комфорт должны оставаться на<br> первом месте. Услуга осмотра авто перед покупкой обеспечивает<br> это в полной мере. </p>
                </div>
            </div>
        </div>
        <div class="about__image">
            <img src="<?= get_template_directory_uri(); ?>/img/why-image.jpg" alt="">
        </div>
    </div>
</section>

<div class="section value _tasks">
    <div class="container">
        <div class="value__title block__title">Какие задачи включает осмотр<br> автомобиля перед покупкой?</div>
        <div class="value__text">
            Цена осмотра автомобиля обычно обсуждается на этапе заключения договора,<br> дополнительно клиент оплачивает только услуги автосервиса. Мы предоставляем<br> осмотр авто перед покупкой в Москве по приемлемой стоимости.
        </div>
        <div class="value__grid grid tabs">
            <div class="value-item">
                <div class="value-item__number">01</div>
                <div class="value-item__text">
                    Осмотр кузова, капота и внешних частей на наличие вмятин, царапин и других косметических повреждений. Крупные вмятины и сколы могут быть хорошо замаскированы, и важно определить это сразу.
                </div>
            </div>
            <div class="value-item">
                <div class="value-item__number">02</div>
                <div class="value-item__text">
                    Изучение состояния номеров и определение, были ли они заменены или отремонтированы после аварии. Если заказать осмотр авто перед покупкой, эксперт проведёт все проверки.
                </div>
            </div>
            <div class="value-item">
                <div class="value-item__number">03</div>
                <div class="value-item__text">
                    Исследование автомобиля с точки зрения скоростных характеристик, состояния жидкостей и топлива. При желании может быть проведен тест-драйв.
                </div>
            </div>
            <div class="value-item">
                <div class="value-item__number">04</div>
                <div class="value-item__text">
                    Анализ и структурирование полученной информации, своевременное предоставление ее клиенту. Сотрудник компании составляет полный отчёт согласно установленному чек-листу в указанный срок и отправляет удобным способом.
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="<?= get_template_directory_uri(); ?>/js/main.js"></script>

</body>
</html>