import $ from 'jquery'

import Swiper, { Navigation, A11y, Autoplay } from 'swiper/swiper.esm'
import 'swiper/swiper-bundle.css'

Swiper.use([Navigation, A11y, Autoplay])

class EcocartPressSlider extends window.HTMLDivElement {
  constructor (...args) {
    const self = super(...args)
    self.init()
    return self
  }

  init () {
    this.$ = $(this)
    this.resolveElements()
  }

  resolveElements () {
    this.$slider = $('.swiper-container', this)
    this.$buttonPrev = $('.ecocart-press__slider-nav-item--prev', this)
    this.$buttonNext = $('.ecocart-press__slider-nav-item--next', this)
  }

  connectedCallback () {
    this.initSlider()
  }

  initSlider () {
    const config = {
      slidesPerView: 1,
      spaceBetween: 0,
      // autoplay: {
      //   delay: 300,
      // },
      loop: true,
      navigation: {
        prevEl: this.$buttonPrev.get(0),
        nextEl: this.$buttonNext.get(0)
      },
      breakpoints: {
        1000: {
          slidesPerView: 3,
          spaceBetween: 50
        }
      }
    }

    this.slider = new Swiper(this.$slider.get(0), config)

    this.slider.on('slideNextTransitionEnd', () => {
      if (!$(this.$buttonPrev.get(0)).hasClass('ecocart-press__slider-nav-item--prev-open')) {
        $(this.$buttonPrev.get(0)).addClass('ecocart-press__slider-nav-item--prev-open')
      }
    })
  }
}

window.customElements.define('ecocart-press-slider', EcocartPressSlider, { extends: 'div' })
