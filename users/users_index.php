<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<? print_navigation('Users','Home Page','../contents.php'); ?>
<? print_title('Users'); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        <form action="secure/users_list.php">
        <table cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Name</font></td>
            <td><input type="text" name="f_name" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Surname</font></td>
            <td><input type="text" name="f_surname" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">ID Card</font></td>
            <td><input type="text" name="f_id_card" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td>&nbsp</td>
            <td>
                <input type="submit" name="submit" value="Search">
                <select name="f_logical_op" size="1">
    	    	    <option value="OR">Any of the words listed</option>
    	    	    <option value="AND">All the words listed</option>
                </select>
                <select name="f_order" size="1">
    	    	    <option value="s">Sorted by surname</option>
    	    	    <option value="i">Sorted by ID card</option>
                    <option value="u">Unsorted</option>
                </select>
            </td>
        </tr>
        </table>
        </form>
        <form action="secure/users_insert.php">
            <input type="submit" value="Insert a new user">
        </form>
        <a href="javascript:history.back(1)">Back</a> to previous screen.
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