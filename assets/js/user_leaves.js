$(document).ready(function() {

    $('#leaveTable').DataTable({
        order: [] // Disable default sorting
    });

    // $(".photoUploadDiv").hide();
    // $('#leaveType').on('change', function() {
    //     var leaveType = $('#leaveType').val();
    //     if (leaveType == 1 || leaveType == 3 || leaveType == 4 || leaveType == 5) {
    //         $(".photoUploadDiv").show();
    //         $("#photoUpload").attr("required", true);
    //     }
    //     else {
    //         $(".photoUploadDiv").hide();
    //         $("#photoUpload").attr("required", false);
    //     }
    // });

    $(".attachmentDiv").hide();
    $('#leaveType').on('change', function() {
        var leaveType = $('#leaveType').val();
        if (leaveType == 1 || leaveType == 3 || leaveType == 4 || leaveType == 5) {
            $(".attachmentDiv").show();
        }
        else {
            $(".attachmentDiv").hide();
        }
    });
    
    $(".viewWithAttachmentRow").hide();
    $(".viewWithoutAttachmentRow").hide();

    // // FILE LEAVE - UPLOAD MEDICAL CERTIFICATE
    // $("#photoUpload").change(function () {
    //     const [file] = photoUpload.files;
    //     const acceptedImageTypes = ["image/jpeg", "image/png"];
    //     if (file) {
    //         const fileType = file["type"];
    //         if ($.inArray(fileType, acceptedImageTypes) < 0) {
    //             Swal.fire({
    //                 icon: "warning",
    //                 title: "Invalid Picture",
    //                 text: "Invalid File only accept (JPG/PNG) file",
    //             });
    //             $("#viewPhotoUpload").attr("disabled", true);
    //         } else {
    //             $("#viewPhotoUpload").attr("disabled", false); // Enable the view button
    //         }
    //     } else {
    //         $("#viewPhotoUpload").attr("disabled", true); // Disable the view button if no file is selected
    //     }
    // });

    // $("#viewPhotoUpload").click(function () {
    //     const [file] = photoUpload.files;
    //     if (file) {
    //         const reader = new FileReader();
    //         reader.onload = (e) => {
    //             Swal.fire({
    //                 title: "Upload Photo",
    //                 imageUrl: e.target.result,
    //                 imageHeight: 500,
    //             });
    //         };
    //         reader.readAsDataURL(file);
    //     }
    // });

    $("select[id='leaveType']").on("change", function () {
        // const leaveDateInput = document.getElementById("effectivityStartDate");
    
        if ($(this).val() == 2) {
            // Get today's date
            const today = new Date();
    
            // Calculate the minimum date (14 days from today)
            const minDate = new Date(today);
            minDate.setDate(today.getDate() + 14);
    
            // Format the date as YYYY-MM-DD
            const year = minDate.getFullYear();
            const month = String(minDate.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
            const day = String(minDate.getDate()).padStart(2, '0');
            const formattedMinDate = `${year}-${month}-${day}`;
    
            // Set the minimum date attribute on the date input
            const effectivityStartDate = document.getElementById("effectivityStartDate");
            const effectivityEndDate = document.getElementById("effectivityEndDate");
            effectivityStartDate.setAttribute("min", formattedMinDate);
            effectivityEndDate.setAttribute("min", formattedMinDate);
        } 
        else if ($(this).val() == 3) {
            document.getElementById("effectivityStartDate").addEventListener("change", function () {
                const startDateValue = this.value; // YYYY-MM-DD

                if (!startDateValue) return;

                // Convert to Date object
                const startDate = new Date(startDateValue);

                // Add 7 days
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + 4);

                // Format to YYYY-MM-DD
                const year = endDate.getFullYear();
                const month = String(endDate.getMonth() + 1).padStart(2, "0");
                const day = String(endDate.getDate()).padStart(2, "0");
                const formattedEndDate = `${year}-${month}-${day}`;

                // Set the value of the end date input
                document.getElementById("effectivityEndDate").value = formattedEndDate;

                // Make the end date readonly
                effectivityEndDate.setAttribute("readonly", true);
            });
        }
        else if ($(this).val() == 5) {
            document.getElementById("effectivityStartDate").addEventListener("change", function () {
                const startDateValue = this.value; // YYYY-MM-DD

                if (!startDateValue) return;

                // Convert to Date object
                const startDate = new Date(startDateValue);

                // Add 7 days
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + 6);

                // Format to YYYY-MM-DD
                const year = endDate.getFullYear();
                const month = String(endDate.getMonth() + 1).padStart(2, "0");
                const day = String(endDate.getDate()).padStart(2, "0");
                const formattedEndDate = `${year}-${month}-${day}`;

                // Set the value of the end date input
                document.getElementById("effectivityEndDate").value = formattedEndDate;

                // Make the end date readonly
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
                else if (res.status == 200 && (res.data.leaveType == "Sick Leave" || res.data.leaveType == "Bereavement Leave" || res.data.leaveType == "Maternity Leave" || res.data.leaveType == "Paternity Leave")) {
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
                } else if (res.status == 200 && (res.data.leaveType == "Sick Leave") || (res.data.leaveType == "Bereavement Leave") || (res.data.leaveType == "Maternity Leave") || (res.data.leaveType == "Paternity Leave")) {
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