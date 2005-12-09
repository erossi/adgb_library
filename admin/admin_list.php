<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<? print_navigation('Administrators list','Home Page','../contents.php','Administrators section','admin_index.php'); ?>
<? print_title('Administrators list'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);
    
    // stampo il risultato
    $query="SELECT * FROM password";
    $result = db_execute($conn,$query);
   
    // conto il numero di righe
    $num_rows=pg_numrows($result);
    if ($DEBUG) { print 'Numbers of rows in table: <b>' . $num_rows . '</b><br>'; };
    
    print '<div align="center">';
    print '<table cellspacing="1" cellpadding="3" border="0" width="90%">';
    print '<tr bgcolor="#336699">';
    print '    <td width="5%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Num.</font></td>';
    print '    <td><font face="arial,helvetica,sans-serif" size="2" style="color: white">Username</font></td>';
    print '    <td><font face="arial,helvetica,sans-serif" size="2" style="color: white">Password</font></td>';
    print '    <td><font face="arial,helvetica,sans-serif" size="2" style="color: white">Area</font></td>';
    for ($count=0; $count<$num_rows; $count++)
    {
        $arr=pg_fetch_array ($result, $count);
        if (($count % 2) == 0) {
            print '<tr bgcolor="#e0e0e0">';
        } else {
            print '<tr bgcolor="white">';
        };
        print '<td valign="top"><font face="arial,helvetica,sans-serif" size="2">' . $count . '</font></td>';
        print '<td valign="top"><font face="arial,helvetica,sans-serif" size="2">' . $arr['username'] . '</font></td>';
        print '<td valign="top"><font face="arial,helvetica,sans-serif" size="2">' . $arr['password'] . '</font></td>';
        print '<td valign="top"><font face="arial,helvetica,sans-serif" size="2">' . $arr['area'] . '</font></td>';
        print '</tr>';
    };
    print '</table>';
    print '</div>';

    // chiudo la connessione
    db_close($conn);
?>
</div>

</font>

</body>
</html>