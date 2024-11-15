function formatNumberWithCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$(document).ready(function() {

    $('#employeeTable').DataTable();

    // INPUT MASK - ADD EMPLOYEE
    $('#sss').inputmask('99-9999999-9', {
        placeholder: '00-0000000-0'
    });

    $('#pagIbig').inputmask('99-9999999-9', {
        placeholder: '00-0000000-0'
    });

    $('#philhealth').inputmask('99-999999999-9', {
        placeholder: '00-000000000-0'
    });

    $('#tin').inputmask('99-9999999-9', {
        placeholder: '00-0000000-0'
    });

    $('#mobileNumber').inputmask('0999-999-9999', {
        placeholder: 'XXXX-XXX-XXXX',
    });

    $('#employeeID').inputmask('999-999', {
        placeholder: 'XXX-XXX'
    });

    // INPUT MASK - UPDATE EMPLOYEE
    $('#updateSSS').inputmask('99-9999999-9', {
        placeholder: '00-0000000-0'
    });

    $('#updatePagIbig').inputmask('99-9999999-9', {
        placeholder: '00-0000000-0'
    });

    $('#updatePhilhealth').inputmask('99-999999999-9', {
        placeholder: '00-000000000-0'
    });

    $('#updateTIN').inputmask('99-9999999-9', {
        placeholder: '00-0000000-0'
    });

    $('#updateMobileNumber').inputmask('0999-999-9999', {
        placeholder: 'XXXX-XXX-XXXX'
    });

    $('#updateEmployeeID').inputmask('999-999', {
        placeholder: 'XXX-XXX'
    });

    $("select[id='designation']").on("change", function() {
        $("input[id='basicPay']").val('');
        $("input[id='dailyRate']").val('');
        $("input[id='hourlyRate']").val('');
        if ($(this).val() == "Facilities") {
            // HOURLY RATE COMPUTATION - ADD EMPLOYEE
            $("input[id='basicPay']").on("input", function() {
                var basicPay = $(this).val();
                var dailyRate = (basicPay * 12 / 313).toFixed(2);
                $('#dailyRate').val(dailyRate).trigger('input');
            });

            $("input[id='dailyRate']").on("input", function() {
                var dailyRate = $(this).val();
                var hourlyRate = (dailyRate / 12).toFixed(2);
                $('#hourlyRate').val(hourlyRate);
            });
        } else {
            // HOURLY RATE COMPUTATION - ADD EMPLOYEE
            $("input[id='basicPay']").on("input", function() {
                var basicPay = $(this).val();
                var dailyRate = (basicPay * 12 / 261).toFixed(2);
                $('#dailyRate').val(dailyRate).trigger('input');
            });

            $("input[id='dailyRate']").on("input", function() {
                var dailyRate = $(this).val();
                var hourlyRate = (dailyRate / 8).toFixed(2);
                $('#hourlyRate').val(hourlyRate);
            });
        }
    });    

    $("select[id='updateDesignation']").on("change", function() {
        $("input[id='updateBasicPay']").val('');
        $("input[id='updateDailyRate']").val('');
        $("input[id='updateHourlyRate']").val('');
        if ($(this).val() == "Facilities") {
            // HOURLY RATE COMPUTATION - ADD EMPLOYEE
            $("input[id='updateBasicPay']").on("input", function() {
                var basicPay = $(this).val();
                var dailyRate = (basicPay * 12 / 313).toFixed(2);
                $('#updateDailyRate').val(dailyRate).trigger('input');
            });
        
            $("input[id='updateDailyRate']").on("input", function() {
                var dailyRate = $(this).val();
                var hourlyRate = (dailyRate / 12).toFixed(2);
                $('#updateHourlyRate').val(hourlyRate);
            });
        } else {
            // HOURLY RATE COMPUTATION - ADD EMPLOYEE
            $("input[id='updateBasicPay']").on("input", function() {
                var basicPay = $(this).val();
                var dailyRate = (basicPay * 12 / 261).toFixed(2);
                $('#updateDailyRate').val(dailyRate).trigger('input');
            });
        
            $("input[id='updateDailyRate']").on("input", function() {
                var dailyRate = $(this).val();
                var hourlyRate = (dailyRate / 8).toFixed(2);
                $('#updateHourlyRate').val(hourlyRate);
            });
        }
    });   
    

    // // HOURLY RATE COMPUTATION - ADD EMPLOYEE
    // $("input[id='basicPay']").on("input", function() {
    //     var basicPay = $(this).val();
    //     var dailyRate = (basicPay * 12 / 261).toFixed(2);
    //     $('#dailyRate').val(dailyRate).trigger('input');
    // });

    // $("input[id='dailyRate']").on("input", function() {
    //     var dailyRate = $(this).val();
    //     var hourlyRate = (dailyRate / 8).toFixed(2);
    //     $('#hourlyRate').val(hourlyRate);
    // });

    // // HOURLY RATE COMPUTATION - UPDATE EMPLOYEE
    // $("input[id='updateBasicPay']").on("input", function() {
    //     var basicPay = $(this).val();
    //     var dailyRate = (basicPay * 12 / 261).toFixed(2);
    //     $('#updateDailyRate').val(dailyRate).trigger('input');
    // });

    // $("input[id='updateDailyRate']").on("input", function() {
    //     var dailyRate = $(this).val();
    //     var hourlyRate = (dailyRate / 8).toFixed(2);
    //     $('#updateHourlyRate').val(hourlyRate);
    // });

    
    // CHECKBOXES FOR REQUIREMENTS - SSS, PAGIBIG, PHILHEALTH, TIN (ADD EMPLOYEE)
    $("input[id='sss']").on("input", function() {
        if ($(this).val().trim() !== "") {
            $('#req_sss').prop('checked', true);
        } else {
            $('#req_sss').prop('checked', false);
        }
    });

    $("input[id='pagIbig']").on("input", function() {
        if ($(this).val().trim() !== "") {
            $('#req_pagIbig').prop('checked', true);
        } else {
            $('#req_pagIbig').prop('checked', false);
        }
    });

    $("input[id='philhealth']").on("input", function() {
        if ($(this).val().trim() !== "") {
            $('#req_philhealth').prop('checked', true);
        } else {
            $('#req_philhealth').prop('checked', false);
        }
    });

    $("input[id='tin']").on("input", function() {
        if ($(this).val().trim() !== "") {
            $('#req_tin').prop('checked', true);
        } else {
            $('#req_tin').prop('checked', false);
        }
    });

    // CHECKBOXES FOR REQUIREMENTS - SSS, PAGIBIG, PHILHEALTH, TIN (ADD EMPLOYEE)
    $("input[id='updateSSS']").on("input", function() {
        if ($(this).val().trim() !== "") {
            $('#update_req_sss').prop('checked', true);
        } else {
            $('#update_req_sss').prop('checked', false);
        }
    });

    $("input[id='updatePagIbig']").on("input", function() {
        if ($(this).val().trim() !== "") {
            $('#update_req_pagIbig').prop('checked', true);
        } else {
            $('#update_req_pagIbig').prop('checked', false);
        }
    });

    $("input[id='updatePhilhealth']").on("input", function() {
        if ($(this).val().trim() !== "") {
            $('#update_req_philhealth').prop('checked', true);
        } else {
            $('#update_req_philhealth').prop('checked', false);
        }
    });

    $("input[id='updateTIN']").on("input", function() {
        if ($(this).val().trim() !== "") {
            $('#update_req_tin').prop('checked', true);
        } else {
            $('#update_req_tin').prop('checked', false);
        }
    });
    

    // ADD EMPLOYEE - UPLOAD PHOTO
    $('#photo').change(function() {
        const [file] = photo.files;
        const acceptedImageTypes = ['image/jpeg', 'image/png'];
        if (file) {
            const fileType = file['type'];
            if ($.inArray(fileType, acceptedImageTypes) < 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Picture',
                    text: 'Invalid File only accept (JPG/PNG) file',
                })
                $('#viewPhoto').attr('disabled', true);
                // $('#previewPhoto').hide();  // Hide the preview if the file is invalid
            } else {
                $('#viewPhoto').attr('disabled', false);  // Enable the view button
                // SHOW PREVIEW IMAGE
                // const reader = new FileReader();
                // reader.onload = (e) => {
                //     $('#previewPhoto').attr('src', e.target.result).show();
                // };
                // reader.readAsDataURL(file);
            }
        } else {
            $('#viewPhoto').attr('disabled', true);  // Disable the view button if no file is selected
            // $('#previewPhoto').hide();  // Hide the preview if no file is selected
        }
    });

    $('#viewPhoto').click(function() {
        const [file] = photo.files;
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                Swal.fire({
                    title: 'Profile Picture',
                    imageUrl: e.target.result,
                    imageHeight: 200,
                });
            }
            reader.readAsDataURL(file);
        }
    });

    // UPDATE EMPLOYEE - UPLOAD PHOTO
    $('#updateProfilePicture').change(function() {
        const [file] = updateProfilePicture.files;
        const acceptedImageTypes = ['image/jpeg', 'image/png'];
        if (file) {
            const fileType = file['type'];
            if ($.inArray(fileType, acceptedImageTypes) < 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Picture',
                    text: 'Invalid File only accept (JPG/PNG) file',
                })
                $('#viewUploadPhoto').attr('disabled', true);
                // $('#previewUploadPhoto').hide();  // Hide the preview if the file is invalid
            } else {
                $('#viewUploadPhoto').attr('disabled', false);  // Enable the view button
                // SHOW PREVIEW IMAGE
                // const reader = new FileReader();
                // reader.onload = (e) => {
                //     $('#previewUploadPhoto').attr('src', e.target.result).show();
                // };
                // reader.readAsDataURL(file);
            }
        } else {
            $('#viewUploadPhoto').attr('disabled', true);  // Disable the view button if no file is selected
            // $('#previewUploadPhoto').hide();  // Hide the preview if the file is invalid
        }
    });
    
    $('#viewUploadPhoto').click(function() {
        const [file] = updateProfilePicture.files;
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                Swal.fire({
                    title: 'Profile Picture',
                    imageUrl: e.target.result,
                    imageHeight: 200,
                });
            }
            reader.readAsDataURL(file);
        }
    });

    // ADD ALLOWANCE MODAL
    $('#effectivityDate_allowanceLabel').hide();
    $('#effectivityDate_allowance').hide();

    $("select[id='allowanceName'], select[id='allowanceType'], input[id='allowanceAmount']").on("input change", function() {
        if ($('#allowanceName').val() !== null && $('#allowanceType').val() !== null && $('#allowanceAmount').val() !== '') {
            $('#allowanceAdd').attr('disabled', false);
        } else {
            $('#allowanceAdd').attr('disabled', true);
        }
    });
    

    $('#allowanceType').on('change', function() {
        if ($(this).val() == '3') {
            $('#effectivityDate_allowanceLabel').show();
            $('#effectivityDate_allowance').show();
        } else {
            $('#effectivityDate_allowanceLabel').hide();
            $('#effectivityDate_allowance').hide();
        }
    })

    // ADD REIMBURSEMENT MODAL
    $('#reimbursement_oncePayrollCycleIDLabel').hide();
    $('#reimbursement_oncePayrollCycleID').hide();

    $("input[id='reimbursementName'], select[id='reimbursementType'], input[id='reimbursementAmount']").on("input change", function() {
        if ($('#reimbursementName').val() !== null && $('#reimbursementType').val() !== null && $('#reimbursementAmount').val() !== '') {
            $('#reimbursementAdd').attr('disabled', false);
        } else {
            $('#reimbursementAdd').attr('disabled', true);
        }
    });

    $('#reimbursementType').on('change', function() {
        if ($(this).val() == '3') {
            $('#reimbursement_oncePayrollCycleIDLabel').show();
            $('#reimbursement_oncePayrollCycleID').show();
        } else {    
            $('#reimbursement_oncePayrollCycleIDLabel').hide();
            $('#reimbursement_oncePayrollCycleID').hide();
        }
    })

    // ADD DEDUCTION MODAL
    $('#deduction_oncePayrollCycleIDLabel').hide();
    $('#deduction_oncePayrollCycleID').hide();

    $("input[id='deductionName'], select[id='deductionType'], input[id='deductionAmount']").on("input change", function() {
        if ($('#deductionName').val() !== null && $('#deductionType').val() !== null && $('#deductionAmount').val() !== '') {
            $('#deductionAdd').attr('disabled', false);
        } else {
            $('#deductionAdd').attr('disabled', true);
        }
    });

    $('#deductionType').on('change', function() {
        if ($(this).val() == '3') {
            $('#deduction_oncePayrollCycleIDLabel').show();
            $('#deduction_oncePayrollCycleID').show();
        } else {    
            $('#deduction_oncePayrollCycleIDLabel').hide();
            $('#deduction_oncePayrollCycleID').hide();
        }
    })

    // ADD ADJUSTMENT MODAL
    $('#adjustment_oncePayrollCycleIDLabel').hide();
    $('#adjustment_oncePayrollCycleID').hide();

    $("input[id='adjustmentName'], select[id='adjustmentType'], input[id='adjustmentAmount']").on("input change", function() {
        if ($('#adjustmentName').val() !== null && $('#adjustmentType').val() !== null && $('#adjustmentAmount').val() !== '') {
            $('#adjustmentAdd').attr('disabled', false);
        } else {
            $('#adjustmentAdd').attr('disabled', true);
        }
    });

    $('#adjustmentType').on('change', function() {
        if ($(this).val() == '3') {
            $('#adjustment_oncePayrollCycleIDLabel').show();
            $('#adjustment_oncePayrollCycleID').show();
        } else {    
            $('#adjustment_oncePayrollCycleIDLabel').hide();
            $('#adjustment_oncePayrollCycleID').hide();
        }
    })

    $('.cashAdvancePart').hide();

    // ADD EMPLOYEE
    $("#addEmployeeForm").submit(function (e) {

        e.preventDefault();

        let addEmployee = new FormData(this);
        var lastName = $("#lastName").val();
        var firstName = $("#firstName").val();
        var gender = $("#gender").val();
        var civilStatus = $("#civilStatus").val();
        var address = $("#address").val();
        var dateOfBirth = $("#dateOfBirth").val();
        var placeOfBirth = $("#placeOfBirth").val();
        var emailAddress = $("#emailAddress").val();
        var employeeID = $("#employeeID").val();
        var mobileNumber = $("#mobileNumber").val();
        var department = $("#department").val();
        var designation = $("#designation").val();
        var shiftID = $("#shiftID").val();
        var basicPay = $("#basicPay").val();
        var dailyRate = $("#dailyRate").val();
        var hourlyRate = $("#hourlyRate").val();
        var vacationLeaves = $("#vacationLeaves").val();
        var sickLeaves = $("#sickLeaves").val();

        if (lastName == "" || firstName == "" || gender == "" || civilStatus == "" || 
            address == "" || dateOfBirth == "" || placeOfBirth == "" ||
            emailAddress == "" || employeeID == "" || mobileNumber == "" ||
            department == "" || designation == "" || shiftID == "" || 
            basicPay == "" || dailyRate == "" || hourlyRate == "" || 
            vacationLeaves == "" || sickLeaves == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',
            })
        } else {
            Swal.fire({
                icon: 'question',
                title: 'Add Employee',
                text: 'Are you sure you want to add this employee?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "../backend/admin/addEmployee.php",
                        data: addEmployee,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.error == 0) {
                                var id = data.id;
                                loadEmployeeData(id);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    // Refresh the View Employee Modal with new added data
                                    $('#addEmployeeModal').modal('hide');
                                    $('#viewEmployeeModal').modal('show');
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: message
                                }) 
                            }
                        }
                    });
                }
            });
        }
    });

    // VIEW AND UPDATE EMPLOYEE
    var array = [];
    $(document).on('click', '.employeeView', function() {
        var employee_id = $(this).data('id');
        array.push(employee_id);
        var id_employee = array[array.length - 1];

        // VIEW EMPLOYEE
        $.ajax({
            type: "GET",
            url: "../backend/admin/employeeModal.php?employee_id=" + id_employee,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 & res.data.cashAdvance != null) {
                    $('#viewID').val(res.data.id);
                    $('#viewLastName').val(res.data.lastName);
                    $('#viewFirstName').val(res.data.firstName);
                    $('#viewGender').val(res.data.gender);
                    $('#viewCivilStatus').val(res.data.civilStatus);
                    $('#viewAddress').val(res.data.address);
                    $('#viewDateOfBirth').val(res.data.dateOfBirth);
                    $('#viewPlaceOfBirth').val(res.data.placeOfBirth);
                    $('#viewsss').val(res.data.sss);
                    $('#viewpagIbig').val(res.data.pagIbig);
                    $('#viewphilhealth').val(res.data.philhealth);
                    $('#viewtin').val(res.data.tin);
                    $('#viewEmailAddress').val(res.data.emailAddress);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewMobileNumber').val(res.data.mobileNumber);
                    $('#viewDepartment').val(res.data.departmentName);
                    $('#viewDesignation').val(res.data.position);
                    $('#viewShiftID').val(res.data.startTime + ' - ' + res.data.endTime);
                    $('#viewBasicPay').val(res.data.basicPay);
                    $('#viewDailyRate').val(res.data.dailyRate);
                    $('#viewHourlyRate').val(res.data.hourlyRate);
                    $('#viewVacationLeaves').val(res.data.availableVL);
                    $('#viewSickLeaves').val(res.data.availableSL);
                    $('#viewCashAdvance').val(res.data.cashAdvance);
                    $('.cashAdvancePart').show();
                    $('#view_req_sss').val(res.data.req_sss == 1 ? $('#view_req_sss').prop('checked', true) : $('#view_req_sss').prop('checked', false));
                    $('#view_req_pagIbig').val(res.data.req_pagIbig == 1 ? $('#view_req_pagIbig').prop('checked', true) : $('#view_req_pagIbig').prop('checked', false));
                    $('#view_req_philhealth').val(res.data.req_philhealth == 1 ? $('#view_req_philhealth').prop('checked', true) : $('#view_req_philhealth').prop('checked', false));
                    $('#view_req_tin').val(res.data.req_tin == 1 ? $('#view_req_tin').prop('checked', true) : $('#view_req_tin').prop('checked', false));
                    $('#view_req_nbi').val(res.data.req_nbi == 1 ? $('#view_req_nbi').prop('checked', true) : $('#view_req_nbi').prop('checked', false));
                    $('#view_req_medicalExam').val(res.data.req_medicalExam == 1 ? $('#view_req_medicalExam').prop('checked', true) : $('#view_req_medicalExam').prop('checked', false));
                    $('#view_req_2x2pic').val(res.data.req_2x2pic == 1 ? $('#view_req_2x2pic').prop('checked', true) : $('#view_req_2x2pic').prop('checked', false));
                    $('#view_req_vaccineCard').val(res.data.req_vaccineCard == 1 ? $('#view_req_vaccineCard').prop('checked', true) : $('#view_req_vaccineCard').prop('checked', false));
                    $('#view_req_psa').val(res.data.req_psa == 1 ? $('#view_req_psa').prop('checked', true) : $('#view_req_psa').prop('checked', false));
                    $('#view_req_validID').val(res.data.req_validID == 1 ? $('#view_req_validID').prop('checked', true) : $('#view_req_validID').prop('checked', false));
                    $('#view_req_helloMoney').val(res.data.req_helloMoney == 1 ? $('#view_req_helloMoney').prop('checked', true) : $('#view_req_helloMoney').prop('checked', false));
                    
                    // UPDATE ALLOWANCES SECTION
                    var allowancesHTML = '';
                    res.allowances.forEach(function(allowance) {
                        allowancesHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        allowancesHTML += '<span>' + allowance.allowanceName + '</span>';
                        allowancesHTML += '<p class="text-sm bg-green-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + allowance.amount + '</p>';
                        allowancesHTML += '<button class="p-2 rounded deleteAllowance" data-id="' + allowance.empAllowanceID + '">';
                        allowancesHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        allowancesHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        allowancesHTML += '</svg>';
                        allowancesHTML += '</button>';
                        allowancesHTML += '</div>';
                    });
                    $('#allowancesSection').html(allowancesHTML);

                    // UPDATE REIMBURSEMENTS SECTION
                    var reimbursementsHTML = '';
                    res.reimbursements.forEach(function(reimbursement) {
                        reimbursementsHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        reimbursementsHTML += '<span>' + reimbursement.reimbursementName + '</span>';
                        reimbursementsHTML += '<p class="text-sm bg-green-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + reimbursement.amount + '</p>';
                        reimbursementsHTML += '<button class="p-2 rounded deleteReimbursement" data-id="' + reimbursement.empReimbursementID + '">';
                        reimbursementsHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        reimbursementsHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        reimbursementsHTML += '</svg>';
                        reimbursementsHTML += '</button>';
                        reimbursementsHTML += '</div>';
                    });
                    $('#reimbursementsSection').html(reimbursementsHTML);

                    // UPDATE DEDUCTIONS SECTION
                    var deductionsHTML = '';
                    res.deductions.forEach(function(deduction) {
                        deductionsHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        deductionsHTML += '<span>' + deduction.deductionName + '</span>';
                        deductionsHTML += '<p class="text-sm bg-red-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + deduction.amount + '</p>';
                        deductionsHTML += '<button class="p-2 rounded deleteDeduction" data-id="' + deduction.empDeductionID + '">';
                        deductionsHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        deductionsHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        deductionsHTML += '</svg>';
                        deductionsHTML += '</button>';
                        deductionsHTML += '</div>';
                    });
                    $('#deductionsSection').html(deductionsHTML);

                    // UPDATE ADJUSTMENTS SECTION
                    var adjustmentsHTML = '';
                    res.adjustments.forEach(function(adjustment) {
                        adjustmentsHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        adjustmentsHTML += '<span>' + adjustment.adjustmentName + '</span>';
                        if (adjustment.adjustmentType == 'Add') {
                            adjustmentsHTML += '<p class="text-sm bg-green-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + adjustment.amount + '</p>';
                        }
                        else {
                            adjustmentsHTML += '<p class="text-sm bg-red-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + adjustment.amount + '</p>';
                        }
                        adjustmentsHTML += '<button class="p-2 rounded deleteAdjustment" data-id="' + adjustment.empAdjustmentID + '">';
                        adjustmentsHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        adjustmentsHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        adjustmentsHTML += '</svg>';
                        adjustmentsHTML += '</button>';
                        adjustmentsHTML += '</div>';
                    });
                    $('#adjustmentsSection').html(adjustmentsHTML);

                    // Show the modal
                    $('#viewEmployeeModal').modal('show');

                    let employeeID_string = res.data.employeeID;
                    $('#viewProfilePicture').click(function() {
                        const imagePath = '../assets/images/profiles/' + employeeID_string.replace("-", "") + '.png'; // Set your directory path here
                    
                        // Use the fetch API to check if the image exists
                        fetch(imagePath)
                            .then(response => {
                                if (response.ok) {
                                    Swal.fire({
                                        title: 'Profile Picture',
                                        imageUrl: imagePath,
                                        imageHeight: 300,
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Profile Picture',
                                        imageUrl: "../assets/images/profiles/profile.png",
                                        imageHeight: 300,
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An error occurred while fetching the image.',
                                });
                                console.error('Error fetching image:', error);
                            });
                    });
                }
                else  {
                    $('#viewID').val(res.data.id);
                    $('#viewLastName').val(res.data.lastName);
                    $('#viewFirstName').val(res.data.firstName);
                    $('#viewGender').val(res.data.gender);
                    $('#viewCivilStatus').val(res.data.civilStatus);
                    $('#viewAddress').val(res.data.address);
                    $('#viewDateOfBirth').val(res.data.dateOfBirth);
                    $('#viewPlaceOfBirth').val(res.data.placeOfBirth);
                    $('#viewsss').val(res.data.sss);
                    $('#viewpagIbig').val(res.data.pagIbig);
                    $('#viewphilhealth').val(res.data.philhealth);
                    $('#viewtin').val(res.data.tin);
                    $('#viewEmailAddress').val(res.data.emailAddress);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewMobileNumber').val(res.data.mobileNumber);
                    $('#viewDepartment').val(res.data.departmentName);
                    $('#viewDesignation').val(res.data.position);
                    $('#viewShiftID').val(res.data.startTime + ' - ' + res.data.endTime);
                    $('#viewBasicPay').val(res.data.basicPay);
                    $('#viewDailyRate').val(res.data.dailyRate);
                    $('#viewHourlyRate').val(res.data.hourlyRate);
                    $('#viewVacationLeaves').val(res.data.availableVL);
                    $('#viewSickLeaves').val(res.data.availableSL);
                    $('#view_req_sss').val(res.data.req_sss == 1 ? $('#view_req_sss').prop('checked', true) : $('#view_req_sss').prop('checked', false));
                    $('#view_req_pagIbig').val(res.data.req_pagIbig == 1 ? $('#view_req_pagIbig').prop('checked', true) : $('#view_req_pagIbig').prop('checked', false));
                    $('#view_req_philhealth').val(res.data.req_philhealth == 1 ? $('#view_req_philhealth').prop('checked', true) : $('#view_req_philhealth').prop('checked', false));
                    $('#view_req_tin').val(res.data.req_tin == 1 ? $('#view_req_tin').prop('checked', true) : $('#view_req_tin').prop('checked', false));
                    $('#view_req_nbi').val(res.data.req_nbi == 1 ? $('#view_req_nbi').prop('checked', true) : $('#view_req_nbi').prop('checked', false));
                    $('#view_req_medicalExam').val(res.data.req_medicalExam == 1 ? $('#view_req_medicalExam').prop('checked', true) : $('#view_req_medicalExam').prop('checked', false));
                    $('#view_req_2x2pic').val(res.data.req_2x2pic == 1 ? $('#view_req_2x2pic').prop('checked', true) : $('#view_req_2x2pic').prop('checked', false));
                    $('#view_req_vaccineCard').val(res.data.req_vaccineCard == 1 ? $('#view_req_vaccineCard').prop('checked', true) : $('#view_req_vaccineCard').prop('checked', false));
                    $('#view_req_psa').val(res.data.req_psa == 1 ? $('#view_req_psa').prop('checked', true) : $('#view_req_psa').prop('checked', false));
                    $('#view_req_validID').val(res.data.req_validID == 1 ? $('#view_req_validID').prop('checked', true) : $('#view_req_validID').prop('checked', false));
                    $('#view_req_helloMoney').val(res.data.req_helloMoney == 1 ? $('#view_req_helloMoney').prop('checked', true) : $('#view_req_helloMoney').prop('checked', false));
                    
                    // UPDATE ALLOWANCES SECTION
                    var allowancesHTML = '';
                    res.allowances.forEach(function(allowance) {
                        allowancesHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        allowancesHTML += '<span>' + allowance.allowanceName + '</span>';
                        allowancesHTML += '<p class="text-sm bg-green-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + allowance.amount + '</p>';
                        allowancesHTML += '<button class="p-2 rounded deleteAllowance" data-id="' + allowance.empAllowanceID + '">';
                        allowancesHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        allowancesHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        allowancesHTML += '</svg>';
                        allowancesHTML += '</button>';
                        allowancesHTML += '</div>';
                    });
                    $('#allowancesSection').html(allowancesHTML);

                    // UPDATE REIMBURSEMENTS SECTION
                    var reimbursementsHTML = '';
                    res.reimbursements.forEach(function(reimbursement) {
                        reimbursementsHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        reimbursementsHTML += '<span>' + reimbursement.reimbursementName + '</span>';
                        reimbursementsHTML += '<p class="text-sm bg-green-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + reimbursement.amount + '</p>';
                        reimbursementsHTML += '<button class="p-2 rounded deleteReimbursement" data-id="' + reimbursement.empReimbursementID + '">';
                        reimbursementsHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        reimbursementsHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        reimbursementsHTML += '</svg>';
                        reimbursementsHTML += '</button>';
                        reimbursementsHTML += '</div>';
                    });
                    $('#reimbursementsSection').html(reimbursementsHTML);

                    // UPDATE DEDUCTIONS SECTION
                    var deductionsHTML = '';
                    res.deductions.forEach(function(deduction) {
                        deductionsHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        deductionsHTML += '<span>' + deduction.deductionName + '</span>';
                        deductionsHTML += '<p class="text-sm bg-red-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + deduction.amount + '</p>';
                        deductionsHTML += '<button class="p-2 rounded deleteDeduction" data-id="' + deduction.empDeductionID + '">';
                        deductionsHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        deductionsHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        deductionsHTML += '</svg>';
                        deductionsHTML += '</button>';
                        deductionsHTML += '</div>';
                    });
                    $('#deductionsSection').html(deductionsHTML);

                    // UPDATE ADJUSTMENTS SECTION
                    var adjustmentsHTML = '';
                    res.adjustments.forEach(function(adjustment) {
                        adjustmentsHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        adjustmentsHTML += '<span>' + adjustment.adjustmentName + '</span>';
                        if (adjustment.adjustmentType == 'Add') {
                            adjustmentsHTML += '<p class="text-sm bg-green-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + adjustment.amount + '</p>';
                        }
                        else {
                            adjustmentsHTML += '<p class="text-sm bg-red-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + adjustment.amount + '</p>';
                        }
                        adjustmentsHTML += '<button class="p-2 rounded deleteAdjustment" data-id="' + adjustment.empAdjustmentID + '">';
                        adjustmentsHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        adjustmentsHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        adjustmentsHTML += '</svg>';
                        adjustmentsHTML += '</button>';
                        adjustmentsHTML += '</div>';
                    });
                    $('#adjustmentsSection').html(adjustmentsHTML);

                    // Show the modal
                    $('#viewEmployeeModal').modal('show');

                    let employeeID_string = res.data.employeeID;
                    $('#viewProfilePicture').click(function() {
                        const imagePath = '../assets/images/profiles/' + employeeID_string.replace("-", "") + '.png'; // Set your directory path here
                    
                        // Use the fetch API to check if the image exists
                        fetch(imagePath)
                            .then(response => {
                                if (response.ok) {
                                    Swal.fire({
                                        title: 'Profile Picture',
                                        imageUrl: imagePath,
                                        imageHeight: 300,
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Profile Picture',
                                        imageUrl: "../assets/images/profiles/profile.png",
                                        imageHeight: 300,
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An error occurred while fetching the image.',
                                });
                                console.error('Error fetching image:', error);
                            });
                    });
                }
            }
        });

        // UPDATE EMPLOYEE
        $(document).on('click', '.employeeUpdate', function() {
            $('#viewEmployeeModal').modal('hide');
            var id_employee = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/employeeModal.php?employee_id=" + id_employee,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } 
                    else if (res.status == 200) {
                        $('#updateID').val(res.data.id);
                        $('#updateLastName').val(res.data.lastName);
                        $('#updateFirstName').val(res.data.firstName);
                        $('#updateGender').val(res.data.gender);
                        $('#updateCivilStatus').val(res.data.civilStatus);
                        $('#updateAddress').val(res.data.address);
                        $('#updateDateOfBirth').val(res.data.dateOfBirth);
                        $('#updatePlaceOfBirth').val(res.data.placeOfBirth);
                        $('#updateSSS').val(res.data.sss);
                        $('#updatePagIbig').val(res.data.pagIbig);
                        $('#updatePhilhealth').val(res.data.philhealth);
                        $('#updateTIN').val(res.data.tin);
                        $('#updateEmailAddress').val(res.data.emailAddress);
                        $('#updateEmployeeID').val(res.data.employeeID);
                        $('#updateMobileNumber').val(res.data.mobileNumber);
                        $('#updateDepartment').val(res.data.departmentName);
                        $('#updateDesignation').val(res.data.position);
                        $('#updateShiftID').val(res.data.startTime + ' - ' + res.data.endTime);
                        $('#updateBasicPay').val(res.data.basicPay);
                        $('#updateDailyRate').val(res.data.dailyRate);
                        $('#updateHourlyRate').val(res.data.hourlyRate);
                        $('#updateVacationLeaves').val(res.data.availableVL);
                        $('#updateSickLeaves').val(res.data.availableSL);
                        $('#updateCashAdvance').val(res.data.cashAdvance);
                        $('#update_req_sss').val(res.data.req_sss == 1 ? $('#update_req_sss').prop('checked', true) : $('#update_req_sss').prop('checked', false));
                        $('#update_req_pagIbig').val(res.data.req_pagIbig == 1 ? $('#update_req_pagIbig').prop('checked', true) : $('#update_req_pagIbig').prop('checked', false));
                        $('#update_req_philhealth').val(res.data.req_philhealth == 1 ? $('#update_req_philhealth').prop('checked', true) : $('#update_req_philhealth').prop('checked', false));
                        $('#update_req_tin').val(res.data.req_tin == 1 ? $('#update_req_tin').prop('checked', true) : $('#update_req_tin').prop('checked', false));
                        $('#update_req_nbi').val(res.data.req_nbi == 1 ? $('#update_req_nbi').prop('checked', true) : $('#update_req_nbi').prop('checked', false));
                        $('#update_req_medicalExam').val(res.data.req_medicalExam == 1 ? $('#update_req_medicalExam').prop('checked', true) : $('#update_req_medicalExam').prop('checked', false));
                        $('#update_req_2x2pic').val(res.data.req_2x2pic == 1 ? $('#update_req_2x2pic').prop('checked', true) : $('#update_req_2x2pic').prop('checked', false));
                        $('#update_req_vaccineCard').val(res.data.req_vaccineCard == 1 ? $('#update_req_vaccineCard').prop('checked', true) : $('#update_req_vaccineCard').prop('checked', false));
                        $('#update_req_psa').val(res.data.req_psa == 1 ? $('#update_req_psa').prop('checked', true) : $('#update_req_psa').prop('checked', false));
                        $('#update_req_validID').val(res.data.req_validID == 1 ? $('#update_req_validID').prop('checked', true) : $('#update_req_validID').prop('checked', false));
                        $('#update_req_helloMoney').val(res.data.req_helloMoney == 1 ? $('#update_req_helloMoney').prop('checked', true) : $('#update_req_helloMoney').prop('checked', false));
                        $('#oldEmailAddress').val(res.data.emailAddress);
                        $('#oldEmployeeID').val(res.data.employeeID);
                        $('#updateEmployeeModal').modal('show');
                    }
                }
            });
        })
    });

    // UPDATE EMPLOYEE
    $("#updateEmployeeForm").submit(function (e) {
        
        e.preventDefault();

        let updateEmployee = new FormData(this);
        var updateID = $("#updateID").val();
        var updateLastName = $("#updateLastName").val();
        var updateFirstName = $("#updateFirstName").val();
        var updateGender = $("#updateGender").val();
        var updateCivilStatus = $("#updateCivilStatus").val();
        var updateAddress = $("#updateAddress").val();
        var updateDateOfBirth = $("#updateDateOfBirth").val();
        var updatePlaceOfBirth = $("#updatePlaceOfBirth").val();
        var updateEmailAddress = $("#updateEmailAddress").val();
        var updateEmployeeID = $("#updateEmployeeID").val();
        var updateMobileNumber = $("#updateMobileNumber").val();
        var updateDepartment = $("#updateDepartment").val();
        var updateDesignation = $("#updateDesignation").val();
        var updateShiftID = $("#updateShiftID").val();
        var updateBasicPay = $("#updateBasicPay").val();
        var updateDailyRate = $("#updateDailyRate").val();
        var updateHourlyRate = $("#updateHourlyRate").val();
        var updateVacationLeaves = $("#updateVacationLeaves").val();
        var updateSickLeaves = $("#updateSickLeaves").val();
        var updateCashAdvance = $("#updateCashAdvance").val();

        if (updateLastName == "" || updateFirstName == "" || updateGender == "" || updateCivilStatus == "" || 
            updateAddress == "" || updateDateOfBirth == "" || updatePlaceOfBirth == "" ||
            updateSSS == "" || updatePagIbig == "" || updatePhilhealth == "" || updateTIN == "" ||
            updateEmailAddress == "" || updateEmployeeID == "" || updateMobileNumber == "" ||
            updateDepartment == "" || updateDesignation == "" || updateShiftID == "" || 
            updateBasicPay == "" || updateDailyRate == "" || updateHourlyRate == "" || 
            updateVacationLeaves == "" || updateSickLeaves == "") {

            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill up all the required Information',

            })

        } else {
            Swal.fire({
                icon: 'question',
                title: 'Update Employee Information',
                text: 'Are you sure you want to save the changes you made?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',

            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: '../backend/admin/updateEmployee.php',
                        type: 'POST',
                        data: updateEmployee,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            const data = JSON.parse(res);
                            if (data.error == 0) {
                                var message = data.em
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000, 
                                    showConfirmButton: false,
                                }).then(() => {
                                    // Refresh the View Employee Modal with updated data
                                    loadEmployeeData(updateID);
                                    $('#updateEmployeeModal').modal('hide');
                                    $('#viewEmployeeModal').modal('show');
                                })
                            } else {
                                var message = data.em;
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Warning', 
                                    text: message,
                                })
                            }
                        }
                    })
                }
            })
        }       

    });

    function loadEmployeeData(id_employee) {
        $.ajax({
            type: "GET",
            url: "../backend/admin/employeeModal.php?employee_id=" + id_employee,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200 && res.data.cashAdvance != null) {
                    $('#viewID').val(res.data.id);
                    $('#viewLastName').val(res.data.lastName);
                    $('#viewFirstName').val(res.data.firstName);
                    $('#viewGender').val(res.data.gender);
                    $('#viewCivilStatus').val(res.data.civilStatus);
                    $('#viewAddress').val(res.data.address);
                    $('#viewDateOfBirth').val(res.data.dateOfBirth);
                    $('#viewPlaceOfBirth').val(res.data.placeOfBirth);
                    $('#viewsss').val(res.data.sss);
                    $('#viewpagIbig').val(res.data.pagIbig);
                    $('#viewphilhealth').val(res.data.philhealth);
                    $('#viewtin').val(res.data.tin);
                    $('#viewEmailAddress').val(res.data.emailAddress);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewMobileNumber').val(res.data.mobileNumber);
                    $('#viewDepartment').val(res.data.departmentName);
                    $('#viewDesignation').val(res.data.position);
                    $('#viewShiftID').val(res.data.startTime + ' - ' + res.data.endTime);
                    $('#viewBasicPay').val(res.data.basicPay);
                    $('#viewDailyRate').val(res.data.dailyRate);
                    $('#viewHourlyRate').val(res.data.hourlyRate);
                    $('#viewVacationLeaves').val(res.data.availableVL);
                    $('#viewSickLeaves').val(res.data.availableSL);
                    $('#viewCashAdvance').val(res.data.cashAdvance);
                    $('.cashAdvancePart').show();
                    $('#view_req_sss').val(res.data.req_sss == 1 ? $('#view_req_sss').prop('checked', true) : $('#view_req_sss').prop('checked', false));
                    $('#view_req_pagIbig').val(res.data.req_pagIbig == 1 ? $('#view_req_pagIbig').prop('checked', true) : $('#view_req_pagIbig').prop('checked', false));
                    $('#view_req_philhealth').val(res.data.req_philhealth == 1 ? $('#view_req_philhealth').prop('checked', true) : $('#view_req_philhealth').prop('checked', false));
                    $('#view_req_tin').val(res.data.req_tin == 1 ? $('#view_req_tin').prop('checked', true) : $('#view_req_tin').prop('checked', false));
                    $('#view_req_nbi').val(res.data.req_nbi == 1 ? $('#view_req_nbi').prop('checked', true) : $('#view_req_nbi').prop('checked', false));
                    $('#view_req_medicalExam').val(res.data.req_medicalExam == 1 ? $('#view_req_medicalExam').prop('checked', true) : $('#view_req_medicalExam').prop('checked', false));
                    $('#view_req_2x2pic').val(res.data.req_2x2pic == 1 ? $('#view_req_2x2pic').prop('checked', true) : $('#view_req_2x2pic').prop('checked', false));
                    $('#view_req_vaccineCard').val(res.data.req_vaccineCard == 1 ? $('#view_req_vaccineCard').prop('checked', true) : $('#view_req_vaccineCard').prop('checked', false));
                    $('#view_req_psa').val(res.data.req_psa == 1 ? $('#view_req_psa').prop('checked', true) : $('#view_req_psa').prop('checked', false));
                    $('#view_req_validID').val(res.data.req_validID == 1 ? $('#view_req_validID').prop('checked', true) : $('#view_req_validID').prop('checked', false));
                    $('#view_req_helloMoney').val(res.data.req_helloMoney == 1 ? $('#view_req_helloMoney').prop('checked', true) : $('#view_req_helloMoney').prop('checked', false));
                    
                    // UPDATE ALLOWANCES SECTION
                    var allowancesHTML = '';
                    res.allowances.forEach(function(allowance) {
                        allowancesHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        allowancesHTML += '<span>' + allowance.allowanceName + '</span>';
                        allowancesHTML += '<p class="text-sm bg-green-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + allowance.amount + '</p>';
                        allowancesHTML += '<button class="p-2 rounded deleteAllowance" data-id="' + allowance.empAllowanceID + '">';
                        allowancesHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        allowancesHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        allowancesHTML += '</svg>';
                        allowancesHTML += '</button>';
                        allowancesHTML += '</div>';
                    });
                    $('#allowancesSection').html(allowancesHTML);

                    // UPDATE REIMBURSEMENTS SECTION
                    var reimbursementsHTML = '';
                    res.reimbursements.forEach(function(reimbursement) {
                        reimbursementsHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        reimbursementsHTML += '<span>' + reimbursement.reimbursementName + '</span>';
                        reimbursementsHTML += '<p class="text-sm bg-green-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + reimbursement.amount + '</p>';
                        reimbursementsHTML += '<button class="p-2 rounded deleteReimbursement" data-id="' + reimbursement.empReimbursementID + '">';
                        reimbursementsHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        reimbursementsHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        reimbursementsHTML += '</svg>';
                        reimbursementsHTML += '</button>';
                        reimbursementsHTML += '</div>';
                    });
                    $('#reimbursementsSection').html(reimbursementsHTML);

                    // UPDATE DEDUCTIONS SECTION
                    var deductionsHTML = '';
                    res.deductions.forEach(function(deduction) {
                        deductionsHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        deductionsHTML += '<span>' + deduction.deductionName + '</span>';
                        deductionsHTML += '<p class="text-sm bg-red-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + deduction.amount + '</p>';
                        deductionsHTML += '<button class="p-2 rounded deleteDeduction" data-id="' + deduction.empDeductionID + '">';
                        deductionsHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        deductionsHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        deductionsHTML += '</svg>';
                        deductionsHTML += '</button>';
                        deductionsHTML += '</div>';
                    });
                    $('#deductionsSection').html(deductionsHTML);

                    // UPDATE ADJUSTMENTS SECTION
                    var adjustmentsHTML = '';
                    res.adjustments.forEach(function(adjustment) {
                        adjustmentsHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        adjustmentsHTML += '<span>' + adjustment.adjustmentName + '</span>';
                        if (adjustment.adjustmentType == 'Add') {
                            adjustmentsHTML += '<p class="text-sm bg-green-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + adjustment.amount + '</p>';
                        }
                        else {
                            adjustmentsHTML += '<p class="text-sm bg-red-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + adjustment.amount + '</p>';
                        }
                        adjustmentsHTML += '<button class="p-2 rounded deleteAdjustment" data-id="' + adjustment.empAdjustmentID + '">';
                        adjustmentsHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        adjustmentsHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        adjustmentsHTML += '</svg>';
                        adjustmentsHTML += '</button>';
                        adjustmentsHTML += '</div>';
                    });
                    $('#adjustmentsSection').html(adjustmentsHTML);

                    let employeeID_string = res.data.employeeID;
                    $('#viewProfilePicture').click(function() {
                        const imagePath = '../assets/images/profiles/' + employeeID_string.replace("-", "") + '.png'; // Set your directory path here
                    
                        // Use the fetch API to check if the image exists
                        fetch(imagePath)
                            .then(response => {
                                if (response.ok) {
                                    Swal.fire({
                                        title: 'Profile Picture',
                                        imageUrl: imagePath,
                                        imageHeight: 300,
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Profile Picture',
                                        imageUrl: "../assets/images/profiles/profile.png",
                                        imageHeight: 300,
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An error occurred while fetching the image.',
                                });
                                console.error('Error fetching image:', error);
                            });
                    });
                }
                else {
                    $('#viewID').val(res.data.id);
                    $('#viewLastName').val(res.data.lastName);
                    $('#viewFirstName').val(res.data.firstName);
                    $('#viewGender').val(res.data.gender);
                    $('#viewCivilStatus').val(res.data.civilStatus);
                    $('#viewAddress').val(res.data.address);
                    $('#viewDateOfBirth').val(res.data.dateOfBirth);
                    $('#viewPlaceOfBirth').val(res.data.placeOfBirth);
                    $('#viewsss').val(res.data.sss);
                    $('#viewpagIbig').val(res.data.pagIbig);
                    $('#viewphilhealth').val(res.data.philhealth);
                    $('#viewtin').val(res.data.tin);
                    $('#viewEmailAddress').val(res.data.emailAddress);
                    $('#viewEmployeeID').val(res.data.employeeID);
                    $('#viewMobileNumber').val(res.data.mobileNumber);
                    $('#viewDepartment').val(res.data.departmentName);
                    $('#viewDesignation').val(res.data.position);
                    $('#viewShiftID').val(res.data.startTime + ' - ' + res.data.endTime);
                    $('#viewBasicPay').val(res.data.basicPay);
                    $('#viewDailyRate').val(res.data.dailyRate);
                    $('#viewHourlyRate').val(res.data.hourlyRate);
                    $('#viewVacationLeaves').val(res.data.availableVL);
                    $('#viewSickLeaves').val(res.data.availableSL);
                    $('#view_req_sss').val(res.data.req_sss == 1 ? $('#view_req_sss').prop('checked', true) : $('#view_req_sss').prop('checked', false));
                    $('#view_req_pagIbig').val(res.data.req_pagIbig == 1 ? $('#view_req_pagIbig').prop('checked', true) : $('#view_req_pagIbig').prop('checked', false));
                    $('#view_req_philhealth').val(res.data.req_philhealth == 1 ? $('#view_req_philhealth').prop('checked', true) : $('#view_req_philhealth').prop('checked', false));
                    $('#view_req_tin').val(res.data.req_tin == 1 ? $('#view_req_tin').prop('checked', true) : $('#view_req_tin').prop('checked', false));
                    $('#view_req_nbi').val(res.data.req_nbi == 1 ? $('#view_req_nbi').prop('checked', true) : $('#view_req_nbi').prop('checked', false));
                    $('#view_req_medicalExam').val(res.data.req_medicalExam == 1 ? $('#view_req_medicalExam').prop('checked', true) : $('#view_req_medicalExam').prop('checked', false));
                    $('#view_req_2x2pic').val(res.data.req_2x2pic == 1 ? $('#view_req_2x2pic').prop('checked', true) : $('#view_req_2x2pic').prop('checked', false));
                    $('#view_req_vaccineCard').val(res.data.req_vaccineCard == 1 ? $('#view_req_vaccineCard').prop('checked', true) : $('#view_req_vaccineCard').prop('checked', false));
                    $('#view_req_psa').val(res.data.req_psa == 1 ? $('#view_req_psa').prop('checked', true) : $('#view_req_psa').prop('checked', false));
                    $('#view_req_validID').val(res.data.req_validID == 1 ? $('#view_req_validID').prop('checked', true) : $('#view_req_validID').prop('checked', false));
                    $('#view_req_helloMoney').val(res.data.req_helloMoney == 1 ? $('#view_req_helloMoney').prop('checked', true) : $('#view_req_helloMoney').prop('checked', false));
                    
                    // UPDATE ALLOWANCES SECTION
                    var allowancesHTML = '';
                    res.allowances.forEach(function(allowance) {
                        allowancesHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        allowancesHTML += '<span>' + allowance.allowanceName + '</span>';
                        allowancesHTML += '<p class="text-sm bg-green-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + allowance.amount + '</p>';
                        allowancesHTML += '<button class="p-2 rounded deleteAllowance" data-id="' + allowance.empAllowanceID + '">';
                        allowancesHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        allowancesHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        allowancesHTML += '</svg>';
                        allowancesHTML += '</button>';
                        allowancesHTML += '</div>';
                    });
                    $('#allowancesSection').html(allowancesHTML);

                    // UPDATE REIMBURSEMENTS SECTION
                    var reimbursementsHTML = '';
                    res.reimbursements.forEach(function(reimbursement) {
                        reimbursementsHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        reimbursementsHTML += '<span>' + reimbursement.reimbursementName + '</span>';
                        reimbursementsHTML += '<p class="text-sm bg-green-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + reimbursement.amount + '</p>';
                        reimbursementsHTML += '<button class="p-2 rounded deleteReimbursement" data-id="' + reimbursement.empReimbursementID + '">';
                        reimbursementsHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        reimbursementsHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        reimbursementsHTML += '</svg>';
                        reimbursementsHTML += '</button>';
                        reimbursementsHTML += '</div>';
                    });
                    $('#reimbursementsSection').html(reimbursementsHTML);

                    // UPDATE DEDUCTIONS SECTION
                    var deductionsHTML = '';
                    res.deductions.forEach(function(deduction) {
                        deductionsHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        deductionsHTML += '<span>' + deduction.deductionName + '</span>';
                        deductionsHTML += '<p class="text-sm bg-red-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + deduction.amount + '</p>';
                        deductionsHTML += '<button class="p-2 rounded deleteDeduction" data-id="' + deduction.empDeductionID + '">';
                        deductionsHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        deductionsHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        deductionsHTML += '</svg>';
                        deductionsHTML += '</button>';
                        deductionsHTML += '</div>';
                    });
                    $('#deductionsSection').html(deductionsHTML);

                    // UPDATE ADJUSTMENTS SECTION
                    var adjustmentsHTML = '';
                    res.adjustments.forEach(function(adjustment) {
                        adjustmentsHTML += '<div class="flex justify-between items-center bg-white p-2 border border-gray-200">';
                        adjustmentsHTML += '<span>' + adjustment.adjustmentName + '</span>';
                        if (adjustment.adjustmentType == 'Add') {
                            adjustmentsHTML += '<p class="text-sm bg-green-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + adjustment.amount + '</p>';
                        }
                        else {
                            adjustmentsHTML += '<p class="text-sm bg-red-500 text-white py-1 px-2 rounded-full my-auto">₱ ' + adjustment.amount + '</p>';
                        }
                        adjustmentsHTML += '<button class="p-2 rounded deleteAdjustment" data-id="' + adjustment.empAdjustmentID + '">';
                        adjustmentsHTML += '<svg class="h-5 w-5 text-gray-800"  fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                        adjustmentsHTML += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
                        adjustmentsHTML += '</svg>';
                        adjustmentsHTML += '</button>';
                        adjustmentsHTML += '</div>';
                    });
                    $('#adjustmentsSection').html(adjustmentsHTML);

                    let employeeID_string = res.data.employeeID;
                    $('#viewProfilePicture').click(function() {
                        const imagePath = '../assets/images/profiles/' + employeeID_string.replace("-", "") + '.png'; // Set your directory path here
                    
                        // Use the fetch API to check if the image exists
                        fetch(imagePath)
                            .then(response => {
                                if (response.ok) {
                                    Swal.fire({
                                        title: 'Profile Picture',
                                        imageUrl: imagePath,
                                        imageHeight: 300,
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Profile Picture',
                                        imageUrl: "../assets/images/profiles/profile.png",
                                        imageHeight: 300,
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An error occurred while fetching the image.',
                                });
                                console.error('Error fetching image:', error);
                            });
                    });
                }
            }
        });
    }

    // CLOSE VIEW EMPLOYEE MODAL
    $('#btnClose').on('click', function() {
        window.location.reload();
    });


    // REMOVE ALLOWANCE ROW ON VIEW EMPLOYEE MODAL
    $(document).on('click', '.deleteAllowance', function() {
        var empAllowanceID = $(this).data('id');
        var viewID = $('#viewID').val();
        
        Swal.fire({
            icon: 'question',
            title: 'Delete Allowance',
            text: 'Are you sure you want to delete this allowance?',
            showCancelButton: true,
            cancelButtonColor: '#6c757d',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Yes',

        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "../backend/admin/deleteEmpAdjustment.php",
                    type: 'POST',
                    data: { empAllowanceID: empAllowanceID },
                    success: function(response) {
                        const res = JSON.parse(response);
                        var message = res.em;
                        if (res.error == 0) {
                            loadEmployeeData(viewID);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                $('#viewEmployeeModal').modal('show');
                            });
                        }
                        else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: message
                            })
                        }
                    }
                })
            }
        })
        
    });

    // REMOVE REIMBURSEMENT ROW ON VIEW EMPLOYEE MODAL
    $(document).on('click', '.deleteReimbursement', function() {
        var empReimbursementID = $(this).data('id');
        var viewID = $('#viewID').val();
        
        Swal.fire({
            icon: 'question',
            title: 'Delete Reimbursement',
            text: 'Are you sure you want to delete this reimbursement?',
            showCancelButton: true,
            cancelButtonColor: '#6c757d',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Yes',

        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "../backend/admin/deleteEmpAdjustment.php",
                    type: 'POST',
                    data: { empReimbursementID: empReimbursementID },
                    success: function(response) {
                        const res = JSON.parse(response);
                        var message = res.em;
                        if (res.error == 0) {
                            loadEmployeeData(viewID);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                $('#viewEmployeeModal').modal('show');
                            });
                        }
                        else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: message
                            })
                        }
                    }
                })
            }
        })
        
    });
    
    // REMOVE DEDUCTION ROW ON VIEW EMPLOYEE MODAL
    $(document).on('click', '.deleteDeduction', function() {
        var empDeductionID = $(this).data('id');
        var viewID = $('#viewID').val();
        
        Swal.fire({
            icon: 'question',
            title: 'Delete Deduction',
            text: 'Are you sure you want to delete this deduction?',
            showCancelButton: true,
            cancelButtonColor: '#6c757d',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Yes',

        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "../backend/admin/deleteEmpAdjustment.php",
                    type: 'POST',
                    data: { empDeductionID: empDeductionID },
                    success: function(response) {
                        const res = JSON.parse(response);
                        var message = res.em;
                        if (res.error == 0) {
                            loadEmployeeData(viewID);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                $('#viewEmployeeModal').modal('show');
                            });
                        }
                        else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: message
                            })
                        }
                    }
                })
            }
        })
    });

    // REMOVE ADJUSTMENT ROW ON VIEW EMPLOYEE MODAL
    $(document).on('click', '.deleteAdjustment', function() {
        var empAdjustmentID = $(this).data('id');
        var viewID = $('#viewID').val();
        
        Swal.fire({
            icon: 'question',
            title: 'Delete Adjustment',
            text: 'Are you sure you want to delete this adjustment?',
            showCancelButton: true,
            cancelButtonColor: '#6c757d',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Yes',

        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "../backend/admin/deleteEmpAdjustment.php",
                    type: 'POST',
                    data: { empAdjustmentID: empAdjustmentID },
                    success: function(response) {
                        const res = JSON.parse(response);
                        var message = res.em;
                        if (res.error == 0) {
                            loadEmployeeData(viewID);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                $('#viewEmployeeModal').modal('show');
                            });
                        }
                        else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: message
                            })
                        }
                    }
                })
            }
        })
    });


    // ADD DATA - ALLOWANCE MODAL
    $("#allowanceForm").on("submit", function (e) {
        e.preventDefault();

        // GET FORM VALUES
        var allowanceName = $("#allowanceName option:selected").text();
        var allowanceID = $("#allowanceName").val();
        var allowanceAmount = $("#allowanceAmount").val();
        var allowanceType = $("#allowanceType option:selected").text();
        var effectivityDate = $("#effectivityDate_allowance").val();

        // VALIDATION IF THERE IS NULL / EMPTY
        if (!allowanceID || !allowanceAmount || !$("#allowanceType").val()) {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill in all required fields: Name, Type, and Amount.',
            })
        }
        else {
            // ADD ROW TO THE TABLE
            var markup = "<tr data-allowance-id='" + allowanceID + "' data-amount='" + allowanceAmount + "' data-type='" + $("#allowanceType").val() + "' data-date='" + effectivityDate + "'>" +
                "<td>" + allowanceName + "</td>" +
                "<td>" + allowanceType + "</td>" +
                "<td>" + allowanceAmount + "</td>" +
                "<td><button type='button' class='btn btn-danger btn-sm removeRow'>Remove</button></td>" +
                "</tr>";

            $("#allowanceTable tbody").append(markup);

            // CLEAR FORM FIELDS
            $("#allowanceForm")[0].reset();

            // RESET THE SELECT ELEMENTS TO DEFAULT OPTIONS
            $("#allowanceName").prop('selectedIndex', 0);
            $("#allowanceType").prop('selectedIndex', 0);
        }

    });

    // ADD DATA - REIMBURSEMENT MODAL
    $("#reimbursementForm").on("submit", function (e) {
        e.preventDefault();

        // GET FORM VALUES
        var reimbursementName = $("#reimbursementName option:selected").text();
        var reimbursementID = $("#reimbursementName").val();
        var reimbursementAmount = $("#reimbursementAmount").val();
        var reimbursementType = $("#reimbursementType option:selected").text();
        var reimbursement_oncePayrollCycleID = $("#reimbursement_oncePayrollCycleID option:selected").val();

        // VALIDATION IF THERE IS NULL / EMPTY
        if (!reimbursementID || !reimbursementAmount || !$("#reimbursementType").val()) {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill in all required fields: Name, Type, and Amount.',
            })
        }
        else {
            // ADD ROW TO THE TABLE
            var markup = "<tr data-reimbursement-id='" + reimbursementID + "' data-amount='" + reimbursementAmount + "' data-type='" + $("#reimbursementType").val() + "' data-cycle='" + $("#reimbursement_oncePayrollCycleID").val() + "'>" +
                "<td>" + reimbursementName + "</td>" +
                "<td>" + reimbursementType + "</td>" +
                "<td>" + reimbursementAmount + "</td>" +
                "<td><button type='button' class='btn btn-danger btn-sm removeRow'>Remove</button></td>" +
                "</tr>";

            $("#reimbursementTable tbody").append(markup);

            // CLEAR FORM FIELDS
            $("#reimbursementForm")[0].reset();

            // RESET THE SELECT ELEMENTS TO DEFAULT OPTIONS
            $("#reimbursementName").prop('selectedIndex', 0);
            $("#reimbursementType").prop('selectedIndex', 0);
        }

    });

    // ADD DATA - DEDUCTION MODAL
    $("#deductionForm").on("submit", function (e) {
        e.preventDefault();

        // GET FORM VALUES
        var deductionName = $("#deductionName option:selected").text();
        var deductionID = $("#deductionName").val();
        var deductionAmount = $("#deductionAmount").val();
        var deductionType = $("#deductionType option:selected").text();
        var deduction_oncePayrollCycleID = $("#deduction_oncePayrollCycleID option:selected").val();

        // VALIDATION IF THERE IS NULL / EMPTY
        if (!deductionID || !deductionAmount || !$("#deductionType").val()) {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill in all required fields: Name, Type, and Amount.',
            })
        }

        // ADD ROW TO THE TABLE
        var markup = "<tr data-deduction-id='" + deductionID + "' data-amount='" + deductionAmount + "' data-type='" + $("#deductionType").val() + "' data-cycle='" + $("#deduction_oncePayrollCycleID").val() + "'>" +
            "<td>" + deductionName + "</td>" +
            "<td>" + deductionType + "</td>" +
            "<td>" + deductionAmount + "</td>" +
            "<td><button type='button' class='btn btn-danger btn-sm removeRow'>Remove</button></td>" +
            "</tr>";

        $("#deductionTable tbody").append(markup);

        // CLEAR FORM FIELDS
        $("#deductionForm")[0].reset();

        // RESET THE SELECT ELEMENTS TO DEFAULT OPTIONS
        $("#deductionName").prop('selectedIndex', 0);
        $("#deductionType").prop('selectedIndex', 0);
    });

    // ADD DATA - ADJUSTMENT MODAL
    $("#adjustmentForm").on("submit", function (e) {
        e.preventDefault();

        // GET FORM VALUES
        var adjustmentName = $("#adjustmentName option:selected").text();
        var adjustmentID = $("#adjustmentName").val();
        var adjustmentAmount = $("#adjustmentAmount").val();
        var adjustmentType = $("#adjustmentType option:selected").text();
        var adjustment_oncePayrollCycleID = $("#adjustment_oncePayrollCycleID option:selected").val();

        // VALIDATION IF THERE IS NULL / EMPTY
        if (!adjustmentID || !adjustmentAmount || !$("#adjustmentType").val()) {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please fill in all required fields: Name, Type, and Amount.',
            })
        }

        // ADD ROW TO THE TABLE
        var markup = "<tr data-adjustment-id='" + adjustmentID + "' data-amount='" + adjustmentAmount + "' data-type='" + $("#adjustmentType").val() + "' data-cycle='" + $("#adjustment_oncePayrollCycleID").val() + "'>" +
            "<td>" + adjustmentName + "</td>" +
            "<td>" + adjustmentType + "</td>" +
            "<td>" + adjustmentAmount + "</td>" +
            "<td><button type='button' class='btn btn-danger btn-sm removeRow'>Remove</button></td>" +
            "</tr>";

        $("#adjustmentTable tbody").append(markup);

        // CLEAR FORM FIELDS
        $("#adjustmentForm")[0].reset();

        // RESET THE SELECT ELEMENTS TO DEFAULT OPTIONS
        $("#adjustmentName").prop('selectedIndex', 0);
        $("#adjustmentType").prop('selectedIndex', 0);
    });

    // HANDLE REMOVING OF ROWS ON THE TABLE - ALLOWANCES
    $(document).on("click", ".removeRow", function () {
        $(this).closest("tr").remove();
    });

    // HANDLE SAVING DATA ON THE DATABASE - ALLOWANCES
    $(".allowanceSave").on("click", function () {
        var allowances = [];
        var viewID = $('#viewID').val();

        $("#allowanceTable tbody tr").each(function () {
            var allowanceID = $(this).data("allowance-id");
            var amount = $(this).data("amount");
            var type = $(this).data("type");
            var date = $(this).data("date");

            allowances.push({
                id: viewID,
                allowanceID: allowanceID,
                amount: amount,
                type: type,
                date: date
            });
        });

        // SEND THE DATA TO HE SERVER VIA AJAX
        $.ajax({
            url: "../backend/admin/saveEmpAdjustments.php",
            method: "POST",
            data: { allowances: JSON.stringify(allowances) }, // Ensure this is JSON string
            success: function (response) {
                const data = JSON.parse(response);
                var message = data.em;
                if (data.error == 0) {
                    var id = data.id;
                    loadEmployeeData(id);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#allowanceModal').modal('hide');
                        $('#viewEmployeeModal').modal('show');
                    });
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: message
                    })
                }
            },
            error: function () {
                alert("An error occurred while saving the allowances.");
            }
        });        
    });

    // HANDLE SAVING DATA ON THE DATABASE - REIMBURSEMENTS
    $(".reimbursementSave").on("click", function () {
        var reimbursements = [];
        var viewID = $('#viewID').val();

        $("#reimbursementTable tbody tr").each(function () {
            var reimbursementID = $(this).data("reimbursement-id");
            var amount = $(this).data("amount");
            var type = $(this).data("type");
            var payrollCycleID = $(this).data("cycle");

            reimbursements.push({
                id: viewID,
                reimbursementID: reimbursementID,
                amount: amount,
                type: type,
                payrollCycleID: payrollCycleID
            });
        });

        // SEND THE DATA TO HE SERVER VIA AJAX
        $.ajax({
            url: "../backend/admin/saveEmpAdjustments.php",
            method: "POST",
            data: { reimbursements: JSON.stringify(reimbursements) }, // Ensure this is JSON string
            success: function (response) {
                const data = JSON.parse(response);
                var message = data.em;
                if (data.error == 0) {
                    var id = data.id;
                    loadEmployeeData(id);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#reimbursementModal').modal('hide');
                        $('#viewEmployeeModal').modal('show');
                    });
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: message
                    })
                }
            },
            error: function () {
                alert("An error occurred while saving the reimbursements.");
            }
        });        
    });

    // HANDLE SAVING DATA ON THE DATABASE - DEDUCTIONS
    $(".deductionSave").on("click", function () {
        var deductions = [];
        var viewID = $('#viewID').val();

        $("#deductionTable tbody tr").each(function () {
            var deductionID = $(this).data("deduction-id");
            var amount = $(this).data("amount");
            var type = $(this).data("type");
            var payrollCycleID = $(this).data("cycle");

            deductions.push({
                id: viewID,
                deductionID: deductionID,
                amount: amount,
                type: type,
                payrollCycleID: payrollCycleID
            });
        });

        // SEND THE DATA TO HE SERVER VIA AJAX
        $.ajax({
            url: "../backend/admin/saveEmpAdjustments.php",
            method: "POST",
            data: { deductions: JSON.stringify(deductions) }, // Ensure this is JSON string
            success: function (response) {
                const data = JSON.parse(response);
                var message = data.em;
                if (data.error == 0) {
                    var id = data.id;
                    loadEmployeeData(id);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#deductionModal').modal('hide');
                        $('#viewEmployeeModal').modal('show');
                    });
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: message
                    })
                }
            },
            error: function () {
                alert("An error occurred while saving the allowances.");
            }
        });
    });

    // HANDLE SAVING DATA ON THE DATABASE - ADJUSTMENTS
    $(".adjustmentSave").on("click", function () {
        var adjustments = [];
        var viewID = $('#viewID').val();

        $("#adjustmentTable tbody tr").each(function () {
            var adjustmentID = $(this).data("adjustment-id");
            var amount = $(this).data("amount");
            var type = $(this).data("type");
            var payrollCycleID = $(this).data("cycle");

            adjustments.push({
                id: viewID,
                adjustmentID: adjustmentID,
                amount: amount,
                type: type,
                payrollCycleID: payrollCycleID
            });
        });

        // SEND THE DATA TO HE SERVER VIA AJAX
        $.ajax({
            url: "../backend/admin/saveEmpAdjustments.php",
            method: "POST",
            data: { adjustments: JSON.stringify(adjustments) }, // Ensure this is JSON string
            success: function (response) {
                const data = JSON.parse(response);
                var message = data.em;
                if (data.error == 0) {
                    var id = data.id;
                    loadEmployeeData(id);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#adjustmentModal').modal('hide');
                        $('#viewEmployeeModal').modal('show');
                    });
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: message
                    })
                }
            },
            error: function () {
                alert("An error occurred while saving the adjustments.");
            }
        });
    });
});