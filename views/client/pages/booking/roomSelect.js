  // window.addEventListener('beforeunload', function(e) {
    //     var confirmationMessage = 'Bạn có chắc muốn tải lại trang?';
    //     e.returnValue = confirmationMessage;

    // });\
    document.addEventListener('DOMContentLoaded', function() {
        var selectedRooms = [];
        const btnSelectRooms = document.querySelectorAll('.selectRoom');

        btnSelectRooms.forEach(function(btn, index) {
            btn.addEventListener('click', function() {
                let roomName = btn.getAttribute('data-nameRoom') || '';
                let roomPrice = btn.getAttribute('data-price') || '';
                let roomCapacity = btn.getAttribute('data-person') || '';
                let roomID = btn.getAttribute('data-room') || '';
                selectedRooms.push({
                    roomName,
                    roomPrice,
                    roomCapacity,
                    roomID
                });
                displaySelectedRooms();
            });
        });

        function displaySelectedRooms() {
            selectedRooms.forEach(function(room, index) {
                console.log("Các phòng đã chọn:", selectedRooms);

                let roomFormsContainer = document.getElementById(`roomSelectionForm-${index + 1}`);
                if (roomFormsContainer) {
                    roomFormsContainer.innerHTML = `
               <div id="hpn-${index + 1}">
               <div class="d-flex justify-content-between customRoomLabel">
                    <div class="itemLeft">
                        <p data-Room="${room.roomID}" data-price="${room.roomPrice}">Loại phòng: ${room.roomName}</p>
                        <p>Số lượng người: ${room.roomCapacity}</p>
                    </div>
                    <div class="itemRight">
                        <p style=" margin: 0;">${room.roomPrice}VNĐ</p>
                        <button style="float: right" type="button" class="remove-room-button">Xóa</button>
                    </div>
                </div>
                </div>
            `;

                    let removeButton = roomFormsContainer.querySelector('.remove-room-button');
                    if (!removeButton.hasEventListener) {
                        removeButton.hasEventListener = true;
                        removeButton.addEventListener('click', function() {
                            removeRoomW(index + 1);
                        });
                    }
                } else {
                    console.error(`Không tìm thấy container với id roomSelectionForm-${index + 1}`);
                }
            });

            let numContainers = selectedRooms.length;
            updateRoomSelectionContainers(numContainers);
        }

    });

    function removeRoomW(index) {
        console.log("Đang xóa phòng tại index:", index);
        let roomFormsContainerToRemove = document.getElementById(`hpn-${index}`);
        if (roomFormsContainerToRemove) {
            roomFormsContainerToRemove.remove();
        }
        let roomFormsContainer = document.getElementById(`roomSelectionForm-${index}`);
        if (roomFormsContainer) {
            roomFormsContainer.innerHTML = `
                                            <span>Chọn phòng ${index}</span>
            `
        }
    }

    function updateRoomSelectionContainers(numContainers) {
        for (let i = 1; i <= numContainers; i++) {
            let roomSelectionContainer = document.querySelector(`.room-selection-container:nth-child(${i})`);
            if (!roomSelectionContainer) {
                console.error(`Không tìm thấy room-selection-container thứ ${i}`);
                return;
            }
        }
    }


    let formCount = 1;
    const maxForms = 3;

    function addPerson() {
        if (formCount < maxForms) {
            let roomFormsContainer = document.getElementById('roomForms');
            let newRoomForm = document.createElement('div');
            newRoomForm.className = 'form-group room-form';
            newRoomForm.innerHTML = `
  <label for="personSelect${formCount + 1}">Phòng ${formCount + 1} - Số Người:</label>
  <button style="float: right" type="button" onclick="removePerson(this)">Xóa</button>
  <select class="custom-select" id="personSelect${formCount + 1}" name="personSelect${formCount + 1}">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>
`;
            roomFormsContainer.appendChild(newRoomForm);
            formCount++;

            if (formCount === maxForms) {
                document.getElementById('addButton').style.display = 'none';
            }
        }
    }

    let displayedRooms = [];

    function displayRoomSelectionForm(formCount) {
        if (formCount > 1 && !displayedRooms.includes(formCount)) {
            let roomSelectionFormsContainer = document.querySelector('.choose-rooms');
            let newRoomSelectionForm = document.createElement('div');
            newRoomSelectionForm.className = 'col-lg-12 room-selection-container';
            newRoomSelectionForm.innerHTML = `
            <div class="choose-room" id="roomSelectionForm-${formCount}">
                <span>Chọn phòng ${formCount}</span>
            </div>
        `;
            roomSelectionFormsContainer.appendChild(newRoomSelectionForm);
            displayedRooms.push(formCount);
        }
    }

    function initializeRoomFormsFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        for (let i = 2; i <= 3; i++) {
            let personValue = urlParams.get(`person${i}`);
            if (personValue) {
                console.log(`Initializing room ${i} with value ${personValue}`);
                displayRoomSelectionForm(i);
                addRoomAndSelect(i, personValue);
            }
        }
    }

    function addRoomAndSelect(formCount, personValue) {
        let roomFormsContainer = document.getElementById('roomForms');
        if (roomFormsContainer) {
            let newRoomForm = document.createElement('div');
            newRoomForm.className = 'form-group room-form';
            newRoomForm.innerHTML = `
            <label for="personSelect${formCount}">Phòng ${formCount} - Số Người:</label>
            <button style="float: right" type="button" onclick="removePerson(this)">Xóa</button>
            <select class="custom-select" id="personSelect${formCount}" name="personSelect${formCount}">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        `;
            roomFormsContainer.appendChild(newRoomForm);

            let additionalPersonSelect = document.getElementById(`personSelect${formCount}`);
            console.log(additionalPersonSelect);
            if (additionalPersonSelect) {
                additionalPersonSelect.value = personValue;
            }

            if (formCount === maxForms) {
                document.getElementById('addButton').style.display = 'none';
            }
        }
    }


    function initializeRoomSelectionFormsFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        for (let i = 2; i <= 3; i++) {
            let personValue = urlParams.get(`person${i}`);
            if (personValue) {
                displayRoomSelectionForm(i);
            }
        }
    }

    window.addEventListener('DOMContentLoaded', function() {
        initializeRoomFormsFromURL();
        initializeRoomSelectionFormsFromURL();
    });


    function removePerson(button) {
        if (formCount > 1) {
            let roomForm = button.parentElement;
            let roomFormsContainer = document.getElementById('roomForms');
            let lastRoomForm = roomFormsContainer.lastChild;

            if (roomForm === lastRoomForm) {
                roomForm.remove();
                formCount--;

                if (formCount < maxForms) {
                    document.getElementById('addButton').style.display = 'block';
                }

            }
        }
    }

    function removeQueryStringParameter(key) {
        let currentUrl = window.location.href;
        let urlParts = currentUrl.split('?');

        if (urlParts.length >= 2) {
            let prefix = encodeURIComponent(key) + '=';
            let params = urlParts[1].split(/[&;]/g);
            for (let i = params.length; i-- > 0;) {
                if (params[i].lastIndexOf(prefix, 0) !== -1) {
                    params.splice(i, 1);
                }
            }

            currentUrl = urlParts[0] + (params.length > 0 ? '?' + params.join('&') : '');
            history.pushState({}, '', currentUrl);
        }
    }

    function applyChangesURL() {
        let currentUrl = window.location.href;
        let newUrl = currentUrl;
        let personSelectValue = document.getElementById('personSelect').value;
        newUrl = updateQueryStringParameter(newUrl, 'person', personSelectValue);

        for (let i = 2; i <= formCount; i++) {
            let additionalPersonSelect = document.getElementById(`personSelect${i}`);
            newUrl = updateQueryStringParameter(newUrl, `person${i}`, additionalPersonSelect.value);
        }

        history.pushState({}, '', newUrl);
    }



    function updateQueryStringParameter(uri, key, value) {
        let re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        let separator = uri.indexOf('?') !== -1 ? "&" : "?";

        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            return uri + separator + key + "=" + value;
        }
    }

    function clearQueryString() {
        for (let i = 2; i <= 3; i++) {
            removeQueryStringParameter(`person${i}`);
        }
    }
    document.getElementById('applyButton').addEventListener('click', function() {
        applyChangesURL();
        clearQueryString();
        displayRoomSelectionForm(formCount);
    });
    document.addEventListener("DOMContentLoaded", function () {
        let checkinDate = this.getAttribute("data-checkin");
        let checkoutDate = this.getAttribute("data-checkout");

        let dataRoomElement1 = document.querySelector("#hpn-1 .customRoomLabel .itemLeft p[data-room] ");
        let dataRoomElement2 = document.querySelector("#hpn-2 .customRoomLabel .itemLeft p[data-room] ");
        let dataRoomElement3 = document.querySelector("#hpn-3 .customRoomLabel .itemLeft p[data-room] ");

        let dataRoomValue1 = dataRoomElement1 ? dataRoomElement1.getAttribute("data-room") : null;
        let dataRoomValue2 = dataRoomElement2 ? dataRoomElement2.getAttribute("data-room") : null;
        let dataRoomValue3 = dataRoomElement3 ? dataRoomElement3.getAttribute("data-room") : null;
        let dataRoomPrice1 = dataRoomElement1 ? dataRoomElement1.getAttribute("data-price") : null;
        let dataRoomPrice2 = dataRoomElement2 ? dataRoomElement2.getAttribute("data-price") : null;
        let dataRoomPrice3 = dataRoomElement3 ? dataRoomElement3.getAttribute("data-price") : null;

        if (dataRoomValue1 && dataRoomValue2 && dataRoomValue3) {
            window.location.href = "index.php?controller=client&action=secureBooking&checkin_date=" +
                checkinDate +
                "&checkout_date=" +
                checkoutDate +
                "&Room1=" +
                dataRoomValue1 +
                "&price1=" +
                dataRoomPrice1
                "&Room2=" +
                dataRoomValue2 +
                "&price2=" +
                dataRoomPrice2
                "&Room3=" +
                dataRoomValue3
                "&price3=" +
                dataRoomPrice3;
        } else if (dataRoomValue1 && dataRoomValue2) {
            window.location.href = "index.php?controller=client&action=secureBooking&checkin_date=" +
                checkinDate +
                "&checkout_date=" +
                checkoutDate +
                "&Room1=" +
                dataRoomValue1 +
                "&price1=" +
                dataRoomPrice1 +
                "&Room2=" +
                dataRoomValue2 +
                "&price2=" +
                dataRoomPrice2;
        } else if (dataRoomValue1) {
            window.location.href = "index.php?controller=client&action=secureBooking&checkin_date=" +
                checkinDate +
                "&checkout_date=" +
                checkoutDate +
                "&Room1=" +
                dataRoomValue1 +
                "&price1=" +
                dataRoomPrice1;
        }  else {
            console.log("Không thể lấy giá trị data-room.");
        }
    });