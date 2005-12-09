<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Articles</title>
    <link rel="stylesheet" href="../../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">


<? print_navigation('Modify an article','Home Page','../../contents.php','Articles','../articles_index.php'); ?>
<? print_title('Modify an article'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // controllo i parametri
    if (!$oid) { 
        print "You don't have selected nothing";
        exit;
    };
    
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // leggo gli articoli
    $query="SELECT oid,* from articoli WHERE oid=" . $oid;
    $result = pg_Exec ($conn,$query);
    if ($DEBUG) { print 'Query: <B>' . $query . '</B><BR>'; };
    if (!$result) {
        if ($DEBUG) { print 'File articles_modify error: cannot execute query.\n'; };
        exit;
    };

    $arr=pg_fetch_array ($result, 0);

    // chiudo la connessione
    db_close($conn);

    // stampa la tabella    
	echo "<table align=\"center\" width=\"90%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
	echo "<tr>\n";
	echo "    <td align=\"left\" valign=\"top\" width=\"70%\" bgcolor=\"#e0e0e0\">\n";
	echo "        <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
	echo "        Please modify article information then press <b>Modify</b> button:<br>\n";
    echo "        <table cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
	echo "        <form action=\"articles_modify_commit.php\">\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Description</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><textarea name=\"note\" rows=\"6\" cols=\"65\">" . $arr["articolo"] . "</textarea>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td>&nbsp;</td>\n";
	echo "            <td>\n";
    echo "                <input type=\"hidden\" name=\"oid\" value=\"" . $arr['oid'] . "\">\n";
    echo "                <input type=\"submit\" name=\"submit\" value=\"Modify\">&nbsp;<input type=\"reset\" name=\"reset\" value=\"Reset values\"></td>\n";
	echo "        </tr>\n";
	echo "        </table>\n";
	echo "        </form>\n";
	echo "        <a href=\"javascript:history.back(1)\">Back</a> to previous screen.\n";
	echo "        </font>\n";
	echo "    </td>\n";
	echo "    <td align=\"justify\" valign=\"top\" width=\"30%\" bgcolor=\"#ffffe0\">\n";
	echo "        <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
	echo "        <div align=\"justify\">\n";
	echo "        <b>On-line Help</b><br>\n";
	echo "        <br>\n";
	echo "        Work in progress.\n";
	echo "        </div>\n";
	echo "        </font>\n";
	echo "    </td>\n";
	echo "</tr>\n";
	echo "</table>\n";
?>

</font>

</body>
</html>