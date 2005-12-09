<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Articles</title>
    <link rel="stylesheet" href="../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<? print_top($prog_name); ?>
<? print_navigation('Articles','Home Page','../contents.php'); ?>
<? print_title('Articles'); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        To search for an article insert words to search then press <b>Article list</b> button:<br><br>
        <form action="articles_list.php">        
        <table cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Search strings</font></td>
            <td>
                <input type="text" name="string1" size="30" align="absmiddle">
                <select name="op1" size="1">
                    <option value="and" selected>And</option>
	                <option value="or">Or</option>
                </select><br>
                <input type="text" name="string2" size="30" align="absmiddle">
                <select name="op2" size="1">
                    <option value="and">And</option>
	                <option value="or">Or</option>
                </select><br>
                <input type="text" name="string3" size="30" align="absmiddle">
                <input type="submit" value="Article list">
            </td>
        </tr>
        </table>
        </font>
        </form>
        <form action="secure/articles_insert.php">
            <input type="submit" name="submit" value="Insert a new article" width="50%">
        </form>
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