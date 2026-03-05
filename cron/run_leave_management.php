<?php
    // CLI only (PREVENTS FROM RUNNING IN WEB BROWSER))
    if (php_sapi_name() !== 'cli') exit("CLI only\n");

    // PREVENTS OVERLAP IF IT RUNS LONG
    $lock = fopen(__DIR__ . '/leave_management.lock', 'c');
    if (!flock($lock, LOCK_EX | LOCK_NB)) exit("Already running\n");

    // LOAD YOUR SYSTEM BOOTSTRAP
    require_once __DIR__ . '/../init.php';

    // Instantiate and run
    $payroll->runLeaveManagement();

    echo "Done\n";
