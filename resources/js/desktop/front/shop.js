var cards = document.querySelectorAll('.card');
var buyButtons = document.querySelectorAll('.buy-now');

buyButtons.forEach(button => {
    button.addEventListener("click", () => {
        console.log("polla");
    })
})

cards.forEach(card=> {
    card.addEventListener( 'mouseenter', () => {
        card.classList.toggle('is-flipped');
    });
    
    card.addEventListener( 'mouseleave', () => {
        card.classList.toggle('is-flipped');
    });
    
    card.addEventListener('click',() =>{
        window.location.replace = 'dev-maquetacion.com/shop/product';
    
    })
})