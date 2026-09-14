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
        let detectionInterval;
        let faceIsValid = false;

        // LOAD MODELS ONCE
        async function loadModels() {
            if (faceapi.nets.tinyFaceDetector.isLoaded) return;
            await faceapi.nets.tinyFaceDetector.loadFromUri('../assets/js/models');
        }

        function startStream(videoElement, action) {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true }).then(async function(s) {
                    stream = s;
                    videoElement.srcObject = stream;
                    videoElement.play();

                    await loadModels();
                    startDetectionLoop(videoElement, action);
                });
            }
        }

        function startDetectionLoop(videoElement, action) {
            const modal = action === 'time_in' ? '#timeInModal' : '#timeOutModal';
            const button = document.getElementById(action === 'time_in' ? 'captureTimeIn' : 'captureTimeOut');
            const statusLabel = document.querySelector(`${modal} .faceStatus`);

            const options = new faceapi.TinyFaceDetectorOptions({ inputSize: 320, scoreThreshold: 0.5 });

            detectionInterval = setInterval(async () => {
                if (!videoElement.srcObject) return;

                const detections = await faceapi.detectAllFaces(videoElement, options);

                if (detections.length === 0) {
                    faceIsValid = false;
                    button.disabled = true;
                    statusLabel.textContent = 'No face detected';
                } else if (detections.length > 1) {
                    faceIsValid = false;
                    button.disabled = true;
                    statusLabel.textContent = 'Multiple faces detected';
                } else {
                    const box = detections[0].box;
                    const vw = videoElement.videoWidth;
                    const vh = videoElement.videoHeight;
                    const margin = 0.08; // 8% margin from edges

                    const withinFrame =
                        box.x > vw * margin &&
                        box.y > vh * margin &&
                        (box.x + box.width) < vw * (1 - margin) &&
                        (box.y + box.height) < vh * (1 - margin);

                    // face too small = too far, too big = too close/cropped
                    const areaRatio = (box.width * box.height) / (vw * vh);
                    const goodSize = areaRatio > 0.08 && areaRatio < 0.65;

                    if (withinFrame && goodSize) {
                        faceIsValid = true;
                        button.disabled = false;
                        statusLabel.textContent = 'Face detected — ready to capture';
                    } else {
                        faceIsValid = false;
                        button.disabled = true;
                        statusLabel.textContent = withinFrame ? 'Move closer/farther' : 'Center your whole face in frame';
                    }
                }
            }, 300); // check ~3x/sec
        }

        function stopDetectionLoop() {
            clearInterval(detectionInterval);
            faceIsValid = false;
        }

        function captureImage(videoElement, canvasElement, action) {
            if (!faceIsValid) {
                Swal.fire('Face not detected', 'Please align your whole face in the frame.', 'warning');
                return;
            }

            const modal = action === 'time_in' ? '#timeInModal' : '#timeOutModal';
            const button = action === 'time_in' ? document.getElementById('captureTimeIn') : document.getElementById('captureTimeOut');
            const spinnerLoader = document.querySelector(`${modal} .spinnerLoader`);

            button.disabled = true;
            spinnerLoader.style.display = 'block';

            const context = canvasElement.getContext('2d');
            context.drawImage(videoElement, 0, 0, 640, 480);

            videoElement.pause();
            videoElement.srcObject = null;
            stopDetectionLoop();
            stopStream();

            const dataURL = canvasElement.toDataURL('image/png');

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
                        window.location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                },
                complete: function() {
                    button.disabled = false;
                    spinnerLoader.style.display = 'none';
                }
            });
        }

        function stopStream() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
        }

        $('#timeInModal').on('shown.bs.modal', function () {
            document.getElementById('captureTimeIn').disabled = true;
            startStream(document.getElementById('videoTimeIn'), 'time_in');
        });

        $('#timeOutModal').on('shown.bs.modal', function () {
            document.getElementById('captureTimeOut').disabled = true;
            startStream(document.getElementById('videoTimeOut'), 'time_out');
        });

        $('#timeInModal').on('hidden.bs.modal', function () {
            stopDetectionLoop();
            stopStream();
            $('#videoTimeIn').attr('src', '');
        });

        $('#timeOutModal').on('hidden.bs.modal', function () {
            stopDetectionLoop();
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
            stopDetectionLoop();
            stopStream();
        });

        $('#cancelTimeOut').on('click', function() {
            stopDetectionLoop();
            stopStream();
        });
    });
    
    
});