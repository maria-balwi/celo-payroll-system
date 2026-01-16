$(document).ready(function() {    

    // LOGOUT BUTTON FUNCTION
    $("#btnLogout").click(function (e) {

        e.preventDefault();
        
        Swal.fire({
            icon: 'question',
            title: 'Log Out Account',
            text: 'Are you sure you want to log out?',
            showCancelButton: true,
            cancelButtonColor: '#6c757d',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Logged out Successfully',
                    timer: 2000,
                    showConfirmButton: false,
                }).then(() => {
                    window.location.href = "../index.php"
                })
            }
        })

    });
    
});