<?php get_header(null, ['header_class' => 'header-dogovor']); /*

* Template Name: Договор купли-продажи

*/ ?>

<section class="section section--banner">
    <div class="contract-sale__breadcrumbs-bg">
        <?php get_template_part(YAR_THEME_TEMPLATES . '/breadcrumbs'); ?>
    </div>
    <div class="page-container container">
        <section class="contract-sale">
            <h1 class="contract-sale__title">Договор купли-продажи автомобиля, мотоцикла, транспортного средства</h1>
            <p class="contract-sale__description">Договор купли-продажи транспортного средства нужно распечатать <span class="red-bold">в трех экземплярах</span> (продавцу, покупателю и ГИБДД) и подписать каждый экземпляр обеими сторонами сделки. Скачайте пустой бланк или заполните онлайн. </p>
            <div class="contract-sale__details">
                <div class="contract-sale__details__main">
                    <div class="contract-sale__details__main__submain">
                        <a class="btn btn--accent" href="<?= get_template_directory_uri(); ?>/яДКП_БЛАНК.docx" download>Скачать пустой бланк <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.5 16.1709L3.98633 9.65723L5.81016 7.76826L9.19727 11.1554V0.538086H11.8027V11.1554L15.1898 7.76826L17.0137 9.65723L10.5 16.1709ZM2.68359 21.3818C1.96709 21.3818 1.35372 21.1267 0.843481 20.6165C0.333244 20.1062 0.078125 19.4929 0.078125 18.7764V14.8682H2.68359V18.7764H18.3164V14.8682H20.9219V18.7764C20.9219 19.4929 20.6668 20.1062 20.1565 20.6165C19.6463 21.1267 19.0329 21.3818 18.3164 21.3818H2.68359Z" fill="white" />
                            </svg>
                        </a>
                    </div>
                    <p class="contract-sale__details__main__btn-subtitle">Бланк договора купли-продажи автомобиля образца 2025 года в формате DOC.</p>
                </div>

                <form class="contract-sale__form contract-sale__details" action="<?php echo get_template_directory_uri(); ?>/generate-doc.php" method="post">
                    <div class="contract-sale__details__main">
                        <div class="contract-sale__details__main__submain">
                            <h2>Заполнить онлайн</h2>
                        </div>
                        <span class="contract-sale__form-subtitle">Дата и место составления</span>
                        <div class="contract-sale__input">
                            <div class="input input--w-50">
                                <label for="contract_date">Дата составления:</label>
                                <input class="input__cell" type="text" maxlength="10" id="contract_date" placeholder="Дата составления" name="contract_date" required>
                            </div>
                            <div class="input input--w-50">
                                <label for="contract_place">Место составления:</label>
                                <input class="input__cell" type="text" id="contract_place" name="contract_place" placeholder="Город, адрес" required>
                            </div>
                        </div>
                    </div>
                    <!-- ПРОДАВЕЦ -->
                    <div class="contract-sale__inputs">
                        <span class="contract-sale__form-subtitle">Продавец</span>
                        <div class="contract-sale__input contract-sale__input--third">
                            <div class="input">
                                <label for="seller_full_name">ФИО:</label>
                                <input class="input__cell" type="text" id="seller_full_name" name="seller_full_name" placeholder="ФИО" required>
                            </div>
                            <div class="input">
                                <label for="seller_birth_date">Дата рождения:</label>
                                <input class="input__cell" type="text" maxlength="10" id="seller_birth_date" placeholder="Дата рождения" name="seller_birth_date" required>
                            </div>
                            <div class="input">
                                <label for="seller_registration_address">Адрес регистрации:</label>
                                <input class="input__cell" type="text" id="seller_registration_address" name="seller_registration_address" placeholder="Адрес регистрации" required>
                            </div>

                            <div class="input">
                                <label for="seller_passport_details">Серия и номер паспорта:</label>
                                <input class="input__cell" type="text" id="seller_passport_details" name="seller_passport_details" maxlength="11" placeholder="Серия и номер паспорта" required>
                            </div>
                            <div class="input">
                                <label for="seller_passport_issue_date">Дата выдачи:</label>
                                <input class="input__cell" type="text" maxlength="10" id="seller_passport_issue_date" placeholder="Дата выдачи" name="seller_passport_issue_date" required>
                            </div>
                            <div class="input">
                                <label for="seller_passport_issued_by">Кем выдан:</label>
                                <input class="input__cell" type="text" id="seller_passport_issued_by" name="seller_passport_issued_by" placeholder="Кем выдан" required>
                            </div>
                        </div>
                        <label for="agree_seller" class="custom-checkbox">
                            По доверенности
                            <input type="checkbox" id="agree_seller" name="agree_seller">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <!-- Договоренность продавцу -->
                    <div class="contract-sale__inputs">
                        <span class="contract-sale__form-subtitle">Представитель продавца по доверенности</span>
                        <div class="contract-sale__input contract-sale__input--third">
                            <div class="input">
                                <label for="seller_proxy_registry_number">Реестровый номер доверенности:</label>
                                <input class="input__cell" type="text" id="seller_proxy_registry_number" name="seller_proxy_registry_number" placeholder="Реестровый номер доверенности">
                            </div>
                            <div class="input">
                                <label for="seller_proxy_full_name">ФИО:</label>
                                <input class="input__cell" type="text" id="seller_proxy_full_name" name="seller_proxy_full_name" placeholder="ФИО">
                            </div>
                            <div class="input">
                                <label for="seller_proxy_birth_date">Дата рождения:</label>
                                <input class="input__cell" type="text" maxlength="10" id="seller_proxy_birth_date" placeholder="Дата рождения" name="seller_proxy_birth_date">
                            </div>
                            <div class="input">
                                <label for="seller_proxy_passport_details">Серия и номер паспорта:</label>
                                <input class="input__cell" type="text" id="seller_proxy_passport_details" name="seller_proxy_passport_details" maxlength="11" placeholder="Серия и номер паспорта">
                            </div>
                            <div class="input">
                                <label for="seller_proxy_passport_issue_date">Дата выдачи:</label>
                                <input class="input__cell" type="text" maxlength="10" id="seller_proxy_passport_issue_date" placeholder="Дата выдачи" name="seller_proxy_passport_issue_date">
                            </div>
                            <div class="input">
                                <label for="seller_proxy_passport_issued_by">Кем выдан:</label>
                                <input class="input__cell" type="text" id="seller_proxy_passport_issued_by" name="seller_proxy_passport_issued_by" placeholder="Кем выдан">
                            </div>
                            <div class="input">
                                <label for="seller_proxy_registration_address">Адрес регистрации:</label>
                                <input class="input__cell" type="text" id="seller_proxy_registration_address" name="seller_proxy_registration_address" placeholder="Адрес регистрации">
                            </div>
                        </div>
                    </div>
                    <!-- ПОКУПАТЕЛЬ -->
                    <div class="contract-sale__inputs">
                        <span class="contract-sale__form-subtitle">Покупатель</span>
                        <div class="contract-sale__input contract-sale__input--third">
                            <div class="input">
                                <label for="buyer_full_name">ФИО:</label>
                                <input class="input__cell" type="text" id="buyer_full_name" name="buyer_full_name" placeholder="ФИО" required>
                            </div>
                            <div class="input">
                                <label for="buyer_birth_date">Дата рождения:</label>
                                <input class="input__cell" type="text" maxlength="10" id="buyer_birth_date" placeholder="Дата рождения" name="buyer_birth_date" required>
                            </div>
                            <div class="input">
                                <label for="buyer_registration_address">Адрес регистрации:</label>
                                <input class="input__cell" type="text" id="buyer_registration_address" name="buyer_registration_address" placeholder="Адрес регистрации" required>
                            </div>

                            <div class="input">
                                <label for="buyer_passport_details">Серия и номер паспорта:</label>
                                <input class="input__cell" maxlength="11" type="text" id="buyer_passport_details" name="buyer_passport_details" placeholder="Серия и номер паспорта" required>
                            </div>
                            <div class="input">
                                <label for="buyer_passport_issue_date">Дата выдачи:</label>
                                <input class="input__cell" type="text" maxlength="10" id="buyer_passport_issue_date" placeholder="Дата выдачи" name="buyer_passport_issue_date" required>
                            </div>
                            <div class="input">
                                <label for="buyer_passport_issued_by">Кем выдан:</label>
                                <input class="input__cell" type="text" id="buyer_passport_issued_by" name="buyer_passport_issued_by" placeholder="Кем выдан" required>
                            </div>
                        </div>
                        <label for="agree_buyer" class="custom-checkbox">
                            По доверенности
                            <input type="checkbox" id="agree_buyer" name="agree_buyer">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <!-- Договоренность покупателю -->
                    <div class="contract-sale__inputs">
                        <span class="contract-sale__form-subtitle">Представитель покупателя по доверенности</span>
                        <div class="contract-sale__input contract-sale__input--third">
                            <div class="input">
                                <label for="buyer_proxy_registry_number">Реестровый номер доверенности:</label>
                                <input class="input__cell" type="text" id="buyer_proxy_registry_number" name="buyer_proxy_registry_number" placeholder="Реестровый номер доверенности">
                            </div>
                            <div class="input">
                                <label for="buyer_proxy_full_name">ФИО:</label>
                                <input class="input__cell" type="text" id="buyer_proxy_full_name" name="buyer_proxy_full_name" placeholder="ФИО">
                            </div>
                            <div class="input">
                                <label for="buyer_proxy_birth_date">Дата рождения:</label>
                                <input class="input__cell" type="text" maxlength="10" id="buyer_proxy_birth_date" placeholder="Дата рождения" name="buyer_proxy_birth_date">
                            </div>
                            <div class="input">
                                <label for="buyer_proxy_passport_details">Серия и номер паспорта:</label>
                                <input class="input__cell" type="text" id="buyer_proxy_passport_details" name="buyer_proxy_passport_details" maxlength="11" placeholder="Серия и номер паспорта">
                            </div>
                            <div class="input">
                                <label for="buyer_proxy_passport_issue_date">Дата выдачи:</label>
                                <input class="input__cell" type="text" maxlength="10" id="buyer_proxy_passport_issue_date" placeholder="Дата выдачи" name="buyer_proxy_passport_issue_date">
                            </div>
                            <div class="input">
                                <label for="buyer_proxy_passport_issued_by">Кем выдан:</label>
                                <input class="input__cell" type="text" id="buyer_proxy_passport_issued_by" name="buyer_proxy_passport_issued_by" placeholder="Кем выдан">
                            </div>
                            <div class="input">
                                <label for="buyer_proxy_registration_address">Адрес регистрации:</label>
                                <input class="input__cell" type="text" id="buyer_proxy_registration_address" name="buyer_proxy_registration_address" placeholder="Адрес регистрации">
                            </div>
                        </div>
                    </div>
                    <!-- Транспортное средство -->
                    <div class="contract-sale__inputs">
                        <span class="contract-sale__form-subtitle">Транспортное средство</span>
                        <div class="contract-sale__input contract-sale__input--third">
                            <div class="input">
                                <label for="vehicle_vin">VIN номер:</label>
                                <input class="input__cell" type="text" id="vehicle_vin" maxlength="17" name="vehicle_vin" placeholder="VIN номер" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_brand_model">Марка и модель ТС:</label>
                                <input class="input__cell" type="text" id="vehicle_brand_model" name="vehicle_brand_model" placeholder="Марка и модель ТС" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_type">Тип ТС:</label>
                                <input class="input__cell" type="text" id="vehicle_type" name="vehicle_type" placeholder="Тип ТС (Легковой, грузовой...)" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_category">Категория ТС:</label>
                                <input class="input__cell" type="text" id="vehicle_category" name="vehicle_category" placeholder="Категория ТС (A, B, C, D, прицеп)" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_year">Год выпуска:</label>
                                <input class="input__cell" type="text" id="vehicle_year" name="vehicle_year" placeholder="Год выпуска" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_engine_model">Модель / Номер двигателя:</label>
                                <input class="input__cell" type="text" id="vehicle_engine_model" name="vehicle_engine_model" placeholder="Модель / Номер двигателя" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_chassis_number">Номер шасси, рамы:</label>
                                <input class="input__cell" type="text" id="vehicle_chassis_number" name="vehicle_chassis_number" placeholder="Номер шасси, рамы" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_body_number">Номер кузова:</label>
                                <input class="input__cell" type="text" id="vehicle_body_number" name="vehicle_body_number" placeholder="Номер кузова" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_color">Цвет:</label>
                                <input class="input__cell" type="text" id="vehicle_color" name="vehicle_color" placeholder="Цвет" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_engine_power">Мощность двигателя, л.с.:</label>
                                <input class="input__cell" type="text" id="vehicle_engine_power" name="vehicle_engine_power" placeholder="Мощность двигателя, л.с." required>
                            </div>
                            <div class="input">
                                <label for="vehicle_engine_volume">Рабочий объем, куб.см:</label>
                                <input class="input__cell" type="text" id="vehicle_engine_volume" name="vehicle_engine_volume" placeholder="Рабочий объем, куб.см" required>
                            </div>
                            <div class="input">
                                <div class="input-checkbox">
                                    <label for="vehicle_pts_series_number">ПТС, серия/номер:</label>
                                    <div class="input-checkbox__check-label">
                                        <label for="epts" class="custom-checkbox">
                                            <input type="checkbox" id="epts" name="epts">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label>ЭПТС, серия/номер:</label>
                                    </div>
                                    </label>
                                </div>
                                <input class="input__cell" type="text" id="vehicle_pts_series_number" maxlength="15" name="vehicle_pts_series_number" placeholder="ПТС, серия/номер" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_pts_issued_by">ПТС, кем выдан:</label>
                                <input class="input__cell" type="text" id="vehicle_pts_issued_by" name="vehicle_pts_issued_by" placeholder="ПТС, кем выдан" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_pts_issue_date">ПТС, дата выдачи:</label>
                                <input class="input__cell" type="text" maxlength="10" id="vehicle_pts_issue_date" placeholder="ПТС, дата выдачи" name="vehicle_pts_issue_date" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_sts_series_number">СТС, серия/номер:</label>
                                <input class="input__cell" type="text" id="vehicle_sts_series_number" name="vehicle_sts_series_number" placeholder="СТС, серия/номер" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_sts_issued_by">СТС, кем выдан/код подразделения:</label>
                                <input class="input__cell" type="text" id="vehicle_sts_issued_by" name="vehicle_sts_issued_by" placeholder="СТС, кем выдан/код подразделения" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_sts_issue_date">СТС, дата выдачи:</label>
                                <input class="input__cell" type="text" maxlength="10" id="vehicle_sts_issue_date" name="vehicle_sts_issue_date" placeholder="СТС, дата выдачи" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_license_plate">Гос. номер:</label>
                                <input class="input__cell" type="text" id="vehicle_license_plate" name="vehicle_license_plate" placeholder="Гос. номер" required>
                            </div>
                            <div class="input">
                                <label for="vehicle_price">Стоимость ТС:</label>
                                <input class="input__cell" type="number" id="vehicle_price" name="vehicle_price" placeholder="Стоимость ТС">
                            </div>
                            <div class="input">
                                <label for="vehicle_mileage">Пробег, км:</label>
                                <input class="input__cell" type="text" id="vehicle_mileage" name="vehicle_mileage" placeholder="Пробег, км">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn--accent">Скачать договор <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.5 16.1709L3.98633 9.65723L5.81016 7.76826L9.19727 11.1554V0.538086H11.8027V11.1554L15.1898 7.76826L17.0137 9.65723L10.5 16.1709ZM2.68359 21.3818C1.96709 21.3818 1.35372 21.1267 0.843481 20.6165C0.333244 20.1062 0.078125 19.4929 0.078125 18.7764V14.8682H2.68359V18.7764H18.3164V14.8682H20.9219V18.7764C20.9219 19.4929 20.6668 20.1062 20.1565 20.6165C19.6463 21.1267 19.0329 21.3818 18.3164 21.3818H2.68359Z" fill="white"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </section>
    </div>
</section>
<?php get_footer(); ?>