<?php

//------------------------- charset ----------------------------

$default_charset = "iso-8859-1";

//--------------------- default phrases ------------------------

$default_phrases['reload'] = "Neu laden";
$default_phrases['generation time'] = "Generierungszeit:";
$default_phrases['button send'] = "Senden";
$default_phrases['button reset'] = "Zur&uuml;cksetzen";
$default_phrases['error'] = "Fehler";
$default_phrases['col'] = "Spalte";

//--------------------- Base dir files ------------------------

//index.php
$language['index.php']['title'] = "Hauptseite";
$language['index.php']['please install mysql admin'] = "Bitte installieren Sie MySQL-Admin erst.";
$language['index.php']['go on to the install page'] = "Weiter zur Installation..";
$language['index.php']['please delete the install file'] = "Bitte löschen Sie den Ordner \"./install\", da er ein Sicherheitsrisiko darstellt.";
$language['index.php']['upload file and reinstall'] = "Laden Sie bitte den Ordner \"./install\" erneut auf den Server und installieren Sie MySQL-Admin anschließend neu.";

//Left.php
$language['left.php']['title'] = "Datenbank&uuml;bersicht";
$language['left.php']['delete table'] = "Tabelle löschen";
$language['left.php']['clear table'] = "Tabelle leeren";
$language['left.php']['table operations'] = "Tabellenoperationen";
$language['left.php']['overview'] = "&Uuml;bersicht";
$language['left.php']['cols'] = "Spalten";
$language['left.php']['import,export'] = "Import und Export";
$language['left.php']['add table'] = "Tabelle erstellen";
$language['left.php']['sql query'] = "SQL Anfrage";
$language['left.php']['status'] = "Status anzeigen";
$language['left.php']['server status'] = "Server Information";
$language['left.php']['database overview'] = "Datenbankübersicht";
$language['left.php']['create database'] = "Datenbank erstellen";
$language['left.php']['delete database'] = "Datenbank löschen";
$language['left.php']['databases'] = "Datenbanken";
$language['left.php']['really delete table'] = 'Tabelle "+ Tab + " wirklich löschen';
$language['left.php']['really delete database'] = 'Wollen sie die Datenbank wirklich löschen?';
$language['left.php']['really clear table'] = 'Tabelle "+ Tab + " wirklich leeren';
$language['left.php']['log out'] = "Abmelden";

//tableData.php
$language['tableData.php']['title'] = "Tabellen&uuml;bersicht";
$language['tableData.php']['delete ds'] = "Diesen Beitrag wirklich löschen?";
$language['tableData.php']['overview over table'] = "&Uuml;bersicht &uuml;ber Tabelle";
$language['tableData.php']['extended overview'] = "Erweiterte Abfrageeigenschaften";
$language['tableData.php']['extended overview hide'] = "Erweiterte Abfrageeigenschaften verbergen";
$language['tableData.php']['basic sorting'] = "Standard Sortierung";
$language['tableData.php']['order by'] = "Sortieren nach:";
$language['tableData.php']['normal site selection'] = "Normale Seitenauswahl";
$language['tableData.php']['max data sets'] = "Maximale Eintr&auml;ge pro Seite";
$language['tableData.php']['data sets from'] = "Datensätze von";
$language['tableData.php']['data sets to'] = "bis";
$language['tableData.php']['cols'] = "Ausgew&auml;hlte Spalten";
$language['tableData.php']['hide export settings'] = "Exporteinstellungen verbergen";
$language['tableData.php']['export settings'] = "Exporteinstellungen";
$language['tableData.php']['export shown data sets'] = "Angezeigte Datens&auml;tze exportieren";
$language['tableData.php']['all settings will be hold'] = "Alle Einstellungen (Sortierung, Spalten) werden beim Export beibehalten.";
$language['tableData.php']['col names in first line'] = "Spaltennamen in der ersten Zeile";
$language['tableData.php']['insert data set'] = "Datensatz einf&uuml;gen";
$language['tableData.php']['site'] = "Seite: ";
$language['tableData.php']['ASC'] = "aufsteigend";
$language['tableData.php']['DESC'] = "absteigend";
$language['tableData.php']['show'] = "Anzeigen";
$language['tableData.php']['download'] = "Downloaden";
$language['tableData.php']['print'] = "Aktuelle Ansicht drucken (optimierte Ansicht)";
$language['tableData.php']['no datasets found'] = "Es wurden keine Datensätze gefunden";

//tableStructure.php
$language['tableStructure.php']['title'] = "Tabellenstruktur";
$language['tableStructure.php']['col name'] = "Name:";
$language['tableStructure.php']['type'] = "Typ:";
$language['tableStructure.php']['is null'] = "Null:";
$language['tableStructure.php']['extra'] = "Extra:";
$language['tableStructure.php']['default val'] = "Standardwert:";
$language['tableStructure.php']['length'] = "Länge: ";
$language['tableStructure.php']['attribute'] = "Attribut:";
$language['tableStructure.php']['yes'] = "Ja";
$language['tableStructure.php']['no'] = "Nein";
$language['tableStructure.php']['headline'] = "Spalten&uuml;bersicht der Tabelle ";
$language['tableStructure.php']['add new col'] = "Neue Spalte einf&uuml;gen";
$language['tableStructure.php']['delete col'] = 'Wollen sie die Spalte \"%s\" wirklich löschen?'; //To JS
$language['tableStructure.php']['delete key'] = 'Wollen sie den Schlüssel \"%s\" wirklich löschen?'; //To JS
$language['tableStructure.php']['add new key'] = "Neuen Schl&uuml;ssel einf&uuml;gen";
$language['tableStructure.php']['key name'] = 'Schl&uuml;sselname:'; 
$language['tableStructure.php']['key type'] = 'Schl&uuml;sseltyp:'; 
$language['tableStructure.php']['col names'] = 'Spaltennamen:'; 

//startpage.php
$language['startpage.php']['title'] = "Anmelden";
$language['startpage.php']['acquire network connection'] = "<b>Stelle Verbindung zum Server her.</b><br /><font size=2>Bitte schalten sie ihre(n) Popupblocker ab, wenn dieser Vorgang zu lange dauert.</font>";
$language['startpage.php']['log on to'] = "Anmelden";
$language['startpage.php']['mysql server'] = "MySQL-Server";
$language['startpage.php']['shared used db'] = "Gemeinsam genutzte Datenbank";
$language['startpage.php']['username'] = "Benutzername:";
$language['startpage.php']['password'] = "Passwort:";
$language['startpage.php']['server address'] = "Server:";
$language['startpage.php']['database'] = "Datenbank*:";
$language['startpage.php']['security settings'] = "Sicherheitseinstellungen";
$language['startpage.php']['remember username, server, db'] = "Benutzername, Server und Datenbank hier wieder anzeigen";
$language['startpage.php']['activate cookies'] = "Cookies aktivieren";
$language['startpage.php']['IP blocker'] = "IP Sperre";
$language['startpage.php']['session timeout'] = "Zeitliche Begrenzung auf";
$language['startpage.php']['minutes'] = "Minuten";
$language['startpage.php']['notice for connection'] = "<font size=2><i>* Hinweis: </i><br />Sie können dieses Feld auch leer lassen, um sich alle Datenbanken anzeigen zu lassen</font>";
$language['startpage.php']['language'] = "Sprache: ";
$language['startpage.php']['design'] = "Design: ";
$language['startpage.php']['design and language'] = "Sprache und Aussehen: ";
$language['startpage.php']['connectiontype'] = "Verbindungstyp: ";
$language['startpage.php']['connection to server failed'] = "Verbindung zu Server fehlgeschlagen.";
$language['startpage.php']['failed to select database'] = "Fehler beim Auswählen der Datenbank.";
$language['startpage.php']['connection error'] = "Verbindungsfehler:";

//logout.php
$language['logout.php']['title'] = "Logout";

//men.php
$language['men.php']['title'] = "Server Login";
$language['men.php']['server login'] = "Server Login";

//----------------------- Pages --------------------------

//pages/loaded.php
$language['pages/loaded.php']['title'] = "Verbunden";
$language['pages/loaded.php']['connected'] = "Verbindung hergestellt";
$language['pages/loaded.php']['choose table in left menu'] = "Sie können nun im Men&uuml; links die zu bearbeitende Tabelle oder Datenbank ausw&auml;hlen.";

//pages/blank.php
$language['pages/blank.php']['title'] = "";

//--------------------- Functions ------------------------

//functions/delete.php
$language['functions/delete.php']['title'] = "Datensatz löschen";
$language['functions/delete.php']['dataset deleted'] = "Datensatz erfolgreich gelöscht";

//functions/editContent.php
$language['functions/editContent.php']['title'] = "Datensatz bearbeiten";
$language['functions/editContent.php']['edit dataset of table'] = "Datensatz von Tabelle \"%s\" bearbeiten.";
$language['functions/editContent.php']['insert dataset in table'] = "Datensätze in Tabelle \"%s\" einfügen.";
$language['functions/editContent.php']['null'] = "Null";

//functions/newTable.php
$language['functions/newTable.php']['title'] = "Tabelle erstellen";
$language['functions/newTable.php']['create new table'] = "Neue Tabelle erstellen";
$language['functions/newTable.php']['tablename'] = "Tabellenname";
$language['functions/newTable.php']['no of cols'] = "Spaltenanzahl";

//functions/createDatabase.php
$language['functions/createDatabase.php']['title'] = "Datenbank erstellen";
$language['functions/createDatabase.php']['create new database'] = "Neue Datenbank erstellen";
$language['functions/createDatabase.php']['database name'] = "Datenbankname";
$language['functions/createDatabase.php']['collation'] = "Kollation";
$language['functions/createDatabase.php']['charset'] = "Zeichensatz";

//functions/deleteDatabase.php
$language['functions/deleteDatabase.php']['title'] = "Datenbank löschen";

//functions/doCreate.php
$language['functions/doCreate.php']['title'] = "Tabelle erstellen";
$language['functions/doCreate.php']['summary'] = "Zusammenfassung";
$language['functions/doCreate.php']['in query'] = "im Query";

//functions/delTab.php
$language['functions/delTab.php']['title'] = "Tabelle löschen";

//functions/deleteAll.php
$language['functions/deleteAll.php']['title'] = "Tabelle leeren";
$language['functions/deleteAll.php']['table cleared'] = "Tabelle erfolgreich geleert";

//functions/create.php
$language['functions/create.php']['title'] = "Tabelle erstellen";
$language['functions/create.php']['cols of table'] = "Spalten der Tabelle";
$language['functions/create.php']['col no'] = "Spalten Nr.";
$language['functions/create.php']['col name'] = "Name:";
$language['functions/create.php']['type'] = "Typ:";
$language['functions/create.php']['length'] = "Länge / Werte:";
$language['functions/create.php']['default value'] = "Standartwert:";
$language['functions/create.php']['primary key'] = "Primary key";
$language['functions/create.php']['unique'] = "Unique";
$language['functions/create.php']['index'] = "Index";
$language['functions/create.php']['nothing'] = "kein Schl&uuml;ssel";
$language['functions/create.php']['not null'] = "nicht Null";
$language['functions/create.php']['auto increment'] = "Auto Increment";
$language['functions/create.php']['create table'] = "Tabelle erstellen";
$language['functions/create.php']['notice'] = "Bei ENUM und SET Typen m&uuml;ssen die gew&uuml;nschten Werte im Feld 'Länge / Werte' eingegeben werden.<br />z.B. 'Enum1','Enum2'";

//functions/tableOperations.php
$language['functions/tableOperations.php']['title'] = "Tabellenoperationen";
$language['functions/tableOperations.php']['table operations'] = "Tabellenoperationen";
$language['functions/tableOperations.php']['rename table'] = "Tabelle umbenennen";
$language['functions/tableOperations.php']['to'] = "zu";
$language['functions/tableOperations.php']['auto increment value'] = "Auto Increment Wert ";
$language['functions/tableOperations.php']['set auto increment value to'] = "Auto Increment Wert: ";

//functions/editCol.php
$language['functions/editCol.php']['title'] = "Spalten bearbeiten / einfügen";
$language['functions/editCol.php']['insert col'] = "Spalte in Tabelle '%s' einfügen"; 
$language['functions/editCol.php']['edit col'] = "Spalte '%s' bearbeiten";
$language['functions/editCol.php']['settings'] = "Einstellungen: ";
$language['functions/editCol.php']['name'] = "Name: ";
$language['functions/editCol.php']['type'] = "Typ: ";
$language['functions/editCol.php']['length'] = "Länge / Werte: ";
$language['functions/editCol.php']['attribute'] = "Attribut: ";
$language['functions/editCol.php']['default value'] = "Standardwert: ";
$language['functions/editCol.php']['null'] = "Null: ";
$language['functions/editCol.php']['auto increment'] = "Auto Inkrement: ";
$language['functions/editCol.php']['position'] = "Position: ";
$language['functions/editCol.php']['position type'] = array('Vor', 'Nach');
$language['functions/editCol.php']['error'] = "Error: ";

//functions/deleteCol.php
$language['functions/deleteCol.php']['title'] = "Spalte löschen";
$language['functions/deleteCol.php']['col deleted'] = "Spalte erfolgreich gelöscht.";

//functions/deleteKey.php
$language['functions/deleteKey.php']['title'] = "Schl&uuml;ssel löschen";
$language['functions/deleteKey.php']['key deleted'] = "Schl&uuml;ssel erfolgreich gelöscht.";

//functions/editKey.php
$language['functions/editKey.php']['title'] = "Schl&uuml;ssel bearbeiten / einfügen";
$language['functions/editKey.php']['edit key'] = "Schl&uuml;ssel '%s' der Tabelle '%s' bearbeiten";
$language['functions/editKey.php']['insert key'] = "Schl&uuml;ssel in Tabelle '%s' einfügen";
$language['functions/editKey.php']['settings'] = "Einstellungen:";
$language['functions/editKey.php']['key name'] = "Name:";
$language['functions/editKey.php']['key type'] = "Typ:";
$language['functions/editKey.php']['col'] = "Spalte:";
$language['functions/editKey.php']['errors'] = "Fehler:";
$language['functions/editKey.php']['length'] = "Länge:";
$language['functions/editKey.php']['insert new col'] = "Neue Spalte einfügen";


//--------------------- Status ------------------------

//status/status.php
$language['status/status.php']['title'] = "Status";
$language['status/status.php']['mysql server status'] = "MySQL Status: ";
$language['status/status.php']['server'] = "Server: ";
$language['status/status.php']['connection type'] = "Verbindungstyp: ";
$language['status/status.php']['server version'] = "MySQL Server Version: ";
$language['status/status.php']['client version'] = "MySQL Client Version: ";
$language['status/status.php']['protocol'] = "Protokoll: ";
$language['status/status.php']['server runtime'] = "Server Laufzeit: ";
$language['status/status.php']['threads'] = "Threads: ";
$language['status/status.php']['queries'] = "Anfragen: ";
$language['status/status.php']['slow queries'] = "langsame Anfragen: ";
$language['status/status.php']['open files'] = "Geöffnete Dateien: ";
$language['status/status.php']['connections'] = "Verbindungen: ";
$language['status/status.php']['open tables'] = "Geöffnete Tabellen: ";
$language['status/status.php']['queries per secound'] = "Durchschnittliche Anfragen pro Sekunde";
$language['status/status.php']['processlist'] = "Prozessliste: ";
$language['status/status.php']['connection id'] = "Verbindungskennung";
$language['status/status.php']['user'] = "Benutzer";
$language['status/status.php']['server name'] = "Server";
$language['status/status.php']['database'] = "Datenbank";
$language['status/status.php']['command'] = "Kommando";
$language['status/status.php']['time'] = "Zeit";
$language['status/status.php']['status'] = "Status";
$language['status/status.php']['info'] = "Info";


//Status/serverStatus.php
$language['status/serverStatus.php']['title'] = "Server Information";
$language['status/serverStatus.php']['server information'] = "Server Information: ";
$language['status/serverStatus.php']['name'] = "Name:";
$language['status/serverStatus.php']['value'] = "Wert:";
$language['status/serverStatus.php']['variables'] = "Variablen: ";

//----------------------- IO --------------------------

//io/import-sql.php
$language['io/import-sql.php']['title'] = "Datei Import";
$language['io/import-sql.php']['progress'] = "Fortschritt:";
$language['io/import-sql.php']['done'] = "Fertig";
$language['io/import-sql.php']['summary'] = "Zusammenfassung: ";
$language['io/import-sql.php']['executed queries'] = "Ausgef&uuml;hrte Querys: ";
$language['io/import-sql.php']['error'] = "Fehler: ";
$language['io/import-sql.php']['time'] = "Zeit: ";
$language['io/import-sql.php']['seconds'] = " Sek.";

//io/import-export.php - this file includes import-sql-load.php, import-csv-load.php, export-sql-options, export-csv-options.php
$language['io/import-export.php']['title'] = "Import - Export";
$language['io/import-export.php']['import export options'] = "Import / Export Einstellungen";
$language['io/import-export.php']['sql file import'] = "SQL-Datei-Import";
$language['io/import-export.php']['sql export'] = "SQL-Export";
$language['io/import-export.php']['export settings'] = "Exporteinstellungen: ";
$language['io/import-export.php']['no create database'] = "Kein &quot;CREATE DATABASE&quot;";
$language['io/import-export.php']['no create table'] = "Kein &quot;CREATE TABLE&quot;";
$language['io/import-export.php']['no contents'] = "Keine Inhalte einf&uuml;gen";
$language['io/import-export.php']['show'] = "Anzeigen";
$language['io/import-export.php']['download'] = "Downloaden:";
$language['io/import-export.php']['go on'] = "Weiter";
$language['io/import-export.php']['filename'] = "Dateiname:";
$language['io/import-export.php']['csv export'] = "CSV-Export";
$language['io/import-export.php']['load csv files in the overview'] = "CSV-Dateien können in der &quot;&Uuml;bersicht&quot; exportiert werden.";
$language['io/import-export.php']['csv file import'] = "CSV-Datei-Import";
$language['io/import-export.php']['colname in first line'] = "Spaltennamen aus erster Zeile der CSV-Datei lesen";
$language['io/import-export.php']['select cols'] = "Spalten auswählen";
$language['io/import-export.php']['skip col'] = "Spalte &uuml;berspringen";
$language['io/import-export.php']['overwrite duplicate entries1'] = "Inhalte bei gleichem Wert im Feld ";
$language['io/import-export.php']['overwrite duplicate entries2'] = " &uuml;berschreiben.";
$language['io/import-export.php']['import'] = "Importieren";
$language['io/import-export.php']['mysqldump'] = "mysqldump";
$language['io/import-export.php']['mysql-admin dump'] = "MySQL-Admin Export";

//io/import-csv.php
$language['io/import-csv.php']['title'] = "CSV Import";
$language['io/import-csv.php']['csv import'] = "CSV-Import";
$language['io/import-csv.php']['summary'] = "Zusammenfassung";
$language['io/import-csv.php']['executed queries, with errors1'] = " ausgef&uuml;hrte Querys, davon ";
$language['io/import-csv.php']['executed queries, with errors2'] = " mit Fehler beendet.";

//io/export-sql.php
$language['io/export-sql.php']['title'] = "SQL Export";
$language['io/export-sql.php']['sql export'] = "MySQL Export";
$language['io/export-sql.php']['error'] = "<br /><b>Es ist ein Fehler aufgetreten.<b>";

//io/print.php
$language['io/print.php']['title'] = "Drucken";
$language['io/print.php']['table'] = "Tabelle";
$language['io/print.php']['no datasets found'] = "Es wurden keine Datensätze gefunden";


//--------------------- Query -------------------------

//query/query.php
$language['query/query.php']['title'] = "MySQL Query";
$language['query/query.php']['query results'] = "Query Ergebnisse:";
$language['query/query.php']['query'] = "Query:";
$language['query/query.php']['status'] = "Status:";
$language['query/query.php']['executed queries'] = "Ausgef&uuml;hrte Querys: ";
$language['query/query.php']['errors'] = "Fehler: ";
$language['query/query.php']['output'] = "Ausgabe:";
$language['query/query.php']['on data available'] = "Keine Daten zu diesem Query vorhanden";
$language['query/query.php']['edit query'] = "Query bearbeiten";


//--------------------- Library ------------------------

//lib/errors.php
$lib_errors['while executing query'] = "beim Ausf&uuml;hren der Anfrage:";
$lib_errors['error, no rows affected'] = "Fehler: Es wurden keine Datensätze bearbeitet";
$lib_errors['error'] = "Fehler:";
$lib_errors['no permission'] = "Sie sind zu dieser Handlung nicht berechtigt";
$lib_errors['in query'] = "in der Anfrage:";
$lib_errors['unauthorized access'] = "Unautorisierter Zugriff";
$lib_errors['log on new'] = "Bitte melden Sie sich bitte erneut an.";
$lib_errors['bad access violation'] = "Schwerwiegende Zugriffverletzung";
$lib_errors['session expired'] = "Die Sitzung ist abgelaufen.";
$lib_errors['loginerror'] = "Fehler bei der Anmeldung";
$lib_errors['wrong username or password'] = "Benutzername oder Passwort stimmen nicht";
$lib_errors['incomplete form'] = "Die von Ihnen gemachten Benutzereingaben sind unvollständig.";
$lib_errors['back'] = "Zur&uuml;ck";

//lib/querys.lib.php
$lib_errors['file not found'] = "Keine Datei f&uuml;r den Import gefunden";

//lib/sql.lib.php
$lib_errors['connection to mainserver failed'] = "Verbindung zum Server fehlgeschlagen";
$lib_errors['error while executing query'] = "Fehler beim Ausf&uuml;hren eines Querys";
$lib_errors['error choosing database'] = "Fehler beim Auswählen der Datenbank:";
$lib_errors['connection error'] = "Verbindungsfehler:"; 



//------------------ Installation ----------------------

//install/index.php
$language['install/index.php']['title'] = "Installation";
$language['install/index.php']['installation step'] = "Installation - Schritt 1 von 5 - Sprache";
$language['install/index.php']['select language'] = "Bitte wählen sie eine Sprache aus:";
$language['install/index.php']['note'] = "Sie sollten f&uuml;r die Dauer der Installation den MySQL-Admin Ordner f&uuml;r alle Benutzer schreibbar machen, um Probleme zu vermeiden.";
$language['install/index.php']['go on'] = "Weiter";

//install/license.php
$language['install/license.php']['title'] = "Installation";
$language['install/license.php']['installation step'] = "Installation - Schritt 2 von 5 - Lizenz";
$language['install/license.php']['show gpl'] = "GNU General Public License anzeigen";
$language['install/license.php']['accept'] = "Lizenz annehmen";
$language['install/license.php']['decline'] = "Lizenz ablehnen";
$language['install/license.php']['go on'] = "Weiter";

//install/create_tables.php
$language['install/create_tables.php']['title'] = "Installation";
$language['install/create_tables.php']['installation step'] = "Installation - Schritt 3 von 5 - Tabellen erzeugen";
$language['install/create_tables.php']['info text'] = "MySQL-Admin benötigt um korrekt funktionieren zu können zwei Tabellen, in welchen die Benutzereinstellungen bis zum Ende einer Sitzung gespeichert werden. Um das Volumen dieser Tabellen so gering wie möglich zu halten, werden unnötige Einträge automatisch gelöscht.<br><br>Sollten Sie die Möglichkeit haben, legen sie die Tabellen in einer eigenen Datenbank an.";
$language['install/create_tables.php']['connection settings'] = "Verbindungseinstellungen:";
$language['install/create_tables.php']['username'] = "Benutzername:";
$language['install/create_tables.php']['password'] = "Passwort:";
$language['install/create_tables.php']['server'] = "Server:";
$language['install/create_tables.php']['database'] = "Datenbank:";
$language['install/create_tables.php']['create database if not exists'] = "Datenbank erstellen wenn sie nicht existiert";
$language['install/create_tables.php']['error'] = "Fehler:";
$language['install/create_tables.php']['connection ready'] = "Verbindung wurde erfolgreich hergestellt.";
$language['install/create_tables.php']['created database'] = "Datenbank wurde erstellt.";
$language['install/create_tables.php']['created tables'] = "Tabellen wurden erfolgreich erstellt.";
$language['install/create_tables.php']['overwrite info'] = "Tabellen mit den Namen sql_iden und sql_user in der gewählten Datenbank werden automatisch &uuml;berschrieben.<br><br> Sollten eine andere Kopie von MySQL-Admin auf diese Tabellen zugreifen, werden alle Benutzer abgemeldet, MySQL-Admin wird weiterhin normal funktionieren.";     
$language['install/create_tables.php']['go on'] = "Weiter";
$language['install/create_tables.php']['check connection'] = "Tabellen erstellen";

//install/write_config.php
$language['install/write_config.php']['title'] = "Installation";
$language['install/write_config.php']['installation step'] = "Installation - Schritt 4 von 5 - Konfiguration schreiben";
$language['install/write_config.php']['info text'] = "MySQL-Admin wird nun versuchen die Konfigurationsdatei mit den MySQL Zugangsdaten zu speichern, dies gelingt nur, wenn PHP die Schreibrechte auf die Datei 'PASS.php' im Stammverzeichnis von MySQL-Admin hat.";
$language['install/write_config.php']['write config'] = "Konfigurationsdatei schreiben";
$language['install/write_config.php']['wrote config'] = "Die Konfigurationsdatei wurde erfolgreich geschrieben";
$language['install/write_config.php']['check config'] = "Konfigurationsdatei &uuml;berpr&uuml;fen";
$language['install/write_config.php']['config file wrong'] = "Überpr&uuml;fung der Konfigurationsdatei fehlgeschlagen.";
$language['install/write_config.php']['unable to write config'] = "Die Konfigurationsdatei konnte nicht geschrieben werden<br><br>Ändern sie die Datei bitte per Hand.<br>Öffnen sie dazu die Datei 'PASS.php' im Stammverzeichnis von MySQL-Admin f&uuml;gen Sie den folgenden Text in die Datei ein und speichern Sie sie wieder.<br>Achten Sie darauf, dass sie keine Leerzeichen am Anfang oder Ende der Datei hinzuf&uuml;gen.";
$language['install/write_config.php']['go on'] = "Weiter";

//install/delete_files.php
$language['install/delete_files.php']['title'] = "Installation";
$language['install/delete_files.php']['installation step'] = "Installation - Schritt 5 von 5 - Installationsdateien löschen";
$language['install/delete_files.php']['info text'] = "MySQL-Admin versucht nun den Installationsordner zu löschen um ein Sicherheitsrisiko zu minimieren. Sie können diesen Schritt auch &uuml;berspringen und die Dateien selbst löschen";
$language['install/delete_files.php']['installer deleted'] = "Installationsdateien wurden gelöscht.";
$language['install/delete_files.php']['delete installer'] = "Installationsdateien löschen";
$language['install/delete_files.php']['unable to delete install files'] = "Der \"install\" Ordner konnte nicht gelöscht werden. Löschen Sie den Ordner bitte manuell, oder geben sei PHP die nötigen Zugriffsberechtigungen um den Ordner zu löschen.";
$language['install/delete_files.php']['go on'] = "Weiter zu MySQL-Admin";

//install/update.php
$language['install/update.php']['title'] = "Installation";
$language['install/update.php']['message'] = "Datenbank Update";
$language['install/update.php']['unable to update database'] = "Datenbankupdate fehlgeschlagen bitte führen sie updaten Se die Datenbank per Hand";
$language['install/update.php']['unable to delete install folder'] = "Löschen des Installationsverzeichnis fehlgeschlagen, bitte löschen Sie das Installationsverzeichnis \"./install/\" per Hand";
$language['install/update.php']['created tables'] = "Tabellen wurden erfolgreich erstellt.";
?>