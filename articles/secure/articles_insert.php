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


<? print_navigation('Insert an article','Home Page','../../contents.php','Articles','../articles_index.php'); ?>
<? print_title('Insert an article'); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        Please insert article description then press <b>Insert</b> button:<br>
        <form action="articles_insert_commit.php">
        <table cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Description</font></td>
            <td align="left"  valign="middle"><textarea name="note" rows="6" cols="65"></textarea></td>
        </tr>
        <tr>
            <td>&nbsp</td>
            <td><input type="submit" name="submit" value="Insert">&nbsp;<input type="reset" name="reset" value="Reset values"></td>
        </tr>
        </table>
        </form>
        <a href="javascript:history.back(1)">Back</a> to previous screen.
        </font>
    </td>
    <td align="justify" valign="top" width="30%" bgcolor="#ffffe0">
        <font face="arial,helvetica,sans-serif" size="2">
        <div align="justify">
        <b>On-line Help</b><br>
        <br>
        Enter article description and other informations into free form box.<br>
        <br>
        Once you've inputted your data, hit the <i>Insert</i> button to commit work.
        </div>
        </font>
    </td>
</tr>
</table>

</font>

</body>
</html>