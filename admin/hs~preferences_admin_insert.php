<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Preferences</title>
    <link rel="stylesheet" href="../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<? printheader('Insert a new administrator','Preferences','preferences_index.php'); ?>

<div align="center"><h2>Insert a new administrator</h2></div>
<div align="justify">

<table align="center" width="80%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td align="left" valign="top">
        <font face="arial,helvetica,sans-serif" size="2">
        <ul>
            <li>Please insert username and password for the new administrator:
                <form action="preferences_admin_insert_commit.php">
                <table cellspacing="0" cellpadding="3" border="0">
                <tr>
                    <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Username</font></td>
                    <td><input type="text" name="f_username" size="30" align="absmiddle"></td>
                </tr>
                <tr>
                    <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Password</font></td>
                    <td><input type="text" name="f_password" size="30" align="absmiddle"></td>
                </tr>
                <tr>
                    <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Area to activate</font></td>
                    <td>
                        <font face="arial,helvetica,sans-serif" size="2">
                        <input type="checkbox" name="f_area_books">Books<br>
                        <input type="checkbox" name="f_area_journals">Journals<br>
                        <input type="checkbox" name="f_area_articles">Articles<br>
                        <input type="checkbox" name="f_area_users">Users<br>
                        <input type="checkbox" name="f_area_preferences">Preferences<br>
                        </font>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                    <td><input type="submit" name="submit" value="Add administrator"></td>
                </tr>
                </table>
                </form>
            <li><a href="javascript:history.back(1)">Back</a> to previous screen.
        </ul>
        </font>
    </td>
    <td align="justify" valign="top" bgcolor="#ffffe0">
        <font face="arial,helvetica,sans-serif" size="2">
        
        </font
    </td>
</tr>
</table>


</font>

</body>
</html>