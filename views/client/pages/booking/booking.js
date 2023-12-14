$(document).ready(function () {
    $("#checkInDatePicker, #checkOutDatePicker").datepicker({
      minDate: "<?php echo $currentDate; ?>",
      dateFormat: "dd/mm/yy", // Định dạng ngày tháng năm
    });
  });
  
  document.addEventListener("DOMContentLoaded", function () {
    document
      .getElementById("searchRoomBtn")
      .addEventListener("click", function () {
        let selectedPerson = document.getElementById("personSelect").value;
        let checkinDate = document.getElementById("checkInDatePicker").value;
        let checkoutDate = document.getElementById("checkOutDatePicker").value;
  
        if (!isValidCheckoutDate(checkinDate, checkoutDate)) {
          swal({
            title: "Ngày trả phòng phải lớn hơn 1 ngày!",
            icon: "error",
          });
          return;
        }
  
        redirectToRoomTypePage(selectedPerson, checkinDate, checkoutDate);
      });
  });
  
  function isValidCheckoutDate(checkinDate, checkoutDate) {
    let currentDate = new Date();
    let checkin = parseDate(checkinDate);
    let checkout = parseDate(checkoutDate);
    return checkout > currentDate && checkout > checkin;
  }
  
  function parseDate(dateString) {
    let parts = dateString.split("/");
    return new Date(parts[2], parts[1] - 1, parts[0]);
  }
  
  function redirectToRoomTypePage(selectedPerson, checkinDate, checkoutDate) {
    window.location.href =
      "index.php?controller=client&action=roomSelection&checkin_date=" +
      checkinDate +
      "&checkout_date=" +
      checkoutDate +
      "&person=" +
      selectedPerson;
  }
  document.addEventListener("DOMContentLoaded", function () {
    let paymentButtons = document.querySelectorAll(".default-btn.btn-bg-three");
  
    paymentButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        let roomTypeId = this.getAttribute("data-room");
        let price = this.getAttribute("data-price");
        let checkinDate = this.getAttribute("data-checkin");
        let checkoutDate = this.getAttribute("data-checkout");
  
        redirectToPaymentPage(roomTypeId, price, checkinDate, checkoutDate);
      });
    });
  
    function redirectToPaymentPage(roomTypeId, price, checkinDate, checkoutDate) {
      window.location.href =
        "index.php?controller=client&action=secureBooking&checkin_date=" +
        checkinDate +
        "&checkout_date=" +
        checkoutDate +
        "&bookRoom=" +
        roomTypeId +
        "&price=" +
        price;
    }
  });