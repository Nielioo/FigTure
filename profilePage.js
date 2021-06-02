const tabs = document.querySelectorAll('[data-tab-target]')
const tabContents = document.querySelectorAll('[data-tab-content]')

tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    const target = document.querySelector(tab.dataset.tabTarget)
    tabContents.forEach(tabContent => {
      tabContent.classList.remove('active')
    })
    tabs.forEach(tab => {
      tab.classList.remove('active')
    })
    tab.classList.add('active')
    target.classList.add('active')
  })
})

// let bio = document.querySelector('.bio');

// function bioText(){
//   bio.oldText = bio.innerText;
//   bio.innerText = bio.innerText.substring(0,75) + "...";
//   bio.innerHTML += "&nbsp;"+`<span onclick='addLength()' id='see-more-bio'> See More</span>`;
// }
// bioText();

// function addLength(){
//   bio.innerHTML = bio.oldText;
// }

