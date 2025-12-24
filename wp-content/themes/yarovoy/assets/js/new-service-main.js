//
// Sliders
//

let videoReviewsSlider = new Swiper(".land-v-reviews__slider", {
	loop: true,
	slidesPerView: 'auto',
	spaceBetween: 20,
	arrows: true,

	navigation: {
		prevEl: document.querySelector(".land-v-reviews .land-slider-prev"),
		nextEl: document.querySelector(".land-v-reviews .land-slider-next"),
	},

	pagination: {
		el: ".land-v-reviews .land-slider-pagination",
		type: "bullets",
		clickable: false,
	},

	breakpoints: {
		768: {
			slidesPerView: 3,
			spaceBetween: 24
		},

		992: {
			slidesPerView: 4,
			spaceBetween: 24
		},

		1300: {
			slidesPerView: 5,
			spaceBetween: 24
		}
	}
});

let carsSlider = new Swiper(".land-cars__slider", {
	loop: true,
	slidesPerView: 'auto',
	spaceBetween: 20,
	arrows: false,

	pagination: {
		el: ".land-cars .land-slider-pagination",
		type: "bullets",
		clickable: false,
	},

	breakpoints: {
		768: {
			slidesPerView: 3,
			spaceBetween: 24
		},

		1300: {
			slidesPerView: 4,
			spaceBetween: 32
		}
	}
});

let stepsSlider = new Swiper(".land-steps__slider", {
	loop: false,
	slidesPerView: 'auto',
	spaceBetween: 20,
	arrows: false,
	pagination: {
		el: ".land-steps .land-slider-pagination",
		type: "bullets",
		clickable: true,
	},
	breakpoints: {
		768: {
			slidesPerView: 'auto',
			spaceBetween: 24
		},

		1300: {
			slidesPerView: 'auto',
			spaceBetween: 32
		}
	}
});

//
// Videos
//

document.addEventListener("DOMContentLoaded", function () {
	let currentVideo = null;

	document.body.addEventListener("click", function (e) {
		const item = e.target.closest(".land-video");

		if (!item) return;

		const video = item.querySelector(".land-video__player");
		const playPauseButton = item.querySelector(".land-video__btn");

		if (video && playPauseButton) {
			if (video !== currentVideo) {
				if (currentVideo) {
					currentVideo.pause();
					const currentPlayPauseButton =
						currentVideo.parentElement.querySelector(".land-video__btn");
					if (currentPlayPauseButton) {
						currentPlayPauseButton.classList.remove("is-pause");
					}
				}

				currentVideo = video;
			}

			if (video.paused) {
				video.play();
				playPauseButton.classList.add("is-pause");
			} else {
				video.pause();
				playPauseButton.classList.remove("is-pause");
			}
		}
	});
});

//
// Modals
//

let modalsNew = document.querySelectorAll(".modal");
let closeButtonsNew = document.querySelectorAll("[data-close-modal]");

function openModal(modalId) {
	let modal = document.getElementById(modalId);
	modal.style.display = "flex";
	modal.classList.add("modal--open");
	document.body.style.overflow = "hidden";

	setTimeout(function () {
		modal.querySelector(".modal__square").style.transform = "translateY(0)";
		modal.querySelector(".modal__square").style.opacity = "1";
	}, 10);
}

function closeModal(modalId) {
	let modal = document.getElementById(modalId);
	modal.querySelector(".modal__square").style.transform = "translateY(40px)";
	modal.querySelector(".modal__square").style.opacity = "0";
	modal.classList.remove("modal--open");
	document.body.style.overflow = "";

	setTimeout(function () {
		modal.style.display = "none";
	}, 300);
}

document.addEventListener("click", function (event) {
	if (event.target.matches("[data-modal]")) {
		let modalId = event.target.getAttribute("data-modal");
		openModal(modalId);
	}

	if (event.target.parentElement.matches("[data-modal]")) {
		let modalId = event.target.parentElement.getAttribute("data-modal");
		openModal(modalId);
	}

	if (event.target.matches("[data-close-modal]")) {
		let modalId = document.querySelector(".modal--open").getAttribute("id");
		closeModal(modalId);
	}

	if (event.target.classList.contains("modal")) {
		let modalId = event.target.getAttribute("id");
		closeModal(modalId);
	}
});

modalsNew.forEach(function (modal) {
	modal.addEventListener(
		"wheel",
		(event) => {
			event.stopPropagation();
		},
		{ passive: false }
	);
});

//
// Accordion
//

document.addEventListener("DOMContentLoaded", function () {
	let items = document.querySelectorAll('.js-acc');

	function toggleAccordion() {
		let itemToggle = this.getAttribute('aria-expanded');
		let itemContent = this.nextElementSibling;

		if (itemToggle == 'false') {
			this.setAttribute('aria-expanded', 'true');
			this.parentElement.classList.add('is-show');
			this.nextElementSibling.style.maxHeight = itemContent.scrollHeight + 'px';

		} else {
			this.setAttribute('aria-expanded', 'false');
			this.parentElement.classList.remove('is-show');
			this.nextElementSibling.style.maxHeight = null;
		}
	}

	items.forEach(item => item.addEventListener('click', toggleAccordion));
});

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
// Scroll Top
//


function checkScrollPosition() {
	const scrollToTopButton = document.querySelector('.scroll-top');

	if (!scrollToTopButton) return;

	const scrollPosition = window.scrollY;
	const pageHeight = document.documentElement.scrollHeight;
	const windowHeight = window.innerHeight;

	if (pageHeight > windowHeight) {
		if (scrollPosition / (pageHeight - windowHeight) > 0.8) {
			scrollToTopButton.classList.add('is-show');
		} else {
			scrollToTopButton.classList.remove('is-show');
		}
	} else {
		scrollToTopButton.classList.remove('is-show');
	}
}

window.addEventListener('scroll', checkScrollPosition);
window.addEventListener('load', checkScrollPosition);

const scrollToTopButton = document.querySelector('.scroll-top');
if (scrollToTopButton) {
	scrollToTopButton.addEventListener('click', function () {
		window.scrollTo({
			top: 0,
			behavior: 'smooth'
		});
	});
}

Fancybox.bind("[data-fancybox]", {

});

//Обработка форм
document.addEventListener("DOMContentLoaded", function () {
	const modalSingleServicePage = document.querySelectorAll(".modal__form");
	if (modalSingleServicePage) {
		modalSingleServicePage.forEach(function (form) {
			form.addEventListener("submit", function (e) {
				e.preventDefault();

				let formData = new FormData(form);
				formData.append("action", "yar_modal_form");

				fetch("/wp-admin/admin-ajax.php", {
					method: "POST",
					body: formData,
				})
					.then(response => response.json())
					.then(result => {
						if (result.success) {
							alert("Заявка успешно отправлена!");
							form.reset();
						} else {
							alert("Ошибка: " + (result.data.errors ? result.data.errors.join("\n") : "Попробуйте позже"));
						}
					})
					.catch(() => {
						alert("Ошибка отправки формы. Попробуйте позже.");
					});
			});
		});
	}
});