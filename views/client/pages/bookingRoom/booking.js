function getRooms() {
    var roomTypeId = document.getElementById("roomTypeSelect").value;
    $.ajax({
        type: "POST",
        url: "index.php?controller=client&action=bookNow", // Tên file PHP xử lý
        data: { roomTypeId: roomTypeId },
        success: function(response) {
            $("#roomList").html(response);
        }
    });
}
