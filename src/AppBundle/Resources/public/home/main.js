import animations from '../utils/animations';

export default () => {

  if (!isHome()) {
    return;
  }

  if (!haveSeenIntro()) {
    displayIntro();
  } else {
    displayContent();
  }
}

function haveSeenIntro() {
  return false;
}

function displayIntro() {
  const container = document.querySelector('.home .animation-container');
  container.style.display = 'block';
  animations.fadeIn(container, {
    complete: () => {
      animations.fadeOut(container, {
        complete: fadeOutComplete,
        duration: 1500,
      });
    },
    duration: 1500,
  });
}

function fadeOutComplete() {
  displayContent();
  hideIntro();
}

function hideIntro() {
  const container = document.querySelector('.home .animation-container');
  container.style.display = 'none';
}

function displayContent() {
  animations.fadeIn(document.querySelector('.home .container'),
      {duration: 1500, complete: () => {}});
}

function isHome() {
  return document.querySelector('body').classList.contains('home');
}