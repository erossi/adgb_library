<? if (file_exists('default.php')) { include 'default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name; ?></title>
</head>

<frameset rows="25,*,25" border="0" frameborder="0" framespacing="0">
    <frame name="top"      src="top.php"      marginwidth="0" marginheight="0" scrolling="no"   frameborder="0" noresize>
    <frame name="contents" src="contents.php" marginwidth="0" marginheight="0" scrolling="auto" frameborder="0">
    <frame name="bottom"   src="bottom.php"   marginwidth="0" marginheight="0" scrolling="no"   frameborder="0" noresize>
</frameset>

</html>