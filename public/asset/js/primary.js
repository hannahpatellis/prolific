/* obj - DOM
   Contains all DOM elements used in this JS file
   Retrieved by document.querySelector() to match CSS declaration
*/
const DOM = {
  nav: {
    mobiMenuButton: document.querySelector('div#navigation-expand-icon'),
    navUnit: document.querySelector('ul#navigation-menu'),
  },
  mediaQueries: {
    mobi: window.matchMedia('(max-width: 821px)')
  }
}

/* obj - pageActions
   Contains all actions that can be taken on this page
   Should reference the DOM object, defined above, as a local variable called ref
*/
const pageActions = {
  showMobiNav(event) {
    event.preventDefault();
    let ref = DOM.nav.navUnit;
    if(ref.style.display == 'none' || ref.style.display == '') {
      ref.style.display = 'flex';
    } else {
      ref.style.display = 'none';
    } 
  },
  changeToMobi() {
    let ref = DOM.nav.navUnit;
    let query = DOM.mediaQueries.mobi;
    if (!query.matches) {
      ref.style.display = 'flex';
    } else {
      ref.style.display = 'none'
    }
  }
}

/* Event listeners */
DOM.nav.mobiMenuButton.addEventListener('touchstart', pageActions.showMobiNav);
DOM.nav.mobiMenuButton.addEventListener('click', pageActions.showMobiNav);
DOM.mediaQueries.mobi.addEventListener('change', pageActions.changeToMobi);