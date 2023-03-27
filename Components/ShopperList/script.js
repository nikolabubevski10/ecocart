import $ from 'jquery'

$(function () {
  $('.ecocart-shopper-list__extra-btn').on('click', function () {
    if ($(this).hasClass('ecocart-shopper-list__extra-btn--open')) {
      $(this).removeClass('ecocart-shopper-list__extra-btn--open')
      $('.ecocart-shopper-list__extra-inner', $(this).parent()).slideUp()
    } else {
      $('.ecocart-shopper-list__extra-inner', $(this).parent()).slideDown()
      $(this).addClass('ecocart-shopper-list__extra-btn--open')
    }
  })
})
