/* 'as' permet de changer le nom, nomDefault est l'export par défaut                                */
/* Ceci permet d'inporter ici les fichiers necessaires afin de couper le code en plusieurs fichiers */
//import nomDefault, {nomExport1 as newName, nomExport2} from "./assets/scripts/nomFichier.js"

window.addEventListener("load", function () {

/* nav-bar (hamburger) */
const hamburgerToggler = document.querySelector(".hamburger");
const navLinksContainer = document.querySelector(".navlinks-container");

const toggleNav = () => {
    hamburgerToggler.classList.toggle("open");

    const ariaToggle = hamburgerToggler.getAttribute("aria-expanded") === "true" ? "false" : "true";
    hamburgerToggler.setAttribute("aria-expanded", ariaToggle);

    navLinksContainer.classList.toggle("open");
}
hamburgerToggler.addEventListener("click", toggleNav);

new ResizeObserver(entries => { //gérer la transition du menu hamburger
    if(entries[0].contentRect.width <= 800){
        navLinksContainer.style.transition = "transform 0.3s ease-out";
    } else {
        navLinksContainer.style.transition = "none";
    }
}).observe(document.body);



//bouton du sroll vers le haut du site
const header = document.querySelector('#navbar');
const toTopBtn = document.querySelector(".to-top-btn");
window.addEventListener("scroll", () => {
    header.classList.toggle("sticky", window.scrollY > 0);

    if(document.documentElement.scrollTop > window.innerHeight * 0.7)
        toTopBtn.classList.add("active");
    else 
        toTopBtn.classList.remove("active");
});
toTopBtn.addEventListener("click", () => {
    if (toTopBtn.classList.contains("active")) {
        window.scrollTo({
            top: 0
        });
    }
});


//input number
const inputNumber = document.querySelectorAll('.input-number');

inputNumber.forEach(num => {
    const numInput = num.querySelector('.num-input');
    const arrayUp = num.querySelector('.bx-plus');
    const arrayDown = num.querySelector('.bx-minus');

    arrayUp.addEventListener('click', () => {
        numInput.stepUp();
        numInput.value = parseInt(numInput.value) +1; // Fix: Update input value
        checkMaxMin(num);
    });

    arrayDown.addEventListener('click', () => {
        numInput.stepDown();
        numInput.value = parseInt(numInput.value) -1; // Fix: Update input value
        checkMaxMin(num);
    });

    numInput.addEventListener('input', () => checkMaxMin(num)); // Fix: Pass num as an argument
});

function checkMaxMin(num) {
    const numInput = num.querySelector('.num-input'); // Fix: Move the declaration inside the function
    const numInputValue = parseInt(numInput.value);
    const numInputMax = parseInt(numInput.max);
    const numInputMin = parseInt(numInput.min);

    if (numInputValue === numInputMax) {
        arrayUp.style.display = "none";
    } else if (numInputValue === numInputMin) {
        arrayDown.style.display = "none";
    }
}


});
