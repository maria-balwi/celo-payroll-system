$(document).ready(function() {

    $('#changeShiftTable').DataTable();

    $('#dropdownButton').on('click', function() {
        $('#dropdownMenu').toggleClass('hidden');
    });

    // Close the dropdown if the user clicks outside of it
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#dropdownButton').length && !$(event.target).closest('#dropdownMenu').length) {
        $('#dropdownMenu').addClass('hidden');
        }
    });

    // FILE REQUEST BUTTON
    $("#btnFileRequest").click(function (e) {

        e.preventDefault();
        
        Swal.fire({
            icon: 'question',
            title: 'Submit Change Shift Request',
            text: 'Are you sure you want to change your shift?',
            showCancelButton: true,
            cancelButtonColor: '#6c757d',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Request Filed Successfully',
                    timer: 2000,
                    showConfirmButton: false,
                }).then(() => {
                    window.location.reload();
                })
            }
        })

    });
    
});