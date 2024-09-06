$(document).ready(function() {

    var payrollTable = $('#payrollTable').DataTable();
    payrollTable.order([[1, "asc"]]).draw();

    // // LIST FOR EVERY CATEGORY AND SUBCATEGORY
    // var payrollCycle = [
    //     {Cycle: '1', Value: '12-26-'},
    // ];

    // // DROPDOWN FOR SUBCATEGORY ADD TICKET FUNCTION - DROPDOWN WILL APPEAR WITH SPECIFIED OPTIONS ONLY WHEN CATEGORY IS CHOSEN
    // $("#categoryID").change(function() {
    //     $("#subcategory").html("<option selected>Chooose Subcategory</option>");
    //     const subcategories = subcategoryList.filter(m=>m.Category == $("#categoryID").val());
    //     subcategories.forEach(element => {
    //         const option = "<option value='" + element.Subcategory + "'>" + element.Subcategory + "</option>";
    //         $("#subcategory").append(option);
    //     });
    // });
    
});