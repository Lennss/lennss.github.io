var hamburger = document.getElementById("hamburger");
var mobileMenu = document.getElementById("mobileMenu");

hamburger.onclick = function () {
  if (mobileMenu.style.display === "flex") {
    mobileMenu.style.display = "none";
  } else {
    mobileMenu.style.display = "flex";
  }
};

const toggle = document.getElementById("darkModeButton");

toggle.addEventListener("change", function () {
  document.body.classList.toggle("dark-mode", this.checked);
});

function openOrderForm(menuItem) {
  document.getElementById("menuItem").value = menuItem;
  document.getElementById("popupBox").style.display = "flex";
}

function closeOrderForm() {
  document.getElementById("popupBox").style.display = "none";
}

window.onclick = function (event) {
  if (event.target == document.getElementById("popupBox")) {
    closeOrderForm();
  }
};

function showNotification(name, menuItem, quantity, note) {
  var notification = document.getElementById("notification");

  notification.innerHTML = `
    <strong>Order Summary:</strong><br>
    Name: ${name}<br>
    Menu Item: ${menuItem}<br>
    Quantity: ${quantity}<br>
    Note: ${note || "No note added."}
  `;

  notification.classList.add("show");

  setTimeout(function () {
    notification.classList.remove("show");
  }, 3000);
}

document
  .getElementById("orderForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    var name = document.getElementById("name").value;
    var menuItem = document.getElementById("menuItem").value;
    var quantity = document.getElementById("quantity").value;
    var note = document.getElementById("note").value;

    showNotification(name, menuItem, quantity, note);

    closeOrderForm();

    this.reset();
  });
