function setDarkMode(dark) {
  if (dark) {
    document.body.setAttribute('id', 'darkMode')
  }else{
    document.body.setAttribute('id', '')
  }
}