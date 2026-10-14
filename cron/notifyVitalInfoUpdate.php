<?php
  require_once __DIR__ . '/../init.php';
  $conn = $database->dbConnect();

  date_default_timezone_set('Asia/Manila'); 

  $DAYS_BEFORE = 3;
  $DUE_MONTHS  = [3, 6, 9, 12];         

  $today = new DateTime($argv[1] ?? 'today');
  $today->setTime(0, 0, 0);

  // Find the next due date on or after today
  $due = null;
  foreach ([0, 1] as $yearOffset) {
      foreach ($DUE_MONTHS as $m) {
          $d = new DateTime(((int)$today->format('Y') + $yearOffset) . "-$m-01");
          if ($d >= $today) { $due = $d; break 2; }
      }
  }

  $daysLeft = (int)$today->diff($due)->days;
  if ($daysLeft > $DAYS_BEFORE) {
      echo "Nothing to send. Next update is " . $due->format('M j, Y') . " ($daysLeft days away).\n";
      exit;
  }

  $dueText = $due->format('F j, Y');
  $title   = "Update of Vital Information - " . $due->format('M j, Y');
  $caption = "Reminder: the quarterly update of employee vital information will take place on $dueText. "
         . "Please prepare your updated details (Civil Status, Mobile Number and Address) so you can update them on that day.";


  $sql = "
      INSERT INTO tbl_notifications (target_empID, title, caption, photo_path, created_by)
      SELECT e.id, ?, ?, NULL, NULL
      FROM tbl_employee e
      WHERE e.e_status = 'Active'
        AND NOT EXISTS (
            SELECT 1 FROM tbl_notifications n
            WHERE n.target_empID = e.id AND n.title = ?
        )
  ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $title, $caption, $title);
  $stmt->execute();

  echo date('Y-m-d H:i') . " | Due $dueText | Notified: " . $stmt->affected_rows . " employee(s)\n";
?>