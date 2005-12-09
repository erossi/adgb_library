<?
    // File: utility
    // contiene una serie di funzioni di utilità generale

    // stampa un messaggiop di errore
    function print_error($message) {
        print '<br>';
        print '<div align="center">';
        print '<table width="60%" cellspacing="0" cellpadding="0" border="1">';
        print '<tr>';
        print '    <td align="left" valign="middle" bgcolor="red">';
        print '    <font face="arial,helvetica,sans-serif" size="2" color="yellow">';
        print $message;
        print '    </font>';
        print '    </td>';
        print '</tr>';
        print '</table>';
        print '</div>';
        return;
    }
    
    // stampa la navigation bar delle pagine
    function print_navigation($title,$first='',$first_link='',$second='',$second_link='',$third='',$third_link='') {
        print '<div align="center">';
        print '<table width="90%" cellspacing="1" cellpadding="3" border="0">';
        print '<tr>';
        print '    <td align="right" valign="middle" bgcolor="#e0e0e0" width="10%">';
        print '    <font face="arial,helvetica,sans-serif" size="2">';
        print '    Navigate';
        print '    </font>';
        print '    </td>';
        print '    <td align="left" valign="middle">';
        print '    <font face="arial,helvetica,sans-serif" size="2">';
        if ($first_link <> '') { print '&nbsp;:&nbsp;<a href="' . $first_link . '">' . ($first == '' ? 'NULL' : $first) . '</a>'; }
        if ($second_link <> '') { print '&nbsp;:&nbsp;<a href="' . $second_link . '">' . ($second == '' ? 'NULL' : $second) . '</a>'; }
        if ($third_link <> '') { print '&nbsp;:&nbsp;<a href="' . $third_link . '">' . ($third == '' ? 'NULL' : $third) . '</a>'; }
        if ($title <> '') { print '&nbsp;:&nbsp;' . $title; }
        print '    </font>';
        print '    </td>';
        print '</tr>';
        print '</table>';
        print '</div>';
        return;
    };
    
    // stampa il titolo
    function print_title($title) {
        print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
        print '<tr>';
        print '<td align="center" valign="middle" width="70%" bgcolor="#336699" colspan="2">';
        print '    <font face="arial,helvetica,sans-serif" size="2" color="white">';
        print $title;
        print '    </font>';
        print '    </td>';
        print '</tr>';
        print '</table>';
    };

    // stampa il titolo
    function print_top($title) {
        print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
        print '<tr>';
        print '<td align="right" valign="middle" width="70%" bgcolor="white" colspan="2">';
        print '    <font face="arial,helvetica,sans-serif" size="2" color="black">';
        echo $title . "&nbsp;-&nbsp;Powered by Tecnobrain\n";
        print '    </font>';
        print '    </td>';
        print '</tr>';
        print '</table>';
    };
    
    // connessione al database
    function db_connect($host='',$port='',$name='',$user='') {
        $connection_string = '';
        if ($host != '') { $connection_string = 'host=' . $host; }
        if ($port != '') { $connection_string = $connection_string . ' port=' . $port; }
        if ($name != '') { $connection_string = $connection_string . ' dbname=' . $name; }
        if ($user != '') { $connection_string = $connection_string . ' user=' . $user; }
        $connection = pg_connect($connection_string);
        if (!$connection) {
           print_error('Function db_connect error: cannot connect to database.<br>' .
                      'Connection string is: <b>' . $connection_string . '</b><br>'); 
            exit;
        }
        return $connection;
    }

    //esegue una query
    function db_execute($connection,$query_string) {
        $query_result = pg_exec ($connection,$query_string);
        if (!$query_result) {
            print_error('File db_execute error: cannot execute query.<br>' .
                       'Query string is: <b>' . $query_string . '</b><br>'); 
            return;
        }
        return $query_result;
    }

    // connessione al database
    function db_close($conn) {
        pg_close ($conn);
        return;
    }
?>
