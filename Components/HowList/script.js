import Lottie from 'lottie-web'

window.howListAnimationList = {
  desktop: [
    '/Components/HowList/Assets/how-it-works/calculate.json',
    '/Components/HowList/Assets/how-it-works/one-click-carbon.json',
    '/Components/HowList/Assets/how-it-works/end-to-end.json',
    '/Components/HowList/Assets/how-it-works/track-efforts.json',
    '/Components/HowList/Assets/how-it-works/keep-shoppers.json'
  ],
  mobile: [
    '/Components/HowList/Assets/how-it-works/calculate.json',
    '/Components/HowList/Assets/how-it-works/one-click-carbon.json',
    '/Components/HowList/Assets/how-it-works/end-to-end.json',
    '/Components/HowList/Assets/how-it-works/track-efforts.json',
    '/Components/HowList/Assets/how-it-works/keep-shoppers.json'
  ]
}

function checkEcocartHowListInfoStart () {
  const sectionElems = document.querySelectorAll('.ecocart-how-list__info')
  const offsetY = window.innerHeight - 250
  let isAnyExist = false

  for (let i = sectionElems.length - 1; i >= 0; i--) {
    const bounding = sectionElems[i].getBoundingClientRect()

    // other elemhas padding bottom. but the last elem doesn't have padding
    // we need to calculate this padding on js
    // 325 : desktop padding
    // 60 : mobile padding
    const lastElemPadding = (i === sectionElems.length - 1) ? (window.innerWidth >= 1200 ? 325 : 60) : 0

    if (
      bounding.top <= offsetY &&
      bounding.bottom + lastElemPadding > offsetY
    ) {
      // check this elem has already active class
      if (!sectionElems[i].classList.contains('ecocart-how-list__info--active')) {
        sectionElems.forEach(elem => {
          elem.classList.remove('ecocart-how-list__info--active')
        })

        sectionElems[i].classList.add('ecocart-how-list__info--active')

        // manage right panel image
        const beforeActiveImage = document.querySelector('.ecocart-how-list__right-img--active') || false
        if (beforeActiveImage) {
          beforeActiveImage.classList.remove('ecocart-how-list__right-img--active')
        }

        const newActiveImage = document.querySelector(`.ecocart-how-list__right-img:nth-child(${i + 1})`) || false
        if (newActiveImage) {
          newActiveImage.classList.add('ecocart-how-list__right-img--active')
        }

        // run desktop animation
        if (window.innerWidth >= 1200 && window.howListAnimationList.desktop[i]) {
          const elem = document.getElementById('js-ecocart-how-list__how-it-works-animation-' + i) || false
          if (elem) {
            Lottie.loadAnimation({
              container: elem,
              path: window.FlyntData.templateDirectoryUri + window.howListAnimationList.desktop[i],
              renderer: 'svg',
              loop: false,
              autoplay: true
            })

            window.howListAnimationList.desktop[i] = false
          }
        }

        // run mobile animation
        if (window.innerWidth < 1200 && window.howListAnimationList.mobile[i]) {
          const elem = document.getElementById('js-ecocart-how-list__how-it-works-mobile-animation-' + i) || false
          if (elem) {
            Lottie.loadAnimation({
              container: elem,
              path: window.FlyntData.templateDirectoryUri + window.howListAnimationList.mobile[i],
              renderer: 'svg',
              loop: false,
              autoplay: true
            })

            window.howListAnimationList.mobile[i] = false
          }
        }
      }

      isAnyExist = true
      break
    }
  }

  // if there is no any elem in view report, remove active class
  if (!isAnyExist) {
    sectionElems.forEach(elem => {
      elem.classList.remove('ecocart-how-list__info--active')
    })
  }
}

document.addEventListener('DOMContentLoaded', function () {
  const ecocartHowListElem = document.getElementById('js-ecocart-how-list') || false

  if (ecocartHowListElem) {
    window.addEventListener('scroll', function () {
      checkEcocartHowListInfoStart()
    })

    checkEcocartHowListInfoStart()
  }
}, false)
