document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("#checkInDatePicker").datepicker({
        minDate: "<?php echo $currentDate; ?>"
    });
});