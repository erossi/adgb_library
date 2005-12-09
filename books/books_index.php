<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Books</title>
    <link rel="stylesheet" href="../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<? print_navigation('Books','Home Page','../contents.php'); ?>
<? print_title('Books'); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        Please insert information to search for then press <b>Search</b> button:<br>
        <form action="books_list.php">
        <table cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Title</font></td>
            <td><input type="text" name="f_title" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Authors</font></td>
            <td>
                <input type="text" name="f_auth1" size="30" align="absmiddle"><br>
                <input type="text" name="f_auth2" size="30" align="absmiddle"><br>
                <input type="text" name="f_auth3" size="30" align="absmiddle"><br>
            </td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Editor</font></td>
            <td><input type="text" name="f_editor" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Collocation</font></td>
            <td><!--input type="text" name="f_collocation" size="11" align="absmiddle"-->
                <select name="f_collocation" size="1">
    	    	    <option value="A">A - Armadio</option>
    	    	    <option value="B" selected>B - Biblioteca</option>
                </select><br>
	    </td>
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
            <td>
                <input type="submit" name="submit" value="Search">
                <select name="f_logical_op" size="1">
    	    	    <option value="AND">All the words listed</option>
    	    	    <option value="OR">Any of the words listed</option>
                </select><br>
                <br>
                <input type="radio" name="f_order" value="c" checked>Sorted by collocation<br>
                <input type="radio" name="f_order" value="t">Sorted by title<br>
                <input type="radio" name="f_order" value="u">Unsorted<br>
            </td>
        </tr>
        </table>
        </form>
        <form action="secure/books_insert.php">
            <input type="submit" value="Insert a new book">
        </form>
        <form action="secure/books_check_drawn.php">
            <input type="hidden" name="f_order" value="c">
            <input type="submit" value="Check drawn">
        </form>
        <a href="javascript:history.back(1)">Back</a> to previous screen.
        </font>
    </td>
    <td align="justify" valign="top" width="30%" bgcolor="#ffffe0">
        <font face="arial,helvetica,sans-serif" size="2">
        <div align="justify">
        <b>On-line Help</b><br>
        <br>
        Enter title, author(s) and editing firm of the book you require into their box.<br>
        <br>
        Before pressing the <i>Search</i> button select <i>Any of the words listed</i>
        if you want an AND among the voices inserted or <i>All the words listed</i>
        if you want an OR search.<br>
        <br>
        Once you've inputted your data, hit the <i>Search </i> button to begin the search.<br>
        <br>
        Bear in mind: it is not necessary to fill in <i>every</i> box to be able
        to perform a book search. You may enter as much information as you want. Naturally,
        if you only enter e.g. an author, the search results will be all the books by that
        author contained in the Library.
        </div>
        </font>
    </td>
</tr>
</table>

</font>

</body>
</html>
