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
    $query="SELECT oid,* FROM articoli WHERE oid=" . $oid;
    $result=db_execute($conn,$query);
    if ($DEBUG) { print 'Query: <B>' . $query . '</B><BR>'; };
    // leggo i dati
    $arr=pg_fetch_array ($result, 0);
   
    // chiudo la connessione
    db_close($conn);
?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        You have requested to delete this article:<br><br>
        <table cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white"><br>Description<br><br></font></td>
            <td align="left"  valign="middle"><textarea name="note" rows="6" cols="65"><? print $arr['articolo']; ?></textarea></td>
        </tr>
        </table>
        <form action="articles_delete_commit.php">
            <input type="hidden" name="oid" value="<? print $oid; ?>">
            <input type="submit" value="Ok ,delete">
        </form>
        <form action="../articles_index.php">
            <input type="submit" value="Oops, cancel operation!">
        </form>
        <a href="javascript:history.back(1)">Back</a> to previous screen.
        </font>
    </td>
</table>

</font>

</body>
</html>