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
                $('#previewPhoto').hide();  // Hide the preview if the file is invalid
            } else {
                $('#viewPhoto').attr('disabled', false);  // Enable the view button
                const reader = new FileReader();
                reader.onload = (e) => {
                    $('#previewPhoto').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        } else {
            $('#viewPhoto').attr('disabled', true);  // Disable the view button if no file is selected
            $('#previewPhoto').hide();  // Hide the preview if no file is selected
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
                $('#previewUploadPhoto').hide();  // Hide the preview if the file is invalid
            } else {
                $('#viewUploadPhoto').attr('disabled', false);  // Enable the view button
                const reader = new FileReader();
                reader.onload = (e) => {
                    $('#previewUploadPhoto').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        } else {
            $('#viewUploadPhoto').attr('disabled', true);  // Disable the view button if no file is selected
            $('#previewUploadPhoto').hide();  // Hide the preview if the file is invalid
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
        var req_sss = $("#req_sss").val();
        var req_pagIbig = $("#req_pagIbig").val();
        console.log({req_sss});
        console.log({req_pagIbig});

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
                                    // window.location.reload();
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
                        $('#update_req_helloMoney').val(res.data.req_helloMoney == 1 ? $('#update_req_helloMoney').prop('checked', true) : $('#view_req_helupdate_req_helloMoneyloMoney').prop('checked', false));
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
                                    // window.location.reload();
                                    // Refresh the View Employee Modal with updated data
                                    loadEmployeeData(updateID);
                                    $('#updateEmployeeModal').modal('hide');
                                    $('#viewEmployeeModal').modal('show');
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

    function loadEmployeeData(employee_id) {
        $.ajax({
            type: "GET",
            url: "../backend/admin/employeeModal.php?employee_id=" + employee_id,
            success: function(response) {
                var res = jQuery.parseJSON(response);
    
                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
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
                    $('#view_req_sss').prop('checked', res.data.req_sss == 1);
                    $('#view_req_pagIbig').prop('checked', res.data.req_pagIbig == 1);
                    $('#view_req_philhealth').prop('checked', res.data.req_philhealth == 1);
                    $('#view_req_tin').prop('checked', res.data.req_tin == 1);
                    $('#view_req_nbi').prop('checked', res.data.req_nbi == 1);
                    $('#view_req_medicalExam').prop('checked', res.data.req_medicalExam == 1);
                    $('#view_req_2x2pic').prop('checked', res.data.req_2x2pic == 1);
                    $('#view_req_vaccineCard').prop('checked', res.data.req_vaccineCard == 1);
                    $('#view_req_psa').prop('checked', res.data.req_psa == 1);
                    $('#view_req_validID').prop('checked', res.data.req_validID == 1);
                    $('#view_req_helloMoney').prop('checked', res.data.req_helloMoney == 1);
    
                    let employeeID_string = res.data.employeeID;
                    $('#viewProfilePicture').off('click').on('click', function() {
                        const imagePath = '../assets/images/profiles/' + employeeID_string.replace("-", "") + '.png';
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

    $('#btnClose').on('click', function() {
        window.location.reload();
    });
});