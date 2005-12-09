<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Books</title>
    <link rel="stylesheet" href="../../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">


<? print_navigation('Insert a new book','Home Page','../contents.php','Books','../books_index.php'); ?>
<? print_title('Insert a new book'); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        Please insert book information then press <b>Insert</b> button:<br>
        <form action="books_insert_commit.php">
        <table cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Title (Info)</font></td>
            <td align="left"  valign="middle"><input type="text" name="f_title" size="30" align="absmiddle">&nbsp;(&nbsp;<input type="text" name="f_info" size="15" align="absmiddle">&nbsp;)</td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Author nr. 1</font></td>
            <td align="left"  valign="middle"><input type="text" name="f_auth1" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">nr. 2</font></td>
            <td align="left"  valign="middle"><input type="text" name="f_auth2" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">nr. 3</font></td>
            <td align="left"  valign="middle"><input type="text" name="f_auth3" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">nr. 4</font></td>
            <td align="left"  valign="middle"><input type="text" name="f_auth4" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">nr. 5</font></td>
            <td align="left"  valign="middle"><input type="text" name="f_auth5" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">nr. 6</font></td>
            <td align="left"  valign="middle"><input type="text" name="f_auth6" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">nr. 7</font></td>
            <td align="left"  valign="middle"><input type="text" name="f_auth7" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Editor</font></td>
            <td align="left"  valign="middle"><input type="text" name="f_editor" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Inventory code</font></td>
            <td align="left"  valign="middle"><input type="text" name="f_inventory" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Collocation</font></td>
            <td align="left"  valign="middle"><input type="text" name="f_collocation" maxlength="1" size="11" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Shelf&nbsp;/&nbsp;Number</font></td>
            <td>
                <input type="text" name="f_shelf"  maxlength="1" size="3" align="absmiddle">&nbsp;/&nbsp;
                <input type="text" name="f_number" maxlength="3" size="5" align="absmiddle">
            </td>
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
        Enter title, author(s) and other informations about the book into appropriate box.<br>
        <br>
        Once you've inputted your data, hit the <i>Input</i> button to commit work.<br>
        <br>
        Please note: it is not necessary to fill in <i>every</i> box to be able
        to insert a book, but title and an unique shelf/number are mandatory.
        </div>
        </font>
    </td>
</tr>
</table>

</font>

</body>
</html>