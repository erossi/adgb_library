<?php if (file_exists('../default.php')) { include '../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><?php print $prog_name; ?> - Books</title>
    <link rel="stylesheet" href="../../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<!-- header -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td align="left">
    <font face="arial,helvetica,sans-serif" size="2">
    &nbsp;Navigate: <a href="../../contents.php" target="contents">Home page</a> : <a href="../books_index.php" target="contents">Books</a> : Book insert
    </font>
    </td>
</tr>
</table>

<!-- title -->
<center><h2>Book insert</h2></center>
<ul>
<li>Insert values then press "Insert":
    <form action="books_insert_commit.php">
    <table cellspacing="2" cellpadding="2" border="0">
    <tr>
        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Title</font></td>
        <td align="left"  valign="middle"><input type="text" name="titolo" size="30" align="absmiddle">&nbsp;(&nbsp;<input type="text" name="info" size="15" align="absmiddle">&nbsp;)</td>
    </tr>
    <tr>
        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Author nr. 1</font></td>
        <td align="left"  valign="middle"><input type="text" name="aut1" size="30" align="absmiddle"></td>
    </tr>
    <tr>
        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">nr. 2</font></td>
        <td align="left"  valign="middle"><input type="text" name="aut2" size="30" align="absmiddle"></td>
    </tr>
    <tr>
        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">nr. 3</font></td>
        <td align="left"  valign="middle"><input type="text" name="aut3" size="30" align="absmiddle"></td>
    </tr>
    <tr>
        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">nr. 4</font></td>
        <td align="left"  valign="middle"><input type="text" name="aut4" size="30" align="absmiddle"></td>
    </tr>
    <tr>
        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">nr. 5</font></td>
        <td align="left"  valign="middle"><input type="text" name="aut5" size="30" align="absmiddle"></td>
    </tr>
    <tr>
        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">nr. 6</font></td>
        <td align="left"  valign="middle"><input type="text" name="aut6" size="30" align="absmiddle"></td>
    </tr>
    <tr>
        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">nr. 7</font></td>
        <td align="left"  valign="middle"><input type="text" name="aut7" size="30" align="absmiddle"></td>
    </tr>
    <tr>
        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Editor</font></td>
        <td align="left"  valign="middle"><input type="text" name="editore" size="30" align="absmiddle"></td>
    </tr>
    <tr>
        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Inventory code</font></td>
        <td align="left"  valign="middle"><input type="text" name="codice_inventariale" size="30" align="absmiddle"></td>
    </tr>
    <tr>
        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Collocation</font></td>
        <td align="left"  valign="middle"><input type="text" name="collocazione" size="30" align="absmiddle"></td>
    </tr>
    <tr>
        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Shelf&nbsp;/&nbsp;Number</font></td>
        <td align="left"  valign="middle"><input type="text" name="scaffale" size="3" maxlength="1" align="absmiddle">&nbsp;/&nbsp;<input type="text" name="numero" size="5" maxlength="3" align="absmiddle"></td>
    </tr>
    <tr>
        <td>&nbsp</td>
        <td><input type="submit" name="submit" value="Insert">&nbsp;<input type="reset" name="reset" value="Reset values"></td>
    </tr>
    </table>
    </form>
</ul>

</font>

</body>
</html>