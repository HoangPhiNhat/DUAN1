document.getElementById("pricePerNight").addEventListener("input", function () {
  changeCurrency();
});
function changeCurrency() {
  const formatCurrency = document.getElementById("pricePerNight");
  let inputValue = formatCurrency.value.replaceAll(/[^\d]/g, "");
  if (inputValue !== "") {
    formatCurrency.value = Intl.NumberFormat().format(inputValue);
  } else {
    formatCurrency.value = "";
  }
  //   inputValue !== "" ?  formatCurrency.value = Intl.NumberFormat().format(inputValue) : formatCurrency.value = "";
  console.log(formatCurrency.value);
}
document.getElementById("capacity").addEventListener("input", function () {
  validateCapacity();
});
function validateCapacity() {
  let capacityInput = document.getElementById("capacity");
  let capacityError = document.getElementById("capacityError");
  let capacityValue = capacityInput.value;
  capacityValue = capacityValue.replace(/[^\d]/g, "");
  capacityInput.value = capacityValue;
  if (
    capacityValue.length === 0 ||
    parseInt(capacityValue) <= 0 ||
    parseInt(capacityValue) > 4
  ) {
    capacityError.textContent =
      "Số lượng người nhiều hơn 0 và tối đa 4 người trong 1 phòng.";
    capacityInput.setCustomValidity("invalid");
  } else {
    capacityError.textContent = "";
    capacityInput.setCustomValidity("");
  }
}
document.getElementById("Email").addEventListener("input", function () {
  validateEmail();
});
function validateEmail() {
  var emailInput = document.getElementById("Email");
  var emailError = document.getElementById("emailError");
  var email = emailInput.value.trim();

  var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

  if (!emailRegex.test(email)) {
    emailError.innerText = "Vui lòng nhập đúng định dạng email.";
    emailInput.classList.add("is-invalid");
    return false;
  } else {
    emailError.innerText = "";
    emailInput.classList.remove("is-invalid");
    return true;
  }
}
// room
function validateForm() {
  var name = document.getElementById("Name").value;
  var pricePerNight = document.getElementById("pricePerNight").value;
  var capacity = document.getElementById("capacity").value;
  var roomType = document.getElementById("roomTypeSelect").value;
  var facility = document.getElementById("facilitySelect").value;

  if (
    name === "" ||
    pricePerNight === "" ||
    capacity === "" ||
    roomType === "0" ||
    facility === "0"
  ) {
    alert("Vui lòng điền đầy đủ thông tin và chọn tùy chọn hợp lệ");
    return false;
  }

  if (isNaN(pricePerNight) || isNaN(capacity) || capacity < 1 || capacity > 4) {
    alert("Vui lòng kiểm tra định dạng và giá trị hợp lệ cho các trường");
    return false;
  }

  return true;
}

function validateInput(inputId) {
  var input = document.getElementById(inputId);
  var value = input.value.trim();
  var errorSpan = document.getElementById(inputId + "Error");

  if (value === "" || value === "0") {
    input.classList.add("is-invalid");
    errorSpan.textContent = "Vui lòng chọn tùy chọn hợp lệ";
    document.getElementById("submitButton").disabled = true;
  } else {
    input.classList.remove("is-invalid");
    errorSpan.textContent = "";
    checkFormValidity();
  }
}

function checkFormValidity() {
  var name = document.getElementById("Name").value;
  var pricePerNight = document.getElementById("pricePerNight").value;
  var capacity = document.getElementById("capacity").value;
  var roomType = document.getElementById("roomTypeSelect").value;
  var facility = document.getElementById("facilitySelect").value;

  document.getElementById("submitButton").disabled = !(
    name !== "" &&
    pricePerNight !== "" &&
    capacity !== "" &&
    roomType !== "0" &&
    facility !== "0"
  );
}

function validateFormSecond() {
  var name = document.getElementById("name").value;
  var description = document.getElementById("description").value;

  if (name === "" || description === "") {
    alert("Vui lòng điền đầy đủ thông tin");
    return false;
  }

  return true;
}
// room type
function validateInputSecond(inputId) {
  var input = document.getElementById(inputId);
  var value = input.value.trim();
  var errorSpan = document.getElementById(inputId + "Error");

  if (value === "") {
    input.classList.add("is-invalid");
    errorSpan.textContent = "Vui lòng điền trường này";
    document.getElementById("submitButton").disabled = true;
  } else {
    input.classList.remove("is-invalid");
    errorSpan.textContent = "";
    checkFormValiditySecond();
  }
}

function checkFormValiditySecond() {
  var name = document.getElementById("name").value;
  var description = document.getElementById("description").value;

  document.getElementById("submitButton").disabled = !(
    name !== "" && description !== ""
  );
}
// facility
