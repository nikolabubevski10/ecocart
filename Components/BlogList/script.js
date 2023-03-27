import $ from 'jquery'

$(function () {
  $('.ecocart-blog-list__cat-dropdown-label').on('click', function () {
    if (window.innerWidth < 1000) {
      if ($(this).hasClass('open')) {
        $(this).removeClass('open')
        $('.ecocart-blog-list__cat-row').slideUp()
      } else {
        $(this).addClass('open')
        $('.ecocart-blog-list__cat-row').slideDown()
      }
    }
  })

  $('.ecocart-blog-list__cat-item span').on('click', function () {
    if (window.innerWidth < 1000) {
      $('.ecocart-blog-list__cat-dropdown-label').removeClass('open').text($(this).text())
      $('.ecocart-blog-list__cat-row').slideUp()
    }

    if (!$(this).parent().hasClass('selected')) {
      const catID = $(this).attr('data-cat-id')

      $('.ecocart-blog-list__cat-item').removeClass('selected')
      $(this).parent().addClass('selected')
      $('.ecocart-blog-list__grid').attr('data-cat-id', catID)

      // $('.ecocart-blog-list__ajax-spinner').removeClass('ecocart-hide')
      $('.ecocart-blog-list__grid').addClass('loading')

      $.ajax({
        type: 'post',
        dataType: 'json',
        url: window.FlyntData.ajaxurl,
        data: {
          action: 'get_blog_list',
          catID,
          offset: 0
        },
        success: function (response) {
          const totalBlogCount = parseInt(response.total_blog_count)

          $('.ecocart-blog-list__grid').html(response.blog_grid_html)
          $('.ecocart-blog-list__grid').attr('data-current-count', response.current_blog_count)
          $('.ecocart-blog-list__grid').attr('data-total-count', response.total_blog_count)

          if (totalBlogCount > 10) {
            $('.ecocart-blog-list__grid').addClass('ecocart-blog-list__grid-has-more')
          } else {
            $('.ecocart-blog-list__grid').removeClass('ecocart-blog-list__grid-has-more')
          }

          // $('.ecocart-blog-list__ajax-spinner').addClass('ecocart-hide')
          $('.ecocart-blog-list__grid').removeClass('loading')
        }
      })
    }
  })

  $(window).on('scroll', function () {
    if ($('.ecocart-blog-list__grid-has-more').not('.loading').length > 0) {
      const blogListBottom = $('.ecocart-blog-list__grid').offset().top + $('.ecocart-blog-list__grid').height()

      if ($(window).scrollTop() + $(window).height() - blogListBottom > 80) {
        const catID = parseInt($('.ecocart-blog-list__grid').attr('data-cat-id'))
        const offset = parseInt($('.ecocart-blog-list__grid').attr('data-current-count'))

        $('.ecocart-blog-list__infinite-spin').removeClass('ecocart-hide')
        $('.ecocart-blog-list__grid').addClass('loading')
        const oldScrollTop = $(window).scrollTop()

        $.ajax({
          type: 'post',
          dataType: 'json',
          url: window.FlyntData.ajaxurl,
          data: {
            action: 'get_blog_list_more',
            catID,
            offset
          },
          success: function (response) {
            const currentBlogCount = offset + parseInt(response.current_blog_count)
            const totalBlogCount = parseInt(response.total_blog_count)

            $('.ecocart-blog-list__grid').append(response.blog_grid_html)
            $(window).scrollTop(oldScrollTop)
            $('.ecocart-blog-list__grid').attr('data-current-count', currentBlogCount)
            $('.ecocart-blog-list__grid').attr('data-total-count', response.total_blog_count)

            if (totalBlogCount > currentBlogCount) {
              $('.ecocart-blog-list__grid').addClass('ecocart-blog-list__grid-has-more')
            } else {
              $('.ecocart-blog-list__grid').removeClass('ecocart-blog-list__grid-has-more')
            }

            $('.ecocart-blog-list__infinite-spin').addClass('ecocart-hide')

            $('.ecocart-blog-list__grid').removeClass('loading')
          }
        })
      }
    }
  })
})
