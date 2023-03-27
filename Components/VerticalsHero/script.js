import $ from 'jquery'

$(function () {
  $('.ecocart-verticals-hero__arrow-down').on('click', function () {
    $('html, body').animate({ scrollTop: $('.ecocart-verticals-hero~section').offset().top }, 1000)
  })

  $('.js-ecocart-verticals-hero-jump-btn').on('click', function () {
    const sectionId = $(this).attr('data-section-id')
    $('html, body').animate({ scrollTop: $('#' + sectionId).offset().top }, 1000)
  })
})
