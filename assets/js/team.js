$(document).ready(function() {
    $("#teamTable").DataTable({
        order: [], // Disable default sorting
    });

    $("#dropdownButton").on("click", function () {
        $("#dropdownMenu").toggleClass("hidden");
    });

    // Close the dropdown if the user clicks outside of it
    $(document).on("click", function (event) {
        if (
        !$(event.target).closest("#dropdownButton").length &&
        !$(event.target).closest("#dropdownMenu").length
        ) {
        $("#dropdownMenu").addClass("hidden");
        }
    });

    // CHECKBOXES FOR WEEK OFF (UPDATE EMPLOYEE)
    $("input.update_wo_day[type='checkbox']").on("change", function () {
        const $checkboxes = $("input.update_wo_day[type='checkbox']");
        const checkedCount = $checkboxes.filter(":checked").length;

        if (checkedCount >= 2) {
        // Disable all unchecked boxes
        $checkboxes.not(":checked").prop("disabled", true);
        } else {
        // Re-enable all boxes
        $checkboxes.prop("disabled", false);
        }
    });   

    // VIEW TEAM
    var array = [];
    $(document).on("click", ".teamView", function () {
        var employee_id = $(this).data("id");
        array.push(employee_id);
        var id_employee = array[array.length - 1];

        // VIEW TEAM
        $.ajax({
            type: "GET",
            url: "../backend/team/teamModal.php?employee_id=" + id_employee,
            success: function (response) {
                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $("#viewEmployeeName").val(
                        res.data.firstName + " " + res.data.lastName
                    );
                    $("#viewGender").val(res.data.gender);
                    $("#viewCivilStatus").val(res.data.civilStatus);
                    $("#viewAddress").val(res.data.address);
                    $("#viewDateOfBirth").val(res.data.dateOfBirth);
                    $("#viewPlaceOfBirth").val(res.data.placeOfBirth);
                    $("#viewsss").val(res.data.sss);
                    $("#viewpagIbig").val(res.data.pagIbig);
                    $("#viewphilheatlh").val(res.data.philhealth);
                    $("#viewEmailAddress").val(res.data.emailAddress);
                    $("#viewEmployeeID").val(res.data.employeeID);
                    $("#viewMobileNumber").val(res.data.mobileNumber);
                    $("#viewDepartment").val(res.data.departmentName);
                    $("#viewDesignation").val(res.data.position);
                    $("#viewShiftID").val(res.data.startTime + " - " + res.data.endTime);

                    // WEEK OFF SECTION
                    $("#view_wo_monday").val(
                        res.data.wo_mon == 1
                        ? $("#view_wo_monday").prop("checked", true)
                        : $("#view_wo_monday").prop("checked", false)
                    );
                    $("#view_wo_tuesday").val(
                        res.data.wo_tue == 1
                        ? $("#view_wo_tuesday").prop("checked", true)
                        : $("#view_wo_tuesday").prop("checked", false)
                    );
                    $("#view_wo_wednesday").val(
                        res.data.wo_wed == 1
                        ? $("#view_wo_wednesday").prop("checked", true)
                        : $("#view_wo_wednesday").prop("checked", false)
                    );
                    $("#view_wo_thursday").val(
                        res.data.wo_thu == 1
                        ? $("#view_wo_thursday").prop("checked", true)
                        : $("#view_wo_thursday").prop("checked", false)
                    );
                    $("#view_wo_friday").val(
                        res.data.wo_fri == 1
                        ? $("#view_wo_friday").prop("checked", true)
                        : $("#view_wo_friday").prop("checked", false)
                    );
                    $("#view_wo_saturday").val(
                        res.data.wo_sat == 1
                        ? $("#view_wo_saturday").prop("checked", true)
                        : $("#view_wo_saturday").prop("checked", false)
                    );
                    $("#view_wo_sunday").val(
                        res.data.wo_sun == 1
                        ? $("#view_wo_sunday").prop("checked", true)
                        : $("#view_wo_sunday").prop("checked", false)
                    );

                    loadTeamData(id_employee);
                    $("#viewTeamModal").modal("show");
                }
            },
        });

        // UPDATE TEAM
        $(document).on("click", ".teamUpdate", function () {
            $("#viewTeamModal").modal("hide");
            var id_employee = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/team/teamModal.php?employee_id=" + id_employee,
                success: function (response) {
                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $("#updateID").val(res.data.id);
                    $("#updateEmployeeName").val(res.data.firstName + " " + res.data.lastName);
                    $("#updateGender").val(res.data.gender);
                    $("#updateCivilStatus").val(res.data.civilStatus);
                    $("#updateAddress").val(res.data.address);
                    $("#updateDateOfBirth").val(res.data.dateOfBirth);
                    $("#updatePlaceOfBirth").val(res.data.placeOfBirth);
                    $("#updateSSS").val(res.data.sss);
                    $("#updatepagIbig").val(res.data.pagIbig);
                    $("#updatephilheatlh").val(res.data.philhealth);
                    $("#updateEmailAddress").val(res.data.emailAddress);
                    $("#updateEmployeeID").val(res.data.employeeID);
                    $("#updateMobileNumber").val(res.data.mobileNumber);
                    $("#updateDepartment").val(res.data.departmentName);
                    $("#updateDesignation").val(res.data.position);
                    $("#updateShiftID").val(
                    res.data.startTime + " - " + res.data.endTime
                    );

                    // WEEK OFF SECTION
                    let selectedWeekOffCounter = 0;
                    // $('#update_wo_mon').val(res.data.wo_mon == 1 ? $('#update_wo_mon').prop('checked', true) : $('#update_wo_mon').prop('checked', false));
                    if (res.data.wo_mon == 1) {
                    $("#update_wo_mon").prop("checked", true);
                    selectedWeekOffCounter++;
                    } else {
                    $("#update_wo_mon").prop("checked", false);
                    }
                    if (res.data.wo_tue == 1) {
                    $("#update_wo_tue").prop("checked", true);
                    selectedWeekOffCounter++;
                    } else {
                    $("#update_wo_tue").prop("checked", false);
                    }
                    if (res.data.wo_wed == 1) {
                    $("#update_wo_wed").prop("checked", true);
                    selectedWeekOffCounter++;
                    } else {
                    $("#update_wo_wed").prop("checked", false);
                    }
                    if (res.data.wo_thu == 1) {
                    $("#update_wo_thu").prop("checked", true);
                    selectedWeekOffCounter++;
                    } else {
                    $("#update_wo_thu").prop("checked", false);
                    }
                    if (res.data.wo_fri == 1) {
                    $("#update_wo_fri").prop("checked", true);
                    selectedWeekOffCounter++;
                    } else {
                    $("#update_wo_fri").prop("checked", false);
                    }
                    if (res.data.wo_sat == 1) {
                    $("#update_wo_sat").prop("checked", true);
                    selectedWeekOffCounter++;
                    } else {
                    $("#update_wo_sat").prop("checked", false);
                    }
                    if (res.data.wo_sun == 1) {
                    $("#update_wo_sun").prop("checked", true);
                    selectedWeekOffCounter++;
                    } else {
                    $("#update_wo_sun").prop("checked", false);
                    }

                    const $checkboxes = $("input.update_wo_day[type='checkbox']");
                    if (selectedWeekOffCounter >= 2) {
                    $checkboxes.not(":checked").prop("disabled", true);
                    } else {
                    checkboxes.prop("disabled", false);
                    }

                    $("#updateTeamModal").modal("show");
                }
                },
            });
        });
    });

    // UPDATE TEAM
    $("#updateTeamForm").submit(function (e) {
        e.preventDefault();
        
        let updateTeam = new FormData(this);
        var updateID = $("#updateID").val();

        if (updateID == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',

            })
        } else {
            Swal.fire({
            icon: "question",
            title: "Update Team Information",
            text: "Are you sure you want to save the changes you made?",
            showCancelButton: true,
            cancelButtonColor: "#6c757d",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Yes",

            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "../backend/team/updateTeam.php",
                        type: "POST",
                        data: updateTeam,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.error == 0) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false,
                                }).then(() => {
                                    // Refresh the View Employee Modal with updated data
                                    $("#updateTeamModal").modal("hide");
                                    loadTeamData(updateID);
                                    $("#viewTeamModal").modal("show");
                                });
                            } else {
                                Swal.fire({
                                    icon: "warning",
                                    title: "Warning",
                                    text: message,
                                });
                            }
                        },
                    });
                }
            });
        }

    });

    function loadTeamData(id_employee) {
        $.ajax({
            type: "GET",
            url: "../backend/team/teamModal.php?employee_id=" + id_employee,
            success: function (response) {
                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $("#viewEmployeeName").val(
                        res.data.firstName + " " + res.data.lastName
                    );
                    $("#viewGender").val(res.data.gender);
                    $("#viewCivilStatus").val(res.data.civilStatus);
                    $("#viewAddress").val(res.data.address);
                    $("#viewDateOfBirth").val(res.data.dateOfBirth);
                    $("#viewPlaceOfBirth").val(res.data.placeOfBirth);
                    $("#viewsss").val(res.data.sss);
                    $("#viewpagIbig").val(res.data.pagIbig);
                    $("#viewphilheatlh").val(res.data.philhealth);
                    $("#viewEmailAddress").val(res.data.emailAddress);
                    $("#viewEmployeeID").val(res.data.employeeID);
                    $("#viewMobileNumber").val(res.data.mobileNumber);
                    $("#viewDepartment").val(res.data.departmentName);
                    $("#viewDesignation").val(res.data.position);
                    $("#viewShiftID").val(
                        res.data.startTime + " - " + res.data.endTime
                    );

                    // WEEK OFF SECTION
                    $("#view_wo_monday").val(
                        res.data.wo_mon == 1
                        ? $("#view_wo_monday").prop("checked", true)
                        : $("#view_wo_monday").prop("checked", false)
                    );
                    $("#view_wo_tuesday").val(
                        res.data.wo_tue == 1
                        ? $("#view_wo_tuesday").prop("checked", true)
                        : $("#view_wo_tuesday").prop("checked", false)
                    );
                    $("#view_wo_wednesday").val(
                        res.data.wo_wed == 1
                        ? $("#view_wo_wednesday").prop("checked", true)
                        : $("#view_wo_wednesday").prop("checked", false)
                    );
                    $("#view_wo_thursday").val(
                        res.data.wo_thu == 1
                        ? $("#view_wo_thursday").prop("checked", true)
                        : $("#view_wo_thursday").prop("checked", false)
                    );
                    $("#view_wo_friday").val(
                        res.data.wo_fri == 1
                        ? $("#view_wo_friday").prop("checked", true)
                        : $("#view_wo_friday").prop("checked", false)
                    );
                    $("#view_wo_saturday").val(
                        res.data.wo_sat == 1
                        ? $("#view_wo_saturday").prop("checked", true)
                        : $("#view_wo_saturday").prop("checked", false)
                    );
                    $("#view_wo_sunday").val(
                        res.data.wo_sun == 1
                        ? $("#view_wo_sunday").prop("checked", true)
                        : $("#view_wo_sunday").prop("checked", false)
                    );
                }
            },
        });
    }

    $("#btnClose").on("click", function () {
        window.location.reload();
    });
});