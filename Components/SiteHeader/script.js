import $ from 'jquery'
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

$(function () {
  $('.ecocart-header__mobile-btn').on('click', function () {
    if ($(this).hasClass('is-open')) {
      enableBodyScroll(document.querySelector('#js-ecocart-header__nav-wrapper'))
      $(this).removeClass('is-open')
      $('.ecocart-header__nav-wrapper').removeClass('is-open')
      $('#js-ecocart-header__nav-wrapper').removeAttr('style')
    } else {
      disableBodyScroll(document.querySelector('#js-ecocart-header__nav-wrapper'))
      $(this).addClass('is-open')
      $('.ecocart-header__nav-wrapper').addClass('is-open')
      $('#js-ecocart-header__nav-wrapper').innerHeight(window.innerHeight - 86)
    }
  })

  $('.ecocart-header__nav-arrow-btn').on('click', function () {
    const subMenuHtml = $('.ecocart-header__nav-child-row', $(this).parent()).html()
    $('.ecocart-header__nav-mobile-panel-info').html(subMenuHtml)
    $('.ecocart-header__nav-mobile-panel').addClass('open')
  })

  $('.ecocart-header__nav-mobile-panel-btn').on('click', function () {
    $('.ecocart-header__nav-mobile-panel').removeClass('open')
    // $('.ecocart-header__nav-mobile-panel-info').html('');
  })
})
