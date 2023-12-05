import HcOffCanvasNav from 'hc-offcanvas-nav';

export const offCanvasNav = () => {
  new HcOffCanvasNav('#mob-nav', {
    customToggle: '.header-mob__burger',
    navTitle: 'ГидроКомплектСнаб',
    levelTitles: true,
    levelTitleAsBack: true,
    labelBack: 'Назад'
  });
};

offCanvasNav();
