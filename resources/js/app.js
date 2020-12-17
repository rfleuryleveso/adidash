require("./bootstrap");
require("./taskModal");
require("./calendar")

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


const myTaskListTitle = document.querySelector("#my-tasks-title");
const myTaskList = document.querySelector("#my-tasks-list");

const availableTaskListTitle = document.querySelector("#available-tasks-title");
const availableTaskList = document.querySelector("#available-tasks-list");


myTaskListTitle.addEventListener("click", function(){
    const chevron = document.querySelector("#my-tasks-chevron");
    chevron.classList.toggle("rotate-right");
    myTaskList.classList.toggle("show-flex");
});

availableTaskListTitle.addEventListener("click", function(){
    const chevron = document.querySelector("#available-tasks-chevron");
    chevron.classList.toggle("rotate-right");
    availableTaskList.classList.toggle("show-flex");
});
 
