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
        {Department:'1', Designation:'TL'},
        {Department:'1', Designation:'Manager'},
        {Department:'2', Designation:'Sourcing Specialist'},
        {Department:'2', Designation:'Recruitment Specialist'},
        {Department:'2', Designation:'Recruitment Supervisor'},
        {Department:'3', Designation:'Business Dev'},
        {Department:'3', Designation:'Finance Staff'},
        {Department:'3', Designation:'HR & Admin Staff'},
        {Department:'3', Designation:'HR Generalist'},
        {Department:'3', Designation:'HR Supervisor'},
        {Department:'3', Designation:'Admin Supervisor'},
        {Department:'4', Designation:'IT L1'},
        {Department:'4', Designation:'IT L2'},
        {Department:'4', Designation:'IT Web Developer'},
        {Department:'4', Designation:'IT Supervisor'},
        {Department:'5', Designation:'Director'},
        {Department:'Operations', Designation:'Agent'},
        {Department:'Operations', Designation:'Trainer'},
        {Department:'Operations', Designation:'QA'},
        {Department:'Operations', Designation:'SME'},
        {Department:'Operations', Designation:'TL'},
        {Department:'Operations', Designation:'Manager'},
        {Department:'Recruitment', Designation:'Sourcing Specialist'},
        {Department:'Recruitment', Designation:'Recruitment Specialist'},
        {Department:'Recruitment', Designation:'Recruitment Supervisor'},
        {Department:'HR/Admin', Designation:'Business Dev'},
        {Department:'HR/Admin', Designation:'Finance Staff'},
        {Department:'HR/Admin', Designation:'HR & Admin Staff'},
        {Department:'HR/Admin', Designation:'HR Generalist'},
        {Department:'HR/Admin', Designation:'HR Supervisor'},
        {Department:'HR/Admin', Designation:'Admin Supervisor'},
        {Department:'IT', Designation:'IT L1'},
        {Department:'IT', Designation:'IT L2'},
        {Department:'IT', Designation:'IT Web Developer'},
        {Department:'IT', Designation:'IT Supervisor'},
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
});