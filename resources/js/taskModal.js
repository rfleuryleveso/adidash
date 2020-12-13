const moment = require("moment");
moment.locale("fr");

function _createModal() {
    const parentDiv = document.createElement("div");
    const backgroundDiv = document.createElement("div");
    const contentDiv = document.createElement("div");
    const closeButton = document.createElement("button");
    const cardDiv = document.createElement("div");
    const cardHeaderDiv = document.createElement("div");
    const cardHeaderP = document.createElement("p");
    const cardContentDiv = document.createElement("div");
    const cardContentContentDiv = document.createElement("div");

    parentDiv.appendChild(backgroundDiv);
    parentDiv.appendChild(contentDiv);
    parentDiv.appendChild(closeButton);
    contentDiv.appendChild(cardDiv);
    cardDiv.appendChild(cardHeaderDiv);
    cardDiv.appendChild(cardContentDiv);
    cardHeaderDiv.appendChild(cardHeaderP);
    cardContentDiv.appendChild(cardContentContentDiv);

    parentDiv.classList.add("modal");
    parentDiv.classList.add("task-modal");
    backgroundDiv.classList.add("modal-background");
    contentDiv.classList.add("modal-content");

    cardDiv.classList.add("card");
    cardHeaderDiv.classList.add("card-header");
    cardHeaderP.classList.add("card-header-title");
    cardContentDiv.classList.add("card-content");
    cardContentContentDiv.classList.add("content");
    closeButton.classList.add("modal-close");
    closeButton.classList.add("is-large");

    document.body.appendChild(parentDiv);

    return {
        parentDiv,
        backgroundDiv,
        contentDiv,
        cardHeaderP,
        closeButton,
        cardContentContentDiv
    };
}

function _closeModal(elements) {
    elements.parentDiv.remove();
}

function _getTaskDetails(taskId) {
    return new Promise((resolve, reject) => {
        axios
            .get(`/tasks/${taskId}`)
            .then(response => {
                if (
                    typeof response !== "undefined" &&
                    typeof response.data !== "undefined" &&
                    typeof response.data.data !== "undefined" &&
                    response.data.data.id === taskId
                ) {
                    resolve(response.data.data);
                } else {
                    reject("Impossible de récupérer les données de la tâche");
                }
            })
            .catch(error => reject(error));
    });
}

function _createLoadingElements(elements) {
    // Add loading animation
    const loadingI = document.createElement("i");
    loadingI.classList.add(
        "fas",
        "fa-sync",
        "fa-spin",
        "is-size-4",
        "icon-center"
    );
    // Add loading text
    const loadingP = document.createElement("p");
    loadingP.classList.add("has-text-centered");
    loadingP.innerText = "Chargement en cours...";

    elements.cardContentContentDiv.appendChild(loadingI);
    elements.cardContentContentDiv.appendChild(loadingP);
    return { loadingP, loadingI };
}

function _createErrorElements(elements, error) {
    // Add loading animation
    const errorI = document.createElement("i");
    errorI.classList.add(
        "fas",
        "fa-exclamation-triangle",
        "is-size-4",
        "icon-center",
        "has-text-danger"
    );
    // Add loading text
    const errorP = document.createElement("p");
    errorP.classList.add("has-text-centered");
    errorP.innerText = `Une erreur est survenue: ${error.message}`;

    elements.cardContentContentDiv.appendChild(errorI);
    elements.cardContentContentDiv.appendChild(errorP);
    return { errorI, errorP };
}

function _removeLoadingElements(elements, loadingI, loadingP) {
    console.log(elements, loadingI, loadingP);
    loadingI.remove();
    elements.cardContentContentDiv
        .getElementsByTagName("svg")
        .item(0)
        .remove();
    loadingP.remove();
}

function _createTaskProperty(name, value) {
    const pElement = document.createElement("p");
    pElement.classList.add("m-0");
    const propertyNameSpan = document.createElement("span");
    const propertyValueSpan = document.createElement("span");
    propertyNameSpan.classList.add("has-text-weight-bold");
    pElement.appendChild(propertyNameSpan);
    pElement.appendChild(propertyValueSpan);
    propertyNameSpan.innerText = name + ": ";
    propertyValueSpan.innerText = value;
    return pElement;
}

function _renderTask(elements, taskData) {
    elements.cardHeaderP.innerText = `Task #${taskData.id} | ${taskData.name}`;

    // Task name
    elements.cardContentContentDiv.append(
        _createTaskProperty("Nom de la tâche", taskData.name)
    );

    // Task creation date
    elements.cardContentContentDiv.append(
        _createTaskProperty(
            "Date de creation",
            moment(taskData.created_at).format("LL")
        )
    );

    // Task end date
    elements.cardContentContentDiv.append(
        _createTaskProperty(
            "Date de fin prévue",
            taskData.ends_at ? moment(taskData.ends_at).format("LL") : "Aucune"
        )
    );
}

function openTaskModal(taskId) {
    const elements = _createModal();
    elements.cardHeaderP.innerText = `Task #${taskId}`;
    elements.parentDiv.classList.add("is-active");

    elements.backgroundDiv.addEventListener("click", () => {
        _closeModal(elements);
    });
    elements.closeButton.addEventListener("click", () => {
        _closeModal(elements);
    });
    const { loadingI, loadingP } = _createLoadingElements(elements);
    _getTaskDetails(taskId)
        .then(taskData => {
            _removeLoadingElements(elements, loadingI, loadingP);
            _renderTask(elements, taskData);
        })
        .catch(error => {
            _removeLoadingElements(elements, loadingI, loadingP);
            _createErrorElements(elements, error);
        });
}

window.openTaskModal = openTaskModal;
