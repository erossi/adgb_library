<!-- Library version 0.9, Copyright (C) 2000 TecnoBrain
     Library comes with ABSOLUTELY NO WARRANTY; This is free software,
     and you are welcome to redistribute it under GNU Public Licence Terms.
     Please read the file COPYING shipped with this distribution. -->

<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<? print_navigation('Check drawn books','Home Page','../../contents.php','Books','../books_index.php'); ?>
<? print_title('Check drawn books'); ?>

<?
    // controllo i parametri
    // ..non ce ne sono
    
    // where..
    // NON C'E' MA E' STATA LASCIATA IN PREVISIONE DI MODIFCHE
    $where_clause="";

    // order by...
    if ($f_order) { $order=$f_order; }
    switch ($order) {
        case "t": $order_clause=" ORDER BY titolo"; break;
        case "c": $order_clause=" ORDER BY l.collocazione,l.scaffale,l.numero"; break;
        default: $order_clause="";
    }

    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);    

    // leggo i "buchi" di numerazione
    $query="SELECT max(numero) AS massimo FROM libri";
    $result = db_execute($conn,$query);
    $arr=pg_fetch_array ($result,0);
    $massimo=$arr['massimo'];
    if ($DEBUG) { print '<b>Massimo: ' . $massimo . '</b><br>'; }
    
    $query="CREATE TEMPORARY TABLE sequenza ( num integer )";
    $result = db_execute($conn,$query);

    for ($count=1; $count<=$massimo; $count++)
    {
      $query="INSERT INTO sequenza VALUES(" . $count . ")";
      $result = db_execute($conn,$query);
    }
    
    // 
    print '<div align="center">';
    print '<table cellspacing="1" cellpadding="3" border="0" width="90%">';
    print '<tr bgcolor="#336699">';
    print '    <td width="10%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Shelf</font></td>';
    print '    <td width="90%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Missing
    numbers</font></td>';
    print '</tr>';
    for ($count_letter=0; $count_letter<=25; $count_letter++) {
    
        $shelf=chr(65+$count_letter);
        
        $query="SELECT s.num AS numero " .
               "FROM sequenza AS s " .
               "WHERE NOT EXISTS(SELECT * FROM libri AS e WHERE e.collocazione='B' AND e.scaffale='" . strtoupper($shelf) . "' AND e.numero=s.num) " .
               " AND s.num < (SELECT max(numero) FROM libri AS l WHERE l.collocazione='B' AND l.scaffale='" . strtoupper($shelf) . "')" .
               "ORDER BY num";
        if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
        $result = db_execute($conn,$query);

        // conto il numero di righe
        $num_rows=pg_numrows($result);
        if ($DEBUG) { print 'Numbers of rows in table: <b>' . $num_rows . '</b><br>'; };    

        //
        if (($count_letter % 2) == 0) {
            print '<tr bgcolor="#e0e0e0">';
        } else {
            print '<tr bgcolor="white">';
        };
        print '    <td width="10%">';
        print '    ' . strtoupper($shelf);
        print '    </td>';
        print '    <td width="90%">';

        if ($num_rows=='0') {
            print 'No missing numbers in shelf <b>' . $shelf . '</b>.';
        } else {

            for ($count=0; $count<$num_rows; $count++)
            {
                $arr=pg_fetch_array($result,$count);
                print $arr['numero'];
                if ($count<$num_rows-1) {
                    print (', ');
                }
            };
        }
        print '    </td>';
        print '</tr>';            
    }
    print '</table>';
    //
    $query="DROP TABLE sequenza";
    $result = db_execute($conn,$query);

    // chiudo la connessione
    db_close($conn);
?>
f
</font>

</body>
</html>
