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
        {Department:'5', Designation:'Director'}
    ];

    // DROPDOWN FOR DESIGNATION AND GROUP - DROPDOWN WILL APPEAR WITH SPECIFIED OPTIONS ONLY WHEN DEPARTMENT IS CHOSEN
    $("#department").change(function() {
        $("#designation").html("<option selected>Chooose Designation</option>");
        const designations = designationList.filter(m=>m.Department == $("#department").val());
        designations.forEach(element => {
            const option = "<option value='" + element.Designation + "'>" + element.Designation + "</option>";
            $("#designation").append(option);
        });
    });

    $("#addEmployeeForm").submit(function (e) {

        e.preventDefault();

        let newEmployeeForm = new FormData();
        var employeeName = $("#employeeName").val();
        var gender = $("#gender").val();
        var civilStatus = $("#civilStatus").val();
        var address = $("#address").val();
        var dateOfBirth = $("#dateOfBirth").val();
        var placeOfBirth = $("#placeOfBirth").val();
        var sss = $("#sss").val();
        var pagIbig = $("#pagIbig").val();
        var philheatlh = $("#philheatlh").val();
        var emailAddress = $("#emailAddress").val();
        var employeeID = $("#employeeID").val();
        var mobileNumber = $("#mobileNumber").val();
        var department = $("#department").val();
        var designation = $("#designation").val();
        var shiftID = $("#shiftID").val();

        console.log({employeeName});
        console.log({gender});
        console.log({civilStatus});
        console.log({address});
        console.log({dateOfBirth});
        console.log({placeOfBirth});
        console.log({sss});
        console.log({pagIbig});
        console.log({philheatlh});
        console.log({emailAddress});
        console.log({employeeID});
        console.log({mobileNumber});
        console.log({department});
        console.log({designation});
        console.log({shiftID});

        if (employeeName == "" || gender == "" || civilStatus == "" || 
            address == "" || dateOfBirth == "" || placeOfBirth == "" ||
            sss == "" || pagIbig == "" || philheatlh == "" ||
            emailAddress == "" || employeeID == "" || mobileNumber == "" ||
            department == "" || designation == "" || shiftID == "") {
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
                    newEmployeeForm.append('employeeName', employeeName);
                    newEmployeeForm.append('gender', gender);
                    newEmployeeForm.append('civilStatus', civilStatus);
                    newEmployeeForm.append('address', address);
                    newEmployeeForm.append('dateOfBirth', dateOfBirth);
                    newEmployeeForm.append('placeOfBirth', placeOfBirth);
                    newEmployeeForm.append('sss', sss);
                    newEmployeeForm.append('pagIbig', pagIbig);
                    newEmployeeForm.append('philheatlh', philheatlh);
                    newEmployeeForm.append('emailAddress', emailAddress);
                    newEmployeeForm.append('employeeID', employeeID);
                    newEmployeeForm.append('mobileNumber', mobileNumber);
                    newEmployeeForm.append('department', department);
                    newEmployeeForm.append('designation', designation);
                    newEmployeeForm.append('shiftID', shiftID);

                    $.ajax({
                        type: "POST",
                        url: "../backend/admin/addEmployee.php",
                        data: newEmployeeForm,
                        processData: false,
                        contentType: false,
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
    
});