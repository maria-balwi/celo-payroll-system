function formatNumberWithCommas(number) {
    number = parseFloat(number);
    if (isNaN(number)) return "0.00";
    return number.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$(document).ready(function () {
    $("#cashAdvanceTable").DataTable({
        order: [],
    });

    $("#employeeID").inputmask("999-999", {
        placeholder: "XXX-XXX",
    });

    let employeeTypingTimer; // OUTSIDE THE EVENT
    const debounceDelay = 400; // ms

    $("#employeeID").on("input", function () {
        clearTimeout(employeeTypingTimer);

    let employeeID = $(this).val().trim();

    if (employeeID === "") {
        $("#employeeLastName").val("");
        $("#employeeFirstName").val("");
        return;
    }

    employeeTypingTimer = setTimeout(function () {
        $.ajax({
            type: "GET",
            url: "../backend/team/fetchEmployees.php",
            data: { employeeID: employeeID },
            success: function (response) {
                var res = jQuery.parseJSON(response);

                if (res.status == 200) {
                    $("#employeeLastName").val(res.data.lastName);
                    $("#employeeFirstName").val(res.data.firstName);
                    $("#id").val(res.data.id);
                } else {
                    $("#employeeLastName").val("");
                    $("#employeeFirstName").val("");
                    $("#id").val("");
                }
            },
        });
        }, debounceDelay);
  });

  // LOAN AMOUNT, TOTAL AMOUNT TO BE PAID, REMAINING AMOUNT TO BE PAID, MONTHLY AMMORTIZATION
    $("input[id='amount']").on("input", function () {
        let amount = parseFloat($(this).val().replace(/,/g, ""));

        if (isNaN(amount)) amount = 0;

        let totalAmountToBePaid = amount.toFixed(2);
        $("#totalAmountToBePaid").val(totalAmountToBePaid).trigger("input");

        let remainingAmount = amount.toFixed(2);
        $("#remainingAmount").val(remainingAmount).trigger("input");

        var term = $("#monthsToPay").val() * 2;
        if (term) {
        if (term == 1) {
            var monthlyAmmortization = (amount / term).toFixed(2);
            $("#monthlyAmmortization").val(monthlyAmmortization).trigger("input");
        } else if (term == 2) {
            var monthlyAmmortization = (amount / term).toFixed(2);
            $("#monthlyAmmortization").val(monthlyAmmortization).trigger("input");
        } else if (term == 3) {
            var monthlyAmmortization = (amount / term).toFixed(2);
            $("#monthlyAmmortization").val(monthlyAmmortization).trigger("input");
        } else {
            var monthlyAmmortization = (amount / term).toFixed(2);
            $("#monthlyAmmortization").val(monthlyAmmortization).trigger("input");
        }
        }
    });

    $("select[id='monthsToPay']").on("change", function () {
        var term = $(this).val() * 2;
        var amount = parseFloat($("#amount").val().replace(/,/g, ""));
        if (isNaN(amount)) amount = 0;
        if (term == 1) {
            var monthlyAmmortization = (amount / term).toFixed(2);
            $("#monthlyAmmortization").val(monthlyAmmortization).trigger("input");
        } else if (term == 2) {
            var monthlyAmmortization = (amount / term).toFixed(2);
            $("#monthlyAmmortization").val(monthlyAmmortization).trigger("input");
        } else if (term == 3) {
            var monthlyAmmortization = (amount / term).toFixed(2);
            $("#monthlyAmmortization").val(monthlyAmmortization).trigger("input");
        } else {
            var monthlyAmmortization = (amount / term).toFixed(2);
            $("#monthlyAmmortization").val(monthlyAmmortization).trigger("input");
        }
    });

    // ADD CASH ADVANCE
    $("#fileCashAdvanceForm").submit(function (e) {
        e.preventDefault();

        let fileCashAdvance = new FormData(this);
        var id = $("#id").val();
        var amount = $("#amount").val();
        var monthsToPay = $("#monthsToPay").val();
        var monthlyAmmortization = $("#monthlyAmmortization").val();
        var remainingAmount = $("#remainingAmount").val();
        var cutoffStart = $("#cutoffStart").val();
        var ca_status = "New";
        var request_status = "Pending";

        if (id == "" || amount == "" || monthsToPay == "" || monthlyAmmortization == "" || remainingAmount == "" || cutoffStart == "" || ca_status == "" || request_status == "") {
            Swal.fire({
                icon: "warning",
                title: "Required Information",
                text: "Please fill up all the required Information",
            });
        } else {
            Swal.fire({
                icon: "question",
                title: "File Cash Advance",
                text: "Are you sure you want to file this cash advance?",
                showCancelButton: true,
                cancelButtonColor: "#6c757d",
                confirmButtonColor: "#28a745",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "../backend/team/fileCashAdvance.php",
                        data: fileCashAdvance,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.error == 0) {
                                var id = data.id;
                                loadCashAdvanceData(id);
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false,
                                }).then(() => {
                                    // Refresh the View Employee Modal with new added data
                                    $("#fileCashAdvanceModal").modal("hide");
                                    $("#viewCashAdvanceModal").modal("show");
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: message,
                                });
                            }
                        },
                    });
                }
            });
        }
    });

    // VIEW CASH ADVANCE
    var array = [];
    $(document).on("click", ".cashAdvanceView", function () {
        var request_id = $(this).data("id");
        array.push(request_id);
        var id_request = array[array.length - 1];

        // VIEW CASH ADVANCE
        $.ajax({
            type: "GET",
            url: "../backend/team/cashAdvanceModal.php?requestID=" + id_request,
            success: function (response) {
                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $("#viewRequestID").val(res.data.requestID);
                    $("#viewEmployeeID").val(res.data.employeeID);
                    $("#viewEmployeeName").val(res.data.firstName + " " + res.data.lastName);
                    $("#viewRequestorName").val(res.data.requestorFirstName + " " + res.data.requestorLastName);
                    $("#viewFiledDate").val(res.data.dateFiled);
                    $("#viewLoanAmount").val("₱ " + formatNumberWithCommas(res.data.amount));
                    $("#viewTotalAmount").val("₱ " + formatNumberWithCommas(res.data.amount));
                    $("#viewRemainingAmount").val("₱ " + formatNumberWithCommas(res.data.remainingAmount));
                    $("#viewMonthsToPay").val(
                        res.data.monthsToPay <= 1
                        ? res.data.monthsToPay + " month"
                        : res.data.monthsToPay + " months"
                    );
                    $("#viewMonthlyAmmortization").val("₱ " + formatNumberWithCommas(res.data.monthlyAmmortization));
                    $("#viewCutoffStart").val(res.data.cutoffStart);
                    $("#viewCAStatus").val(res.data.ca_status);
                    $("#viewRequestStatus").val(res.data.request_status);

                    // Show the modal
                    $("#viewCashAdvanceModal").modal("show");
                }
            },
        });

        // // UPDATE EMPLOYEE
        // $(document).on("click", ".employeeUpdate", function () {
        // $("#viewEmployeeModal").modal("hide");
        // var id_employee = array[array.length - 1];

        // $.ajax({
        //     type: "GET",
        //     url: "../backend/admin/employeeModal.php?employee_id=" + id_employee,
        //     success: function (response) {
        //     var res = jQuery.parseJSON(response);
        //     if (res.status == 404) {
        //         alert(res.message);
        //     } else if (res.status == 200) {
        //         $("#updateID").val(res.data.id);
        //         $("#updateLastName").val(res.data.lastName);
        //         $("#updateFirstName").val(res.data.firstName);
        //         $("#updateGender").val(res.data.gender);
        //         $("#updateCivilStatus").val(res.data.civilStatus);
        //         $("#updateAddress").val(res.data.address);
        //         $("#updateDateOfBirth").val(res.data.dateOfBirth);
        //         $("#updatePlaceOfBirth").val(res.data.placeOfBirth);
        //         $("#updateSSS").val(res.data.sss);
        //         $("#updatePagIbig").val(res.data.pagIbig);
        //         $("#updatePhilhealth").val(res.data.philhealth);
        //         $("#updateTIN").val(res.data.tin);
        //         $("#updateEmailAddress").val(res.data.emailAddress);
        //         $("#updateEmployeeID").val(res.data.employeeID);
        //         $("#updateMobileNumber").val(res.data.mobileNumber);
        //         $("#updateDepartment").val(res.data.departmentName);
        //         $("#updateDesignation").val(res.data.position);
        //         $("#updateShiftID").val(
        //         res.data.startTime + " - " + res.data.endTime
        //         );
        //         $("#updateEmploymentStatus").val(res.data.employmentStatus);
        //         $("#updateDateHired").val(res.data.dateHired);

        //         if (res.data.employmentStatus == "Regular") {
        //         $("#updateDateRegularized").val(res.data.dateRegularized);
        //         } else {
        //         $("#updateDateRegularizedLabel").hide();
        //         }

        //         $("#updateBasicPay").val(res.data.basicPay);
        //         $("#updateDailyRate").val(res.data.dailyRate);
        //         $("#updateHourlyRate").val(res.data.hourlyRate);
        //         $("#updateVacationLeaves").val(res.data.availableVL);
        //         $("#updateSickLeaves").val(res.data.availableSL);
        //         $("#updateCashAdvance").val(res.data.cashAdvance);

        //         // WEEK OFF SECTION
        //         let selectedWeekOffCounter = 0;
        //         // $('#update_wo_mon').val(res.data.wo_mon == 1 ? $('#update_wo_mon').prop('checked', true) : $('#update_wo_mon').prop('checked', false));
        //         if (res.data.wo_mon == 1) {
        //         $("#update_wo_mon").prop("checked", true);
        //         selectedWeekOffCounter++;
        //         } else {
        //         $("#update_wo_mon").prop("checked", false);
        //         }
        //         if (res.data.wo_tue == 1) {
        //         $("#update_wo_tue").prop("checked", true);
        //         selectedWeekOffCounter++;
        //         } else {
        //         $("#update_wo_tue").prop("checked", false);
        //         }
        //         if (res.data.wo_wed == 1) {
        //         $("#update_wo_wed").prop("checked", true);
        //         selectedWeekOffCounter++;
        //         } else {
        //         $("#update_wo_wed").prop("checked", false);
        //         }
        //         if (res.data.wo_thu == 1) {
        //         $("#update_wo_thu").prop("checked", true);
        //         selectedWeekOffCounter++;
        //         } else {
        //         $("#update_wo_thu").prop("checked", false);
        //         }
        //         if (res.data.wo_fri == 1) {
        //         $("#update_wo_fri").prop("checked", true);
        //         selectedWeekOffCounter++;
        //         } else {
        //         $("#update_wo_fri").prop("checked", false);
        //         }
        //         if (res.data.wo_sat == 1) {
        //         $("#update_wo_sat").prop("checked", true);
        //         selectedWeekOffCounter++;
        //         } else {
        //         $("#update_wo_sat").prop("checked", false);
        //         }
        //         if (res.data.wo_sun == 1) {
        //         $("#update_wo_sun").prop("checked", true);
        //         selectedWeekOffCounter++;
        //         } else {
        //         $("#update_wo_sun").prop("checked", false);
        //         }

        //         const $checkboxes = $("input.update_wo_day[type='checkbox']");
        //         if (selectedWeekOffCounter >= 2) {
        //         $checkboxes.not(":checked").prop("disabled", true);
        //         } else {
        //         checkboxes.prop("disabled", false);
        //         }
        //         // REQUIREMENTS SECTION
        //         $("#update_req_sss").val(
        //         res.data.req_sss == 1
        //             ? $("#update_req_sss").prop("checked", true)
        //             : $("#update_req_sss").prop("checked", false)
        //         );
        //         $("#update_req_pagIbig").val(
        //         res.data.req_pagIbig == 1
        //             ? $("#update_req_pagIbig").prop("checked", true)
        //             : $("#update_req_pagIbig").prop("checked", false)
        //         );
        //         $("#update_req_philhealth").val(
        //         res.data.req_philhealth == 1
        //             ? $("#update_req_philhealth").prop("checked", true)
        //             : $("#update_req_philhealth").prop("checked", false)
        //         );
        //         $("#update_req_tin").val(
        //         res.data.req_tin == 1
        //             ? $("#update_req_tin").prop("checked", true)
        //             : $("#update_req_tin").prop("checked", false)
        //         );
        //         $("#update_req_nbi").val(
        //         res.data.req_nbi == 1
        //             ? $("#update_req_nbi").prop("checked", true)
        //             : $("#update_req_nbi").prop("checked", false)
        //         );
        //         $("#update_req_medicalExam").val(
        //         res.data.req_medicalExam == 1
        //             ? $("#update_req_medicalExam").prop("checked", true)
        //             : $("#update_req_medicalExam").prop("checked", false)
        //         );
        //         $("#update_req_2x2pic").val(
        //         res.data.req_2x2pic == 1
        //             ? $("#update_req_2x2pic").prop("checked", true)
        //             : $("#update_req_2x2pic").prop("checked", false)
        //         );
        //         $("#update_req_vaccineCard").val(
        //         res.data.req_vaccineCard == 1
        //             ? $("#update_req_vaccineCard").prop("checked", true)
        //             : $("#update_req_vaccineCard").prop("checked", false)
        //         );
        //         $("#update_req_psa").val(
        //         res.data.req_psa == 1
        //             ? $("#update_req_psa").prop("checked", true)
        //             : $("#update_req_psa").prop("checked", false)
        //         );
        //         $("#update_req_validID").val(
        //         res.data.req_validID == 1
        //             ? $("#update_req_validID").prop("checked", true)
        //             : $("#update_req_validID").prop("checked", false)
        //         );
        //         $("#update_req_helloMoney").val(
        //         res.data.req_helloMoney == 1
        //             ? $("#update_req_helloMoney").prop("checked", true)
        //             : $("#update_req_helloMoney").prop("checked", false)
        //         );

        //         $("#oldEmailAddress").val(res.data.emailAddress);
        //         $("#oldEmployeeID").val(res.data.employeeID);

        //         // LOAD PROFILE PICTURE
        //         const img = $("#updatePreviewPhoto");
        //         let employeeID_string = res.data.employeeID;
        //         const imagePath =
        //         "../assets/images/profiles/" +
        //         employeeID_string.replace("-", "") +
        //         ".png";
        //         fetch(imagePath)
        //         .then((response) => {
        //             if (response.ok) {
        //             console.log("Image loaded");
        //             img.attr("src", imagePath).show();
        //             } else {
        //             console.log("Image not found");
        //             }
        //         })
        //         .catch((error) => {
        //             Swal.fire({
        //             icon: "error",
        //             title: "Error",
        //             text: "An error occurred while fetching the image.",
        //             });
        //             console.error("Error fetching image:", error);
        //         });

        //         $("#updateEmployeeModal").modal("show");
        //     }
        //     },
        // });
        // });
    });

    function loadCashAdvanceData($requestID) {
        $.ajax({
            type: "GET",
            url: "../backend/team/cashAdvanceModal.php?requestID=" + $requestID,
            success: function (response) {
                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $("#viewRequestID").val(res.data.requestID);
                    $("#viewEmployeeID").val(res.data.employeeID);
                    $("#viewEmployeeName").val(
                        res.data.firstName + " " + res.data.lastName
                    );
                    $("#viewRequestorName").val(
                        res.data.requestorFirstName + " " + res.data.requestorLastName
                    );
                    $("#viewFiledDate").val(res.data.dateFiled);
                    $("#viewLoanAmount").val(
                        "₱ " + formatNumberWithCommas(res.data.amount)
                    );
                    $("#viewTotalAmount").val(
                        "₱ " + formatNumberWithCommas(res.data.amount)
                    );
                    $("#viewRemainingAmount").val(
                        "₱ " + formatNumberWithCommas(res.data.remainingAmount)
                    );
                    $("#viewMonthsToPay").val(
                        res.data.monthsToPay <= 1
                        ? res.data.monthsToPay + " month"
                        : res.data.monthsToPay + " months"
                    );
                    $("#viewMonthlyAmmortization").val(
                        "₱ " + formatNumberWithCommas(res.data.monthlyAmmortization)
                    );
                    $("#viewCutoffStart").val(res.data.cutoffStart);
                    $("#viewCAStatus").val(res.data.ca_status);
                    $("#viewRequestStatus").val(res.data.request_status);
                }
            },
        });
    }

    $("#btnClose").on("click", function () {
        window.location.reload();
    });
});
