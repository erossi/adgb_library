<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<? print_navigation('Administrators section','Home Page','../contents.php'); ?>
<? print_title('Administrators section'); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        <table cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="right" valign="top">
                <img src="../img/big-admin.png" width="48" height="48" border="0" hspace="5">
            </td>
            <td align="left" valign="top">
                <form action="admin_list.php">
                    <input type="submit" name="submit" value="Administrators list" width="50%">
                </form>
            </td>
        </tr>
        </table>
        <? print_back(); ?>
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