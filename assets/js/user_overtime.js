$(document).ready(function() {

    $('#overtimeTable').DataTable();

    // FILE OT BUTTON
    $("#fileOTform").submit(function (e) {

        e.preventDefault();

        var otDate = $('#otDate').val();
        var otType = $('#otType').val();
        var actualOThours = $('#actualOThours').val();
        var actualOTmins = $('#actualOTmins').val();
        var purpose = $('#purpose').val();

        if (otDate == "" || otType == "" || actualOThours == "" || purpose == "") {
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
                        url: "../backend/user/fileOT.php",
                        data: $(this).serialize(),
                        cache: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em
                            if (data.error == 0) {
                                var id = data.id;
                                loadOTData(id);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false,
                                }).then(() => {
                                    // window.location.reload();
                                    $('#fileOTmodal').modal('hide');
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

    // VIEW FILED OT
    var array = [];
    $(document).on('click', '.filedOTview', function() {
        var ot_id = $(this).data('id');
        array.push(ot_id);
        var id_ot = array[array.length - 1];

        // VIEW FILED OT
        $.ajax({
            type: "GET",
            url: "../backend/user/filedOTModal.php?ot_id=" + id_ot,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.status == null || res.data.status == 1 || res.data.status == 0)) {
                    $('#viewFiledOTID').val(res.data.requestID);
                    $('#viewOTDate').val(res.data.otDate);
                    $('#viewOTType').val(res.data.otType);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewActualOTHours').val(res.data.actualOThours + " hour/s");
                    if (res.data.actualOTmins == null) {
                        $('#viewActualOTMins').val("-");
                    }
                    else {
                        $('#viewActualOTMins').val(res.data.actualOTmins + " minute/s");
                    }
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#approvedLabelRow').hide();
                    $('#approvedInputRow').hide();
                    $('#viewFiledOTModal').modal('show');
                }
                else if (res.status == 200 && res.data.status == 2) {
                    $('#viewFiledOTID').val(res.data.requestID);
                    $('#viewOTDate').val(res.data.otDate);
                    $('#viewOTType').val(res.data.otType);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewActualOTHours').val(res.data.actualOThours + " hour/s");
                    if (res.data.actualOTmins == null) {
                        $('#viewActualOTMins').val("-");
                    }
                    else {
                        $('#viewActualOTMins').val(res.data.actualOTmins + " minute/s");
                    }
                    $('#viewApprovedOTHours').val(res.data.approvedOThours + " hour/s");
                    if (res.data.approvedOTmins == null) {
                        $('#viewApprovedOTMins').val("-");
                    }
                    else {
                        $('#viewApprovedOTMins').val(res.data.approvedOTmins + " minute/s");
                    }
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#viewFiledOTModal').modal('show');
                }
            }
        });
    });

    function loadOTData(id_ot) {
        $.ajax({
            type: "GET",
            url: "../backend/user/filedOTModal.php?ot_id=" + id_ot,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.status == null || res.data.status == 1 || res.data.status == 0)) {
                    $('#viewFiledOTID').val(res.data.requestID);
                    $('#viewOTDate').val(res.data.otDate);
                    $('#viewOTType').val(res.data.otType);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewActualOTHours').val(res.data.actualOThours + " hour/s");
                    if (res.data.actualOTmins == null) {
                        $('#viewActualOTMins').val("-");
                    }
                    else {
                        $('#viewActualOTMins').val(res.data.actualOTmins + " minute/s");
                    }
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val(res.data.status);
                    $('#approvedLabelRow').hide();
                    $('#approvedInputRow').hide();
                }
                else if (res.status == 200 && res.data.status == 2) {
                    $('#viewFiledOTID').val(res.data.requestID);
                    $('#viewOTDate').val(res.data.otDate);
                    $('#viewOTType').val(res.data.otType);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewActualOTHours').val(res.data.actualOThours + " hour/s");
                    if (res.data.actualOTmins == null) {
                        $('#viewActualOTMins').val("-");
                    }
                    else {
                        $('#viewActualOTMins').val(res.data.actualOTmins + " minute/s");
                    }
                    $('#viewApprovedOTHours').val(res.data.approvedOThours + " hour/s");
                    if (res.data.approvedOTmins == null) {
                        $('#viewApprovedOTMins').val("-");
                    }
                    else {
                        $('#viewApprovedOTMins').val(res.data.approvedOTmins + " minute/s");
                    }
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