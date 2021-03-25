// Tasks list chevron
const myTaskListTitle = document.querySelector("#my-tasks-title");
const myTaskList = document.querySelector("#my-tasks-list");

const availableTaskListTitle = document.querySelector("#available-tasks-title");
const availableTaskList = document.querySelector("#available-tasks-list");

if (
    myTaskList &&
    myTaskListTitle &&
    availableTaskList &&
    availableTaskListTitle
) {
    myTaskListTitle.addEventListener("click", function() {
        const chevron = document.querySelector("#my-tasks-chevron");
        chevron.classList.toggle("rotate-right");
        chevron.classList.toggle("rotate-back");
        myTaskList.classList.toggle("show-flex");
    });

    availableTaskListTitle.addEventListener("click", function() {
        const chevron = document.querySelector("#available-tasks-chevron");
        chevron.classList.toggle("rotate-right");
        chevron.classList.toggle("rotate-back");
        availableTaskList.classList.toggle("show-flex");
    });
}
