$(document).ready(function() {
    $("#btnLogin").click(function(e) {
        e.preventDefault();

        Swal.fire({
            icon: 'question',
            title: 'Login',
             text: 'Are you sure you want to submit this credentials?',
            showCancelButton: true,
            cancelButtonColor: '#6c757d',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Yes',

        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "pages/dashboard.php";
            }
        })
    });
});