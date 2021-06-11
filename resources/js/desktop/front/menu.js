const menuButtons = document.querySelectorAll(".menu-item");

menuButtons.forEach(menuButton => {
    menuButton.addEventListener("click",() => {
        url=menuButton.dataset.url;
        window.history.pushState('', '', url);
    })
})