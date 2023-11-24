document.addEventListener("DOMContentLoaded", function () {
    let currentDate = new Date();
    let formattedDate = currentDate.getDate() + '/' + (currentDate.getMonth() + 1) + '/' + currentDate.getFullYear();
    document.getElementById('datetimepicker').value = formattedDate;
    document.getElementById('datetimepicker-check').value = formattedDate;
});