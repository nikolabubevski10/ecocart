import $ from 'jquery'

$(function () {
  $('.ecocart-faq__item-title').on('click', function () {
    if ($(this).hasClass('ecocart-faq__item-title--open')) {
      $(this).removeClass('ecocart-faq__item-title--open')
      $('.ecocart-faq__item-content', $(this).parent()).slideUp()
    } else {
      $('.ecocart-faq__item-content', $(this).parent()).slideDown()
      $(this).addClass('ecocart-faq__item-title--open')
    }
  })
})
