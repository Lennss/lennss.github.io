// Dark Mode
const toggle = document.getElementById('darkModeButton');
toggle.addEventListener('change', function() {
    document.body.classList.toggle('dark-mode', this.checked);
});

// Pop Up Box
var popupBox = document.getElementById("popupBox");
var openPopupButtons = document.querySelectorAll(".openPopup");
var close = document.getElementsByClassName("close")[0];

openPopupButtons.forEach(function(button) {
    button.onclick = function() {
        popupBox.style.display = "flex";
    }
});

close.onclick = function() {
    popupBox.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == popupBox) {
        popupBox.style.display = "none";
    }
}


// Get the hamburger menu and the mobile menu
var hamburger = document.getElementById("hamburger");
var mobileMenu = document.getElementById("mobileMenu");

// Add event listener to hamburger icon
hamburger.onclick = function() {
    if (mobileMenu.style.display === "flex") {
        mobileMenu.style.display = "none";
    } else {
        mobileMenu.style.display = "flex";
    }
};

