const bulmaCalendar = require("bulma-calendar");

bulmaCalendar.attach('[type="date"]', { type: "date", dateFormat: "DD-MM-YYYY" });

const tags_choices = new Choices("#tags-selection", {
    placeholder: true,
    placeholderValue: "Sélectionnez un ou des tags",
    removeItemButton: true
});
tags_choices.setChoices(function() {
    return axios
        .get("/tags")
        .then(function(response) {
            return response.data.data;
        })
        .then(function(data) {
            return data.map(function(tag) {
                return {
                    value: tag.id,
                    label: tag.name
                };
            });
        });
});
