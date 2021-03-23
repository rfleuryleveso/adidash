require("./bootstrap");
require("./taskModal");
require("./calendar");
require("./header");

const dropdown = document.querySelector(".dropdown");
const dropdownMenu = document.querySelector(".dropdown-menu");

let hovered = false;
dropdown.addEventListener("mouseover", function(event) {
    event.stopPropagation();
    dropdown.classList.add("is-active");
    hovered = true;
});

dropdownMenu.addEventListener("mouseleave", function(event) {
    event.stopPropagation();
    if (hovered === true) {
        dropdown.classList.remove("is-active");
        hovered = false;
    }
});

burgerBtn = document.querySelector(".mobile-btn");
closeBtn = document.querySelector(".mobile-close-btn");

sidebar = document.querySelector(".sidebar")


burgerBtn.addEventListener("click", function(e){
    e.preventDefault();
    sidebar.classList.toggle("slide-in");
})
closeBtn.addEventListener("click", function(e){
    e.preventDefault();
    sidebar.classList.toggle("slide-in");

})