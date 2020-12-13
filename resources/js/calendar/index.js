import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import frLocale from "@fullcalendar/core/locales/fr";

document.addEventListener("DOMContentLoaded", function() {
    var calendarEl = document.getElementById("calendar");
    if (calendarEl === null) {
        return;
    }
    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin],
        locale: frLocale,
        initialView: "dayGridWeek",
        headerToolbar: {
            start: "title", // will normally be on the left. if RTL, will be on the right
            center: "",
            end: "dayGridMonth,dayGridWeek today prev,next" // will normally be on the right. if RTL, will be on the left
        },
        events: [
            {
                id: "a",
                title: "Drone: Finir la stabilisation zebi",
                allDay: true,
                start: "2020-12-12"
            }
        ],
        eventDisplay: "block"
    });
    calendar.render();
});
