<?php
	require_once __DIR__ . '/../init.php';
	date_default_timezone_set('Asia/Manila');

	// 3 days before Mar 1 / Jun 1 / Sep 1 / Dec 1: notify every active employee
	function sendVitalInfoReminder($conn, DateTime $today) {
		$DAYS_BEFORE = 3;
		$DUE_MONTHS  = [3, 6, 9, 12];

		$due = null;
		foreach ([0, 1] as $yearOffset) {
			foreach ($DUE_MONTHS as $m) {
				$d = new DateTime(((int)$today->format('Y') + $yearOffset) . "-$m-01");
				if ($d >= $today) { $due = $d; break 2; }
			}
		}

		$daysLeft = (int)$today->diff($due)->days;
		if ($daysLeft > $DAYS_BEFORE || $daysLeft < 1) {
			echo date('Y-m-d H:i:s') . " Vital info reminder: nothing to send (next update " . $due->format('M j, Y') . ", $daysLeft days away)\n";
			return;
		}

		$dueText = $due->format('F j, Y');
		$title   = "Update of Vital Information - " . $due->format('M j, Y');
		$caption = "Reminder: the quarterly update of employee vital information will take place on $dueText. "
				. "Please prepare your updated details (civil status, mobile number and address) so you can update them on that day.";

		// one notice per active employee; skips anyone who already has this one
		$stmt = $conn->prepare("
			INSERT INTO tbl_notifications (target_empID, title, caption, photo_path, created_by)
			SELECT e.id, ?, ?, NULL, NULL
			FROM tbl_employee e
			WHERE e.e_status = 'Active'
			AND NOT EXISTS (
				SELECT 1 FROM tbl_notifications n
				WHERE n.target_empID = e.id AND n.title = ?
			)
		");
		$stmt->bind_param('sss', $title, $caption, $title);
		$stmt->execute();

		echo date('Y-m-d H:i:s') . " Vital info reminder: due $dueText, notified " . $stmt->affected_rows . " employee(s)\n";
	}

	// On Mar 1 / Jun 1 / Sep 1 / Dec 1: set everyone to 'Pending'
	function runVitalInfoCycle($conn, DateTime $today) {
		$isDueDay = (int)$today->format('j') === 1
				&& in_array((int)$today->format('n'), [3, 6, 9, 12], true);

		if (!$isDueDay) {
			echo date('Y-m-d H:i:s') . " Vital info cycle: not a due date, skipped\n";
			return;
		}

		$todayStr = $today->format('Y-m-d');

		$stmt = $conn->prepare("
			UPDATE tbl_updateempinfo
			SET status = 'Scheduled', nextChangeDate = ?
			WHERE status <> 'Scheduled'
			AND (lastUpdateDate IS NULL OR lastUpdateDate < ?)
		");
		$stmt->bind_param('ss', $todayStr, $todayStr);
		$stmt->execute();

		echo date('Y-m-d H:i:s') . " Vital info cycle: $todayStr -> Scheduled for " . $stmt->affected_rows . " employee(s)\n";
	}

	// Optional date argument only works when this file is run directly:
	// php vital_info_cycle.php 2026-11-28
	$isDirectRun = isset($_SERVER['SCRIPT_FILENAME']) && realpath($_SERVER['SCRIPT_FILENAME']) === __FILE__;
	$testDate    = $isDirectRun ? ($argv[1] ?? 'today') : 'today';

	$vitalConn = $database->dbConnect();
	sendVitalInfoReminder($vitalConn, new DateTime($testDate));
	runVitalInfoCycle($vitalConn, new DateTime($testDate));
?>