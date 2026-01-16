$(document).ready(function() {

    $('#overtimeTable').DataTable({
        order: [] // Disable default sorting
    });
    // var overtimeTable = $('#overtimeTable').DataTable();
    // overtimeTable.order([[0, "desc"], [1, "desc"]]).draw();

    $('#approveOT').hide();
    $('#disapproveOT').hide();
    
    // VIEW FILED OT
    var array = [];
    $(document).on('click', '.filedOTview', function() {
        var ot_id = $(this).data('id');
        var designationID = $(this).data('designation');
        console.log({designationID});
        array.push(ot_id);
        var id_ot = array[array.length - 1];

        // VIEW FILED OT
        $.ajax({
            type: "GET",
            url: "../backend/admin/filedOTModal.php?ot_id=" + id_ot,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                var userDept = $('#userDept').val();

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.status == 1 || res.data.status == 0)) {
                    $('#viewFiledOTID').val(res.data.requestID);
                    $('#viewOTDate').val(res.data.otDate);
                    $('#viewOTType').val(res.data.otType);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewFromTime').val(res.data.fromTime);
                    $('#viewToTime').val(res.data.toTime);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status == 1 ? 'Approved' : 'Disapproved');
                    $('#approveOT').hide();
                    $('#disapproveOT').hide();
                    $('#viewFiledOTModal').modal('show');
                }
                else if (res.status == 200 && (userDept == 3 && res.data.status == null)) {
                    $('#viewFiledOTID').val(res.data.requestID);
                    $('#viewOTDate').val(res.data.otDate);
                    $('#viewOTType').val(res.data.otType);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewFromTime').val(res.data.fromTime);
                    $('#viewToTime').val(res.data.toTime);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val('Pending');
                    $('#viewFiledOTModal').modal('show');

                    if (res.isCheck) {
                        $('#approveOT').show();
                        $('#disapproveOT').show();
                    }
                }
                else if (res.status == 200 && (userDept == 5 && res.data.status == null)) {
                    $('#viewFiledOTID').val(res.data.requestID);
                    $('#viewOTDate').val(res.data.otDate);
                    $('#viewOTType').val(res.data.otType);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewFromTime').val(res.data.fromTime);
                    $('#viewToTime').val(res.data.toTime);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val('Pending');
                    $('#approveOT').show();
                    $('#disapproveOT').show();
                    $('#viewFiledOTModal').modal('show');
                }
                // else if (res.status == 200 && res.data.status == null) {
                //     $('#viewFiledOTID').val(res.data.requestID);
                //     $('#viewOTDate').val(res.data.otDate);
                //     $('#viewOTType').val(res.data.otType);
                //     $('#viewDateFiled').val(res.data.dateFiled);
                //     $('#viewName').val(res.data.employeeName);
                //     $('#viewFromTime').val(res.data.fromTime);
                //     $('#viewToTime').val(res.data.toTime);
                //     $('#viewPurpose').val(res.data.remarks);
                //     $('#viewStatus').val('Pending for 1st Approval');
                //     $('#viewFiledOTModal').modal('show');
                // }
                // else if (res.status == 200 && res.data.status == 1 && userDept == 3) {
                //     $('#viewFiledOTID').val(res.data.requestID);
                //     $('#viewOTDate').val(res.data.otDate);
                //     $('#viewOTType').val(res.data.otType);
                //     $('#viewDateFiled').val(res.data.dateFiled);
                //     $('#viewName').val(res.data.employeeName);
                //     $('#viewFromTime').val(res.data.fromTime);
                //     $('#viewToTime').val(res.data.toTime);
                //     $('#viewPurpose').val(res.data.remarks);
                //     $('#viewStatus').val('Pending for 2nd Approval');
                //     $('#approveOT').hide();
                //     $('#disapproveOT').hide();
                //     $('#viewFiledOTModal').modal('show');
                // }
                // else if (res.status == 200 && res.data.status == 1 && userDept == 5) {
                //     $('#viewFiledOTID').val(res.data.requestID);
                //     $('#viewOTDate').val(res.data.otDate);
                //     $('#viewOTType').val(res.data.otType);
                //     $('#viewDateFiled').val(res.data.dateFiled);
                //     $('#viewName').val(res.data.employeeName);
                //     $('#viewFromTime').val(res.data.fromTime);
                //     $('#viewToTime').val(res.data.toTime);
                //     $('#viewPurpose').val(res.data.remarks);
                //     $('#viewStatus').val('Pending for 2nd Approval');
                //     $('#approveOT').show();
                //     $('#disapproveOT').show();
                //     $('#viewFiledOTModal').modal('show');
                // }
                // else if (res.status == 200 && res.data.status == 0) {
                //     $('#viewFiledOTID').val(res.data.requestID);
                //     $('#viewOTDate').val(res.data.otDate);
                //     $('#viewOTType').val(res.data.otType);
                //     $('#viewDateFiled').val(res.data.dateFiled);
                //     $('#viewName').val(res.data.employeeName);
                //     $('#viewFromTime').val(res.data.fromTime);
                //     $('#viewToTime').val(res.data.toTime);
                //     $('#viewPurpose').val(res.data.remarks);
                //     $('#viewStatus').val('Disapproved');
                //     $('#approveOT').hide();
                //     $('#disapproveOT').hide();
                //     $('#viewFiledOTModal').modal('show');
                // }
                // else if (res.status == 200 && res.data.status == 2) {
                //     $('#viewFiledOTID').val(res.data.requestID);
                //     $('#viewOTDate').val(res.data.otDate);
                //     $('#viewOTType').val(res.data.otType);
                //     $('#viewDateFiled').val(res.data.dateFiled);
                //     $('#viewName').val(res.data.employeeName);
                //     $('#viewFromTime').val(res.data.fromTime);
                //     $('#viewToTime').val(res.data.toTime);
                //     $('#viewPurpose').val(res.data.remarks);
                //     $('#viewStatus').val('Approved');
                //     $('#approveOT').hide();
                //     $('#disapproveOT').hide();
                //     $('#viewFiledOTModal').modal('show');
                // }
            }
        });

        // APPROVE OT FORM
        $(document).on('click', '.approveOT', function() {
            var id_ot = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/filedOTModal.php?ot_id=" + id_ot,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Approve OT Form',
                            text: 'Are you sure you want to approve this OT form?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/admin/otAction.php",
                                    type: 'POST',
                                    data: {
                                        id_ot: id_ot,
                                        action: 'approve'
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'OT Form has been approved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            // window.location.reload();
                                            updateOTModal(id_ot);
                                        })
                                    }
                                })
                            }
                        })
                    }
                }
            });
        })

        // DISAPPROVE OT FORM
        $(document).on('click', '.disapproveOT', function() {
            var id_ot = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/filedOTModal.php?ot_id=" + id_ot,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {

                        Swal.fire({
                            icon: 'question',
                            title: 'Disapprove OT Form',
                            text: 'Are you sure you want to disapprove this OT form?',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',

                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/admin/otAction.php",
                                    type: 'POST',
                                    data: {
                                        id_ot: id_ot,
                                        action: 'disapprove'
                                    },
                                    cache: false,
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'OT Form has been disapproved!',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            // window.location.reload();
                                            updateOTModal(id_ot);
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

    // LOAD FILED OT MODAL 
    function loadOTModal(id_ot, userDeptFileOT) {
        $.ajax({
            type: "GET",
            url: "../backend/admin/filedOTModal.php?ot_id=" + id_ot,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.status == 1 || res.data.status == 0)) {
                    $('#viewFiledOTID').val(res.data.requestID);
                    $('#viewOTDate').val(res.data.otDate);
                    $('#viewOTType').val(res.data.otType);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewFromTime').val(res.data.fromTime);
                    $('#viewToTime').val(res.data.toTime);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status == 1 ? 'Approved' : 'Disapproved');
                    $('#approveOT').hide();
                    $('#disapproveOT').hide();
                }
                else if (res.status == 200 && (userDeptFileOT == 3 && res.data.status == null)) {
                    $('#viewFiledOTID').val(res.data.requestID);
                    $('#viewOTDate').val(res.data.otDate);
                    $('#viewOTType').val(res.data.otType);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewFromTime').val(res.data.fromTime);
                    $('#viewToTime').val(res.data.toTime);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val('Pending');

                    if (res.isCheck) {
                        $('#approveOT').show();
                        $('#disapproveOT').show();
                    }
                }
                else if (res.status == 200 && (userDeptFileOT == 5 && res.data.status == null)) {
                    $('#viewFiledOTID').val(res.data.requestID);
                    $('#viewOTDate').val(res.data.otDate);
                    $('#viewOTType').val(res.data.otType);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewFromTime').val(res.data.fromTime);
                    $('#viewToTime').val(res.data.toTime);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val('Pending');
                    $('#approveOT').show();
                    $('#disapproveOT').show();
                }
            }
        });
    }

    // FILE OT BUTTON
    $("#fileOTform").submit(function (e) {

        e.preventDefault();

        var user = $('#user').val();
        var otDate = $('#otDate').val();
        var otType = $('#otType').val();
        var fromTime = $('#fromTime').val();
        var toTime = $('#toTime').val();
        var purpose = $('#purpose').val();

        if (user == "" || otDate == "" || otType == "" || fromTime == "" || toTime == "" || purpose == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
        } else {
            Swal.fire({
                icon: 'question',
                title: 'File Overtime Form',
                text: 'Are you sure you want to file overtime?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "../backend/admin/fileOT.php",
                        data: $(this).serialize(),
                        cache: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em
                            if (data.error == 0) {
                                var id = data.id;
                                var userDeptFileOT = $('#userDeptFileOT').val();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false,
                                }).then(() => {
                                    $('#fileOTmodal').modal('hide');
                                    loadOTModal(id, userDeptFileOT);
                                    $('#viewFiledOTModal').modal('show');
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: message,
                                })
                            }
                        }
                    });
                }
            });
        }
        

    });

    $('#btnClose').on('click', function() {
        window.location.reload();
    });
});