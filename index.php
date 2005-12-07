<?php if (file_exists('default.php')) { include 'default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
    <TITLE><?php print $prog_name; ?></TITLE>
</HEAD>

<FRAMESET ROWS="25,*,25" BORDER="0" FRAMEBORDER="0" FRAMESPACING="0">
    <FRAME NAME="top"      SRC="top.php"      MARGINWIDTH="0" MARGINHEIGHT="0" SCROLLING="no"   FRAMEBORDER="0" NORESIZE>
    <FRAME NAME="contents" SRC="contents.php" MARGINWIDTH="0" MARGINHEIGHT="0" SCROLLING="auto" FRAMEBORDER="0">
    <FRAME NAME="bottom"   SRC="bottom.php"   MARGINWIDTH="0" MARGINHEIGHT="0" SCROLLING="no"   FRAMEBORDER="0" NORESIZE>
</FRAMESET>

</HTML>