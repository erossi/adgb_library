<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Administrators section</title>
    <link rel="stylesheet" href="../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<? print_top($prog_name); ?>
<? print_navigation('Administrators section','Home Page','../contents.php'); ?>
<? print_title('Administrators section'); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        <form action="admin_list.php">
            <input type="submit" name="submit" value="Administrators list" width="50%">
        </form>
        <form action="admin_insert.php">
            <input type="submit" name="submit" value="Add an administrator" width="50%">
        </form>
        </font>
    </td>
    <td align="justify" valign="top" width="30%" bgcolor="#ffffe0">
        <font face="arial,helvetica,sans-serif" size="2">
        <b>On-line Help</b><br>
        <br>
        Work in progress. This page will be ready ASAP.<br>
        </font>
    </td>
</tr>
</table>

</font>

</body>
</html>