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
document.addEventListener("DOMContentLoaded", function () {
  var form = document.querySelector(".forms-sample");
  var inputs = form.querySelectorAll("input");
  var selects = form.querySelectorAll("select");
  var submitButton = document.getElementById("submitButton");

  inputs.forEach(function (input) {
    input.addEventListener("input", validateForm);
  });

  selects.forEach(function (select) {
    select.addEventListener("change", validateForm);
  });

  function validateForm() {
    var isValid = true;
    inputs.forEach(function (input) {
      if (input.value === "") {
        isValid = false;
      }
    });

    selects.forEach(function (select) {
      if (select.value === "0") {
        isValid = false;
      }
    });

    if (isValid) {
      submitButton.removeAttribute("disabled");
    } else {
      submitButton.setAttribute("disabled", "disabled");
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

// let imageInput = document.getElementById("imageInput");
// let imagePreviews = document.getElementById("img-previews");
// let addImageButton = document.getElementById("uploadImage");

// addImageButton.addEventListener("click", function() {
//     imageInput.click(); // Gọi sự kiện click cho phần tử nhập tệp
// });

// imageInput.addEventListener("change", function() {
//     let files = imageInput.files;

//     for (let i = 0; i < files.length; i++) {
//         let file = files[i];

//         if (file) {
//             let reader = new FileReader();
//             reader.onload = function(e) {
//                 let img = new Image();
//                 img.src = e.target.result;

//                 img.onload = function() {
//                     let canvas = document.createElement("canvas");
//                     let ctx = canvas.getContext("2d");

//                     // Đặt kích thước cố định cho canvas (105x92)
//                     canvas.width = 105;
//                     canvas.height = 93;

//                     // Tính toán tỷ lệ thu phóng
//                     let scale = Math.min(105 / img.width, 93 / img.height);

//                     // Tính toán kích thước mới dựa trên tỷ lệ thu phóng
//                     let newWidth = img.width * scale;
//                     let newHeight = img.height * scale;

//                     // Tính toán vị trí để căn giữa ảnh trên canvas
//                     let offsetX = (105 - newWidth) / 2;
//                     let offsetY = (93 - newHeight) / 2;

//                     // Vẽ hình ảnh lên canvas với kích thước mới và vị trí căn giữa
//                     ctx.drawImage(img, offsetX, offsetY, newWidth, newHeight);

//                     // Chuyển đổi canvas thành dữ liệu URL (base64)
//                     let resizedImageURL = canvas.toDataURL("image/jpeg", 0.7);

//                     let image = document.createElement("img");
//                     image.src = resizedImageURL;
//                     image.style.maxWidth = "105px";
//                     image.style.maxHeight = "93px";
//                     imagePreviews.appendChild(image);
//                 };
//             };
//             reader.readAsDataURL(file);
//         }
//     }
// });
let imageInput = document.getElementById("imageInput");
let imagePreviews = document.getElementById("img-previews");
let addImageButton = document.getElementById("uploadImage");

addImageButton.addEventListener("click", function () {
  imageInput.click(); // Trigger click event for file input element
});

imageInput.addEventListener("change", function () {
  let files = imageInput.files;
  let file = files[0]; // Get the first file

  if (file) {
    let reader = new FileReader();
    reader.onload = function (e) {
      let img = new Image();
      img.src = e.target.result;

      img.onload = function () {
        let canvas = document.createElement("canvas");
        let ctx = canvas.getContext("2d");
        canvas.width = 105;
        canvas.height = 93;
        let scale = Math.min(105 / img.width, 93 / img.height);
        let newWidth = img.width * scale;
        let newHeight = img.height * scale;
        let offsetX = (105 - newWidth) / 2;
        let offsetY = (93 - newHeight) / 2;
        ctx.drawImage(img, offsetX, offsetY, newWidth, newHeight);
        let resizedImageURL = canvas.toDataURL("image/jpeg", 0.7);
        addImageButton.style.display = "none";
        let image = document.createElement("img");
        image.src = resizedImageURL;
        image.style.maxWidth = "105px";
        image.style.maxHeight = "93px";
        imagePreviews.appendChild(image);

        let deleteButton = document.createElement("button");
        deleteButton.innerHTML = "Delete";
        deleteButton.addEventListener("click", function () {
          imageInput.value = "";
          imagePreviews.innerHTML = "";
        });
        imagePreviews.appendChild(deleteButton);
      };
    };
    reader.readAsDataURL(file);
  }
});
imagePreviews.addEventListener("click", function(event) {
  if (event.target.tagName === "BUTTON") {
    if (event.target.innerHTML === "Delete") {
      imageInput.value = "";
      imagePreviews.innerHTML = "";
      addImageButton.style.display = "block";
    }
  }
});
