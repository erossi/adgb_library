<?php if (file_exists('../default.php')) { include '../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><?php print $prog_name; ?> - Books</title>
    <link rel="stylesheet" href="../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<!-- header -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td align="left">
    <font face="arial,helvetica,sans-serif" size="2">
    &nbsp;Navigate: <a href="../contents.php" target="contents">Home page</a> : Books
    </font>
    </td>
</tr>
</table>

<!-- title -->
<center><h2>Books</h2></center>

<ul>
    <li>Insert information to search for then press "Search" button:<br>
        <form action="books_list.php">
        <table cellspacing="1" cellpadding="2" border="0">
        <tr>
            <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Title</font></td>
            <td><input type="text" name="title" size="30" align="absmiddle">&nbsp;(&nbsp;<input type="text" name="info" size="15" align="absmiddle">&nbsp;)</td>
        </tr>
        <tr>
            <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Authors</font></td>
            <td><input type="text" name="aut1" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2"></font></td>
            <td><input type="text" name="aut2" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2"></font></td>
            <td><input type="text" name="aut3" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Editor</font></td>
            <td><input type="text" name="editor" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Shelf / Number</font></td>
            <td><input type="text" name="shelf" size="3" maxlength="1" align="absmiddle">&nbsp;/&nbsp;<input type="text" name="number" size="5" maxlength="3" align="absmiddle"></td>
        </tr>
        <tr>
            <td>&nbsp</td>
            <td><input type="submit" name="submit" value="Search">
            <select name="logical_op" size="1">
    	    	<option value="OR">Any of the words listed</option>
	    	    <option value="AND">All the words listed</option>
            </select>
            </td>
        </tr>
        </table>
        </form>
    <li><a href="secure/books_insert.php">Insert a new book</a>
    (<img src="../icone/ico_protected.gif" width="45" height="15" border="0" hspace="5" vspace="2" alt="This link is password protected" align="absmiddle">Only for trusted users&nbsp;)
    <li><a href="#" target="contents" onclick="javascript:window.open('../help/node_book_1.html','ne','scrollbars=1,location=0,menubar=0,toolbar=0,resizable=0,width=400,height=500')">Help on line</a>
</ul>
</form>

</body>
</html>