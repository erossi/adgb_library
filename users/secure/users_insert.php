<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Users</title>
    <link rel="stylesheet" href="../../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<? print_top($prog_name); ?>
<? print_navigation('Insert a new user','Home Page','../../contents.php','Users','../users_index.php'); ?>
<? print_title('Insert a new user'); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
 <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
     <font face="arial,helvetica,sans-serif" size="2">
     Please insert users information then press <b>Insert</b> button:<br>
     <form action="users_insert_commit.php?oid=" . $oid . "">
     <table cellspacing="1" cellpadding="3" border="0">
     <tr>
         <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Name</font></td>
         <td align="left"  valign="middle"><input type="text" name="f_name" value="" . $arr['nome'] . "" size="30" align="absmiddle"></td>
     </tr>
     <tr>
         <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Surname</font></td>
         <td align="left"  valign="middle"><input type="text" name="f_surname" value="" . $arr['cognome'] . "" size="30" align="absmiddle"></td>
     </tr>
     <tr>
         <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Title</font></td>
         <td align="left"  valign="middle"><input type="text" name="f_title" value="" . $arr['titolo'] . "" size="30" align="absmiddle"></td>
     </tr>
     <tr>
         <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">ID Card</font></td>
         <td align="left"  valign="middle"><input type="text" name="f_id_card" value="" . $arr['carta_identita'] . "" size="30" align="absmiddle"></td>
     </tr>
     <tr>
         <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">ID Card (City)</font></td>
         <td align="left"  valign="middle"><input type="text" name="f_id_card_city" value="" . $arr['comune_carta'] . "" size="30" align="absmiddle"></td>
     </tr>
     <tr>
         <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Phone number</font></td>
         <td align="left"  valign="middle"><input type="text" name="f_phone" value="" . $arr['telefono'] . "" size="30" align="absmiddle"></td>
     </tr>
     <tr>
         <td>&nbsp;</td>
         <td>
             <input type="hidden" name="oid" value="" . $arr['oid'] . "">
             <input type="submit" name="submit" value="Insert">&nbsp;<input type="reset" name="reset" value="Reset values">
         </td>
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
     Work in progress.<br>
     </div>
     </font>
 </td>
</tr>
</table>

</font>

</body>
</html>