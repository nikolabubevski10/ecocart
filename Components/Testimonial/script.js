import $ from 'jquery'

import Swiper, { Navigation, A11y, Autoplay, EffectFade } from 'swiper/swiper.esm'
import 'swiper/swiper-bundle.css'

Swiper.use([Navigation, A11y, Autoplay, EffectFade])

class EcocartTestimonialSlider extends window.HTMLDivElement {
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
    this.$buttonPrev = $('.ecocart-testimonial__slider-btn--prev', this)
    this.$buttonNext = $('.ecocart-testimonial__slider-btn--next', this)
  }

  connectedCallback () {
    this.initSlider()
  }

  initSlider () {
    const config = {
      slidesPerView: 1,
      spaceBetween: 20,
      // autoplay: {
      //   delay: 300,
      // },
      loopedSlides: 10,
      loop: true,
      navigation: {
        prevEl: this.$buttonPrev.get(0),
        nextEl: this.$buttonNext.get(0)
      }
    }

    this.slider = new Swiper(this.$slider.get(0), config)
  }
}

window.customElements.define('ecocart-testimonial-slider', EcocartTestimonialSlider, { extends: 'div' })
