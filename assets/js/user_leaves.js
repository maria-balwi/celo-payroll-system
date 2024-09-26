$(document).ready(function() {

    $('#leaveTable').DataTable();

    $('.medCertDiv').hide();
    $('#leaveType').on('change', function() {
        var leaveType = $('#leaveType').val();
        if (leaveType == 1) {
            $('.medCertDiv').show();
            $('#medCert').attr('required', true);
        }
        else {
            $('.medCertDiv').hide();
            $('#medCert').attr('required', false);
        }
    });

    // FILE LEAVE - UPLOAD MEDICAL CERTIFICATE
    $('#medCert').change(function() {
        const [file] = medCert.files;
        const acceptedImageTypes = ['image/jpeg', 'image/png'];
        if (file) {
            const fileType = file['type'];
            if ($.inArray(fileType, acceptedImageTypes) < 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Picture',
                    text: 'Invalid File only accept (JPG/PNG) file',
                })
                $('#viewMedCert').attr('disabled', true);
            } else {
                $('#viewMedCert').attr('disabled', false);  // Enable the view button
            }
        } else {
            $('#viewMedCert').attr('disabled', true);  // Disable the view button if no file is selected
        }
    });

    $('#viewMedCert').click(function() {
        const [file] = medCert.files;
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                Swal.fire({
                    title: 'Medical Certificate',
                    imageUrl: e.target.result,
                    imageHeight: 500,
                });
            }
            reader.readAsDataURL(file);
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
                                    // window.location.reload();
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
                else if (res.status == 200 && res.data.leaveType == "Sick Leave") {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#viewMedCertRow').show();
                    $('#viewLeaveModal').modal('show');
                    
                    $('#viewMedicalCert').click(function(event) {
                        event.preventDefault();
                        
                        const imagePath = '../assets/images/medicalCertificates/' + res.data.medCert; // Set your directory path here
                        
                        // VIEW MEDICAL CERTIFICATE IN NEW TAB
                        window.open(imagePath, '_blank');

                        // VIEW MEDICAL CERTIFICATE IN MODAL
                        // Use the fetch API to check if the image exists
                        // fetch(imagePath)
                        //     .then(response => {
                        //         if (response.ok) {
                        //             Swal.fire({
                        //                 title: 'Medical Certificate',
                        //                 imageUrl: imagePath,
                        //                 imageHeight: 500,
                        //             });
                        //         }
                        //     })
                        //     .catch(error => {
                        //         Swal.fire({
                        //             icon: 'error',
                        //             title: 'Error',
                        //             text: 'An error occurred while fetching the image.',
                        //         });
                        //         console.error('Error fetching image:', error);
                        //     });
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
                    $('#viewMedCertRow').hide();
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
                } 
                else if (res.status == 200) {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                }
            }
        });

        $('#btnClose').on('click', function() {
            window.location.reload();
        });
    }
});