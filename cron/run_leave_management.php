<?php
    file_put_contents(
        __DIR__ . '/leave_management_cron.log',
        date('Y-m-d H:i:s') . " Script started\n",
        FILE_APPEND
    );

    $lock = fopen(__DIR__ . '/leave_management.lock', 'c');
    if (!flock($lock, LOCK_EX | LOCK_NB)) {
        file_put_contents(
            __DIR__ . '/leave_management_cron.log',
            date('Y-m-d H:i:s') . " Already running\n",
            FILE_APPEND
        );
        exit;
    }

    require_once __DIR__ . '/../init.php';

    $payroll->runLeaveManagement();

    file_put_contents(
        __DIR__ . '/leave_management_cron.log',
        date('Y-m-d H:i:s') . " Done\n",
        FILE_APPEND
    );
?>