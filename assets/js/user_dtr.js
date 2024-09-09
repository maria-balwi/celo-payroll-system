$(document).ready(function() {

    var dtrTable = $('#dtrTable').DataTable();
    dtrTable.order([[1, "asc"]]).draw();
    // $('#dtrTable').DataTable();

    var filterYear = (new Date). getFullYear();
    const d = new Date();
    var filterMonth = d.getMonth() + 1;

    document.getElementById('filterYear').addEventListener('change', function() {
        filterYear = null;
        filterYear = $('#filterYear').val();

        document.getElementById('filterMonth').addEventListener('change', function() {
            filterMonth = null;
            filterMonth = $('#filterMonth').val();
        
            $.ajax({
                url: '../backend/user/filteredDTRtable.php', 
                type: 'POST',
                data: { filterYear: filterYear,
                    filterMonth: filterMonth },
                success: function(response) {
                    $('#dtrTable').DataTable().clear().destroy(); 
                    $('#dtrTable tbody').html(response);
                    var dtrTable = $('#dtrTable').DataTable();
                    dtrTable.order([[1, "asc"]]).draw();
                }
            });
        });
    
        $.ajax({
            url: '../backend/user/filteredDTRtable.php', 
            type: 'POST',
            data: { filterYear: filterYear,
                filterMonth: filterMonth },
            success: function(response) {
                $('#dtrTable').DataTable().clear().destroy(); 
                $('#dtrTable tbody').html(response);
                var dtrTable = $('#dtrTable').DataTable();
                dtrTable.order([[1, "asc"]]).draw();
            }
        });
    });

    document.getElementById('filterMonth').addEventListener('change', function() {
        filterMonth = null;
        filterMonth = $('#filterMonth').val();
        // $('#filterYear').prop('disabled', true);

        document.getElementById('filterYear').addEventListener('change', function() {
            filterYear = null;
            filterYear = $('#filterYear').val();
        
            $.ajax({
                url: '../backend/user/filteredDTRtable.php', 
                type: 'POST',
                data: { filterYear: filterYear,
                    filterMonth: filterMonth },
                success: function(response) {
                    $('#dtrTable').DataTable().clear().destroy(); 
                    $('#dtrTable tbody').html(response);
                    var dtrTable = $('#dtrTable').DataTable();
                    dtrTable.order([[1, "asc"]]).draw();
                }
            });
        });
    
        $.ajax({
            url: '../backend/user/filteredDTRtable.php', 
            type: 'POST',
            data: { filterYear: filterYear,
                filterMonth: filterMonth },
            success: function(response) {
                $('#dtrTable').DataTable().clear().destroy(); 
                $('#dtrTable tbody').html(response);
                var dtrTable = $('#dtrTable').DataTable();
                dtrTable.order([[1, "asc"]]).draw();
            }
        });
    });

    // FOR VIEWING FACE DTR
    $(document).on('click', '.viewFaceDTR', function() {
        var timeInDate = $(this).data('id');
        var timeOutDate = $(this).data('id2');
        var employeeID = $(this).data('id3');
        const timeInImagePath = '../assets/images/attendance/' + employeeID.replace("-", "") + '_' + timeInDate + '_time_in.png'; 
        const timeOutImagePath = '../assets/images/attendance/' + employeeID.replace("-", "") + '_' + timeOutDate + '_time_out.png'; 
        
        // Use the fetch API to check if the images exist
        Promise.allSettled([fetch(timeInImagePath), fetch(timeOutImagePath)])
        .then(results => {
            const img1Result = results[0];
            const img2Result = results[1];
    
            const image1Src = img1Result.status === 'fulfilled' && img1Result.value.ok 
                ? timeInImagePath 
                : null;
    
            const image2Src = img2Result.status === 'fulfilled' && img2Result.value.ok 
                ? timeOutImagePath 
                : null;
    
            let htmlContent = '<div class="flex justify-center space-x-6">';
    
            if ((image1Src == null) && (image2Src == null)) {
                htmlContent += `
                    <div class="text-center ">
                        <p>No Face DTR Recorded</p>
                    </div>
                `;
            }
            else {
                // Check if time-in image exists
                if (image1Src) {
                    htmlContent += `
                        <div class="text-center">
                            <img src="${image1Src}" alt="Log In" style="height:300px; width: 300px">
                            <p>Time In</p>
                        </div>
                    `;
                } else {
                    
                }
        
                // Check if time-out image exists
                if (image2Src) {
                    htmlContent += `
                        <div class="text-center">
                            <img src="${image2Src}" alt="Log Out" style="height:300px; width: 300px">
                            <p>Time Out</p>
                        </div>
                    `;
                } else {
                    
                }
            }
    
            htmlContent += '</div>';
    
            Swal.fire({
                title: 'Face DTR',
                html: htmlContent,
                showCloseButton: false,
                showConfirmButton: true,
                width: 600,
            }).then((result) => {
                if (result.isConfirmed) {
                    timeInDate = null;
                    timeOutDate = null;
                }
            });
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while fetching the images.',
            });
            console.error('Error fetching images:', error);
        });
    }); 
});