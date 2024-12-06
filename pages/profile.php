<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- HEADER -->
        <?php include('../includes/header.php'); ?>
    </head>
    <body>
        <!-- SIDEBAR -->
        <?php include('../includes/sidebar.php'); ?>	
 
        <!-- MAIN CONTENT -->
        <main class="flex-1 p-3">
            <div class="flex flex-1 px-4 pb-2 text-2xl font-bold justify-between items-center">
                <div>
                    Profile Section
                </div>    
            </div>
            
            <!-- CONTENT -->
            <div class="flex overflow-auto justify-center">
                <div class="container mx-auto">
                    <div class="grid grid-cols-12 md:grid-cols-12 gap-3">

                        <?php
                            $userQuery = mysqli_query($conn, $users->viewUser($_SESSION['id']));
                            while ($userDetails = mysqli_fetch_array($userQuery)) {
                        ?>
                        <!-- LEFT CARD -->
                        <div class="col-span-12 md:col-span-4">
                            <div class="bg-white shadow rounded-lg p-4">
                                <div class="flex flex-col items-center">
                                    <?php
                                        $baseDirectory = "../assets/images/profiles/";
                                        $employeeID = str_replace("-", "", $_SESSION['employeeID']);
                                        $filename = $employeeID.".png";

                                        $filepath = $baseDirectory . $filename;

                                        if (file_exists($filepath)) {
                                            // EXISITING PROFILE PICTURE
                                        } else {
                                            $filename = "profile.png";
                                        }
                                    ?>
                                    <img src="../assets/images/profiles/<?php echo $filename ?>" class="w-32 h-32 bg-gray-300 rounded-md mb-4 shrink-0">

                                    </img>
                                    <h1 class="text-lg font-bold uppercase"><?php echo $userDetails['employeeName'] ?></h1>
                                </div>
                                <hr class="my-2 border-t border-gray-300">
                                <h2 class="text-lg font-bold">Personal Information:</h2>
                                <div class="flex flex-col py-1">
                                    <div class="flex gap-2 py-1">
                                        <h2 class="text-sm font-bold text-gray-500">Mobile:</h2>
                                        <h2 class="text-sm text-gray-400"><?php echo $userDetails['mobileNumber'] ?></h2>
                                    </div>
                                    <div class="flex gap-2 py-1">
                                        <h2 class="text-sm text-gray-500">Address:</h2>
                                        <h2 class="text-sm text-gray-400"><?php echo $userDetails['address'] ?></h2>
                                    </div>
                                    <div class="flex gap-2 py-1">
                                        <h2 class="text-sm text-gray-500">Mobile:</h2>
                                        <h2 class="text-sm text-gray-400"><?php echo $userDetails['mobileNumber'] ?></h2>
                                    </div>
                                    <div class="flex gap-2 py-1">
                                        <h2 class="text-sm text-gray-500">Birthday:</h2>
                                        <h2 class="text-sm text-gray-400"><?php echo $userDetails['dateOfBirth'] ?></h2>
                                    </div>
                                    <div class="flex gap-2 py-1">
                                        <h2 class="text-sm text-gray-500">Gender:</h2>
                                        <h2 class="text-sm text-gray-400"><?php echo $userDetails['gender'] ?></h2>
                                    </div>
                                    <div class="flex gap-2 py-1">
                                        <h2 class="text-sm text-gray-500">Place of Birth:</h2>
                                        <h2 class="text-sm text-gray-400"><?php echo $userDetails['placeOfBirth'] ?></h2>
                                    </div>
                                    <div class="flex gap-2 py-1">
                                        <h2 class="text-sm text-gray-500">Civil Status:</h2>
                                        <h2 class="text-sm text-gray-400"><?php echo $userDetails['civilStatus'] ?></h2>
                                    </div>
                                    <div class="flex gap-2 py-1">
                                        <!-- <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 text-sm font-medium bg-blue-500 text-white" data-bs-target="#changePasswordModal" data-bs-toggle="modal">
                                            Change Password
                                        </button> -->
                                            <?php if ($_SESSION['activated'] == 0) 
                                            { ?>
                                                <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 text-sm font-medium bg-blue-500 text-white" data-bs-toggle="modal" data-bs-target="#updatePasswordModal">Update Password</button>
                                            <?php }
                                            else 
                                            { ?>
                                                <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 text-sm font-medium bg-blue-500 text-white" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                                            <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT CARD -->
                        <div class="col-span-12 md:col-span-8">
                            <div class="bg-white shadow rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 justify-center">
                                <div>
                                    <h2 class="text-lg font-bold">Employment Information:</h2>
                                    <div class="flex flex-col py-1 pr-6">
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Email:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['emailAddress'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Job Title:</h2>
                                            <h2 class="text-sm text-gray-400">
                                                <?php 
                                                    if ($userDetails['departmentName'] == "Operations")
                                                    {
                                                        echo $userDetails['departmentName']." - ". $userDetails['position'];
                                                    }
                                                    else 
                                                    {
                                                        echo $userDetails['position'];
                                                    }
                                                ?>
                                            </h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Employment Status:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['employmentStatus'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Date Hired:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['dateHired'] ?></h2>
                                        </div>
                                        <?php 
                                            if ($userDetails['employmentStatus'] == "Regular") { ?>
                                            <div class="flex gap-2 py-1">
                                                <h2 class="text-sm text-gray-500">Date Regularized:</h2>
                                                <h2 class="text-sm text-gray-400"><?php echo $userDetails['dateRegularized'] ?></h2>
                                            </div>
                                        <?php } ?>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">SSS No.:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['sss'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Pag-Ibig No.:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['pagIbig'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Philhealth No.:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['philhealth'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">TIN:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['tin'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Shift:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['startTime']." - ".$userDetails['endTime'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Available Sick Leaves:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['availableSL']?></h2>
                                        </div>                                        
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Available Vacation Leaves:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['availableVL'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Accumulated Leave Points:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['leavePoints'] ?></h2>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold">Requirements:</h2>
                                    <div class="flex flex-col py-1">
                                        <div class="flex gap-2 py-1">
                                            <?php 
                                                if ($userDetails['req_sss'] == 0) { ?>
                                                <input class="form-check-input" type="checkbox" id="req_sss" name="req_sss" disabled readonly>
                                            <?php } else { ?>
                                                <input class="form-check-input" type="checkbox" id="req_sss" name="req_sss" checked disabled readonly>
                                            <?php }; ?>
                                            <label class="form-check-label text-sm text-gray-800" for="req_sss">
                                                SSS
                                            </label>  
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <?php 
                                                if ($userDetails['req_pagIbig'] == 0) { ?>
                                                <input class="form-check-input" type="checkbox" id="req_pagIbig" name="req_pagIbig" disabled readonly>
                                            <?php } else { ?>
                                                <input class="form-check-input" type="checkbox" id="req_pagIbig" name="req_pagIbig" checked disabled readonly>
                                            <?php }; ?>
                                            <label class="form-check-label text-sm text-gray-800" for="req_pagIbig">
                                                Pag-Ibig
                                            </label>  
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <?php 
                                                if ($userDetails['req_philhealth'] == 0) { ?>
                                                <input class="form-check-input" type="checkbox" id="req_philhealth" name="req_philhealth" disabled readonly>
                                            <?php } else { ?>
                                                <input class="form-check-input" type="checkbox" id="req_philhealth" name="req_philhealth" checked disabled readonly>
                                            <?php }; ?>
                                            <label class="form-check-label text-sm text-gray-800" for="req_philhealth">
                                                PhilHealth
                                            </label>  
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <?php 
                                                if ($userDetails['req_tin'] == 0) { ?>
                                                <input class="form-check-input" type="checkbox" id="req_tin" name="req_tin" disabled readonly>
                                            <?php } else { ?>
                                                <input class="form-check-input" type="checkbox" id="req_tin" name="req_tin" checked disabled readonly>
                                            <?php }; ?>
                                            <label class="form-check-label text-sm text-gray-800" for="req_tin">
                                                TIN
                                            </label>  
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <?php 
                                                if ($userDetails['req_nbi'] == 0) { ?>
                                                <input class="form-check-input" type="checkbox" id="req_nbi" name="req_nbi" disabled readonly>
                                            <?php } else { ?>
                                                <input class="form-check-input" type="checkbox" id="req_nbi" name="req_nbi" checked disabled readonly>
                                            <?php }; ?>
                                            <label class="form-check-label text-sm text-gray-800" for="req_nbi">
                                                NBI
                                            </label>  
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <?php 
                                                if ($userDetails['req_medicalExam'] == 0) { ?>
                                                <input class="form-check-input" type="checkbox" id="req_medicalExam" name="req_medicalExam" disabled readonly>
                                            <?php } else { ?>
                                                <input class="form-check-input" type="checkbox" id="req_medicalExam" name="req_medicalExam" checked disabled readonly>
                                            <?php }; ?>
                                            <label class="form-check-label text-sm text-gray-800" for="req_medicalExam">
                                                Medical Exam
                                            </label>  
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <?php 
                                                if ($userDetails['req_2x2pic'] == 0) { ?>
                                                <input class="form-check-input" type="checkbox" id="req_2x2pic" name="req_2x2pic" disabled readonly>
                                            <?php } else { ?>
                                                <input class="form-check-input" type="checkbox" id="req_2x2pic" name="req_2x2pic" checked disabled readonly>
                                            <?php }; ?>
                                            <label class="form-check-label text-sm text-gray-800" for="req_2x2pic">
                                                2x2 Picture
                                            </label>  
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <?php 
                                                if ($userDetails['req_vaccineCard'] == 0) { ?>
                                                <input class="form-check-input" type="checkbox" id="req_vaccineCard" name="req_vaccineCard" disabled readonly>
                                            <?php } else { ?>
                                                <input class="form-check-input" type="checkbox" id="req_vaccineCard" name="req_vaccineCard" checked disabled readonly>
                                            <?php }; ?>
                                            <label class="form-check-label text-sm text-gray-800" for="req_vaccineCard">
                                                Vaccine Card
                                            </label>  
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <?php 
                                                if ($userDetails['req_psa'] == 0) { ?>
                                                <input class="form-check-input" type="checkbox" id="req_psa" name="req_psa" disabled readonly>
                                            <?php } else { ?>
                                                <input class="form-check-input" type="checkbox" id="req_psa" name="req_psa" checked disabled readonly>
                                            <?php }; ?>
                                            <label class="form-check-label text-sm text-gray-800" for="req_psa">
                                                PSA - Birth Certificate
                                            </label>  
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <?php 
                                                if ($userDetails['req_validID'] == 0) { ?>
                                                <input class="form-check-input" type="checkbox" id="req_validID" name="req_validID" disabled readonly>
                                            <?php } else { ?>
                                                <input class="form-check-input" type="checkbox" id="req_validID" name="req_validID" checked disabled readonly>
                                            <?php }; ?>
                                            <label class="form-check-label text-sm text-gray-800" for="req_validID">
                                                2 Valid IDs
                                            </label>  
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <?php 
                                                if ($userDetails['req_validID'] == 0) { ?>
                                                <input class="form-check-input" type="checkbox" id="req_helloMoney" name="req_helloMoney" disabled readonly>
                                            <?php } else { ?>
                                                <input class="form-check-input" type="checkbox" id="req_helloMoney" name="req_helloMoney" checked disabled readonly>
                                            <?php }; ?>
                                            <label class="form-check-label text-sm text-gray-800" for="req_helloMoney">
                                                Account Number in Hello Money (AUB)
                                            </label>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!---------------------------------------------------------------------------------------------------------------------------------------------------------->
            <!-------------------------------------------------------------------------- MODAL ------------------------------------------------------------------------->
            <!---------------------------------------------------------------------------------------------------------------------------------------------------------->
            
            <!---------------------------------------------------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------------- CHANGE PASSWORD FORM -------------------------------------------------------------------->
            <form id="changePasswordForm">
                <div class="modal fade" id="changePasswordModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="resetPassLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content" id="changePasswordModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="resetPassLabel">Change Password</h1>
                                <input type="hidden" id="currentPassword" value="<?php echo $_SESSION['hashedPassword']; ?>">
                                <input type="hidden" id="userID" value="<?php echo $_SESSION['userID']; ?>">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="currentPass">Current Password</label>
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <input type="password" class="form-control" id="currentPass" placeholder="Password">
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="newPass">New Password</label>
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <input type="password" class="form-control" id="newPass" placeholder="Password">
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="retypePass">Retype New Password</label>
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <input type="password" class="form-control" id="retypePass" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!---------------------------------------------------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------------- UPDATE PASSWORD FORM -------------------------------------------------------------------->
            <form id="updatePasswordForm">
                <div class="modal fade" id="updatePasswordModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="resetPassLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content" id="updatePasswordModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="resetPassLabel">Update Password</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="newPassword">New Password</label>
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <input type="password" class="form-control" id="newPassword" placeholder="Password">
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="retypePassword">Retype New Password</label>
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <input type="password" class="form-control" id="retypePassword" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    
        <script src="../assets/js/profile.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>