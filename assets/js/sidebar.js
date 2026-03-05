$(document).ready(function() {    

    // VIEW NOTIFICATION MODAL
    // $(document).on("click", ".notifView", function (e) {
    //     e.stopPropagation();

    //     const notification_id = $(this).data("id");
    //     console.log("clicked notif:", notification_id);

    //     $('#notifDropdown').addClass('hidden');

    //     $.ajax({
    //         type: "GET",
    //         url: "../backend/user/notificationModal.php",
    //         data: { notification_id: notification_id },
    //         dataType: "json",
    //         success: function (res) {

    //             if (res.status == 404) {
    //                 alert(res.message);
    //             } else if (res.status == 200) {
    //                 $("#view_notificationID").val(res.data.notificationID);
    //                 $("#view_title").val(res.data.title);
    //                 $("#view_dateCreated").val(res.data.created_at);

    //                 // LOAD PROFILE PICTURE
    //                 const img = $("#view_profilePhoto");
    //                 const imagePath = res.data.photo_path;
    //                 fetch(imagePath)
    //                     .then((response) => {
    //                         if (response.ok) {
    //                             console.log("Image loaded");
    //                             img.attr("src", imagePath).show();
    //                         } else {
    //                             console.log("Image not found");
    //                         }
    //                     })
    //                     .catch((error) => {
    //                         Swal.fire({
    //                             icon: "error",
    //                             title: "Error",
    //                             text: "An error occurred while fetching the image.",
    //                         });
    //                         console.error("Error fetching image:", error);
    //                     });
    //                 $("#viewNotifModal").modal("show");
    //             }
    //         },
    //         error: function (xhr) {
    //             console.log("AJAX ERROR:", xhr.status, xhr.responseText);
    //             alert("Request failed. Check console (F12).");
    //         }
    //     });
    // });

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