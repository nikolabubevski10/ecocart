import mapboxgl from 'mapbox-gl/dist/mapbox-gl'
import 'mapbox-gl/dist/mapbox-gl.css'

mapboxgl.accessToken = 'pk.eyJ1IjoiemFpbmxrcyIsImEiOiJja2xvNWdwN2kwMmZkMnFteDc2b3B0Mml4In0.YkTH3vccTMOv_y9O4Ah_mg'

// function initEcocartOffsetProjectMapForDesktop () {
//   const mapElem = document.getElementById('js-ecocart-single-op-side-map')

//   if (mapElem && typeof google === 'object' && typeof google.maps === 'object') {
//     const lat = parseFloat(mapElem.getAttribute('data-lat'))
//     const lng = parseFloat(mapElem.getAttribute('data-lng'))
//     const point = { lat, lng }

//     const map = new google.maps.Map(mapElem, {
//       center: point,
//       zoom: 11,
//       mapTypeId: 'satellite'
//     })

//     window.marker = new google.maps.Marker({
//       position: point,
//       map: map
//     })
//   }
// }

// window.initEcocartOffsetProjectMapForDesktop = initEcocartOffsetProjectMapForDesktop

// function initEcocartOffsetProjectMapForMobile () {
//   const mapElem = document.getElementById('js-ecocart-single-op-map')

//   if (mapElem && typeof google === 'object' && typeof google.maps === 'object') {
//     const lat = parseFloat(mapElem.getAttribute('data-lat'))
//     const lng = parseFloat(mapElem.getAttribute('data-lng'))
//     const point = { lat, lng }

//     const map = new google.maps.Map(mapElem, {
//       center: point,
//       zoom: 11,
//       mapTypeId: 'satellite'
//     })

//     window.marker = new google.maps.Marker({
//       position: point,
//       map: map
//     })
//   }
// }

// window.initEcocartOffsetProjectMapForMobile = initEcocartOffsetProjectMapForMobile

document.addEventListener('DOMContentLoaded', function () {
  const mapElem = document.getElementById('js-ecocart-single-op-side-map')

  if (mapElem) {
    const lat = parseFloat(mapElem.getAttribute('data-lat'))
    const lng = parseFloat(mapElem.getAttribute('data-lng'))

    const map = new mapboxgl.Map({
      container: 'js-ecocart-single-op-side-map',
      style: 'mapbox://styles/zainlks/cklo64we23khz17s4izwq65nf',
      center: [lng, lat],
      zoom: 7
    })

    map.flyTo({
      center: [lng, lat],
      zoom: 9,
      bearing: 0,
      speed: 0.2,
      curve: 1,
      essential: true
    })

    map.on('load', () => {
      map.loadImage(
        'https://docs.mapbox.com/mapbox-gl-js/assets/custom_marker.png',
        (error, image) => {
          if (error) throw error

          map.addImage('custom-marker', image)
          map.addSource('places', {
            type: 'geojson',
            data: {
              type: 'Feature',
              geometry: {
                type: 'Point',
                coordinates: [lng, lat]
              }
            }
          })

          map.addLayer({
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
  }

  const mapMobileElem = document.getElementById('js-ecocart-single-op-map')

  if (mapMobileElem) {
    const lat = parseFloat(mapMobileElem.getAttribute('data-lat'))
    const lng = parseFloat(mapMobileElem.getAttribute('data-lng'))

    const map = new mapboxgl.Map({
      container: 'js-ecocart-single-op-map',
      style: 'mapbox://styles/zainlks/cklo64we23khz17s4izwq65nf',
      center: [lng, lat],
      zoom: 7
    })

    map.flyTo({
      center: [lng, lat],
      zoom: 9,
      bearing: 0,
      speed: 0.2,
      curve: 1,
      essential: true
    })

    map.on('load', () => {
      map.loadImage(
        'https://docs.mapbox.com/mapbox-gl-js/assets/custom_marker.png',
        (error, image) => {
          if (error) throw error

          map.addImage('custom-marker', image)
          map.addSource('places', {
            type: 'geojson',
            data: {
              type: 'Feature',
              geometry: {
                type: 'Point',
                coordinates: [lng, lat]
              }
            }
          })

          map.addLayer({
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
  }
}, false)
