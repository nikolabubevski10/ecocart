function importAll (r) {
  r.keys().forEach(r)
}

importAll(require.context('../Components/', true, /\/map\.js$/))
