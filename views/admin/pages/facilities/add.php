<div class="col-12 grid-margin stretch-card h-100">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm Cơ sở</h4>
            <?php
            if (isset($message) && ($message != ""))
                echo "<div id='customAlert' class='alert alert-success position-fixed top-0 end-0' role='alert' style='display: none;'>
                   $message
                   </div>";

            ?>

            <form action="/DUAN1/index.php?controller=admin&action=addFacility" method="POST" class="forms-sample" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="Name">Tên Cơ Sở</label>
                    <input type="text" class="form-control" id="Name" name="name" placeholder="Tên Cở Sở">
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="Email" class="form-control" id="Email" name="email" placeholder="Địa chỉ Email">
                    <span id="emailError" style="color: red;"></span>
                </div>
                <div class="form-group">
                    <label for="Phone">Số điện thoại</label>
                    <input type="tel" class="form-control" id="Phone" name="phone_number" placeholder="Số điện thoại">
                </div>
                <div class="form-group">
                    <label for="Rank">Xếp loại</label>
                    <input type="text" class="form-control" id="Rank" name="starts" placeholder="VD: 4 sao">
                </div>
                <div class="form-group">
                    <label for="Description">Mô tả</label>
                    <input type="text" class="form-control" id="Description" name="description" placeholder="Nhập mô tả">
                </div>
                <div class="form-group">
                    <label for="Address">Địa chỉ</label>
                    <input type="text" class="form-control" id="Address" name="address" placeholder="Nhập địa chỉ">
                </div>
                <!-- <div class="form-group">
                    <label>Hình ảnh</label>
                    <input type="file" name="img[]" class="file-upload-default">
                    <div class="input-group col-xs-12">
                        <span class="input-group-append custom_image">
                            <div id="imageOverlay" class="image-overlay">
                                <img id="overlayImage" src="" alt="Full Image Preview" class="overlay-image">
                                <button id="deleteImage" class="delete-button">Delete</button>
                            </div>

                            <div id="img-previews"></div>
                            <input style="display: none" type="file" class="form-control-file" id="imageInput"
                                name="imageInput" accept="image/*">
                            <button id="uploadImage" class="btn btn-upload" type="button">+ Upload</button>
                        </span>

                    </div>
                </div> -->
                <button type="submit" name="submitButton" class="btn btn-gradient-primary me-2">Submit</button>
                <a href="index.php?controller=admin&action=facilityList">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</div>
<!-- <script>
    function validateForm() {
  var name = document.getElementById("Name").value;
  var email = document.getElementById("Email").value;
  var phone = document.getElementById("Phone").value;
  var rank = document.getElementById("Rank").value;
  var Description = document.getElementById("Description").value;
  var Address = document.getElementById("Address").value;

  if (
    name === "" ||
    email === "" ||
    phone === "" ||
    rank === "0" ||
    Description === "0" ||
    Address === "0"
  ) {
    alert("Vui lòng điền đầy đủ thông tin và chọn tùy chọn hợp lệ");
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
  var email = document.getElementById("email").value;
  var phone = document.getElementById("phone").value;
  var rank = document.getElementById("rank").value;
  var Description = document.getElementById("Description").value;
  var Address = document.getElementById("Address").value;


  document.getElementById("submitButton").disabled = !(
    name !== "" &&
    email !== "" &&
    phone !== "" &&
    rank !== "0" &&
    Description !== "0" &&
    Address !== "0"
  );
}
</script> -->