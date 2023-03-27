import 'normalize.css/normalize.css'
import './main.scss'

import Lottie from 'lottie-web'
import AOS from 'aos'
import installCE from 'document-register-element/pony'

AOS.init({
  once: true
})

window.lazySizesConfig = window.lazySizesConfig || {}
window.lazySizesConfig.preloadAfterLoad = true
require('lazysizes')

installCE(window, {
  type: 'force',
  noBuiltIn: true
})

function importAll (r) {
  r.keys().forEach(r)
}

importAll(require.context('../Components/', true, /\/script\.js$/))

// function initEcocartOffsetProjectMap () {
//   window.initEcocartOffsetProjectMapForMobile()
//   window.initEcocartOffsetProjectMapForDesktop()
//   window.initEcocartOffsetProjectListMap(null)
// }

// window.initEcocartOffsetProjectMap = initEcocartOffsetProjectMap

// play animation when the region is in the viewport
document.addEventListener('DOMContentLoaded', function () {
  const ecocartLottieElemList = document.querySelectorAll('.ecocart-lottie')

  if (typeof (ecocartLottieElemList) !== 'undefined' && ecocartLottieElemList.length > 0) {
    let ecocartLottieElemArr = Array.from(ecocartLottieElemList)

    const ecocartLottieScroll = () => {
      // console.log('lottie scroll');

      if (ecocartLottieElemArr.length > 0) {
        const notPlayElemArr = []
        const screenTop = window.scrollY
        const screenBottom = screenTop + window.innerHeight

        ecocartLottieElemArr.forEach(function (elem) {
          const rect = elem.getBoundingClientRect()
          const elemTop = rect.top + window.scrollY
          const elemBottom = elemTop + rect.height

          if (screenBottom > elemTop && screenTop < elemBottom) {
            Lottie.loadAnimation({
              container: elem,
              path: window.FlyntData.templateDirectoryUri + elem.getAttribute('data-animation-src'),
              renderer: 'svg',
              loop: false,
              autoplay: true
            })
          } else {
            notPlayElemArr.push(elem)
          }
        })

        ecocartLottieElemArr = notPlayElemArr
      } else {
        window.removeEventListener('scroll', ecocartLottieScroll)
      }
    }

    ecocartLottieScroll()

    window.addEventListener('scroll', ecocartLottieScroll)
  }
}, false)
