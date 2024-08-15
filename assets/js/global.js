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
        {Department:'1', Designation:'QA'},
        {Department:'1', Designation:'SME'},
        {Department:'1', Designation:'TL'},
        {Department:'1', Designation:'Manager'},
        {Department:'3', Designation:'Facilities'},
        {Department:'3', Designation:'Finance Staff'},
        {Department:'3', Designation:'HR Staff'},
        {Department:'3', Designation:'HR Admin'},
        {Department:'4', Designation:'IT Staff'},
        {Department:'4', Designation:'IT Supervisor'},
        {Department:'5', Designation:'Director'},
        {Department:'Operations', Designation:'Agent'},
        {Department:'Operations', Designation:'QA'},
        {Department:'Operations', Designation:'SME'},
        {Department:'Operations', Designation:'TL'},
        {Department:'Operations', Designation:'Manager'},
        {Department:'HR/Admin', Designation:'Facilities'},
        {Department:'HR/Admin', Designation:'Finance Staff'},
        {Department:'HR/Admin', Designation:'HR Staff'},
        {Department:'HR/Admin', Designation:'HR Admin'},
        {Department:'IT', Designation:'IT Staff'},
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