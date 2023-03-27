document.addEventListener('DOMContentLoaded', function () {
  const ecocartShopVideo = document.getElementById('js-ecocart-shop__video') || false

  const ecocartShopVideoPlayTimeCheck = () => {
    setInterval(function () {
      // console.log(ecocartShopVideo.currentTime);

      for (let i = window.ecocartShopVideoTimeSeconds.length - 1; i >= 0; i--) {
        if (ecocartShopVideo.currentTime >= window.ecocartShopVideoTimeSeconds[i]) {
          const currentActiveTimeLabel = document.querySelector('#js-ecocart-shop__time-label-' + i)

          if (!currentActiveTimeLabel.classList.contains('ecocart-shop__left-item--active')) {
            const beforeActiveTimeLabel = document.querySelector('.ecocart-shop__left-item--active')
            beforeActiveTimeLabel.classList.remove('ecocart-shop__left-item--active')

            currentActiveTimeLabel.classList.add('ecocart-shop__left-item--active')
          }

          break
        }
      }
    }, 1000)
  }

  if (ecocartShopVideo) {
    ecocartShopVideoPlayTimeCheck()

    const ecocartShopTimeLabelElems = document.querySelectorAll('.ecocart-shop__left-item')
    ecocartShopTimeLabelElems.forEach(elem => elem.addEventListener('click', function () {
      if (!this.classList.contains('ecocart-shop__left-item--active')) {
        const beforeActiveTimeLabel = document.querySelector('.ecocart-shop__left-item--active')
        beforeActiveTimeLabel.classList.remove('ecocart-shop__left-item--active')

        this.classList.add('ecocart-shop__left-item--active')

        const timeSecond = parseInt(this.getAttribute('data-time'))

        ecocartShopVideo.currentTime = timeSecond

        // console.log('run', timeSecond, ecocartShopVideo.currentTime)
      }
    }))
  }
}, false)
