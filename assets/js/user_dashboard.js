function updateClock() {
    $.ajax({
        url: '../backend/user/time.php',
        success: function(data) {
            $('#clock').text(data);
        }
    });
}

$(document).ready(function() {

    updateClock(); // INITIAL CALL
    setInterval(updateClock, 1000); // UPDATE EVERY SECOND

    // FOR FACE RECOGNITION - IN
    $(document).on('click', '.faceDTR', function() {
        let stream;

        function startStream(videoElement) {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true }).then(function(s) {
                    stream = s;
                    videoElement.srcObject = stream;
                    videoElement.play();
                });
            }
        }

        function captureImage(videoElement, canvasElement, action) {
            const context = canvasElement.getContext('2d');
            context.drawImage(videoElement, 0, 0, 640, 480);

            // Get the data URL of the image
            const dataURL = canvasElement.toDataURL('image/png');
            // const fileName = $('#fileName').val() + '_' + action;
            var faceDTR_action = $("#faceDTR_action").val();

            // Send the image data to the server
            $.ajax({
                type: 'POST',
                url: '../backend/user/saveDTR.php',
                data: {
                    imgBase64: dataURL,
                    faceDTR_action: faceDTR_action
                },
                success: function(response) {
                    // alert(action.charAt(0).toUpperCase() + action.slice(1) + ' image saved successfully: ' + response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Image saved successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        stopStream();
                        window.location.reload();
                    })
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    stopStream();
                }
            });
        }

        function stopStream() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
        }

        $('#timeInModal').on('shown.bs.modal', function () {
            startStream(document.getElementById('videoTimeIn'));
        });

        $('#timeOutModal').on('shown.bs.modal', function () {
            startStream(document.getElementById('videoTimeOut'));
        });

        $('#timeInModal').on('hidden.bs.modal', function () {
            stopStream();
            $('#videoTimeIn').attr('src', '');
        });

        $('#timeOutModal').on('hidden.bs.modal', function () {
            stopStream();
            $('#videoTimeOut').attr('src', '');
        });

        $('#captureTimeIn').on('click', function() {
            captureImage(document.getElementById('videoTimeIn'), document.getElementById('canvasTimeIn'), 'time_in');
        });

        $('#captureTimeOut').on('click', function() {
            captureImage(document.getElementById('videoTimeOut'), document.getElementById('canvasTimeOut'), 'time_out');
        });

        $('#cancelTimeIn').on('click', function() {
            stopStream();
        });

        $('#cancelTimeOut').on('click', function() {
            stopStream();
        });
    });
    
    // // FOR FACE RECOGNITION - OUT
    // $(document).on('click', '.faceDTROut', function() {
    //     const video = document.getElementById('videoOut');
    //     let stream;

    //     // Get access to the webcam
    //     if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    //         navigator.mediaDevices.getUserMedia({ video: true }).then(function(s) {
    //             stream = s;
    //             video.srcObject = stream;
    //             video.play();
    //         });
    //     }

    //     // Trigger photo take
    //     $('#captureOut').on('click', function() {
    //         const canvas = document.getElementById('canvasOut');
    //         const context = canvas.getContext('2d');
    //         context.drawImage(video, 0, 0, 640, 480);

    //         // Get the data URL of the image
    //         const dataURL = canvas.toDataURL('image/png');
    //         const fileName = $('#fileName').val();

    //         // Send the image data to the server
    //         $.ajax({
    //             type: 'POST',
    //             url: 'save_image.php',
    //             data: {
    //                 imgBase64: dataURL,
    //                 fileName: fileName
    //             },
    //             success: function(response) {
    //                 alert('Image saved successfully: ' + response);
    //                 stopStream();
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error(xhr.responseText);
    //                 stopStream();
    //             }
    //         });
    //     });

    //     // Handle cancel button
    //     $('#cancelOut').on('click', function() {
    //         stopStream();
    //         video.pause();
    //     });

    //     function stopStream() {
    //         if (stream) {
    //             stream.getTracks().forEach(track => track.stop());
    //             video.srcObject = null;
    //         }
    //     }
    // });
});