<? if (file_exists('default.php')) { include 'default.php'; } ?>
<? if (file_exists('procedure/utility.php')) { include 'procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name; ?></title>
    <link rel="stylesheet" href="library.css">
</head>
<body text="black" bgcolor="white" link="white" alink="white" vlink="white">

<? print_top($prog_name); ?>
<? print_navigation('Home Page'); ?>
<? print_title('Welcome to ' . $prog_name . " Version " . $prog_version); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        Please select an option below:<br>
        <table cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="center" valign="bottom"><a href="books/books_index.php"><img src="icone/main-books.png" width="48" height="48" border="0" alt="Books"></a></td>
            <td align="center" valign="bottom"><a href="journals/journals_index.php"><img src="icone/main-journals.png" width="48" height="48" border="0" alt="Journals"></a></td>
            <td align="center" valign="bottom"><a href="articles/articles_index.php"><img src="icone/main-articles.png" width="48" height="48" border="0" alt="Articles"></a></td>
            <td align="center" valign="bottom"><a href="users/users_index.php"><img src="icone/main-users.png" width="48" height="48" border="0" alt="Users"></a></td>
            <td align="center" valign="bottom"><a href="admin/admin_index.php"><img src="icone/main-admin.png" width="48" height="48" border="0" alt="Administrators section"></a></td>
        </tr>
        <tr>
            <td align="center" valign="top">
                <font face="arial,helvetica,sans-serif" size="2">
                <a href="books/books_index.php">Books</a>
                </font>
            </td>
            <td align="center" width="20%">
                <font face="arial,helvetica,sans-serif" size="2">
                <a href="journals/journals_index.php">Journals</a>
                </font>
            </td>
            <td align="center" width="20%">
                <font face="arial,helvetica,sans-serif" size="2">
                <a href="articles/articles_index.php">Articles</a>
                </font>
            </td>
            <td align="center" width="20%">
                <font face="arial,helvetica,sans-serif" size="2">
                <a href="users/users_index.php">Users</a>
                </font>
            </td>
            <td align="center" width="20%">
                <font face="arial,helvetica,sans-serif" size="2">
                <a href="admin/admin_index.php">Administrators section</a>
                </font>
            </td>
        </tr>
        </table>
        </font>
    </td>
    <td align="justify" valign="top" width="30%" bgcolor="#ffffe0">
        <font face="arial,helvetica,sans-serif" size="2">
        <div align="justify">
        <b>On-line Help</b><br>
        <br>
        This is free software, and you are welcome to redistribute it
        under the <a href="COPYING">Gnu Public License</a> terms.<br> 
        </div>
        </font>
    </td>
</tr>
</table>

<div align="center">
<br>
<br>
<br>
This software use <a href="http://www.gnome.org" target="_top">GNOME<img src="icone/logo-gnome.gif" width="48" height="48" border="0" hspace="5" alt="The GNOME Project" align="absmiddle"></a> icons.
</div>

</body>
</html>