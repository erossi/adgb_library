<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<? print_navigation('Insert a new administrator','Home Page','../contents.php','Administrators section','admin_index.php'); ?>
<? print_title('Insert a new administrator'); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        Please insert username and password for the new administrator:<br>
        <form action="admin_insert_commit.php">
        <table cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Username</font></td>
            <td><input type="text" name="f_username" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Password</font></td>
            <td><input type="text" name="f_password" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Area to activate</font></td>
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
        <a href="javascript:history.back(1)">Back</a> to previous screen.
        </font>
    </td>
    <td align="justify" valign="top" width="30%" bgcolor="#ffffe0">
        <font face="arial,helvetica,sans-serif" size="2">
        <b>On-line Help</b><br>
        <br>
        Work in progress
        </font
    </td>
</tr>
</table>

</font>

</body>
</html>