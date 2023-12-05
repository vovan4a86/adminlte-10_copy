import Swiper, { Pagination, EffectFade, Autoplay, Navigation } from 'swiper';
import { LazyInstance } from './lazyLoading';

export const pageSlider = ({ slider, navigationPrev, navigationNext, speed, delay, gap }) => {
  new Swiper(slider, {
    modules: [Navigation],
    slidesPerView: 1.2,
    centeredSlides: false,
    spaceBetween: 10,
    autoplay: {
      delay: delay || 3000,
      disableOnInteraction: false
    },
    navigation: {
      nextEl: navigationNext,
      prevEl: navigationPrev
    },
    speed: speed || 600,
    observer: true,
    observeParents: true,
    on: {
      init: function () {
        LazyInstance.update();
      }
    },
    breakpoints: {
      600: {
        slidesPerView: 2.2,
        spaceBetween: 20
      },
      810: {
        slidesPerView: 2.2,
        spaceBetween: 20
      },
      1080: {
        slidesPerView: 'auto',
        spaceBetween: 20
      },
      1440: {
        slidesPerView: 'auto',
        spaceBetween: 30
      }
    }
  });
};

pageSlider({
  slider: '[data-hero-slider]',
  navigationNext: '[data-hero-slider-next]',
  navigationPrev: '[data-hero-slider-prev]'
});

pageSlider({
  slider: '[data-page-slider]',
  navigationNext: '[data-page-slider-next]',
  navigationPrev: '[data-page-slider-prev]'
});

export const sectionSlider = ({ slider, navigationPrev, navigationNext, speed, delay, gap }) => {
  new Swiper(slider, {
    modules: [Navigation],
    slidesPerView: 1.3,
    centeredSlides: false,
    spaceBetween: 10,
    autoplay: {
      delay: delay || 3000,
      disableOnInteraction: false
    },
    navigation: {
      nextEl: navigationNext,
      prevEl: navigationPrev
    },
    speed: speed || 600,
    breakpoints: {
      768: {
        slidesPerView: 2.3,
        spaceBetween: 20,
        centeredSlides: false
      },
      810: {
        slidesPerView: 3.2,
        spaceBetween: 20,
        centeredSlides: false
      },
      1080: {
        slidesPerView: 3.2,
        spaceBetween: 20,
        centeredSlides: false
      },
      1440: {
        slidesPerView: 4,
        spaceBetween: 30,
        centeredSlides: false
      }
    },
    observer: true,
    observeParents: true,
    on: {
      init: function () {
        LazyInstance.update();
      }
    }
  });
};

sectionSlider({
  slider: '[data-gas-slider]',
  navigationNext: '[data-gas-slider-next]',
  navigationPrev: '[data-gas-slider-prev]'
});

sectionSlider({
  slider: '[data-water-slider]',
  navigationNext: '[data-water-slider-next]',
  navigationPrev: '[data-water-slider-prev]'
});

sectionSlider({
  slider: '[data-specials-slider]',
  navigationNext: '[data-specials-slider-next]',
  navigationPrev: '[data-specials-slider-prev]'
});
