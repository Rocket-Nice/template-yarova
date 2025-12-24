//
// Mobile menu
//
let isClicksEnabled = false;
const header = document.querySelector('.header'),
	headerBurger = document.querySelector('.header__burger'),
	headerBurgerMob = document.querySelector('.burger-mob'),
	headerOverlay = document.querySelector('.header__overlay');
let burgerLogo = document.querySelector('.header__logo-burger'),
	mobileNumberHeader = document.querySelector('.header__commun--mob .commun__item--phone');
function toggleMobileMenu(e) {
	header.classList.toggle('header--mobile-menu');
	headerOverlay.classList.toggle('is-show');
	document.body.classList.toggle('overflow-hidden');
	headerBurger.classList.toggle('btn--cross');
	headerBurgerMob.classList.toggle('btn--cross');

	if (window.innerWidth < 576) {
		if (isClicksEnabled) {
			burgerLogo.style.pointerEvents = 'auto';
			mobileNumberHeader.style.pointerEvents = 'auto';
			burgerLogo.style.opacity = '1';
			mobileNumberHeader.style.opacity = '1';
		} else {
			burgerLogo.style.pointerEvents = 'none';
			burgerLogo.style.opacity = '0';
			mobileNumberHeader.style.pointerEvents = 'none';
			mobileNumberHeader.style.opacity = '0';
		}

		isClicksEnabled = !isClicksEnabled;
	}
}

headerBurger.addEventListener('click', toggleMobileMenu);
headerBurgerMob.addEventListener('click', toggleMobileMenu);
headerOverlay.addEventListener('click', toggleMobileMenu);

//
// Footer menu
//

document.addEventListener('DOMContentLoaded', function () {
	const buttons = document.querySelectorAll('.footer__nav-toggle');

	buttons.forEach(function (button) {
		button.addEventListener('click', function () {
			const parentItem = this.closest('.footer__nav-item');

			if (parentItem.classList.contains('is-active')) {
				parentItem.classList.remove('is-active');
			} else {
				closeAllChildLists();
				parentItem.classList.add('is-active');
			}
		});
	});

	function closeAllChildLists() {
		const allChildLists = document.querySelectorAll('.footer__nav-item.is-active');

		allChildLists.forEach(function (list) {
			list.classList.remove('is-active');
		});
	}
});

//
// Accordion
//

let items = document.querySelectorAll('.js-accordion');

function toggleAccordion() {
	let itemToggle = this.getAttribute('aria-expanded');

	items.forEach((item) => item.setAttribute('aria-expanded', 'false'));

	if (itemToggle == 'false') {
		this.setAttribute('aria-expanded', 'true');

	} else {
		this.setAttribute('aria-expanded', 'false');
	}
}

items.forEach((item) => item.addEventListener('click', toggleAccordion));

//
// Modals
//

let modals = document.querySelectorAll(".modal");
let modalButtons = document.querySelectorAll("[data-modal]");
let closeButtons = document.querySelectorAll("[data-close-modal]");

function openModal(modalId) {
	let modal = document.getElementById(modalId);

	modal.style.display = "flex";
	modal.classList.add('modal--open');
	document.body.style.overflow = 'hidden';

	setTimeout(function () {
		modal.querySelector(".modal__square").style.transform = "translateY(0)";
		modal.querySelector(".modal__square").style.opacity = "1";
	}, 10);
}

function closeModal(modalId) {
	let modal = document.getElementById(modalId);
	modal.querySelector(".modal__square").style.transform = "translateY(-20px)";
	modal.querySelector(".modal__square").style.opacity = "0";
	modal.classList.remove('modal--open');
	document.body.style.overflow = '';

	setTimeout(function () {
		modal.style.display = "none";
	}, 300);
}

modalButtons.forEach(function (button) {
	button.addEventListener("click", function () {
		let modalId = button.getAttribute("data-modal");
		openModal(modalId);
	});
});

closeButtons.forEach(function (button) {
	button.addEventListener("click", function () {
		let modalId = document.querySelector('.modal--open').getAttribute('id');
		closeModal(modalId);
	});
});

window.addEventListener("click", function (event) {
	if (event.target.classList.contains("modal")) {
		let modalId = event.target.getAttribute("id");
		closeModal(modalId);
	}
})

document.addEventListener('DOMContentLoaded', function () {
	const galleries = document.querySelectorAll('.cases__card-gallery');

	galleries.forEach(gallery => {
		const mainImg = gallery.querySelector('.cases__card-gallery-main-img');
		const subImgs = gallery.querySelectorAll('.cases__card-gallery-sub-img');

		subImgs.forEach(img => {
			img.addEventListener('click', () => {
				mainImg.src = img.src;
			});
		});
	});
});

//
// Tabs
//

const initTabs = () => {
	const tabs = document.querySelectorAll('.tabs');

	if (!tabs) return;

	tabs.forEach(function (tab) {
		const head = tab.querySelector('.tabs__nav');
		const body = tab.querySelector('.tabs__body');

		tab.querySelectorAll('.tabs__nav-item')[0].classList.add('tabs__nav-item--active');
		// tab.querySelectorAll('.tabs__section')[0].classList.add('tabs__nav-section--active');

		const getActiveTabName = () => {
			return head.querySelector('.tabs__nav-item--active').dataset.tab;
		}

		const setActiveContent = () => {
			if (body.querySelector('.tabs__section--active')) {
				body.querySelector('.tabs__section--active').classList.remove('tabs__section--active');
			}

			body.querySelector(`[data-tab=${getActiveTabName()}]`).classList.add('tabs__section--active');
		}

		if (!head.querySelector('.tabs__nav-item--active')) {
			head.querySelector('.tabs__nav-item').classList.add('tabs__nav-item--active');
		}

		setActiveContent(getActiveTabName());

		head.addEventListener('click', e => {
			const caption = e.target.closest('.tabs__nav-item');

			if (!caption) return;
			if (caption.classList.contains('.frogtool__tabs-nav-item--active')) return;

			if (head.querySelector('.tabs__nav-item--active')) {
				head.querySelector('.tabs__nav-item--active').classList.remove('tabs__nav-item--active');
			}

			caption.classList.add('tabs__nav-item--active');

			setActiveContent(getActiveTabName());
		})
	})
}

initTabs();

//
// Animation
//

document.addEventListener("DOMContentLoaded", function () {
	function onEntry(entries, observer) {
		entries.forEach(entry => {
			if (entry.isIntersecting) {
				entry.target.classList.add('anim-elem--show');

				observer.unobserve(entry.target);
			}
		});
	}

	let options = {
		root: null,
		rootMargin: '0px',
		threshold: 0
	};
	let observer = new IntersectionObserver(onEntry, options);
	let elements = document.querySelectorAll('.anim-elem');

	elements.forEach(element => {
		observer.observe(element);
	});
});


//
// Sliders
//

let casesSlider = new Swiper(".cases__slider", {
	autoHeight: true,
	spaceBetween: 10,
	slidesPerView: 1,

	navigation: {
		nextEl: ".cases .slider-btn-next",
		prevEl: ".cases .slider-btn-prev",
	},

	pagination: {
		el: ".cases .slider-pagination",
		clickable: true
	},

	breakpoints: {
		768: {
			slidesPerView: 1,
			spaceBetween: 32,
			autoHeight: true,
		}
	}
});

let hotofferSlider = new Swiper(".hotoffer__slider", {
	spaceBetween: 10,
	slidesPerView: 1,

	navigation: {
		nextEl: ".hotoffer .slider-btn-next",
		prevEl: ".hotoffer .slider-btn-prev",
	},

	pagination: {
		el: ".hotoffer .slider-pagination",
		clickable: true
	},

	breakpoints: {
		1279: {
			slidesPerView: 3,
			spaceBetween: 32,
		},
		768: {
			slidesPerView: 2,
			spaceBetween: 24
		}
	}
});

// Mask for phone
const phones = document.querySelectorAll('input[name="phone"]');
phones.forEach((phone) => {
	let im = new Inputmask("+7 (999) 999-99-99{1,3}");
	im.mask(phone);
});

const reviewsSliders = document.querySelectorAll('.reviews__slider');
if (reviewsSliders) {
	reviewsSliders.forEach((slider) => {
		const swiper = slider.querySelector('.swiper');
		if (!swiper) {
			return;
		}

		const pagination = slider.querySelector('.reviews__slider-pagination');
		const prev = slider.querySelector('.reviews__slider-prev');
		const next = slider.querySelector('.reviews__slider-next');

		new Swiper(swiper, {
			pagination: {
				el: pagination,
				clickable: true
			},
			navigation: {
				nextEl: next,
				prevEl: prev,
			},
			breakpoints: {
				0: {
					slidesPerView: 1.3,
					spaceBetween: 10,
				},
				768: {
					slidesPerView: 2,
					spaceBetween: 30,
				},
				1281: {
					slidesPerView: 4,
					spaceBetween: 30,
				},
			}
		});
	});
}

const reviewsPlayers = document.querySelectorAll('.reviews__item');
if (reviewsPlayers) {
	reviewsPlayers.forEach((item) => {
		const button = item.querySelector('button');
		const video = item.querySelector('video');

		if (!video) {
			return;
		}

		button.addEventListener('click', () => {
			if (item.classList.contains('_played')) {
				video.pause();
				item.classList.remove('_played');

				return;
			}

			reviewsPlayers.forEach((other) => {
				other.classList.remove('_played');
				other.querySelector('video').pause();
			});

			video.play();
			item.classList.add('_played', '_hide');
		});

		video.addEventListener('ended', () => {
			item.classList.remove('_played');
		});
	});
}

const textBlocks = document.querySelectorAll(".land-section .cases__card-text");

if (textBlocks) {
	const maxLength = 300;

	textBlocks.forEach((textContainer) => {
		const paragraphs = Array.from(textContainer.querySelectorAll("p"));
		let fullText = paragraphs.map((p) => p.innerText).join(" ");

		if (fullText.length > maxLength) {
			const truncatedText = fullText.substring(0, maxLength) + "...";

			const fullTextDiv = document.createElement("div");
			fullTextDiv.classList.add("cases__card-full");
			fullTextDiv.style.display = "none";
			paragraphs.forEach((p) => fullTextDiv.appendChild(p.cloneNode(true)));

			textContainer.innerHTML = `<p>${truncatedText}</p>`;
			textContainer.appendChild(fullTextDiv);

			const btn = document.createElement("div");
			btn.textContent = "Показать еще";
			btn.classList.add("cases__card-text-more");
			textContainer.appendChild(btn);

			btn.addEventListener("click", function () {
				textContainer.innerHTML = "";
				textContainer.appendChild(fullTextDiv);
				fullTextDiv.style.display = "block";
				btn.remove();
				casesSlider.update();
			});
		}
	});
}

function removeElement() {
	const element = document.querySelector('.sw-review-bottom a');
	if (element) {
		element.remove();
	} else {
		setTimeout(removeElement, 500);
	}
}
removeElement();

//Обработка форм
document.addEventListener("DOMContentLoaded", function () {
	const submitButtons = document.querySelectorAll("#submit-form--js");

	if (submitButtons) {
		submitButtons.forEach((submitButton) => {
			submitButton.addEventListener("click", function (e) {
				e.preventDefault();
				const form = submitButton.closest(".modal__form");

				if (!form) {
					console.error("Форма не найдена!");
					return;
				}

				const formData = new FormData();

				const name = form.querySelector('input[name="name"]').value;
				const phone = form.querySelector('input[name="phone"]').value;
				const budget = form.querySelector('input[name="budget"]') ? form.querySelector('input[name="budget"]').value : '';

				formData.append("action", "yar_modal_form");
				formData.append("_wpnonce", form.querySelector('input[name="_wpnonce"]').value);
				formData.append("name", name);
				formData.append("phone", phone);
				if (budget) {
					formData.append("budget", budget);
				}

				fetch("/wp-admin/admin-ajax.php", {
					method: "POST",
					body: formData,
				})
					.then(response => response.json())
					.then(result => {
						if (result.success) {
							alert("Заявка успешно отправлена!");
							form.reset();
						}
					})
					.catch(() => {
						console.log("Ошибка отправки формы. Попробуйте позже.");
					});
			});
		});
	}
});

// Скролл ивент на "как устроена услуга", на главной

const itemsService = document.querySelectorAll('.how-work__item');

if (itemsService && window.innerWidth > 1280) {
	function isElementVisible(el) {
		const rect = el.getBoundingClientRect();
		const windowHeight = window.innerHeight || document.documentElement.clientHeight;
		return rect.top <= windowHeight * 0.75 && rect.bottom >= 0;
	}

	function animateOnScroll() {
		itemsService.forEach((item, index) => {
			if (isElementVisible(item) && !item.classList.contains('animated')) {
				item.style.animationDelay = `${index * 1}s`;
				item.style.opacity = 1;
				item.style.animation = 'slideInFromLeft 1s ease-out forwards';
				item.classList.add('animated');
			}
		});
	}

	animateOnScroll();
	window.addEventListener('scroll', animateOnScroll);
}

//Аккордеон на услугах

const serviceAcc = document.querySelectorAll('.services__card-head');

if (serviceAcc && window.innerWidth < 576) {
	serviceAcc.forEach(cardHead => {
		cardHead.addEventListener('click', () => {
			const cardText = cardHead.nextElementSibling;
			const parent = cardText.closest(".services__card");
			const svgArrow = parent.querySelector("svg");

			if (cardText.classList.contains('open')) {
				cardText.style.maxHeight = `${cardText.scrollHeight}px`;
				setTimeout(() => {
					cardText.style.maxHeight = '0';
				}, 10);
				cardText.classList.remove('open');
				svgArrow.style.transform = "rotate(0deg)";
			} else {
				cardText.style.maxHeight = `${cardText.scrollHeight}px`;
				cardText.classList.add('open');
				svgArrow.style.transform = "rotate(180deg)";
			}
		});
	});
}

// Появление элементов блока со сложностями после клика на "Подробнее"
const seeMoreBtn = document.querySelector('.difficulties-see-more');

if (seeMoreBtn) {
	seeMoreBtn.addEventListener('click', () => {
		const difficultiesItems = document.querySelector('.difficulties__items');
		seeMoreBtn.classList.add('hide');
		difficultiesItems.style.maxHeight = `${difficultiesItems.scrollHeight}px`;
		difficultiesItems.classList.add('open');
	});
}

// Обработчик активности договоренности на ДКП
const buyerCheckbox = document.getElementById('agree_buyer');
if (buyerCheckbox) {
	const sellerCheckbox = document.getElementById('agree_seller');
	const buyerProxyBlock = document.querySelector('.contract-sale__inputs:nth-child(5)');
	const sellerProxyBlock = document.querySelector('.contract-sale__inputs:nth-child(3)');
	let ptsInput = document.querySelector('#vehicle_pts_series_number');

	function toggleProxyBlock(checkbox, block) {
		checkbox.addEventListener('change', function () {
			block.style.display = checkbox.checked ? 'flex' : 'none';
		});
	}

	toggleProxyBlock(buyerCheckbox, buyerProxyBlock);
	toggleProxyBlock(sellerCheckbox, sellerProxyBlock);

	buyerProxyBlock.style.display = buyerCheckbox.checked ? 'flex' : 'none';
	sellerProxyBlock.style.display = sellerCheckbox.checked ? 'flex' : 'none';

	// ПТС и ЭПТС тут
	function handlePTSInput(event) {
		if (event.type === 'keydown') {
			if (!/[0-9a-zA-Zа-яА-Я]|Backspace|Delete|ArrowLeft|ArrowRight|Tab/.test(event.key) &&
				!(event.ctrlKey && (event.key === 'c' || event.key === 'v' || event.key === 'a')) &&
				!(event.ctrlKey && (event.key === 'с' || event.key === 'м' || event.key === 'ф'))) {
				event.preventDefault();
			}
		} else {
			formatPtsInput(this);
		}
	}

	function handleEPTSInput(event) {
		if (event.type === 'keydown') {
			if (!/[0-9]|Backspace|Delete|ArrowLeft|ArrowRight|Tab/.test(event.key) &&
				!(event.ctrlKey && (event.key === 'c' || event.key === 'v' || event.key === 'a')) &&
				!(event.ctrlKey && (event.key === 'с' || event.key === 'м' || event.key === 'ф'))) {
				event.preventDefault();
			}
		} else {
			this.value = this.value.replace(/\D/g, '').slice(0, 15);
		}
	}

	function addPTSHandlers() {
		ptsInput.removeEventListener('input', handleEPTSInput);
		ptsInput.removeEventListener('keydown', handleEPTSInput);

		ptsInput.addEventListener('input', handlePTSInput);
		ptsInput.addEventListener('keydown', handlePTSInput);
	}

	function addEPTSHandlers() {
		ptsInput.removeEventListener('input', handlePTSInput);
		ptsInput.removeEventListener('keydown', handlePTSInput);

		ptsInput.addEventListener('input', handleEPTSInput);
		ptsInput.addEventListener('keydown', handleEPTSInput);
	}

	document.querySelector('#epts').checked ? addEPTSHandlers() : addPTSHandlers();

	document.querySelector('#epts').addEventListener('change', (event) => {
		ptsInput.value = '';

		if (event.target.checked) {
			ptsInput.setAttribute("placeholder", "ЭПТС, серия/номер");
			ptsInput.removeAttribute("maxlength");
			addEPTSHandlers();
		} else {
			ptsInput.setAttribute("placeholder", "ПТС, серия/номер");
			ptsInput.setAttribute("maxlength", "15");
			addPTSHandlers();
		}
	});
}

// Ограничение для серии и номера паспорта инпутов | Ограничение на даты
function formatPassportInput(input) {
	let value = input.value.replace(/\D/g, '');

	value = value.slice(0, 10);

	if (value.length > 4) {
		value = value.slice(0, 4) + ' ' + value.slice(4, 10);
	}

	input.value = value;
}

function formatPtsInput(input) {
	let value = input.value.replace(/[^a-zA-Zа-яА-Я0-9]/g, '');

	value = value.slice(0, 10);

	if (value.length <= 2) {
		input.value = value;
	}
	else if (value.length <= 4) {
		input.value = value.slice(0, 2) + ' ' + value.slice(2, 4);
	}
	else {
		value = value.slice(0, 2) + ' ' + value.slice(2, 4) + ' ' + value.slice(4, 10);
	}

	input.value = value.toUpperCase();
}

function formatStsInput(input) {
	let value = input.value.replace(/[^a-zA-Zа-яА-Я0-9]/g, '');

	value = value.slice(0, 10);

	if (value.length <= 2) {
		input.value = value;
	}
	else if (value.length <= 4) {
		input.value = value.slice(0, 2) + ' ' + value.slice(2, 4);
	}
	else {
		value = value.slice(0, 2) + ' ' + value.slice(2, 4) + ' ' + value.slice(4, 10);
	}

	input.value = value;
}
let stsInput = document.querySelector('#vehicle_sts_series_number');
if (stsInput) {
	stsInput.addEventListener('input', function () {
		formatStsInput(this);
	});
}

function formatDateInput(input) {
	let value = input.value.replace(/\D/g, '');

	if (value.length <= 2) {
		input.value = value;
	}
	else if (value.length <= 4) {
		input.value = value.slice(0, 2) + '.' + value.slice(2, 4);
	}
	else {
		input.value = value.slice(0, 2) + '.' + value.slice(2, 4) + '.' + value.slice(4, 8);
	}
}

const passportInputs = document.querySelectorAll('input[id$="passport_details"]');
const dateDKP = document.querySelectorAll('input[id$="_date"]');

passportInputs.forEach(input => {
	input.addEventListener('input', function () {
		formatPassportInput(this);
	});

	input.addEventListener('keydown', function (event) {
		if (!/[0-9]|Backspace|Delete|ArrowLeft|ArrowRight|Tab/.test(event.key) &&
			!(event.ctrlKey && (event.key === 'c' || event.key === 'v' || event.key === 'a')) &&
			!(event.ctrlKey && (event.key === 'с' || event.key === 'м' || event.key === 'ф'))) {
			event.preventDefault();
		}
	});
});

dateDKP.forEach(input => {
	input.addEventListener('input', function () {
		formatDateInput(this);
	});

	input.addEventListener('keydown', function (event) {
		if (!/[0-9]|Backspace|Delete|ArrowLeft|ArrowRight|Tab/.test(event.key) &&
			!(event.ctrlKey && (event.key === 'c' || event.key === 'v' || event.key === 'a')) &&
			!(event.ctrlKey && (event.key === 'с' || event.key === 'м' || event.key === 'ф'))) {
			event.preventDefault();
		}
	});
});

// Маска для модели и двигателя, чтобы пробел требовался и не больше двух слов
const engineModelInput = document.getElementById('vehicle_engine_model');
if (engineModelInput) {
	const form = document.querySelector('.contract-sale__form');

	form.addEventListener('submit', function (event) {
		const value = engineModelInput.value.trim();
		const words = value.split(/\s+/);

		if (words.length !== 2) {
			engineModelInput.setCustomValidity('Введите ровно два слова (модель и номер двигателя) через пробел');
			engineModelInput.reportValidity();
			event.preventDefault();
			engineModelInput.focus();
		} else {
			engineModelInput.setCustomValidity('');
		}
	});

	engineModelInput.addEventListener('input', function () {
		const value = this.value.trim();
		const words = value.split(/\s+/);

		if (words.length > 2) {
			this.value = words.slice(0, 2).join(' ');
		}

		this.setCustomValidity('');
	});
}