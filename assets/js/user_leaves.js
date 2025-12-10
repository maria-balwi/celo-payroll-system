$(document).ready(function() {

    $('#leaveTable').DataTable({
        order: [] // Disable default sorting
    });

    $(".photoUploadDiv").hide();
    $('#leaveType').on('change', function() {
        var leaveType = $('#leaveType').val();
        if (leaveType == 1 || leaveType == 3 || leaveType == 4 || leaveType == 5) {
            $(".photoUploadDiv").show();
            $("#photoUpload").attr("required", true);
        }
        else {
            $(".photoUploadDiv").hide();
            $("#photoUpload").attr("required", false);
        }
    });

    // FILE LEAVE - UPLOAD MEDICAL CERTIFICATE
    $("#photoUpload").change(function () {
        const [file] = photoUpload.files;
        const acceptedImageTypes = ["image/jpeg", "image/png"];
        if (file) {
            const fileType = file["type"];
            if ($.inArray(fileType, acceptedImageTypes) < 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Invalid Picture",
                    text: "Invalid File only accept (JPG/PNG) file",
                });
                $("#viewPhotoUpload").attr("disabled", true);
            } else {
                $("#viewPhotoUpload").attr("disabled", false); // Enable the view button
            }
        } else {
            $("#viewPhotoUpload").attr("disabled", true); // Disable the view button if no file is selected
        }
    });

    $("#viewPhotoUpload").click(function () {
        const [file] = photoUpload.files;
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                Swal.fire({
                    title: "Upload Photo",
                    imageUrl: e.target.result,
                    imageHeight: 500,
                });
            };
            reader.readAsDataURL(file);
        }
    });

    $("select[id='leaveType']").on("change", function () {
        const leaveDateInput = document.getElementById("effectivityStartDate");
    
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
        } else {
            // Remove the min attribute if the leaveType is not 2
            if (effectivityStartDate) {
                effectivityStartDate.removeAttribute("min");
                effectivityEndDate.removeAttribute("min");
            }
        }
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
                    $("#viewPhotoRow").show();
                    $('#viewLeaveModal').modal('show');
                    
                    $('#viewPhoto').click(function(event) {
                        event.preventDefault();
                        if (res.data.leaveType == "Sick Leave") {
                            const imagePath = '../assets/images/medicalCertificates/' + res.data.photoUpload; // Set your directory path here

                            // VIEW UPLOADED PHOTO IN NEW TAB
                            window.open(imagePath, '_blank');
                        }
                        else if (res.data.leaveType == "Bereavement Leave") {
                            const imagePath = '../assets/images/bereavementLeaves/' + res.data.photoUpload; // Set your directory path here

                            // VIEW UPLOADED PHOTO IN NEW TAB
                            window.open(imagePath, '_blank');
                        }
                        else if (res.data.leaveType == "Maternity Leave") {
                            const imagePath = '../assets/images/maternityLeaves/' + res.data.photoUpload; // Set your directory path here

                            // VIEW UPLOADED PHOTO IN NEW TAB
                            window.open(imagePath, '_blank');
                        }
                        else {
                            const imagePath = '../assets/images/paternityLeaves/' + res.data.photoUpload; // Set your directory path here

                            // VIEW UPLOADED PHOTO IN NEW TAB
                            window.open(imagePath, '_blank');
                        }
                    });
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
                    $("#viewPhotoRow").hide();
                    $('#viewLeaveModal').modal('show');
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
                    $("#viewPhotoRow").show();

                    $("#viewPhoto").click(function (event) {
                        event.preventDefault();
                        if (res.data.leaveType == "Sick Leave") {
                        const imagePath =
                            "../assets/images/medicalCertificates/" +
                            res.data.photoUpload; // Set your directory path here

                        // VIEW UPLOADED PHOTO IN NEW TAB
                        window.open(imagePath, "_blank");
                        } else if (res.data.leaveType == "Bereavement Leave") {
                        const imagePath =
                            "../assets/images/bereavementLeaves/" +
                            res.data.photoUpload; // Set your directory path here

                        // VIEW UPLOADED PHOTO IN NEW TAB
                        window.open(imagePath, "_blank");
                        } else if (res.data.leaveType == "Maternity Leave") {
                        const imagePath =
                            "../assets/images/maternityLeaves/" +
                            res.data.photoUpload; // Set your directory path here

                        // VIEW UPLOADED PHOTO IN NEW TAB
                        window.open(imagePath, "_blank");
                        } else {
                        const imagePath =
                            "../assets/images/paternityLeaves/" +
                            res.data.photoUpload; // Set your directory path here

                        // VIEW UPLOADED PHOTO IN NEW TAB
                        window.open(imagePath, "_blank");
                        }
                    });
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
                    $("#viewPhotoRow").hide();
                }
            }
        });

        $('#btnClose').on('click', function() {
            window.location.reload();
        });
    }
});