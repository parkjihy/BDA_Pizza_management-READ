const toggle = document.getElementById("toggle-dark");
const body = document.querySelector("#page-body");

if (localStorage.getItem("darkMode") === "true") {
    enableDarkMode();
}

toggle.addEventListener("click", function() {
    if(body.classList.contains("dark-mode")) {
        disableDarkMode();
    } else {
        enableDarkMode();
    }
})

function enableDarkMode() {
    body.classList.add("dark-mode");
    localStorage.setItem("darkMode", "true");
}

function disableDarkMode() {
    body.classList.remove("dark-mode");
    localStorage.setItem("darkMode", "false");
}