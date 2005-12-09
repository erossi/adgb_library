<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<script language="JavaScript">
<!--
function changeicon(name,number) {
        if (((navigator.appName == "Netscape") && (parseInt(navigator.appVersion) >= 3 )) || 
            ((navigator.appName == "Microsoft Internet Explorer") && (parseInt(navigator.appVersion) >= 4 ))) {
	switch (number) {
	    case 0: document.images[name].src='../img/big-journals.png'; break;
		case 1: document.images[name].src='../img/big-articles.png'; break;
		case 2: document.images[name].src='../img/big-users.png'; break;
		case 3: document.images[name].src='../img/big-money.png'; break;
	}
}
}
-->
</script>
    
<? print_navigation('Delete table','Home Page','../contents.php','Administrators section','admin_index.php'); ?>
<? print_title('Delete table'); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        <div align="center">
        <img src="../img/big-warning.png" width="48" height="48" border="0" alt="Warning !"><br>
        </div>
        <b>Warning</b>: You have requested to delete table <b><? echo $table; ?></b>.
        Deleting a table will also delete <b>all</b> data contained within. Please confirm operation:
        <form name="f_name" action="admin_table_delete_commit.php">
            <input type="hidden" name="table" value="<? echo $table; ?>">
            <input type="submit" name="submit" value="Ok, delete">
        </form>
        <form name="f_name" action="admin_table_list.php">
            <input type="submit" name="submit" value="Ooops, cancel operation">
        </form>        
        <? print_back(); ?>
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