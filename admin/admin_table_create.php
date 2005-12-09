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
    
<? print_navigation('Create table','Home Page','../contents.php','Administrators section','admin_index.php'); ?>
<? print_title('Create table'); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        Please insert table information:<br>
        <form name="f_name" action="admin_table_create_commit.php">
        <table cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Table name</font></td>
            <td><input type="text" name="f_tablename" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Description</font></td>
            <td><input type="text" name="f_description" size="30" align="absmiddle"></td>
        </tr>        
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Table Icon</font></td>
            <td>
                <font face="arial,helvetica,sans-serif" size="2">
                <img src="../img/big-journals.png" name="f_icon" width="48" height="48" border="0" alt="Icona della tabella"><br>
            <!--/td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Area to activate</font></td>
            <td-->
                
				<select name="f_icon_select" onchange="changeicon('f_icon',document.forms.f_name.f_icon_select.selectedIndex)">
					<option>Journals</option>
   					<option>Articles</option>
					<option>Users</option>
					<option>Money</option>
				</select>
                </font>
            </td>
        </tr>
        <tr>
            <td>&nbsp</td>
            <td><input type="submit" name="submit" value="Add table"></td>
        </tr>
        </table>
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