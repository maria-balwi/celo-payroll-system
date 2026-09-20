$(document).ready(function() {

    // // AUTO REFRESH EVERY 5 MINS
    // setTimeout(function () {
    //     location.reload(true);
    //   }, 3000000); 

    // SESSION MANAGEMENT
    $.ajax({
        url: "../backend/session/session_management.php",
        type: "POST",
        success: function(res) {
            const data = JSON.parse(res);
            var message = data.message
            if (data.status == 404) 
            {
                window.location.href = "../index.php";
            }
            else if (data.status == 200 && data.result == 1) 
            {
                Swal.fire({
                    icon: 'info',
                    title: message,
                    showconfirmbutton: true,
                }).then((result) => {
                    if (result.isConfirmed)
                    {
                        window.location.href = "../index.php";
                    }
                })
            }
        }
    });

    // LIST FOR EVERY DEPARTMENT AND DESIGNATION
    var designationList = [
        {Department:'1', Designation:'Agent'},
        {Department:'1', Designation:'Trainer'},
        {Department:'1', Designation:'QA'},
        {Department:'1', Designation:'SME'},
        {Department:'1', Designation:'Workforce Supervisor'},
        {Department:'1', Designation:'TL'},
        {Department:'1', Designation:'Manager'},
        {Department:'2', Designation:'Sourcing Specialist'},
        {Department:'2', Designation:'Recruitment Specialist'},
        {Department:'2', Designation:'Recruitment Supervisor'},
        {Department:'3', Designation:'HR Staff'},
        {Department:'3', Designation:'HR Compensation & Benefits Staff'},
        {Department:'3', Designation:'HR Learning and Development Staff'},
        {Department:'3', Designation:'HR Employee Relations'},
        {Department:'3', Designation:'HR Supervisor'},
        {Department:'3', Designation:'Liaison & Administrative Officer'},
        {Department:'3', Designation:'Procurement & Inventory Control Officer'},
        {Department:'3', Designation:'Admin Supervisor'},
        {Department:'4', Designation:'IT L1'},
        {Department:'4', Designation:'IT L2'},
        {Department:'4', Designation:'IT Web Developer'},
        {Department:'4', Designation:'IT Supervisor'},
        {Department:'5', Designation:'Director'},
        {Department:'6', Designation:'Business Development Staff'},
        {Department:'6', Designation:'Process Supervisor'},
        {Department:'7', Designation:'Facilities Personnel'},
        {Department:'7', Designation:'Maintenance Staff'},
        {Department:'7', Designation:'Sanitation Staff'},
        {Department:'7', Designation:'Sanitation Lead'},
        {Department:'8', Designation:'Driver'},
        {Department:'9', Designation:'Payroll Officer'},
        {Department:'9', Designation:'Accounting Officer'},
        {Department:'9', Designation:'Accounting Staff'},
        {Department:'Operations', Designation:'Agent'},
        {Department:'Operations', Designation:'Trainer'},
        {Department:'Operations', Designation:'QA'},
        {Department:'Operations', Designation:'SME'},
        {Department:'Operations', Designation:'Workforce Supervisor'},
        {Department:'Operations', Designation:'TL'},
        {Department:'Operations', Designation:'Manager'},
        {Department:'Recruitment', Designation:'Sourcing Specialist'},
        {Department:'Recruitment', Designation:'Recruitment Specialist'},
        {Department:'Recruitment', Designation:'Recruitment Supervisor'},
        {Department:'HR/Admin', Designation:'HR Staff'},
        {Department:'HR/Admin', Designation:'HR Compensation & Benefits Staff'},
        {Department:'HR/Admin', Designation:'HR Learning and Development Staff'},
        {Department:'HR/Admin', Designation:'HR Employee Relations'},
        {Department:'HR/Admin', Designation:'HR Supervisor'},
        {Department:'HR/Admin', Designation:'Liaison & Administrative Officer'},
        {Department:'HR/Admin', Designation:'Procurement & Inventory Control Officer'},
        {Department:'HR/Admin', Designation:'Admin Supervisor'},
        {Department:'IT', Designation:'IT L1'},
        {Department:'IT', Designation:'IT L2'},
        {Department:'IT', Designation:'IT Web Developer'},
        {Department:'IT', Designation:'IT Supervisor'},
        {Department:'Directors', Designation:'Director'},
        {Department:'Business Development', Designation:'Business Development Staff'},
        {Department:'Business Development', Designation:'Process Supervisor'},
        {Department:'Maintenance & Facility', Designation:'Facilities Personnel'},
        {Department:'Maintenance & Facility', Designation:'Maintenance Staff'},
        {Department:'Maintenance & Facility', Designation:'Sanitation Staff'},
        {Department:'Maintenance & Facility', Designation:'Sanitation Lead'},
        {Department:'Logistics', Designation:'Driver'},
        {Department:'Finance', Designation:'Payroll Officer'},
        {Department:'Finance', Designation:'Accounting Officer'},
        {Department:'Finance', Designation:'Accounting Staff'},
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

    // CHECK DEPARTMENT TO SHOW MAKE TEAMS AVAILABLE (ADD EMPLOYEE)
    $("select[id='department']").on("change", function () {
        var selectDept = $(this).val();

        if (selectDept == 1) {
            $("#teamID").prop("disabled", false);
        }
        else {
            $("#teamID").prop("disabled", true);
            $("#teamID").val("");
        }
    });

    // CHECK DEPARTMENT TO SHOW MAKE TEAMS AVAILABLE (UPDATE EMPLOYEE)
    $("select[id='updateDepartment']").on("change", function () {
        var selectDept = $(this).val();

        if (selectDept == "Operations") {
            $("#updateTeamID").prop("disabled", false);
        }
        else {
            $("#updateTeamID").prop("disabled", true);
            $("#updateTeamID").val("");
        }
    });
});