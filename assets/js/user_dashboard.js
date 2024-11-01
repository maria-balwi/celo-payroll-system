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

            // GET THE DATA URL OF THE IMAGE 
            const dataURL = canvasElement.toDataURL('image/png');

            // SEND THE IMAGE TO THE SERVER
            $.ajax({
                type: 'POST',
                url: '../backend/user/saveDTR.php',
                data: {
                    imgBase64: dataURL,
                    faceDTR_action: action  
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Image saved successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        stopStream();
                        // window.location.reload();
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
    
    
});