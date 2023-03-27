import $ from 'jquery'

import Swiper, { Navigation, A11y, Autoplay } from 'swiper/swiper.esm'
import 'swiper/swiper-bundle.css'

Swiper.use([Navigation, A11y, Autoplay])

class EcocartProjectSlider extends window.HTMLDivElement {
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
    this.$buttonPrev = $('.ecocart-project-slider__slider-nav-item--prev', this)
    this.$buttonNext = $('.ecocart-project-slider__slider-nav-item--next', this)
  }

  connectedCallback () {
    this.initSlider()
  }

  initSlider () {
    const config = {
      slidesPerView: 1,
      spaceBetween: 20,
      loopedSlides: 10,
      // autoplay: {
      //   delay: 300,
      // },
      loop: true,
      navigation: {
        prevEl: this.$buttonPrev.get(0),
        nextEl: this.$buttonNext.get(0)
      },
      breakpoints: {
        500: {
          slidesPerView: 2,
          spaceBetween: 20
        },
        750: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        1000: {
          slidesPerView: 1,
          spaceBetween: 25
        },
        1200: {
          slidesPerView: 2,
          spaceBetween: 25
        }
      }
    }

    this.slider = new Swiper(this.$slider.get(0), config)

    this.slider.on('slideNextTransitionEnd', () => {
      if (!$(this.$buttonPrev.get(0)).hasClass('ecocart-project-slider__slider-nav-item--prev-open')) {
        $(this.$buttonPrev.get(0)).addClass('ecocart-project-slider__slider-nav-item--prev-open')
      }
    })
  }
}

window.customElements.define('ecocart-project-slider', EcocartProjectSlider, { extends: 'div' })
