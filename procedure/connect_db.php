<?php
    // File: connect_db
    // Connessione al database
    if (file_exists('../default.php')) { include '../default.php'; }

    $connection_string = "";
    if ($db_host != "") {
        $connection_string = "host=" . $db_host;
    }
    if ($db_port != "") {
        $connection_string = $connection_string . " port=" . $db_port;
    }
    if ($db_name != "") {
        $connection_string = $connection_string . " dbname=" . $db_name;
    }
    if ($db_user != "") {
        $connection_string = $connection_string . " user=" . $db_user;
    }
    $conn = pg_connect($connection_string);
    if (!$conn) {
        print "File connect_db error: cannot connect to database.<BR>" .
              "Connection string is: <B>" . $connection_string . "</B><BR>" . 
        exit;
    }
?>
