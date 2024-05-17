$(document).ready(function() {    

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
                window.location.href = "../index.php"
            }
        })

    });
    
});