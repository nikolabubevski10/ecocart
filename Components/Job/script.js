import $ from 'jquery'

$(function () {
  $('#js-ecocart-job__more-btn').on('click', function () {
    $('.ecocart-job__card').removeClass('ecocart-hide')
    $('.ecocart-job__card').removeClass('ecocart-job__card--last')
    $('.ecocart-job__card:nth-child(8)').addClass('ecocart-job__card--last')

    $('.ecocart-job__card-more-btn').addClass('ecocart-hide')
  })
})
