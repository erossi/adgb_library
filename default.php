<!-- Library version 0.5, Copyright (C) 2000 TecnoBrain
     Library comes with ABSOLUTELY NO WARRANTY; This is free software,
     and you are welcome to redistribute it under GNU Public Licence Terms.
     Please read the file COPYING shipped with this distribution. -->

<?
    // inforazioni riguardanti la gestione web
    $prog_name = "Library";
    $prog_version = "0.5";
    
    // debug
    $DEBUG = false;

    // variabili usate per la connessione al database della lamda
    $db_host = "localhost";
    $db_port = "5432";
    $db_name = "biblioteca";
    $db_user = "www-data";
    
    // numero massimo di righe per ogni tabella stampata
    // (in pratica ogni tabella viene raggruppata in sottotabelle con tante righe
    // quante sono indicate sotto).
    $max_table_rows = 50;
?>
