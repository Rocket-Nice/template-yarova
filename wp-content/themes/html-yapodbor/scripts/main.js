//
// Mobile menu
//

const header = document.querySelector('.header'),
	headerBurger = document.querySelector('.header__burger'),
	headerOverlay = document.querySelector('.header__overlay');

function toggleMobileMenu(e) {
	header.classList.toggle('header--mobile-menu');
	headerOverlay.classList.toggle('is-show');
	document.body.classList.toggle('overflow-hidden');
	headerBurger.classList.toggle('btn--cross');
}

headerBurger.addEventListener('click', toggleMobileMenu);
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

	if (itemToggle == 'false') {
		this.setAttribute('aria-expanded', 'true');

	} else {
		this.setAttribute('aria-expanded', 'false');
	}
}

items.forEach(item => item.addEventListener('click', toggleAccordion));

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
// Sliders
//

let casesSlider = new Swiper(".cases__slider", {
	autoHeight: true,
	spaceBetween: 32,

	navigation: {
		nextEl: ".cases .slider-btn-next",
		prevEl: ".cases .slider-btn-prev",
	},

	pagination: {
		el: ".cases .slider-pagination",
		clickable: true
	},
});

let hotofferSlider = new Swiper(".hotoffer__slider", {
	spaceBetween: 16,
	slidesPerView: 1.2,

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