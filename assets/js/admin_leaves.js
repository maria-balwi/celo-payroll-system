$(document).ready(function() {

    $('#leavesTable').DataTable();

    // VIEW LEAVE APPLICATION
    var array = [];
    $(document).on('click', '.leaveView', function() {
        var leave_id = $(this).data('id');
        array.push(leave_id);
        var id_leave = array[array.length - 1];

        // VIEW LEAVE
        $.ajax({
            type: "GET",
            url: "../backend/admin/leaveModal.php?leave_id=" + id_leave,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                // LEAVE ALREADY APPROVED
                else if (res.status == 200 && (res.data.status == "Approved" || res.data.status == "Disapproved")) {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    // $('#viewInclusiveDates').val(res.data.effectivityStartDate+' - '+res.data.effectivityEndDate);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#approveLeave').hide();
                    $('#disapproveLeave').hide();
                    $('#viewLeaveModal').modal('show');
                    
                    if (res.data.leaveType == "Sick Leave") {
                        $('#viewMedCertRow').show();

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
                        $('#viewMedCertRow').hide();
                    }
                }
                else if (res.status == 200 && res.data.status == "Pending") {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    // $('#viewInclusiveDates').val(res.data.effectivityStartDate+' - '+res.data.effectivityEndDate);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#viewLeaveModal').modal('show');

                    if (res.data.leaveType == "Sick Leave") {
                        $('#viewMedCertRow').show();

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
                        $('#viewMedCertRow').show();
                    }
                }
            }
        });

        // APPROVE LEAVE APPPLICATION
        $(document).on('click', '.approveLeave', function() {
            var id_leave = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/leaveModal.php?leave_id=" + id_leave,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Approve Leave Application',
                            text: 'Are you sure you want to approve this leave application?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/admin/leaveAction.php",
                                    type: 'POST',
                                    data: {
                                        id_leave: id_leave,
                                        action: 'approve'
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Leave application has been approved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            // window.location.reload();
                                            updateLeaveModal(id_leave);
                                        })
                                    }
                                })
                            }
                        })
                    }
                }
            });
        })

        // DISAPPROVE LEAVE APPPLICATION
        $(document).on('click', '.disapproveLeave', function() {
            var id_leave = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/leaveModal.php?leave_id=" + id_leave,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Disapprove Leave Application',
                            text: 'Are you sure you want to disapprove this leave application?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/admin/leaveAction.php",
                                    type: 'POST',
                                    data: {
                                        id_leave: id_leave,
                                        action: 'disapprove'
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Leave application has been disapproved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            // window.location.reload();
                                            updateLeaveModal(id_leave);
                                        })
                                    }
                                })
                            }
                        })
                    }
                }
            });
        })
    });

    function updateLeaveModal(id_leave) {
        $.ajax({
            type: "GET",
            url: "../backend/admin/leaveModal.php?leave_id=" + id_leave,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $('#viewLeaveID').val(res.data.requestID);
                    $('#viewEmpID').val(res.data.employeeID);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewLeaveType').val(res.data.leaveType);
                    $('#viewStartDate').val(res.data.effectivityStartDate);
                    $('#viewEndDate').val(res.data.effectivityEndDate);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    
                    // Hide the approve/disapprove buttons if the status is updated
                    if (res.data.status == "Approved" || res.data.status == "Disapproved") {
                        $('#approveLeave').hide();
                        $('#disapproveLeave').hide();
                    } else {
                        $('#approveLeave').show();
                        $('#disapproveLeave').show();
                    }
                    
                    if (res.data.leaveType == "Sick Leave") {
                        $('#viewMedCertRow').show();

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
                        $('#viewMedCertRow').hide();
                    }
                }
            }
        });
    }

    $('#btnClose').on('click', function() {
        window.location.reload();
    });
});