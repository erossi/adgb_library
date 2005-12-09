<?
    // File: utility
    // contiene una serie di funzioni di utilità generale


    // search level.
    function find_prefix() {
        if (file_exists("default.php")) {
            $prefix="";    // we are in root directory
        } else {
            if (file_exists("../default.php")) {
                $prefix="../";    // we are in first subdirectory
            } else {
                if (file_exists("../../default.php")) {
                    $prefix="../../";    // we are in second subdirectory
                } else {
                    // *** DO SOMETHING !! ***
                }
            }
        }
        
        return $prefix;
    }

    // stampa un messaggio di debug
    function print_debug($message) {
        echo "<br>\n";
        echo "<div align=\"center\">\n";
        echo "<table width=\"60%\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\">\n";
        echo "<tr>\n";
        echo "    <td align=\"left\" valign=\"middle\" bgcolor=\"cyan\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"black\">\n";
        echo "    $message\n";
        echo "    </font>\n";
        echo "    </td>\n";
        echo "</tr>\n";
        echo "</table>\n";
        echo "</div>\n";
        return;
    }
    
    // stampa un messaggio di errore
    function print_error($message) {
        echo "<br>\n";
        echo "<div align=\"center\">\n";
        echo "<table width=\"60%\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\">\n";
        echo "<tr>\n";
        echo "    <td align=\"left\" valign=\"middle\" bgcolor=\"red\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"yellow\">\n";
        echo "    $message\n";
        echo "    </font>\n";
        echo "    </td>\n";
        echo "</tr>\n";
        echo "</table>\n";
        echo "</div>\n";
        return;
    }
    
    // stampa la navigation bar delle pagine
    function print_navigation($title,$first='',$first_link='',$second='',$second_link='',$third='',$third_link='') {
        echo "<div align=\"center\">\n";
        echo "<br>\n";
        echo "<table width=\"90%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
        echo "<tr>\n";
        echo "    <td align=\"right\" valign=\"middle\" bgcolor=\"#e0e0e0\" width=\"10%\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
        echo "    Navigate\n";
        echo "    </font>\n";
        echo "    </td>\n";
        echo "    <td align=\"left\" valign=\"middle\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
        if ($first_link <> "") { echo "&nbsp;:&nbsp;<a href=\"" . $first_link . "\">" . ($first == "" ? "NULL" : $first) . "</a>\n"; }
        if ($second_link <> "") { echo "&nbsp;:&nbsp;<a href=\"" . $second_link . "\">" . ($second == "" ? "NULL" : $second) . "</a>\n"; }
        if ($third_link <> "") { echo "&nbsp;:&nbsp;<a href=\"" . $third_link . "\">" . ($third == "" ? "NULL" : $third) . "</a>\n"; }
        if ($title <> "") { echo "&nbsp;:&nbsp;" . $title . "\n"; }
        echo "    </font>\n";
        echo "    </td>\n";
        echo "    <td align=\"right\" valign=\"middle\" bgcolor=\"#e0e0e0\" width=\"10%\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
        echo "    <img name=\"ico_db_status\" src=\"" . find_prefix() . "icone/micro-database-off.png\" onmouseover=\"changeimage('ico_db_status','" . find_prefix() . "icone/mini-database.png')\" width=\"15\" height=\"15\" border=\"0\" align=\"absmiddle\">\n";
        echo "    </font>\n";
        echo "    </td>\n";        
        echo "</tr>\n";
        echo "</table>\n";
        echo "</div>\n";
        return;
    };
    
    // stampa il titolo
    function print_title($title) {
        echo "<table align=\"center\" width=\"90%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
        echo "<tr>\n";
        echo "<td align=\"center\" valign=\"middle\" width=\"70%\" bgcolor=\"#336699\" colspan=\"2\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">\n";
        print $title;
        echo "    </font>\n";
        echo "    </td>\n";
        echo "</tr>\n";
        echo "</table>\n";
    };
    
    // print "back to previous screen"
    function print_back() {
        echo "&nbsp;<img src=\"" . find_prefix() . "icone/micro-back.png\" align=\"absmiddle\">&nbsp;<a href=\"javascript:history.back(1)\">Back</a> to previous screen.\n";
    };

    // stampa il titolo
    function print_top($title) {
        echo "<table align=\"center\" width=\"90%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
        echo "<tr>\n";
        echo "<td align=\"right\" valign=\"middle\" width=\"70%\" bgcolor=\"white\" colspan=\"2\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"black\">\n";
        echo $title . "&nbsp;-&nbsp;Powered by Tecnobrain\n";
        echo "    </font>\n";
        echo "    </td>\n";
        echo "</tr>\n";
        echo "</table>\n";
    };
    
    // connessione al database
    function db_connect($host='',$port='',$name='',$user='') {
        // activate image
        echo "<script language=\"javascript\">\n";
        echo "//<!--\n";
        echo "  changeimage('ico_db_status','" . find_prefix() . "icone/micro-database-on.png');\n";
        echo "//-->\n";
        echo "</script>\n";
        // compose connection string
        $connection_string = "";
        if ($host != '') { $connection_string = 'host=' . $host; }
        if ($port != '') { $connection_string = $connection_string . ' port=' . $port; }
        if ($name != '') { $connection_string = $connection_string . ' dbname=' . $name; }
        if ($user != '') { $connection_string = $connection_string . ' user=' . $user; }
        // execute connection
        $connection = pg_connect($connection_string);
        if (!$connection) {
           print_error('Function db_connect error: cannot connect to database.<br>' .
                      'Connection string is: <b>' . $connection_string . '</b><br>'); 
            exit;
        }
        return $connection;
    }

    // esegue una query
    function db_execute($connection,$query_string) {
        if ($DEBUG) {
            print_debug('Query string is: <b>' . $query_string . '</b><br>');
        }
        $query_result = pg_exec ($connection,$query_string);
        if (!$query_result) {
            print_error('File db_execute error: cannot execute query.<br>' .
                       'Query string is: <b>' . $query_string . '</b><br>'); 
            return;
        }
        return $query_result;
    }

    // connessione al database
    function db_close($conn) {
        pg_close ($conn);
        // deactivate image
        echo "<script language=\"javascript\">\n";
        echo "//<!--\n";
        echo "  changeimage('ico_db_status','" . find_prefix() . "icone/micro-database-off.png');\n";
        echo "//-->\n";
        echo "</script>\n";
        return;
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name - $prog_section ?></title>
    <? echo "<link rel=\"stylesheet\" href=\"" . find_prefix() . "library.css\">\n"; ?>
    <script language="JavaScript">
    <!--
    function changeimage(name,newicon) {
        if (((navigator.appName == "Netscape") && (parseInt(navigator.appVersion) >= 3 )) || 
            ((navigator.appName == "Microsoft Internet Explorer") && (parseInt(navigator.appVersion) >= 4 ))) {
            document.images[name].src=newicon;
        }
    }
    //-->
    </script> 
</head>
<body text="black" bgcolor="white" link="#336699" alink="#336699" vlink="#336699">

<font face="arial,helvetica,sans-serif" size="2">

