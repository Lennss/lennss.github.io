var hamburger = document.getElementById("hamburger");
var mobileMenu = document.getElementById("mobileMenu");

hamburger.onclick = function () {
  mobileMenu.style.display = mobileMenu.style.display === "flex" ? "none" : "flex";
};

const toggle = document.getElementById("darkModeButton");

toggle.addEventListener("change", function () {
  document.body.classList.toggle("dark-mode", this.checked);
});

function searchMenu() {
  // Ambil nilai input pencarian
  let input = document.getElementById('searchInput').value.toLowerCase();
  // Ambil semua elemen menu-item
  let menuItems = document.getElementsByClassName('menu-item');

  // Loop melalui semua menu-item untuk menyaring berdasarkan pencarian
  for (let i = 0; i < menuItems.length; i++) {
      // Ambil nama menu dari setiap elemen menu-item
      let menuName = menuItems[i].getElementsByTagName('h3')[0].innerText.toLowerCase();
      // Jika nama menu mengandung teks input, tampilkan menu, jika tidak sembunyikan
      if (menuName.includes(input)) {
          menuItems[i].style.display = '';
      } else {
          menuItems[i].style.display = 'none';
      }
  }
}



function openOrderForm(menuItem) {
  document.getElementById("menuItem").value = menuItem;
  document.getElementById("popupBox").style.display = "flex";
}

function closeOrderForm() {
  document.getElementById("popupBox").style.display = "none";
}

function editOrder(order) {
  document.getElementById('orderId').value = order.id;
  document.getElementById('name').value = order.name;
  document.getElementById('menuItem').value = order.menu_item;
  document.getElementById('quantity').value = order.quantity;
  document.getElementById('note').value = order.note;
  document.getElementById("popupBox").style.display = "flex";
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

document.getElementById("orderForm").addEventListener("submit", function (event) {
  // Allow form submission to the server
  // event.preventDefault();

  var name = document.getElementById("name").value;
  var menuItem = document.getElementById("menuItem").value;
  var quantity = document.getElementById("quantity").value;
  var note = document.getElementById("note").value;

  showNotification(name, menuItem, quantity, note);

  closeOrderForm();
});