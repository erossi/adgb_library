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


<? print_navigation('Delete an article','Home Page','../../contents.php','Articles','../articles_index.php'); ?>
<? print_title('Delete an article'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // leggo gli articoli
    $query="DELETE from articoli WHERE oid=" . $oid;
    $result=db_execute($conn,$query);

    // chiudo la connessione
    db_close($conn);
?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        Article deleted.<br>
        <form action="../articles_list.php">
            <input type="submit" name="submit" value="Go to Article List">
        </form>
        <form action="../articles_index.php">
            <input type="submit" name="submit" value="Return to Articles Menu">
        </form>
        </font>
    </td>
</tr>
</table>

</font>

</body>
</html>