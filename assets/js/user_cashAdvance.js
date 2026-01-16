function formatNumberWithCommas(number) {
    number = parseFloat(number);
    if (isNaN(number)) return "0.00";
    return number.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function formatDate(mmdd, year) {
    const [month, day] = mmdd.split("-");
    return new Date(year, month - 1, day).toLocaleDateString("en-US", {
        month: "short",
        day: "2-digit",
        year: "numeric",
    });
}

$(document).ready(function () {
    $("#cashAdvanceTable").DataTable({
        order: [],
    });

    $("#employeeID").inputmask("999-999", {
        placeholder: "XXX-XXX",
    });

    $("#breakdownDiv").hide();

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
            url: "../backend/user/fetchEmployees.php",
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
                        url: "../backend/user/fileCashAdvance.php",
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
            url: "../backend/user/cashAdvanceModal.php?requestID=" + id_request,
            success: function (response) {
                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $("#viewRequestID").val(res.data.requestID);
                    $("#viewEmployeeID").val(res.data.employeeID);
                    $("#viewEmployeeName").val(res.data.firstName + " " + res.data.lastName);
                    if (res.data.empID == res.data.requestorID) {
                        $("#endorsedByRow").hide();
                    }
                    else {
                        $("#viewRequestorName").val(res.data.requestorFirstName + " " + res.data.requestorLastName);
                    }
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

                    if (res.data.request_status == "Approved") {
                        $("#breakdownDiv").show();
                        let currentYear = new Date().getFullYear();
                        let previousCycle = null;
                        let previousYear = currentYear;
                        var caBreakdownHTML = "";    
                        let amount = res.data.amount;
                        let monthlyAmmortization = res.data.monthlyAmmortization;
                        
                        const paidCycleIDs = new Set();


                        // Collect ALL paid cycle IDs
                        if (Array.isArray(res.caPaymentHistory)) {
                            res.caPaymentHistory.forEach(row => {
                                paidCycleIDs.add(Number(row.payrollCycleID));
                            });
                        }

                        if (Array.isArray(res.caBreakdown)) {
                            res.caBreakdown.forEach(cabreakdown => {
                                const cycleID = Number(cabreakdown.payrollCycleID);
                                const isPaid = paidCycleIDs.has(cycleID);

                                // YEAR ROLLOVER: 24 → 1
                                if (previousCycle == 24 && cycleID == 1) {
                                    currentYear++;

                                    caBreakdownHTML += `
                                            <tr>
                                                <td>${formatDate(cabreakdown.payrollCycleFrom,previousYear)} - ${formatDate(cabreakdown.payrollCycleTo,currentYear)}</td>
                                                <td>${formatNumberWithCommas(amount)}</td>
                                                <td>${formatNumberWithCommas(monthlyAmmortization)}</td>
                                                <td>${isPaid ? `<p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Paid</p>` : ""}</td>
                                            </tr>
                                        `;
                                } else {
                                    caBreakdownHTML += `
                                            <tr>
                                                <td>${formatDate(cabreakdown.payrollCycleFrom,currentYear)} - ${formatDate(cabreakdown.payrollCycleTo,currentYear)}</td>
                                                <td>${formatNumberWithCommas(amount)}</td>
                                                <td>${formatNumberWithCommas(monthlyAmmortization)}</td>
                                                <td>${isPaid ? `<p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Paid</p>` : ""}</td>
                                            </tr>
                                        `;
                                }

                                amount -= monthlyAmmortization;
                                previousCycle = cycleID;
                            });
                        }

                        $("#breakdownSection").html(caBreakdownHTML);
                    }
                    // Show the modal
                    $("#viewCashAdvanceModal").modal("show");

                }
            },
        });
    });

    function loadCashAdvanceData($requestID) {
        $.ajax({
            type: "GET",
            url: "../backend/user/cashAdvanceModal.php?requestID=" + id_request,
            success: function (response) {
                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $("#viewRequestID").val(res.data.requestID);
                    $("#viewEmployeeID").val(res.data.employeeID);
                    $("#viewEmployeeName").val(res.data.firstName + " " + res.data.lastName);
                    if (res.data.empID == res.data.requestorID) {
                        $("#endorsedByRow").hide();
                    }
                    else {
                        $("#viewRequestorName").val(res.data.requestorFirstName + " " + res.data.requestorLastName);
                    }
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

                    let currentYear = new Date().getFullYear();
                    let previousCycle = null;
                    let previousYear = currentYear;
                    var caBreakdownHTML = "";    
                    let amount = res.data.amount;
                    let monthlyAmmortization = res.data.monthlyAmmortization;
                    
                    const paidCycleIDs = new Set();


                    // Collect ALL paid cycle IDs
                    if (Array.isArray(res.caPaymentHistory)) {
                        res.caPaymentHistory.forEach(row => {
                            paidCycleIDs.add(Number(row.payrollCycleID));
                        });
                    }

                    if (Array.isArray(res.caBreakdown)) {
                        res.caBreakdown.forEach(cabreakdown => {
                            const cycleID = Number(cabreakdown.payrollCycleID);
                            const isPaid = paidCycleIDs.has(cycleID);

                            // YEAR ROLLOVER: 24 → 1
                            if (previousCycle == 24 && cycleID == 1) {
                                currentYear++;

                                caBreakdownHTML += `
                                        <tr>
                                            <td>${formatDate(cabreakdown.payrollCycleFrom,previousYear)} - ${formatDate(cabreakdown.payrollCycleTo,currentYear)}</td>
                                            <td>${formatNumberWithCommas(amount)}</td>
                                            <td>${formatNumberWithCommas(monthlyAmmortization)}</td>
                                            <td>${isPaid ? `<p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Paid</p>` : ""}</td>
                                        </tr>
                                    `;
                            } else {
                                caBreakdownHTML += `
                                        <tr>
                                            <td>${formatDate(cabreakdown.payrollCycleFrom,currentYear)} -${formatDate(cabreakdown.payrollCycleTo,currentYear)}</td>
                                            <td>${formatNumberWithCommas(amount)}</td>
                                            <td>${formatNumberWithCommas(monthlyAmmortization)}</td>
                                            <td>${isPaid ? `<p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>Paid</p>` : ""}</td>
                                        </tr>
                                    `;
                            }

                            amount -= monthlyAmmortization;
                            previousCycle = cycleID;
                        });
                    }

                    $("#breakdownSection").html(caBreakdownHTML);
                }
            },
        });
    }

    $("#btnClose").on("click", function () {
        window.location.reload();
    });
});
