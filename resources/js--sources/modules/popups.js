import { Fancybox } from '@fancyapps/ui';
import { initMap } from './maps';

export const closeBtn =
  '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none"><path fill="currentColor" d="m17.244 16 14.49-14.489A.807.807 0 0 0 32 .89C32 .356 31.644 0 31.111 0a.807.807 0 0 0-.622.267L16 14.756 1.511.266A.807.807 0 0 0 .89 0C.356 0 0 .356 0 .889c0 .267.089.444.267.622L14.756 16 .265 30.489A.807.807 0 0 0 0 31.11c0 .533.356.889.889.889a.807.807 0 0 0 .622-.267L16 17.244l14.489 14.49a.807.807 0 0 0 .622.266c.533 0 .889-.356.889-.889a.807.807 0 0 0-.267-.622L17.244 16Z"/></svg>';

const closeBtnSearch = `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none"><path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M25 7 7 25M25 25 7 7"/></svg>`;

Fancybox.bind('[data-fancy-map]', {
  mainClass: 'popup--custom popup--mapping',
  closeButton: 'outside',
  on: {
    reveal: (e, trigger) => {
      const popup = document.querySelector(trigger.src);

      if (popup && trigger.src.includes('map')) {
        const popupMap = popup.querySelector('ymaps');

        if (!popupMap) {
          const latitude = popup.dataset.lat;
          const longitude = popup.dataset.long;
          const label = popup.dataset.hint;
          const id = popup.id;

          initMap(id, latitude, longitude, 10, label);
        }
      }
    }
  }
});

Fancybox.bind('[data-popup]', {
  mainClass: 'popup--custom',
  template: { closeButton: closeBtn },
  hideClass: 'fancybox-zoomOut',
  hideScrollbar: false
});

Fancybox.bind('[data-search-popup]', {
  template: { closeButton: closeBtnSearch },
  mainClass: 'popup--search',
  hideClass: 'fancybox-zoomOut',
  closeButton: 'outside'
});

Fancybox.bind('[data-cities]', {
  mainClass: 'popup--custom popup--ajax',
  template: { closeButton: closeBtn }
});

export const showCompleteDialog = () => {
  Fancybox.show([{ src: '#complete', type: 'inline' }], {
    mainClass: 'popup--custom popup--complete',
    template: { closeButton: closeBtn },
    hideClass: 'fancybox-zoomOut'
  });
};

// в свой модуль форм, импортируешь функцию вызова «спасибо» → вызываешь on success
// import { showCompleteDialog } from 'путь до компонента'
// вызываешь когда нужно
// showCompleteDialog();
