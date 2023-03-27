import $ from 'jquery'

import mapboxgl from 'mapbox-gl/dist/mapbox-gl'
import 'mapbox-gl/dist/mapbox-gl.css'

mapboxgl.accessToken = 'pk.eyJ1IjoiemFpbmxrcyIsImEiOiJja2xvNWdwN2kwMmZkMnFteDc2b3B0Mml4In0.YkTH3vccTMOv_y9O4Ah_mg'
let mapboxList = null

document.addEventListener('DOMContentLoaded', function () {
  const mapListElem = document.getElementById('js-ecocart-project-list__map') || false

  if (mapListElem) {
    mapboxList = new mapboxgl.Map({
      container: 'js-ecocart-project-list__map',
      style: 'mapbox://styles/zainlks/cklo64we23khz17s4izwq65nf',
      center: [-45.0, 38.7205],
      zoom: 0
    })

    mapboxList.on('load', () => {
      mapboxList.loadImage(
        'https://docs.mapbox.com/mapbox-gl-js/assets/custom_marker.png',
        (error, image) => {
          if (error) throw error

          mapboxList.addImage('custom-marker', image)
          mapboxList.addSource('places', window.ecocartOffsetProjectList)

          mapboxList.addLayer({
            id: 'places',
            type: 'symbol',
            source: 'places',
            layout: {
              'icon-image': 'custom-marker',
              'icon-allow-overlap': true
            }
          })
        }
      )
    })

    const popup = new mapboxgl.Popup({
      closeButton: false,
      closeOnClick: true
    })

    mapboxList.on('click', 'places', (e) => {
      window.location = e.features[0].properties.link
    })

    mapboxList.on('mouseenter', 'places', (e) => {
      mapboxList.getCanvas().style.cursor = 'pointer'
      var coordinates = e.features[0].geometry.coordinates.slice()
      var title = e.features[0].properties.title

      // Ensure that if the map is zoomed out such that multiple
      // copies of the feature are visible, the popup appears
      // over the copy being pointed to.
      while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360
      }
      // Populate the popup and set its coordinates
      // based on the feature found.
      popup.setLngLat(coordinates).setHTML(title).addTo(mapboxList)
    })

    mapboxList.on('mouseleave', 'places', () => {
      mapboxList.getCanvas().style.cursor = ''
      popup.remove()
    })
  }
}, false)

$(function () {
  function getEcocartOffsetProjectList () {
    const projectType = $('.ecocart-project-list__dropdown-list-item--project-type.selected').attr('data-slug')
    const orderby = $('.ecocart-project-list__dropdown-list-item--orderby.selected').attr('data-orderby')

    $.ajax({
      type: 'post',
      dataType: 'json',
      url: window.FlyntData.ajaxurl,
      data: {
        action: 'get_project_list',
        projectType,
        orderby
      },
      success: function (response) {
        $('.ecocart-project-list__card-wrapper').html(response.project_list_html)

        if (mapboxList) {
          mapboxList.getStyle().layers.forEach((layer) => {
            if (layer.id === 'places') {
              mapboxList.removeLayer(layer.id)
              mapboxList.removeSource(layer.id)
            }
          })

          mapboxList.addSource('places', response.ecocartOffsetProjectList)

          mapboxList.addLayer({
            id: 'places',
            type: 'symbol',
            source: 'places',
            layout: {
              'icon-image': 'custom-marker',
              'icon-allow-overlap': true
            }
          })
        }

        // initEcocartOffsetProjectListMap(response.ecocartOffsetProjectList)
      }
    })
  }

  $('.ecocart-project-list__dropdown-label').on('click', function () {
    const $parentElem = $(this).parent()

    if ($(this).hasClass('open')) {
      $(this).removeClass('open')
      $('.ecocart-project-list__dropdown-list', $parentElem).slideUp()
    } else {
      $(this).addClass('open')
      $('.ecocart-project-list__dropdown-list', $parentElem).slideDown()
    }
  })

  $('.ecocart-project-list__dropdown-list-item--project-type').on('click', function () {
    const $parentElem = $(this).parent().parent()

    $('.ecocart-project-list__dropdown-label', $parentElem).removeClass('open')
    $('.ecocart-project-list__dropdown-list', $parentElem).slideUp()

    if (!$(this).hasClass('selected')) {
      const label = $(this).text()

      $('.ecocart-project-list__dropdown-label span', $parentElem).text(label)
      $('.ecocart-project-list__dropdown-list-item--project-type').removeClass('selected')
      $(this).addClass('selected')

      getEcocartOffsetProjectList()
    }
  })

  $('.ecocart-project-list__dropdown-list-item--orderby').on('click', function () {
    const $parentElem = $(this).parent().parent()

    $('.ecocart-project-list__dropdown-label', $parentElem).removeClass('open')
    $('.ecocart-project-list__dropdown-list', $parentElem).slideUp()

    if (!$(this).hasClass('selected')) {
      const label = $(this).text()

      $('.ecocart-project-list__dropdown-label span', $parentElem).text(label)
      $('.ecocart-project-list__dropdown-list-item--orderby').removeClass('selected')
      $(this).addClass('selected')

      getEcocartOffsetProjectList()
    }
  })
})

// function initEcocartOffsetProjectListMap (ecocartOffsetProjectList) {
//   const mapElem = document.getElementById('js-ecocart-project-list__map')
//   const offsetProjectList = ecocartOffsetProjectList || window.ecocartOffsetProjectList

//   if (mapElem && typeof google === 'object' && typeof google.maps === 'object') {
//     const map = new google.maps.Map(mapElem, {
//     })

//     const bounds = new google.maps.LatLngBounds()

//     const infoWindow = new google.maps.InfoWindow()

//     for (let i = 0; i < offsetProjectList.length; i++) {
//       const position = new google.maps.LatLng(offsetProjectList[i].lat, offsetProjectList[i].lng)

//       bounds.extend(position)

//       const marker = new google.maps.Marker({
//         position: position,
//         map: map
//         // title: offsetProjectList[i]['title']
//       })

//       google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
//         return function () {
//           infoWindow.setContent('<a href="' + offsetProjectList[i].link + '">' + offsetProjectList[i].title + '</a>')
//           infoWindow.open({
//             anchor: marker,
//             map
//             // shouldFocus: false
//           })
//         }
//       })(marker, i))

//       google.maps.event.addListener(marker, 'mouseout', (function (marker, i) {
//         return function () {
//           infoWindow.close()
//         }
//       })(marker, i))

//       mapboxList.fitBounds(bounds)
//     }

//     var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function () {
//       this.setZoom(2)
//       google.maps.event.removeListener(boundsListener)
//     })
//   }
// }

// window.initEcocartOffsetProjectListMap = initEcocartOffsetProjectListMap
