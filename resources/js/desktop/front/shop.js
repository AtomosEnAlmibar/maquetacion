var card = document.querySelector('.card');
var buyButtons = document.querySelectorAll('.buy-now');

buyButtons.forEach(button => {
    button.addEventListener("click", () => {
        console.log("polla");
    })
})

card.addEventListener( 'mouseenter', () => {
    card.classList.toggle('is-flipped');
});

card.addEventListener( 'mouseleave', () => {
    card.classList.toggle('is-flipped');
});

card.addEventListener('click',() =>{
    window.location.replace = 'dev-maquetacion.com/shop/product';

})