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
});