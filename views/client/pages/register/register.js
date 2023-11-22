console.log("vc");

// Sự kiện input cho trường email
document.getElementById("email").addEventListener("input", function () {
    Email();
});

// Sự kiện input cho trường Password
document.getElementById("password").addEventListener("input", function () {
    Password();
});

// Sự kiện input cho trường Confirm Password
document.getElementById("ConfirmPassword").addEventListener("input", function () {
    ConfirmPassword();
});

// Hàm kiểm tra địa chỉ email
function Email() {
    let emailInput = document.getElementById("email");
    let emailError = document.getElementById("emailError");
    let emailValue = emailInput.value;

    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(emailValue)) {
        emailError.textContent = "Please enter a valid email address.";
        emailInput.setCustomValidity("invalid");
    } else {
        emailError.textContent = "";
        emailInput.setCustomValidity("");
    }
}

// Hàm kiểm tra mật khẩu
function Password() {
    let passwordInput = document.getElementById("password");
    let passwordError = document.getElementById("passwordError");
    let passwordValue = passwordInput.value;

    if (passwordValue.length < 6) {
        passwordError.textContent = "Mật khẩu phải nhiều hơn 6 kí tự.";
        passwordInput.setCustomValidity("invalid");
    } else {
        passwordError.textContent = "";
        passwordInput.setCustomValidity("");
    }
}

// Hàm kiểm tra xác nhận mật khẩu
function ConfirmPassword() {
    let passwordInput = document.getElementById("Password");
    let confirmPasswordInput = document.getElementById("ConfirmPassword");
    let confirmPasswordError = document.getElementById("confirmPasswordError");
    let confirmPasswordValue = confirmPasswordInput.value;

    if (confirmPasswordValue !== passwordInput.value) {
        confirmPasswordError.textContent = "Mật khẩu không trùng khớp.";
        confirmPasswordInput.setCustomValidity("invalid");
    } else {
        confirmPasswordError.textContent = "";
        confirmPasswordInput.setCustomValidity("");
    }
}
