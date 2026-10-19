function formatDate(dateStr) {
    if (!dateStr) return '';

    var dateObj = new Date(dateStr);

    return dateObj.toLocaleDateString("en-US", {
        month: "short",
        day: "2-digit",
        year: "numeric"
    });
}

function formatNumberWithCommas(number) {
    number = parseFloat(number);
    if (isNaN(number)) return "0.00";
    return number.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$(document).ready(function() {

    // $('#auditTrailTable').DataTable();
    var employeeTable = $('#employeesTable').DataTable();
    employeeTable.order([[0, "desc"]]).draw();

    var payrollTable = $("#payrollTable").DataTable();
    payrollTable.order([[0, "desc"]]).draw();

    var leaveTable = $("#leaveTable").DataTable();
    leaveTable.order([[0, "desc"]]).draw();

    var changeShiftTable = $("#changeShiftTable").DataTable();
    changeShiftTable.order([[0, "desc"]]).draw();

    var overtimeTable = $("#overtimeTable").DataTable();
    overtimeTable.order([[0, "desc"]]).draw();

    var adjustmentsTable = $("#adjustmentsTable").DataTable();
    adjustmentsTable.order([[0, "desc"]]).draw();

    var disputesTable = $("#disputesTable").DataTable();
    disputesTable.order([[0, "desc"]]).draw();

    var usersTable = $("#usersTable").DataTable();
    usersTable.order([[0, "desc"]]).draw();

    var notificationsTable = $("#notificationsTable").DataTable();
    notificationsTable.order([[0, "desc"]]).draw();
    
    var passwordResetTable = $("#passwordResetTable").DataTable();
    passwordResetTable.order([[0, "desc"]]).draw();

    var payslipTable = $("#payslipTable").DataTable();
    payslipTable.order([[0, "desc"]]).draw();

    var logsTable = $("#logsTable").DataTable();
    logsTable.order([[0, "desc"]]).draw();

    // VIEW EMPLOYEE AUDIT TRAIL DETAILS
    var array = [];
    // $(document).on('click', '.employeeView', function () {
    //     var audit_id = $(this).data('id');
    //     array.push(audit_id);
    //     var id_audit = array[array.length - 1];
    //     console.log(id_audit);
        
    //     $.ajax({
    //         type: "GET",
    //         url: "../backend/admin/employeeAuditTrailModal.php?audit_id=" + id_audit,
    //         success: function (res) {
    //             if (res.status === 404) {
    //                 Swal.fire({
    //                     icon: 'warning',
    //                     title: 'Warning',
    //                     text: res.message,
    //                     timer: 2000,
    //                     showConfirmButton: false,
    //                 })
    //                 return;
    //             } 
    //             if (res.status !== 200) return;

    //             const cells = row.children('td');
    //             const meta = cells.eq(1).text() + ' ' + cells.eq(2).text() + ' • ' +
    //                         cells.eq(3).text() + ' updated ' + cells.eq(6).text();

    //             const rows = res.data.map(c =>
    //                 '<tr><td>' + esc(c.category) + '</td>' +
    //                 '<td>' + (esc(c.oldData) || '-') + '</td>' +
    //                 '<td>' + (esc(c.newData) || '-') + '</td></tr>'
    //             ).join('');

    //             const size = res.data.length > 5 ? 'modal-lg' : '';

    //             // remove any previous modal, then create a fresh one
    //             $('#auditChangesModal').remove();
    //             $('body').append(`
    //                 <div class="modal fade" id="auditChangesModal" tabindex="-1" aria-labelledby="auditChangesLabel" aria-hidden="true">
    //                     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ${size}">
    //                         <div class="modal-content">
    //                             <div class="modal-header">
    //                                 <h1 class="modal-title fs-5" id="auditChangesLabel">Employee Changes</h1>
    //                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    //                             </div>
    //                             <div class="modal-body">
    //                                 <p class="mb-2 small text-muted">${esc(meta)}</p>
    //                                 <table class="table table-bordered table-sm text-center mb-0">
    //                                     <thead class="bg-gray-50">
    //                                         <tr><th>Field</th><th>Old Value</th><th>New Value</th></tr>
    //                                     </thead>
    //                                     <tbody>${rows}</tbody>
    //                                 </table>
    //                             </div>
    //                             <div class="modal-footer">
    //                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>
    //             `);

    //             const modalEl = document.getElementById('auditChangesModal');
    //             modalEl.addEventListener('hidden.bs.modal', () => modalEl.remove());
    //             new bootstrap.Modal(modalEl).show();

    //         }
    //     })
    // })

    // VIEW EMPLOYEE AUDIT TRAIL DETAILS
    $(document).on('click', '.employeeView', function () {
        const row = $(this);
        const audit_id = row.data('id');
        const esc = s => $('<div>').text(s ?? '').html();

        $.ajax({
            type: "GET",
            url: "../backend/admin/employeeAuditTrailModal.php",
            data: { audit_id: audit_id },
            dataType: "json",
            success: function (res) {
                if (res.status === 404) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: res.message,
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    return;
                }
                if (res.status !== 200) return;

                const cells = row.children('td');
                const meta = cells.eq(1).text() + ' ' + cells.eq(2).text() + ' • ' +
                            cells.eq(3).text() + ' updated ' + cells.eq(6).text();

                const rows = res.data.map(c =>
                    '<tr><td>' + esc(c.category) + '</td>' +
                    '<td>' + (esc(c.oldData) || '-') + '</td>' +
                    '<td>' + (esc(c.newData) || '-') + '</td></tr>'
                ).join('');

                const size = res.data.length > 5 ? 'modal-lg' : '';

                // remove any previous modal, then create a fresh one
                $('#auditChangesModal').remove();
                $('body').append(`
                    <div class="modal fade" id="auditChangesModal" tabindex="-1" aria-labelledby="auditChangesLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ${size}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="auditChangesLabel">Employee Changes</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-2 small text-muted">${esc(meta)}</p>
                                    <table class="table table-bordered table-sm text-center mb-0">
                                        <thead class="bg-gray-50">
                                            <tr><th>Field</th>
                                            <th>Old Value</th>
                                            <th>New Value</th></tr>
                                        </thead>
                                        <tbody>${rows}</tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `);

                const modalEl = document.getElementById('auditChangesModal');
                modalEl.addEventListener('hidden.bs.modal', () => modalEl.remove());
                new bootstrap.Modal(modalEl).show();
            },
            error: function (xhr) {
                console.error('Audit trail request failed:', xhr.status, xhr.responseText);
            }
        });
    });
    
    // VIEW AND UPDATE SALARY ADJUSTMENTS
    var array = [];
    $(document).on('click', '.salaryAdjustmentView  ', function() {
        var salaryadj_id = $(this).data('id');
        array.push(salaryadj_id);
        var id_salaryadj = array[array.length - 1];

        // VIEW SALARY ADJUSTMENTS
        $.ajax({
            type: "GET",
            url: "../backend/admin/salaryAdjustmentModal.php?salaryadj_id=" + id_salaryadj,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $("#viewAction").val(res.data.action);
                    $("#viewUser").val(res.data.firstName + " " + res.data.lastName);
                    $("#viewDateFiled").val(formatDate(res.data.dateFiled));
                    $("#viewEmployeeID").val(res.data.employeeID);
                    $("#viewReason").val(res.data.reason);
                    $("#viewEmployeeName").val(res.data.affectedFirstName + " " + res.data.affectedLastName);
                    $("#viewCurrentSalary").val("₱ " + formatNumberWithCommas(res.data.currentSalary));
                    $("#viewSuggestedSalary").val("₱ " + formatNumberWithCommas(res.data.suggestedSalary));
                    $("#viewReason").val(res.data.reason);

                    $("#viewSalaryAdjustmentModal").modal("show");
                }
            }
        });
    });
});