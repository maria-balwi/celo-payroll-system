$(document).ready(function() {

    $('#overtimeTable').DataTable({
        order: [] // Disable default sorting
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
            url: "../backend/team/filedOTModal.php?ot_id=" + id_ot,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.status == 1 || res.data.status == 0)) {
                    $('#viewFiledOTID').val(res.data.requestID);
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
                else if (res.status == 200 && res.data.status == null) {
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
                //     $('#approvedLabelRow').hide();
                //     $('#approvedInputRow').hide();
                //     $('#viewFiledOTModal').modal('show');
                // }
                // else if (res.status == 200 && res.data.status == 1) {
                //     $('#viewFiledOTID').val(res.data.requestID);
                //     $('#viewOTDate').val(res.data.otDate);
                //     $('#viewOTType').val(res.data.otType);
                //     $('#viewDateFiled').val(res.data.dateFiled);
                //     $('#viewName').val(res.data.employeeName);
                //     $('#viewFromTime').val(res.data.fromTime);
                //     $('#viewToTime').val(res.data.toTime);
                //     $('#viewPurpose').val(res.data.remarks);
                //     $('#viewStatus').val('Pending for 2nd Approval');
                //     $('#approvedLabelRow').hide();
                //     $('#approvedInputRow').hide();
                //     $('#approveOT').hide();
                //     $('#disapproveOT').hide();
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
                //     $('#approvedLabelRow').hide();
                //     $('#approvedInputRow').hide();
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
                url: "../backend/team/filedOTModal.php?ot_id=" + id_ot,
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
                                    url: "../backend/team/otAction.php",
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
                url: "../backend/team/filedOTModal.php?ot_id=" + id_ot,
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
                                    url: "../backend/team/otAction.php",
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

    function updateOTModal(id_ot) {
        $.ajax({
            type: "GET",
            url: "../backend/team/filedOTModal.php?ot_id=" + id_ot,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && (res.data.status == 1 || res.data.status == 0)) {
                    $('#viewFiledOTID').val(res.data.requestID);
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
                else if (res.status == 200 && res.data.status == null) {
                    $('#viewFiledOTID').val(res.data.requestID);
                    $('#viewOTDate').val(res.data.otDate);
                    $('#viewOTType').val(res.data.otType);
                    $('#viewDateFiled').val(res.data.dateFiled);
                    $('#viewName').val(res.data.employeeName);
                    $('#viewFromTime').val(res.data.fromTime);
                    $('#viewToTime').val(res.data.toTime);
                    $('#viewPurpose').val(res.data.remarks);
                    $('#viewStatus').val('Pending');
                }
            }
        });
    }

    $('#btnClose').on('click', function() {
        window.location.reload();
    });
});