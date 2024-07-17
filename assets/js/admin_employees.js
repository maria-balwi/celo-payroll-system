function formatNumberWithCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$(document).ready(function() {

    $('#employeeTable').DataTable();

    $('#dropdownButton').on('click', function() {
        $('#dropdownMenu').toggleClass('hidden');
    });

    // Close the dropdown if the user clicks outside of it
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#dropdownButton').length && !$(event.target).closest('#dropdownMenu').length) {
        $('#dropdownMenu').addClass('hidden');
        }
    });

    // LIST FOR EVERY DEPARTMENT AND DESIGNATION
    var designationList = [
        {Department:'1', Designation:'Agent'},
        {Department:'1', Designation:'QA'},
        {Department:'1', Designation:'SME'},
        {Department:'1', Designation:'TL'},
        {Department:'1', Designation:'Manager'},
        {Department:'3', Designation:'Facilities'},
        {Department:'3', Designation:'HR'},
        {Department:'3', Designation:'Finance'},
        {Department:'4', Designation:'IT'},
        {Department:'5', Designation:'Director'},
        {Department:'Operations', Designation:'Agent'},
        {Department:'Operations', Designation:'QA'},
        {Department:'Operations', Designation:'SME'},
        {Department:'Operations', Designation:'TL'},
        {Department:'Operations', Designation:'Manager'},
        {Department:'HR/Admin', Designation:'Facilities'},
        {Department:'HR/Admin', Designation:'HR'},
        {Department:'HR/Admin', Designation:'Finance'},
        {Department:'IT', Designation:'IT'},
        {Department:'Directors', Designation:'Director'}
    ];

    // DROPDOWN FOR DESIGNATION ADDING USER - DROPDOWN WILL APPEAR WITH SPECIFIED OPTIONS ONLY WHEN DEPARTMENT IS CHOSEN
    $("#department").change(function() {
        $("#designation").html("<option selected>Chooose Designation</option>");
        const designations = designationList.filter(m=>m.Department == $("#department").val());
        designations.forEach(element => {
            const option = "<option value='" + element.Designation + "'>" + element.Designation + "</option>";
            $("#designation").append(option);
        });
    });

    // DROPDOWN FOR DESIGNATION UPDATING USER - DROPDOWN WILL APPEAR WITH SPECIFIED OPTIONS ONLY WHEN DEPARTMENT IS CHOSEN
    $("#updateDepartment").change(function() {
        $("#updateDesignation").html("<option selected>Chooose Designation</option>");
        const designations = designationList.filter(m=>m.Department == $("#updateDepartment").val());
        designations.forEach(element => {
            const option = "<option value='" + element.Designation + "'>" + element.Designation + "</option>";
            $("#updateDesignation").append(option);
        });
    });

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
        placeholder: 'XXXX-XXX-XXXX'
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

    // HOURLY RATE COMPUTATION - UPDATE EMPLOYEE
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

    // ADD EMPLOYEE
    $("#addEmployeeForm").submit(function (e) {

        e.preventDefault();

        // let newEmployeeForm = new FormData();
        var lastName = $("#lastName").val();
        var firstName = $("#firstName").val();
        var gender = $("#gender").val();
        var civilStatus = $("#civilStatus").val();
        var address = $("#address").val();
        var dateOfBirth = $("#dateOfBirth").val();
        var placeOfBirth = $("#placeOfBirth").val();
        var sss = $("#sss").val();
        var pagIbig = $("#pagIbig").val();
        var philhealth = $("#philhealth").val();
        var tin = $("#tin").val();
        var emailAddress = $("#emailAddress").val();
        var employeeID = $("#employeeID").val();
        var mobileNumber = $("#mobileNumber").val();
        var department = $("#department").val();
        var designation = $("#designation").val();
        var shiftID = $("#shiftID").val();
        var basicPay = $("#basicPay").val();
        var dailyRate = $("#dailyRate").val();
        var hourlyRate = $("#hourlyRate").val();
        console.log({hourlyRate});

        if (lastName == "" || firstName == "" || gender == "" || civilStatus == "" || 
            address == "" || dateOfBirth == "" || placeOfBirth == "" ||
            sss == "" || pagIbig == "" || philhealth == "" || tin == "" ||
            emailAddress == "" || employeeID == "" || mobileNumber == "" ||
            department == "" || designation == "" || shiftID == "" || 
            basicPay == "" || dailyRate == "" || hourlyRate == "") {
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
                    // newEmployeeForm.append('employeeName', employeeName);
                    // newEmployeeForm.append('gender', gender);
                    // newEmployeeForm.append('civilStatus', civilStatus);
                    // newEmployeeForm.append('address', address);
                    // newEmployeeForm.append('dateOfBirth', dateOfBirth);
                    // newEmployeeForm.append('placeOfBirth', placeOfBirth);
                    // newEmployeeForm.append('sss', sss);
                    // newEmployeeForm.append('pagIbig', pagIbig);
                    // newEmployeeForm.append('philhealth', philhealth);
                    // newEmployeeForm.append('tin', tin);
                    // newEmployeeForm.append('emailAddress', emailAddress);
                    // newEmployeeForm.append('employeeID', employeeID);
                    // newEmployeeForm.append('mobileNumber', mobileNumber);
                    // newEmployeeForm.append('department', department);
                    // newEmployeeForm.append('designation', designation);
                    // newEmployeeForm.append('shiftID', shiftID);

                    $.ajax({
                        type: "POST",
                        url: "../backend/admin/addEmployee.php",
                        // data: newEmployeeForm,
                        // processData: false,
                        // contentType: false,
                        data: $(this).serialize(),
                        cache: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.error == 0) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload();
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
                else if (res.status == 200) {
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
                    $('#view_req_sss').val(res.data.req_sss == 1 ? $('#view_req_sss').prop('checked', true) : $('#view_req_sss').prop('checked', false));
                    $('#view_req_pagIbig').val(res.data.req_pagIbig == 1 ? $('#view_req_pagIbig').prop('checked', true) : $('#view_req_pagIbig').prop('checked', false));
                    $('#view_req_philhealth').val(res.data.req_philhealth == 1 ? $('#view_req_philhealth').prop('checked', true) : $('#view_req_philhealth').prop('checked', false));
                    $('#view_req_tin').val(res.data.req_tin == 1 ? $('#view_req_tin').prop('checked', true) : $('#view_req_tin').prop('checked', false));
                    $('#view_req_nbi').val(res.data.req_nbi == 1 ? $('#view_req_nbi').prop('checked', true) : $('#view_req_nbi').prop('checked', false));
                    $('#viewEmployeeModal').modal('show');
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
                        $('#update_req_sss').val(res.data.req_sss == 1 ? $('#update_req_sss').prop('checked', true) : $('#update_req_sss').prop('checked', false));
                        $('#update_req_pagIbig').val(res.data.req_pagIbig == 1 ? $('#update_req_pagIbig').prop('checked', true) : $('#update_req_pagIbig').prop('checked', false));
                        $('#update_req_philhealth').val(res.data.req_philhealth == 1 ? $('#update_req_philhealth').prop('checked', true) : $('#update_req_philhealth').prop('checked', false));
                        $('#update_req_tin').val(res.data.req_tin == 1 ? $('#update_req_tin').prop('checked', true) : $('#update_req_tin').prop('checked', false));
                        $('#update_req_nbi').val(res.data.req_nbi == 1 ? $('#update_req_nbi').prop('checked', true) : $('#update_req_nbi').prop('checked', false));
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

        // let updateEmployeeForm = new FormData();
        var updateLastName = $("#updateLastName").val();
        var updateFirstName = $("#updateFirstName").val();
        var updateGender = $("#updateGender").val();
        var updateCivilStatus = $("#updateCivilStatus").val();
        var updateAddress = $("#updateAddress").val();
        var updateDateOfBirth = $("#updateDateOfBirth").val();
        var updatePlaceOfBirth = $("#updatePlaceOfBirth").val();
        var updateSSS = $("#updateSSS").val();
        var updatePagIbig = $("#updatePagIbig").val();
        var updatePhilhealth = $("#updatePhilhealth").val();
        var updateTIN = $("#updateTIN").val();
        var updateEmailAddress = $("#updateEmailAddress").val();
        var updateEmployeeID = $("#updateEmployeeID").val();
        var updateMobileNumber = $("#updateMobileNumber").val();
        var updateDepartment = $("#updateDepartment").val();
        var updateDesignation = $("#updateDesignation").val();
        var updateShiftID = $("#updateShiftID").val();
        var updateBasicPay = $("#updateBasicPay").val();
        var updateDailyRate = $("#updateDailyRate").val();
        var updateHourlyRate = $("#updateHourlyRate").val();

        if (updateLastName == "" || updateFirstName == "" || updateGender == "" || updateCivilStatus == "" || 
            updateAddress == "" || updateDateOfBirth == "" || updatePlaceOfBirth == "" ||
            updateSSS == "" || updatePagIbig == "" || updatePhilhealth == "" || updateTIN == "" ||
            updateEmailAddress == "" || updateEmployeeID == "" || updateMobileNumber == "" ||
            updateDepartment == "" || updateDesignation == "" || updateShiftID == "" || 
            updateBasicPay == "" || updateDailyRate == "" || updateHourlyRate == "") {

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
                    // updateEmployeeForm.append("updateID", updateID);
                    // updateEmployeeForm.append("updateEmployeeName", updateEmployeeName);
                    // updateEmployeeForm.append("updateGender", updateGender);
                    // updateEmployeeForm.append("updateCivilStatus", updateCivilStatus);
                    // updateEmployeeForm.append("updateAddress", updateAddress);
                    // updateEmployeeForm.append("updateDateOfBirth", updateDateOfBirth);
                    // updateEmployeeForm.append("updatePlaceOfBirth", updatePlaceOfBirth);
                    // updateEmployeeForm.append("updateSSS", updateSSS);
                    // updateEmployeeForm.append("updatePagIbig", updatePagIbig);
                    // updateEmployeeForm.append("updatePhilhealth", updatePhilhealth);
                    // updateEmployeeForm.append("updateTIN", updateTIN);
                    // updateEmployeeForm.append("updateEmailAddress", updateEmailAddress);
                    // updateEmployeeForm.append("updateEmployeeID", updateEmployeeID);
                    // updateEmployeeForm.append("updateMobileNumber", updateMobileNumber);
                    // updateEmployeeForm.append("updateDepartment", updateDepartment);
                    // updateEmployeeForm.append("updateDesignation", updateDesignation);
                    // updateEmployeeForm.append("updateShiftID", updateShiftID);
                    // updateEmployeeForm.append("oldEmailAddress", oldEmailAddress);
                    // updateEmployeeForm.append("oldEmployeeID", oldEmployeeID);

                    $.ajax({
                        url: '../backend/admin/updateEmployee.php',
                        type: 'POST',
                        // data: updateEmployeeForm,
                        // contentType: false,
                        // processData: false,
                        data: $(this).serialize(),
                        cache: false,
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
                                    window.location.reload();
                                })
                            } else {
                                var message = data.em
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
});