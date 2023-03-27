import Lottie from 'lottie-web'
import $ from 'jquery'

$(function () {
  let desktopPlayed = false
  let mobilePlayed = false

  function checkHomeHeroAnimation () {
    if (!desktopPlayed && $('#js-ecocart-homepage-hero__animation').length > 0) {
      if ($('#js-ecocart-homepage-hero__animation').is(':visible')) {
        Lottie.loadAnimation({
          container: document.getElementById('js-ecocart-homepage-hero__animation'),
          path: window.FlyntData.templateDirectoryUri + '/Components/HomepageHero/Assets/hd_external.json',
          renderer: 'svg',
          loop: true,
          autoplay: true
        })

        desktopPlayed = true
      }
    }

    if (!mobilePlayed && $('#js-ecocart-homepage-hero__animation-mobile').length > 0) {
      if ($('#js-ecocart-homepage-hero__animation-mobile').is(':visible')) {
        Lottie.loadAnimation({
          container: document.getElementById('js-ecocart-homepage-hero__animation-mobile'),
          path: window.FlyntData.templateDirectoryUri + '/Components/HomepageHero/Assets/hm_external.json',
          renderer: 'svg',
          loop: true,
          autoplay: true
        })

        mobilePlayed = true
      }
    }
  }

  checkHomeHeroAnimation()

  $(window).on('resize', function () {
    checkHomeHeroAnimation()
  })
})
