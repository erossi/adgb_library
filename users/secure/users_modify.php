<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Users</title>
    <link rel="stylesheet" href="../../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">


<? print_navigation('Modify an user','Home Page','../../contents.php','Users','../users_index.php'); ?>
<? print_title('Modify  a book'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // stampo il risultato
    $query="SELECT oid,* FROM utenti WHERE oid=" . $oid;
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
        
    $result = db_execute($conn,$query);    

    // leggo in un array il risultato
    $arr=pg_fetch_array($result,0);

	echo "<table align=\"center\" width=\"90%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
	echo "<tr>\n";
	echo "    <td align=\"left\" valign=\"top\" width=\"70%\" bgcolor=\"#e0e0e0\">\n";
	echo "        <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
	echo "        Please modify users information then press <b>Modify</b> button:<br>\n";
	echo "        <form action=\"users_modify_commit.php\">\n";
	echo "        <table cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Name</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_name\" value=\"" . $arr['nome'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Surname</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_surname\" value=\"" . $arr['cognome'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Title</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_title\" value=\"" . $arr['titolo'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">ID Card</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_id_card\" value=\"" . $arr['carta_identita'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">ID Card (City)</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_id_card_city\" value=\"" . $arr['comune_carta'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Phone number</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_phone\" value=\"" . $arr['telefono'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td>&nbsp;</td>\n";
	echo "            <td>\n";
    echo "                <input type=\"hidden\" name=\"oid\" value=\"" . $arr['oid'] . "\">\n";
    echo "                <input type=\"submit\" name=\"submit\" value=\"Modify\">&nbsp;<input type=\"reset\" name=\"reset\" value=\"Reset values\">\n";
    echo "            </td>\n";
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
	echo "        Work in progress.<br>\n";
	echo "        </div>\n";
	echo "        </font>\n";
	echo "    </td>\n";
	echo "</tr>\n";
	echo "</table>\n";
    
    db_close($conn);
?>

</font>

</body>
</html>