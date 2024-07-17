$(document).ready(function() {

    var payrollTable = $('#payrollTable').DataTable();
    payrollTable.order([[1, "asc"]]).draw();

    $('#dropdownButton').on('click', function() {
        $('#dropdownMenu').toggleClass('hidden');
    });

    // Close the dropdown if the user clicks outside of it
    $(document).on('click', function(event) {
        if (!$(event.target).closest('#dropdownButton').length && !$(event.target).closest('#dropdownMenu').length) {
        $('#dropdownMenu').addClass('hidden');
        }
    });
    
});