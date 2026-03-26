$(document).ready(function() {

    $('#leaveTable').DataTable({
        order: [] // Disable default sorting
    });

    $(".attachmentDiv").hide();
    $('#leaveType').on('change', function() {
        var leaveType = $('#leaveType').val();
        if (leaveType == 1 || leaveType == 3 || leaveType == 4 || leaveType == 5 || leaveType == 6 || leaveType == 7 || leaveType == 8) {
            $(".attachmentDiv").show();
        }
        else {
            $(".attachmentDiv").hide();
        }
    });
    
    $(".viewWithAttachmentRow").hide();
    $(".viewWithoutAttachmentRow").hide();


    $("select[id='leaveType']").on("change", function () {
        if ($(this).val() == 2) { // VACATION LEAVE
            // GET DATE TODAY
            const today = new Date();
    
            // ADD 14 DAYS FROM TODAY FOR ADVANCE FILING OF VL
            const minDate = new Date(today);
            minDate.setDate(today.getDate() + 14);
    
            // FORMAT DATE AS YYYY-MM-DD
            const year = minDate.getFullYear();
            const month = String(minDate.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
            const day = String(minDate.getDate()).padStart(2, '0');
            const formattedMinDate = `${year}-${month}-${day}`;
    
            // SET THE MINIMUM DATE ATTRIBUTE ON THE DATE INPUT
            const effectivityStartDate = document.getElementById("effectivityStartDate");
            const effectivityEndDate = document.getElementById("effectivityEndDate");
            effectivityStartDate.setAttribute("min", formattedMinDate);
            effectivityEndDate.setAttribute("min", formattedMinDate);
        } 
        else if ($(this).val() == 3) { // BEREAVEMENT LEAVE
            document.getElementById("effectivityStartDate").addEventListener("change", function () {
                const startDateValue = this.value; // YYYY-MM-DD

                if (!startDateValue) return;

                const startDate = new Date(startDateValue);

                // ADD 5 DAYS
                const maxDate = new Date(startDate);
                maxDate.setDate(startDate.getDate() + 4);

                // FORMAT FUNCTION
                function formatDate(date) {
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, "0");
                    const day = String(date.getDate()).padStart(2, "0");
                    return `${year}-${month}-${day}`;
                }

                const effectivityEndDate = document.getElementById("effectivityEndDate");

                // SET THE MINIMUM AND MAXIMUM DATE FOR EACH INPUT
                effectivityEndDate.min = formatDate(startDate);
                effectivityEndDate.max = formatDate(maxDate);
            });
        }
        else if ($(this).val() == 4) { // MATERNITY LEAVE
            document.getElementById("effectivityStartDate").addEventListener("change", function () {
                const startDateValue = this.value; // YYYY-MM-DD

                if (!startDateValue) return;

                // CONVERT TO DATE OBJECT 
                const startDate = new Date(startDateValue);

                // Add 105 days
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + 104);

                // FORMAT TO YYYY-MM-DD
                const year = endDate.getFullYear();
                const month = String(endDate.getMonth() + 1).padStart(2, "0");
                const day = String(endDate.getDate()).padStart(2, "0");
                const formattedEndDate = `${year}-${month}-${day}`;

                // SET THE VALUE OF THE END DATE INPUT
                document.getElementById("effectivityEndDate").value = formattedEndDate;

                // MAKE THE END DATE READONLY
                effectivityEndDate.setAttribute("readonly", true);
            });
        }
        else if ($(this).val() == 5) { // MATERNITY LEAVE - SOLO PARENT
            document.getElementById("effectivityStartDate").addEventListener("change", function () {
                const startDateValue = this.value; // YYYY-MM-DD

                if (!startDateValue) return;

                // CONVERT TO DATE OBJECT 
                const startDate = new Date(startDateValue);

                // ADD 120 DAYS
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + 119);

                // FORMAT TO YYYY-MM-DD
                const year = endDate.getFullYear();
                const month = String(endDate.getMonth() + 1).padStart(2, "0");
                const day = String(endDate.getDate()).padStart(2, "0");
                const formattedEndDate = `${year}-${month}-${day}`;

                // SET THE VALUE OF THE END DATE INPUT
                document.getElementById("effectivityEndDate").value = formattedEndDate;

                // MAKE THE END DATE READONLY
                effectivityEndDate.setAttribute("readonly", true);
            });
        }
        else if ($(this).val() == 6) { // MATERNITY LEAVE - MISCARRIAGE
            document.getElementById("effectivityStartDate").addEventListener("change", function () {
                const startDateValue = this.value; // YYYY-MM-DD

                if (!startDateValue) return;

                // CONVERT TO DATE OBJECT 
                const startDate = new Date(startDateValue);

                // ADD 60 DAYS
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + 59);

                // FORMAT TO YYYY-MM-DD
                const year = endDate.getFullYear();
                const month = String(endDate.getMonth() + 1).padStart(2, "0");
                const day = String(endDate.getDate()).padStart(2, "0");
                const formattedEndDate = `${year}-${month}-${day}`;

                // SET THE VALUE OF THE END DATE INPUT
                document.getElementById("effectivityEndDate").value = formattedEndDate;

                // MAKE THE END DATE READONLY
                effectivityEndDate.setAttribute("readonly", true);
            });
        }
        else if ($(this).val() == 7 || $(this).val() == 8) { // PATERNITY AND SOLO PARENT LEAVE
            document.getElementById("effectivityStartDate").addEventListener("change", function () {
                const startDateValue = this.value; // YYYY-MM-DD

                if (!startDateValue) return;

                // CONVERT TO DATE OBJECT 
                const startDate = new Date(startDateValue);

                // ADD 7 DAYS
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + 6);

                // FORMAT TO YYYY-MM-DD
                const year = endDate.getFullYear();
                const month = String(endDate.getMonth() + 1).padStart(2, "0");
                const day = String(endDate.getDate()).padStart(2, "0");
                const formattedEndDate = `${year}-${month}-${day}`;

                // SET THE VALUE OF THE END DATE INPUT
                document.getElementById("effectivityEndDate").value = formattedEndDate;

                // MAKE THE END DATE READONLY
                effectivityEndDate.setAttribute("readonly", true);
            });
        } 
        else {
            // Remove the min attribute if the leaveType is not 2
            if (effectivityStartDate) {
                effectivityStartDate.removeAttribute("min");
                effectivityEndDate.removeAttribute("min");
            }
        }
    });
    
    $("input.attachment[type='checkbox']").on("change", function () {
        const $checkboxes = $("input.attachment[type='checkbox']");
        const checkedCount = $checkboxes.filter(":checked").length;

        if (checkedCount >= 1) {
            // Disable all unchecked boxes
            $checkboxes.not(":checked").prop("disabled", true);
        } else {
            // Re-enable all boxes
            $checkboxes.prop("disabled", false);
        }
    });

    // 90-DAY LIMITATION
    const today = new Date();
    const minDate = new Date(today);
    minDate.setDate(minDate.getDate() - 90);

    function formatDate(date) {
        let month = '' + (date.getMonth() + 1);
        let day = '' + date.getDate();
        const year = date.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }

    $("#effectivityStartDate").attr({
        min: formatDate(minDate),
    });

    $("#effectivityEndDate").attr({
        min: formatDate(minDate),
    });

    // FILE A LEAVE BUTTON
    $("#fileLeaveForm").submit(function (e) {

        e.preventDefault();

        let fileLeaveForm = new FormData(this);
        var leaveType = $('#leaveType').val();
        var startDate = $('#effectivityStartDate').val();
        var endDate = $('#effectivityEndDate').val();
        var purpose = $('#purpose').val();

        if (leaveType == "" || startDate == "" || endDate == "" || purpose == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
        } else {
            Swal.fire({
                icon: 'question',
                title: 'Submit File Leave',
                text: 'Are you sure you want to file this leave?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "../backend/user/fileLeave.php",
                        data: fileLeaveForm,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            const data = JSON.parse(response);
                            var message = data.em
                            if (data.error == 0) {
                                var id = data.id;
                                loadEmployeeData(id);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false,
                                }).then(() => {
                                    $('#fileLeaveModal').modal('hide');
                                    $('#viewLeaveModal').modal('show');
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: message,
                                })
                            }
                        }
                    })
                }
            })
        }
    })

    // VIEW LEAVE APPLICATION
    var array = [];
    $(document).on('click', '.leaveView', function() {
        var leave_id = $(this).data('id');
        array.push(leave_id);
        var id_leave = array[array.length - 1];

        // VIEW LEAVE
        $.ajax({
            type: "GET",
            url: "../backend/user/leaveModal.php?leave_id=" + id_leave,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.leaveType == "Sick Leave" || res.data.leaveType == "Bereavement Leave" || res.data.leaveType == "Maternity Leave" || 
                    res.data.leaveType == "Maternity Leave - Solo Parent" || res.data.leaveType == "Maternity Leave - Miscarriage" || res.data.leaveType == "Paternity Leave" || res.data.leaveType == "Solo Parent Leave")) {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    
                    // $('#viewPhoto').click(function(event) {
                    //     event.preventDefault();
                    //     if (res.data.leaveType == "Sick Leave") {
                    //         const imagePath = '../assets/images/medicalCertificates/' + res.data.photoUpload; // Set your directory path here

                    //         // VIEW UPLOADED PHOTO IN NEW TAB
                    //         window.open(imagePath, '_blank');
                    //     }
                    //     else if (res.data.leaveType == "Bereavement Leave") {
                    //         const imagePath = '../assets/images/bereavementLeaves/' + res.data.photoUpload; // Set your directory path here

                    //         // VIEW UPLOADED PHOTO IN NEW TAB
                    //         window.open(imagePath, '_blank');
                    //     }
                    //     else if (res.data.leaveType == "Maternity Leave") {
                    //         const imagePath = '../assets/images/maternityLeaves/' + res.data.photoUpload; // Set your directory path here

                    //         // VIEW UPLOADED PHOTO IN NEW TAB
                    //         window.open(imagePath, '_blank');
                    //     }
                    //     else {
                    //         const imagePath = '../assets/images/paternityLeaves/' + res.data.photoUpload; // Set your directory path here

                    //         // VIEW UPLOADED PHOTO IN NEW TAB
                    //         window.open(imagePath, '_blank');
                    //     }
                    // });
                    if (res.data.attachment == 1) {
                        $("#viewWithAttachmentRow").show();
                        $("#viewWithoutAttachmentRow").hide();
                    }
                    else if (res.data.attachment == 0) {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").show();
                    }
                    else {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").hide();
                    }
                    $("#viewLeaveModal").modal("show");
                }
                else {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $("#viewWithAttachmentRow").hide();
                    $("#viewWithoutAttachmentRow").hide();
                    $("#viewLeaveModal").modal("show");
                }
            }
        });
    });

    function loadEmployeeData(id_leave) {
        $.ajax({
            type: "GET",
            url: "../backend/user/leaveModal.php?leave_id=" + id_leave,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200 && (res.data.leaveType == "Sick Leave" || res.data.leaveType == "Bereavement Leave" || res.data.leaveType == "Maternity Leave" || 
                    res.data.leaveType == "Maternity Leave - Solo Parent" || res.data.leaveType == "Maternity Leave - Miscarriage" || res.data.leaveType == "Paternity Leave" || res.data.leaveType == "Solo Parent Leave")){
                    $("#viewLeaveID").val(res.data.requestID);
                    $("#viewEmpID").val(res.data.employeeID);
                    $("#viewDateFiled").val(res.data.dateFiled);
                    $("#viewName").val(res.data.employeeName);
                    $("#viewLeaveType").val(res.data.leaveType);
                    $("#viewStartDate").val(res.data.effectivityStartDate);
                    $("#viewEndDate").val(res.data.effectivityEndDate);
                    $("#viewPurpose").val(res.data.remarks);
                    $("#viewStatus").val(res.data.status);
                    // $("#viewPhotoRow").show();

                    // $("#viewPhoto").click(function (event) {
                    //     event.preventDefault();
                    //     if (res.data.leaveType == "Sick Leave") {
                    //     const imagePath =
                    //         "../assets/images/medicalCertificates/" +
                    //         res.data.photoUpload; // Set your directory path here

                    //     // VIEW UPLOADED PHOTO IN NEW TAB
                    //     window.open(imagePath, "_blank");
                    //     } else if (res.data.leaveType == "Bereavement Leave") {
                    //     const imagePath =
                    //         "../assets/images/bereavementLeaves/" +
                    //         res.data.photoUpload; // Set your directory path here

                    //     // VIEW UPLOADED PHOTO IN NEW TAB
                    //     window.open(imagePath, "_blank");
                    //     } else if (res.data.leaveType == "Maternity Leave") {
                    //     const imagePath =
                    //         "../assets/images/maternityLeaves/" +
                    //         res.data.photoUpload; // Set your directory path here

                    //     // VIEW UPLOADED PHOTO IN NEW TAB
                    //     window.open(imagePath, "_blank");
                    //     } else {
                    //     const imagePath =
                    //         "../assets/images/paternityLeaves/" +
                    //         res.data.photoUpload; // Set your directory path here

                    //     // VIEW UPLOADED PHOTO IN NEW TAB
                    //     window.open(imagePath, "_blank");
                    //     }
                    // });
                    if (res.data.attachment == 1) {
                        $("#viewWithAttachmentRow").show();
                        $("#viewWithoutAttachmentRow").hide();
                    } else if (res.data.attachment == 0) {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").show();
                    } else {
                        $("#viewWithAttachmentRow").hide();
                        $("#viewWithoutAttachmentRow").hide();
                    }
                } else {
                    $("#viewLeaveID").val(res.data.requestID);
                    $("#viewEmpID").val(res.data.employeeID);
                    $("#viewDateFiled").val(res.data.dateFiled);
                    $("#viewName").val(res.data.employeeName);
                    $("#viewLeaveType").val(res.data.leaveType);
                    $("#viewStartDate").val(res.data.effectivityStartDate);
                    $("#viewEndDate").val(res.data.effectivityEndDate);
                    $("#viewPurpose").val(res.data.remarks);
                    $("#viewStatus").val(res.data.status);
                    // $("#viewPhotoRow").hide();
                }
            }
        });

        $('#btnClose').on('click', function() {
            window.location.reload();
        });
    }
});