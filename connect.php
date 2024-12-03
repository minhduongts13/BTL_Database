<?php

  $uri = "mysql://avnadmin:AVNS_jrEt7Tk8bsnASgwESoB@mysql-21f8fd80-hcmut-database.c.aivencloud.com:17289/defaultdb?ssl-mode=REQUIRED";

  $fields = parse_url($uri);

  // build the DSN including SSL settings
  $conn = "mysql:";
  $conn .= "host=" . $fields["host"];
  $conn .= ";port=" . $fields["port"];;
  $conn .= ";dbname=ass2";
  $conn .= ";sslmode=verify-ca;sslrootcert=ca.pem";

  try {
    $db = new PDO($conn, $fields["user"], $fields["pass"]);
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }









