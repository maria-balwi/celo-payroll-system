function formatTimestamp(timestamp) {
    if (!timestamp) return '';

    var jsDate = new Date(timestamp.replace(" ", "T"));

    var datePart = jsDate.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: '2-digit'
    });

    var timePart = jsDate.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    });

    return datePart + ' ' + timePart;
}

$(document).ready(function () {
    $("#notificationsTable").DataTable();

    $("#removeButton").hide();
    
    // UPDATE NOTIFIFCATION - LOAD PHOTO
    let isUploadPhoto = 0;
    $("#uploadPhoto").change(function () {
        const [file] = this.files;
        const acceptedImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        const img = $("#updateMemoPhoto");

        if (file) {
            const fileType = file["type"];

            if ($.inArray(fileType, acceptedImageTypes) < 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Invalid Picture",
                    text: "Invalid File only accept (JPG/JPEG/PNG) file",
                });
                img.show();
                $(this).val("");
            } else {
                const reader = new FileReader();
                reader.onload = (e) => {
                    img.attr("src", e.target.result).show();
                };
                reader.readAsDataURL(file);
                isUploadPhoto = 1;
                $("#removeButton").show();
            }
        }
    });

    // ADD NOTIFICATION
    $("#addNotificationForm").submit(function (e) {
        e.preventDefault();

        let addNotification = new FormData(this);
        var notificationName = $("#notificationName").val();
        var action = "add";

        if (notificationName == "") {
            Swal.fire({
                icon: "warning",
                title: "Required Information",
                text: "Please fill up all the required Information",
            });
        } else {
            Swal.fire({
                icon: "question",
                title: "Add Notiifcation",
                text: "Are you sure you want to add this notification?",
                showCancelButton: true,
                cancelButtonColor: "#6c757d",
                confirmButtonColor: "#28a745",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    addNotification.append("action", action);
                    $.ajax({
                        type: "POST",
                        url: "../backend/admin/notificationAction.php",
                        data: addNotification,
                        processData: false, 
                        contentType: false,
                        dataType: 'json',
                        success: function (res) {
                            var message = res.em;
                            if (res.error == 0) {
                                var id = res.id;
                                loadNotificationData(id);
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false,
                                }).then(() => {
                                    // Refresh the View Employee Modal with new added data
                                    $("#addNotificationModal").modal("hide");
                                    $("#viewNotificationModal").modal("show");
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: message,
                                });
                            }
                        },
                    });
                }
            });
        }
    });

    // VIEW AND UPDATE HOLIDAY
    var array = [];
    $(document).on("click", ".notificationView", function () {
        var notification_id = $(this).data("id");
        array.push(notification_id);
        var id_notification = array[array.length - 1];

        // VIEW NOTIFICATION
        $.ajax({
            type: "GET",
            url: "../backend/admin/notificationModal.php?notification_id=" + id_notification,
            success: function (response) {
                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $("#viewNotificationID").val(res.data.notificationID);
                    $("#viewTitle").val(res.data.title);
                    $("#viewDateCreated").val(formatTimestamp(res.data.created_at));
                    $("#viewCreatedBy").val(res.data.firstName + " " + res.data.lastName,);

                    // LOAD PROFILE PICTURE
                    const img = $("#viewProfilePhoto");
                    const imagePath = res.data.photo_path;
                    fetch(imagePath)
                        .then((response) => {
                            if (response.ok) {
                                console.log("Image loaded");
                                img.attr("src", imagePath).show();
                            } else {
                                console.log("Image not found");
                            }
                        })
                        .catch((error) => {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "An error occurred while fetching the image.",
                            });
                            console.error("Error fetching image:", error);
                        });
                    $("#viewNotificationModal").modal("show");
                }
            },
        });

        // UPDATE NOTIICATION
        $(document).on("click", ".notificationUpdate", function () {
            $("#viewNotificationModal").modal("hide");
            var id_notification = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/notificationModal.php?notification_id=" + id_notification,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {
                        $("#updateNotificationID").val(res.data.notificationID);
                        $("#updateTitle").val(res.data.title);
                        $("#updateDateCreated").val(formatTimestamp(res.data.created_at));
                        $("#updateCreatedBy").val(res.data.firstName + " " + res.data.lastName,);

                        // LOAD PROFILE PICTURE
                        const img = $("#updateMemoPhoto");
                        const imagePath = res.data.photo_path;
                        fetch(imagePath)
                        .then((response) => {
                            if (response.ok) {
                                console.log("Image loaded");
                                img.attr("src", imagePath).show();
                            } else {
                                console.log("Image not found");
                            }
                        })
                        .catch((error) => {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "An error occurred while fetching the image.",
                            });
                            console.error("Error fetching image:", error);
                        });

                        $("#removeButton").on("click", function () {
                            $("#uploadPhoto").val("");
                            img.attr("src", imagePath).show();
                            $("#removeButton").hide();
                        });

                        $("#updateNotificationModal").modal("show");
                    }
                },
            });
        });

        // DELETE NOTIFICATION
        $(document).on("click", ".notificationDelete", function () {
            var id_notification = array[array.length - 1];

            $.ajax({
                type: "GET",
                url: "../backend/admin/notificationModal.php?notification_id=" + id_notification,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {
                        Swal.fire({
                            icon: "question",
                            title: "Delete Memo",
                            text: "Are you sure you want to delete this memo?",
                            showCancelButton: true,
                            cancelButtonColor: "#6c757d",
                            confirmButtonColor: "#28a745",
                            confirmButtonText: "Yes",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "../backend/admin/notificationAction.php",
                                    type: "POST",
                                    data: {
                                        id_notification: id_notification,
                                        action: 'delete',
                                    },
                                    cache: false,
                                    success: function (data) {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Success",
                                            text: "Memo Deleted Successfully",
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            window.location.reload();
                                        });
                                    },
                                });
                            }
                        });
                    }
                },
            });
        });
    });

    // UPDATE NOTIFICATION
    $("#updateNotificationForm").submit(function (e) {
        e.preventDefault();

        let updateNotification = new FormData(this);
        var updateNotificationID = $("#updateNotificationID").val();
        var updateTitle = $("#updateTitle").val();
        console.log({isUploadPhoto});

        if (updateNotificationID == "" || updateTitle == ""
        ) {
            Swal.fire({
                icon: "warning",
                title: "Required Information",
                text: "Please fill up all the required Information",
            });
        } else {
            Swal.fire({
                icon: "question",
                title: "Update Memo Information",
                text: "Are you sure you want to save the changes you made?",
                showCancelButton: true,
                cancelButtonColor: "#6c757d",
                confirmButtonColor: "#28a745",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    updateNotification.append("id_notification", updateNotificationID);
                    updateNotification.append("updateTitle", updateTitle);
                    updateNotification.append("isUploadPhoto", isUploadPhoto);
                    updateNotification.append("action", "update");
                    $.ajax({
                        url: "../backend/admin/notificationAction.php",
                        type: "POST",
                        data: updateNotification,
                        processData: false, 
                        contentType: false,
                        dataType: 'json',
                        success: function (res) {
                            if (res.error == 0) {
                                var message = res.em;
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false,
                                }).then(() => {
                                    loadNotificationData(updateNotificationID);
                                    $("#updateNotificationModal").modal("hide");
                                    $("#viewNotificationModal").modal("show");
                                });
                            } else {
                                var message = res.em;
                                Swal.fire({
                                    icon: "warning",
                                    title: "Warning",
                                    text: message,
                                });
                            }
                        },
                    });
                }
            });
        }
    });

    function loadNotificationData(id_notification) {
        $.ajax({
            type: "GET",
            url: "../backend/admin/notificationModal.php?notification_id=" + id_notification,
            success: function (response) {
                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $("#viewNotificationID").val(res.data.notificationID);
                    $("#viewTitle").val(res.data.title);
                    $("#viewDateCreated").val(formatTimestamp(res.data.created_at));
                    $("#viewCreatedBy").val(res.data.firstName + " " + res.data.lastName,);

                    // LOAD PROFILE PICTURE
                    const img = $("#viewProfilePhoto");
                    const imagePath = "../assets/images/notifications/" + res.data.title.replace(/\s+/g, '') + ".png";
                    fetch(imagePath)
                        .then((response) => {
                            if (response.ok) {
                                console.log("Image loaded");
                                img.attr("src", imagePath).show();
                            } else {
                                console.log("Image not found");
                            }
                        })
                        .catch((error) => {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "An error occurred while fetching the image.",
                            });
                            console.error("Error fetching image:", error);
                        });
                }
            },
        });
    }

    $("#btnClose").on("click", function () {
        window.location.reload();
    });
});
