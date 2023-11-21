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

// room
document.addEventListener('DOMContentLoaded', function() {
  var form = document.querySelector('.forms-sample');
  var inputs = form.querySelectorAll('input');
  var selects = form.querySelectorAll('select');
  var submitButton = document.getElementById('submitButton');

  inputs.forEach(function(input) {
    input.addEventListener('input', validateForm);
  });

  selects.forEach(function(select) {
    select.addEventListener('change', validateForm);
  });

  function validateForm() {
    var isValid = true;
    inputs.forEach(function(input) {
      if (input.value === '') {
        isValid = false;
      }
    });

    selects.forEach(function(select) {
      if (select.value === '0') {
        isValid = false;
      }
    });

    if (isValid) {
      submitButton.removeAttribute('disabled');
    } else {
      submitButton.setAttribute('disabled', 'disabled');
    }
  }
});
// room type
function validateFormSecond() {
  var name = document.getElementById("name").value;
  var description = document.getElementById("description").value;

  if (name === "" || description === "") {
    alert("Vui lòng điền đầy đủ thông tin");
    return false;
  }

  return true;
}
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
