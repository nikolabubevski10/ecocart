import $ from 'jquery'

$(function () {
  $('.ecocart-plan-list__list-type-name').on('click', function () {
    if ($(this).hasClass('ecocart-plan-list__list-type-name--open')) {
      $(this).removeClass('ecocart-plan-list__list-type-name--open')
      $('.ecocart-plan-list__detail-wrapper', $(this).parent()).slideUp()
    } else {
      $('.ecocart-plan-list__detail-wrapper', $(this).parent()).slideDown()
      $(this).addClass('ecocart-plan-list__list-type-name--open')
    }
  })
})
