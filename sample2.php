<?php
$host = "ec2-54-210-226-209.compute-1. amazonaws. com";
$db = "dcrjvkg6kjn1dl";
        "5432"; $port
$username = "kahmqccbcdxwcn";
$password "64072b406829e7c35273aecac40f91fe299d328bb747b8e81ad3d8234f1d5b34";

try {
    $dsn = "pgsql:host=$host; dbname=$db; charset=UTF8; port=$port";
          = new PDO($dsn, $username, $password, [
         
    $pdo
        PDO: :ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
    1);
    $updateSchedule = $pdo->prepare("UPDATE tbl_schedule
    SET status = 'Overdue'
    WHERE
    TIMESTAMP (sched_date, start) <= CURRENT_TIMESTAMP()
    AND status != 'Done'");
    $updateSchedule->execute();
    $updateAppointments
tbl_appointment AS a
                      $pdo->prepare("UPDATE
INNER JOIN tbl_schedule AS s
ON
s.sched_id = a.sched_id
SET a.status "OVERDUE'
WHERE TIMESTAMP (s.sched_date, s.start) <= CURRENT_TIMESTAMP()
AND a.status != 'DONE' AND s.status != 'Done'");
$updateAppointments->execute();
} catch (PDOException $e) {
echo $e->getMessage();
}