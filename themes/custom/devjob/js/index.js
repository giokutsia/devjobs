
const togglerDiv = document.querySelector("#toggler")
const toggleButton = document.querySelector("#button-toggle")
let darkMode = false;

const localDarkMode = JSON.parse(localStorage.getItem('darkMode'))
console.log(localDarkMode)

if(localDarkMode) {
  darkMode = localDarkMode
  document.querySelector('html').classList.add('dark')
  toggleButton.classList.remove('bg-red-600', "-translate-x-0")
  toggleButton.classList.add('bg-gray-600', "translate-x-6")
}else {
  document.querySelector('html').classList.remove('dark')
  toggleButton.classList.add('bg-red-600', "-translate-x-0")
  toggleButton.classList.remove('bg-gray-600', "translate-x-6")
}
togglerDiv.addEventListener ('click', () => {
  darkMode = !darkMode;
  localStorage.setItem('darkMode', darkMode)
  console.log(localDarkMode)
  // const localDarkMode = localStorage.getItem('darMode')

  if (darkMode) {
    document.querySelector('html').classList.add('dark')

    toggleButton.classList.remove('bg-red-600', "-translate-x-0")
    toggleButton.classList.add('bg-gray-600', "translate-x-6")

  } else {
    document.querySelector('html').classList.remove('dark')
    toggleButton.classList.add('bg-red-600', "-translate-x-0")
    toggleButton.classList.remove('bg-gray-600', "translate-x-6")


  }

} )
