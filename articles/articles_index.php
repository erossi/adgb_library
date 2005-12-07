<?php if (file_exists('../default.php')) { include '../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><?php print $prog_name; ?> - Articles</title>
    <link rel="stylesheet" href="../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<!-- header -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td align="left">
    <font face="arial,helvetica,sans-serif" size="2">
    &nbsp;Navigate: <a href="../contents.php" target="contents">Home page</a> : Articles
    </font>
    </td>
</tr>
</table>

<!-- title -->
<center><h2>Articles</h2></center>

<form action="articles_list.php">
<ul>
    <li>To search for an article insert words to search then press "Article list":<br><br>
        <input type="text" name="string1" size="10">
        <select name="op1" size="1">
            <option value="and" selected>and</option>
	        <option value="or">or</option>
        </select><br>
        <input type="text" name="string2" size="10">
        <select name="op2" size="1">
            <option value="and">and</option>
	        <option value="or">or</option>
        </select><br>
        <input type="text" name="string3" size="10">
        <input type="submit" value="Article list">
</ul>
</form>
<ul>
    <li><a href="secure/articles_insert.php">Insert a new article</a><img src="../icone/ico_protected.gif" width="45" height="15" border="0" hspace="5" alt="This link is password protected" align="absmiddle">
</ul>

</body>
</html>