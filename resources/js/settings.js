;(function () {
  const themeDefaults = {
    'theme': 'auto',
    'theme-base': 'neutral',
    'theme-font': 'sans-serif',
    'theme-primary': 'blue',
    'theme-radius': '1',
    'layout': 'default',
    'navbar': 'default',
    'navbar-position': 'horizontal',
    'navbar-style': 'default',
    'navbar-theme': 'default',
    'offcanvas-style': 'default',
    'sidebar': 'default'
  }

  const themePresets = {
    scheme: {
      'auto': { 'theme': 'auto', 'navbar-theme': 'default' },
      'light': { 'theme': 'light', 'navbar-theme': 'default' },
      'dark': { 'theme': 'dark', 'navbar-theme': 'default' },
      'dark-nav': { 'theme': 'light', 'navbar-theme': 'dark' },
      'colored': { 'theme': 'light', 'navbar-theme': 'primary' }
    }
  }

  const sidebarOnlyKeys = ['sidebar']
  const navbarOnlyKeys = ['navbar']

  document.addEventListener('DOMContentLoaded', function () {
    const url = new URL(window.location)
    const form = document.getElementById('offcanvas-settings')
    const resetButton = document.getElementById('reset-changes')

    if (!form) {
      return
    }

    const applyValue = function (key, value) {
      let applied = value

      if (key === 'theme' && value === 'auto') {
        applied = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
      }

      if (applied !== themeDefaults[key]) {
        document.documentElement.setAttribute('data-bs-' + key, applied)
      } else {
        document.documentElement.removeAttribute('data-bs-' + key)
      }
    }

    const currentValue = function (key) {
      const stored = window.localStorage['tabler-' + key]
      const rendered = key === 'theme' ? null : document.documentElement.getAttribute('data-bs-' + key)

      return stored || rendered || themeDefaults[key]
    }

    const toggleSidebarSettings = function () {
      const vertical = currentValue('navbar-position') === 'vertical'

      const setHidden = function (keys, hidden) {
        keys.forEach(function (key) {
          const fieldset = form.querySelector('[data-theme-setting="' + key + '"]')
          if (fieldset) {
            fieldset.hidden = hidden
          }
        })
      }

      setHidden(sidebarOnlyKeys, !vertical)
      setHidden(navbarOnlyKeys, vertical)
    }

    const setValue = function (key, value) {
      applyValue(key, value)
      window.localStorage.setItem('tabler-' + key, value)
      url.searchParams.set(key, value)
    }

    const presetMatches = function (values) {
      return Object.keys(values).every(function (key) {
        return currentValue(key) === values[key]
      })
    }

    const checkItems = function () {
      for (const key in themeDefaults) {
        const value = currentValue(key)

        form.querySelectorAll('[name="' + key + '"]').forEach(function (radio) {
          radio.checked = radio.value === value
        })
      }

      for (const name in themePresets) {
        form.querySelectorAll('[name="' + name + '"]').forEach(function (radio) {
          radio.checked = presetMatches(themePresets[name][radio.value])
        })
      }

      toggleSidebarSettings()
    }

    form.addEventListener('change', function (event) {
      const target = event.target
      const name = target.name
      const value = target.value

      if (name in themePresets) {
        const values = themePresets[name][value]

        for (const presetKey in values) {
          setValue(presetKey, values[presetKey])
        }
      } else if (name in themeDefaults) {
        setValue(name, value)
      }

      toggleSidebarSettings()
      window.dispatchEvent(new Event('resize'))
      window.history.pushState({}, '', url)
    })

    resetButton.addEventListener('click', function () {
      for (const key in themeDefaults) {
        applyValue(key, themeDefaults[key])
        window.localStorage.removeItem('tabler-' + key)
        url.searchParams.delete(key)
      }

      checkItems()

      window.dispatchEvent(new Event('resize'))
      window.history.pushState({}, '', url)
    })

    checkItems()
  })
})()