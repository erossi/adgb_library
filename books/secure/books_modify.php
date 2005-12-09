<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Books</title>
    <link rel="stylesheet" href="../../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">


<? print_navigation('Modify a book','Home Page','../contents.php','Books','../books_index.php'); ?>
<? print_title('Modify  a book'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // stampo il risultato
    $query="SELECT oid,* FROM libri WHERE oid=" . $oid;
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
        
    $result = db_execute($conn,$query);    

    // leggo in un array il risultato
    $arr=pg_fetch_array($result,0);

	echo "<table align=\"center\" width=\"90%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
	echo "<tr>\n";
	echo "    <td align=\"left\" valign=\"top\" width=\"70%\" bgcolor=\"#e0e0e0\">\n";
	echo "        <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
	echo "        Please modify book information then press <b>Modify</b> button:<br>\n";
	echo "        <form action=\"books_modify_commit.php?oid=" . $oid . "\">\n";
	echo "        <table cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Title (Info)</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_title\" value=\"" . $arr['titolo'] . "\" size=\"30\" align=\"absmiddle\">&nbsp;(&nbsp;<input type=\"text\" name=\"f_info\" value=\"" . $arr['info'] . "\"  size=\"15\" align=\"absmiddle\">&nbsp;)</td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Author nr. 1</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_auth1\" value=\"" . $arr['aut1'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">nr. 2</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_auth2\" value=\"" . $arr['aut2'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">nr. 3</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_auth3\" value=\"" . $arr['aut3'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">nr. 4</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_auth4\" value=\"" . $arr['aut4'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">nr. 5</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_auth5\" value=\"" . $arr['aut5'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">nr. 6</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_auth6\" value=\"" . $arr['aut6'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">nr. 7</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_auth7\" value=\"" . $arr['aut7'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Editor</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_editor\" value=\"" . $arr['casa_editoriale'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Inventory code</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><input type=\"text\" name=\"f_inventory\" value=\"" . $arr['codice_inventariale'] . "\" size=\"30\" align=\"absmiddle\"></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Collocation</font></td>\n";
	echo "            <td align=\"left\"  valign=\"middle\"><font face=\"arial,helvetica,sans-serif\" size=\"2\"><b>" . $arr['collocazione'] . "</b></font></td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Shelf&nbsp;/&nbsp;Number</font></td>\n";
	echo "            <td>\n";
	echo "                <font face=\"arial,helvetica,sans-serif\" size=\"2\"><b>" . $arr['scaffale'] . "</b>&nbsp;/&nbsp;<b>" . $arr['numero'] . "</font></td>\n";
	echo "            </td>\n";
	echo "        </tr>\n";
	echo "        <tr>\n";
	echo "            <td>&nbsp;</td>\n";
	echo "            <td>\n";
    echo "                <input type=\"hidden\" name=\"oid\" value=\"" . $arr['oid'] . "\">\n";
    echo "                <input type=\"hidden\" name=\"f_collocation\" value=\"" . $arr['collocazione'] . "\">\n";
    echo "                <input type=\"hidden\" name=\"f_shelf\" value=\"" . $arr['scaffale'] . "\">\n";
    echo "                <input type=\"hidden\" name=\"f_number\" value=\"" . $arr['numero'] . "\">\n";            
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
	echo "        Enter title, author(s) and other informations about the book into appropriate box.<br>\n";
	echo "        <br>\n";
	echo "        Once you've inputted your data, hit the <i>Modify</i> button to commit work.<br>\n";
	echo "        <br>\n";
	echo "        Please note: it is not necessary to fill in <i>every</i> box to be able\n";
	echo "        to insert a book, but title and an unique shelf/number are mandatory.\n";
	echo "        </div>\n";
	echo "        </font>\n";
	echo "    </td>\n";
	echo "</tr>\n";
	echo "</table>\n";
    
    db_close ($conn);
?>

</font>

</body>
</html>