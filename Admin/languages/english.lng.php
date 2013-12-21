<?php

//------------------------- charset ----------------------------

$default_charset = "iso-8859-1";

//--------------------- default phrases ------------------------

$default_phrases['reload'] = "Reload";
$default_phrases['generation time'] = "Generation time: ";
$default_phrases['button send'] = "Send";
$default_phrases['button reset'] = "Reset";
$default_phrases['error'] = "Error";
$default_phrases['col'] = "Column";

//--------------------- Base dir files ------------------------

//index.php
$language['index.php']['title'] = "Main page";
$language['index.php']['please install mysql admin'] = "Please install MySQL-Admin first.";
$language['index.php']['go on to the install page'] = "To the install page..";
$language['index.php']['please delete the install file'] = "Please delete the directory \"./install\" first.";
$language['index.php']['upload file and reinstall'] = "Please upload the directory \"./install\" and reinstall MySQL-Admin.";

//Left.php
$language['left.php']['title'] = "Database overview";
$language['left.php']['delete table'] = "Delete table";
$language['left.php']['clear table'] = "Clear table";
$language['left.php']['table operations'] = "Table operations";
$language['left.php']['overview'] = "Overview";
$language['left.php']['cols'] = "Columns";
$language['left.php']['import,export'] = "Import and export";
$language['left.php']['add table'] = "Create table";
$language['left.php']['sql query'] = "SQL query";
$language['left.php']['status'] = "Show status";
$language['left.php']['server status'] = "Show server information";
$language['left.php']['database overview'] = "Database overview";
$language['left.php']['create database'] = "Create database";
$language['left.php']['delete database'] = "Delete Database";
$language['left.php']['databases'] = "Databases";
$language['left.php']['really delete table'] = 'Do you really want to delete the table \""+ Tab + "\"';
$language['left.php']['really delete database'] = 'Do your really want to delete this database?';
$language['left.php']['really clear table'] = 'Do you really want to delete all datasets from \""+ Tab + "\"';
$language['left.php']['log out'] = "Log off";

//tableData.php
$language['tableData.php']['title'] = "Table overview";
$language['tableData.php']['delete ds'] = "Do you really want to delete this dataset?";
$language['tableData.php']['overview over table'] = "Overview over the table";
$language['tableData.php']['extended overview'] = "Show extended query options";
$language['tableData.php']['extended overview hide'] = "Hide extended query options";
$language['tableData.php']['basic sorting'] = "Basic sort";
$language['tableData.php']['order by'] = "Order by:";
$language['tableData.php']['normal site selection'] = "Normal site selection";
$language['tableData.php']['max data sets'] = "Maximum entries per page: ";
$language['tableData.php']['data sets from'] = "Datasets from";
$language['tableData.php']['data sets to'] = "to";
$language['tableData.php']['cols'] = "Selected cols";
$language['tableData.php']['hide export settings'] = "Hide export options";
$language['tableData.php']['export settings'] = "Show export options";
$language['tableData.php']['export shown data sets'] = "Export shown datasets";
$language['tableData.php']['all settings will be hold'] = "All order and site options will be kept";
$language['tableData.php']['col names in first line'] = "Column names in first line";
$language['tableData.php']['insert data set'] = "Insert dataset";
$language['tableData.php']['site'] = "Site: ";
$language['tableData.php']['ASC'] = "ascending";
$language['tableData.php']['DESC'] = "descending";
$language['tableData.php']['show'] = "Show";
$language['tableData.php']['download'] = "Download";
$language['tableData.php']['print'] = "Print current page (optimized view)";
$language['tableData.php']['no datasets found'] = "No datasets found";

//tableStructure.php
$language['tableStructure.php']['title'] = "Table structure";
$language['tableStructure.php']['col name'] = "Name:";
$language['tableStructure.php']['type'] = "Type:";
$language['tableStructure.php']['is null'] = "Null:";
$language['tableStructure.php']['extra'] = "Extras:";
$language['tableStructure.php']['default val'] = "Default:";
$language['tableStructure.php']['length'] = "Length:";
$language['tableStructure.php']['attribute'] = "Attribute:";
$language['tableStructure.php']['yes'] = "Yes";
$language['tableStructure.php']['no'] = "No";
$language['tableStructure.php']['headline'] = "Table structure of the table ";
$language['tableStructure.php']['add new col'] = "Insert new column";
$language['tableStructure.php']['delete col'] = 'Do you really want to delete the column \'%s\'?'; //To JS
$language['tableStructure.php']['delete key'] = 'Do you really want to delete the key \'%s\'?';  //To JS
$language['tableStructure.php']['add new key'] = "Insert new key";
$language['tableStructure.php']['key name'] = 'Key name:'; 
$language['tableStructure.php']['key type'] = 'Keys type:'; 
$language['tableStructure.php']['col names'] = 'Column name:';

//startpage.php
$language['startpage.php']['title'] = "Login";
$language['startpage.php']['acquire network connection'] = "<b>Acquire connection to server</b><br /><font size=2>Please disable your popupblocker(s), if this process takes to long.</font>";
$language['startpage.php']['log on to'] = "Login";
$language['startpage.php']['mysql server'] = "MySQL server";
$language['startpage.php']['shared used db'] = "Shared used database";
$language['startpage.php']['username'] = "Username:";
$language['startpage.php']['password'] = "Password:";
$language['startpage.php']['server address'] = "Server:";
$language['startpage.php']['database'] = "Database*:";
$language['startpage.php']['security settings'] = "Security settings:";
$language['startpage.php']['remember username, server, db'] = "Remember username, server and database";
$language['startpage.php']['activate cookies'] = "Activate cookies";
$language['startpage.php']['IP blocker'] = "IP lock";
$language['startpage.php']['session timeout'] = "Limit session to";
$language['startpage.php']['minutes'] = "minutes";
$language['startpage.php']['notice for connection'] = "<font size=2><i>* Note: </i><br />Leave this field blank to get an overview over all databases.</font>";
$language['startpage.php']['language'] = "Language: ";
$language['startpage.php']['design'] = "Design: ";
$language['startpage.php']['design and language'] = "Language and design: ";
$language['startpage.php']['connectiontype'] = "Connection type: ";
$language['startpage.php']['connection to server failed'] = "Connection to server failed.";
$language['startpage.php']['failed to select database'] = "Unable to select database.";
$language['startpage.php']['connection error'] = "Connection error:";

//logout.php
$language['logout.php']['title'] = "Log off";

//men.php
$language['men.php']['title'] = "Server login";
$language['men.php']['server login'] = "Server login";

//----------------------- Pages --------------------------

//pages/loaded.php
$language['pages/loaded.php']['title'] = "Connected";
$language['pages/loaded.php']['connected'] = "Connected";
$language['pages/loaded.php']['choose table in left menu'] = "Please choose a table or database in the menu to the left";

//pages/blank.php
$language['pages/blank.php']['title'] = "";

//--------------------- Functions ------------------------

//functions/delete.php
$language['functions/delete.php']['title'] = "Delete dataset";
$language['functions/delete.php']['dataset deleted'] = "Dataset successfully deleted";

//functions/editContent.php
$language['functions/editContent.php']['title'] = "Edit dataset";
$language['functions/editContent.php']['edit dataset of table'] = "Edit dataset of table '%s'.";
$language['functions/editContent.php']['insert dataset in table'] = "Insert dataset into table '%s'.";
$language['functions/editContent.php']['null'] = "Null";

//functions/newTable.php
$language['functions/newTable.php']['title'] = "Create table";
$language['functions/newTable.php']['create new table'] = "Create new table";
$language['functions/newTable.php']['tablename'] = "Table name";
$language['functions/newTable.php']['no of cols'] = "Number of columns";

//functions/createDatabase.php
$language['functions/createDatabase.php']['title'] = "Create Database";
$language['functions/createDatabase.php']['create new database'] = "Create new database";
$language['functions/createDatabase.php']['database name'] = "Databasename";
$language['functions/createDatabase.php']['collation'] = "Collation";
$language['functions/createDatabase.php']['charset'] = "Charset";

//functions/deleteDatabase.php
$language['functions/deleteDatabase.php']['title'] = "Delete database";

//functions/doCreate.php
$language['functions/doCreate.php']['title'] = "Create table";
$language['functions/doCreate.php']['summary'] = "Summary";
$language['functions/doCreate.php']['in query'] = "in query";

//functions/delTab.php
$language['functions/delTab.php']['title'] = "Delete table";

//functions/deleteAll.php
$language['functions/deleteAll.php']['title'] = "Clear table";
$language['functions/deleteAll.php']['table cleared'] = "All datasets successfully deleted";

//functions/create.php
$language['functions/create.php']['title'] = "Create table";
$language['functions/create.php']['cols of table'] = "Columns in table";
$language['functions/create.php']['col no'] = "Column number.";
$language['functions/create.php']['col name'] = "Name:";
$language['functions/create.php']['type'] = "Type:";
$language['functions/create.php']['length'] = "Length / Values:";
$language['functions/create.php']['default value'] = "Default value:";
$language['functions/create.php']['primary key'] = "Primary key";
$language['functions/create.php']['unique'] = "Unique";
$language['functions/create.php']['index'] = "Index";
$language['functions/create.php']['nothing'] = "Not a key";
$language['functions/create.php']['not null'] = "Not null";
$language['functions/create.php']['auto increment'] = "Auto increment";
$language['functions/create.php']['create table'] = "Create table";
$language['functions/create.php']['notice'] = "Write the values for ENUM and SET columns in the 'Lenght / Values' field.<br />For example: 'Enum1','Enum2'";

//functions/tableOperations.php
$language['functions/tableOperations.php']['title'] = "Table operations";
$language['functions/tableOperations.php']['table operations'] = "Table operations";
$language['functions/tableOperations.php']['rename table'] = "Rename table";
$language['functions/tableOperations.php']['to'] = "to";
$language['functions/tableOperations.php']['auto increment value'] = "Auto increment value ";
$language['functions/tableOperations.php']['set auto increment value to'] = "Auto increment value: ";


//functions/editCol.php
$language['functions/editCol.php']['title'] = "Insert / Edit columns";
$language['functions/editCol.php']['insert col'] = "Insert column into table '%s'"; 
$language['functions/editCol.php']['edit col'] = "Edit column '%s'";
$language['functions/editCol.php']['settings'] = "Settings: ";
$language['functions/editCol.php']['name'] = "Name: ";
$language['functions/editCol.php']['type'] = "Type: ";
$language['functions/editCol.php']['length'] = "Length / Values: ";
$language['functions/editCol.php']['attribute'] = "Attribute: ";
$language['functions/editCol.php']['default value'] = "Default value: ";
$language['functions/editCol.php']['null'] = "Null: ";
$language['functions/editCol.php']['auto increment'] = "Auto increment: ";
$language['functions/editCol.php']['position'] = "Position: ";
$language['functions/editCol.php']['position type'] = array('Before', 'After');


//functions/deleteCol.php
$language['functions/deleteCol.php']['title'] = "Delete column";
$language['functions/deleteCol.php']['col deleted'] = "Column successfully deleted";

//functions/deleteKey.php
$language['functions/deleteKey.php']['title'] = "Delete key";
$language['functions/deleteKey.php']['key deleted'] = "Key successfully deleted";

//functions/editKey.php
$language['functions/editKey.php']['title'] = "Insert / Edit key";
$language['functions/editKey.php']['edit key'] = "Edit key '%s' of table '%s'";
$language['functions/editKey.php']['insert key'] = "Insert key into table '%s'";
$language['functions/editKey.php']['settings'] = "Settings:";
$language['functions/editKey.php']['key name'] = "Name:";
$language['functions/editKey.php']['key type'] = "Type:";
$language['functions/editKey.php']['col'] = "Column:";
$language['functions/editKey.php']['errors'] = "Error:";
$language['functions/editKey.php']['length'] = "Length:";
$language['functions/editKey.php']['insert new col'] = "Insert new column";

//--------------------- Status ------------------------

//status/status.php
$language['status/status.php']['title'] = "Status";
$language['status/status.php']['mysql server status'] = "MySQL Status: ";
$language['status/status.php']['server'] = "Server: ";
$language['status/status.php']['connection type'] = "Connection type: ";
$language['status/status.php']['server version'] = "MySQL server version: ";
$language['status/status.php']['client version'] = "MySQL client version: ";
$language['status/status.php']['protocol'] = "Protocol: ";
$language['status/status.php']['server runtime'] = "Server runtime: ";
$language['status/status.php']['threads'] = "Threads: ";
$language['status/status.php']['queries'] = "Queries: ";
$language['status/status.php']['slow queries'] = "Slow queries: ";
$language['status/status.php']['open files'] = "Open files: ";
$language['status/status.php']['connections'] = "Connections: ";
$language['status/status.php']['open tables'] = "Open tables";
$language['status/status.php']['queries per secound'] = "Average queries per second";
$language['status/status.php']['processlist'] = "Process list: ";
$language['status/status.php']['connection id'] = "Connection ID";
$language['status/status.php']['user'] = "User";
$language['status/status.php']['server name'] = "Server";
$language['status/status.php']['database'] = "Database";
$language['status/status.php']['command'] = "Command";
$language['status/status.php']['time'] = "Time";
$language['status/status.php']['status'] = "Status";
$language['status/status.php']['info'] = "Information";

//Status/serverStatus.php
$language['status/serverStatus.php']['title'] = "Server information";
$language['status/serverStatus.php']['server information'] = "Server information: ";
$language['status/serverStatus.php']['name'] = "Name:";
$language['status/serverStatus.php']['value'] = "Value:";
$language['status/serverStatus.php']['variables'] = "Variables: ";

//----------------------- IO --------------------------

//io/import-sql.php
$language['io/import-sql.php']['title'] = "File Import";
$language['io/import-sql.php']['progress'] = "Progress:";
$language['io/import-sql.php']['done'] = "done";
$language['io/import-sql.php']['summary'] = "Summary: ";
$language['io/import-sql.php']['executed queries'] = "Executed queries: ";
$language['io/import-sql.php']['error'] = "Errors: ";
$language['io/import-sql.php']['time'] = "Time: ";
$language['io/import-sql.php']['seconds'] = " Sec.";

//io/import-export.php - this file includes import-sql-load.php, import-csv-load.php, export-sql-options, export-csv-options.php
$language['io/import-export.php']['title'] = "Import - Export";
$language['io/import-export.php']['import export options'] = "Import / Export settings";
$language['io/import-export.php']['sql file import'] = "SQL file import";
$language['io/import-export.php']['sql export'] = "SQL  export";
$language['io/import-export.php']['export settings'] = "Export settings: ";
$language['io/import-export.php']['no create database'] = "No &quot;CREATE DATABASE&quot;";
$language['io/import-export.php']['no create table'] = "No &quot;CREATE TABLE&quot;";
$language['io/import-export.php']['no contents'] = "No contents";
$language['io/import-export.php']['show'] = "Show";
$language['io/import-export.php']['download'] = "Download:";
$language['io/import-export.php']['go on'] = "Go on";
$language['io/import-export.php']['filename'] = "Filename:";
$language['io/import-export.php']['csv export'] = "CSV export";
$language['io/import-export.php']['load csv files in the overview'] = "You can export CSV files in the overview.";
$language['io/import-export.php']['csv file import'] = "CSV file import";
$language['io/import-export.php']['colname in first line'] = "Read Column names from first line in the CSV file";
$language['io/import-export.php']['select cols'] = "Select columns";
$language['io/import-export.php']['skip col'] = "Skip column";
$language['io/import-export.php']['overwrite duplicate entries1'] = "Overwrite rows with the same contents in ";
$language['io/import-export.php']['overwrite duplicate entries2'] = "";
$language['io/import-export.php']['import'] = "Import";
$language['io/import-export.php']['mysqldump'] = "mysqldump";
$language['io/import-export.php']['mysql-admin dump'] = "MySQL-Admin export";

//io/import-csv.php
$language['io/import-csv.php']['title'] = "CSV import";
$language['io/import-csv.php']['csv import'] = "CSV import";
$language['io/import-csv.php']['summary'] = "Summary";
$language['io/import-csv.php']['executed queries, with errors1'] = " executed queries, terminated with errors: ";
$language['io/import-csv.php']['executed queries, with errors2'] = " ";

//io/export-sql.php
$language['io/export-sql.php']['title'] = "SQL export";
$language['io/export-sql.php']['sql export'] = "MySQL export";
$language['io/export-sql.php']['error'] = "<br /><b>An error occurred.<b>";

//io/print.php
$language['io/print.php']['title'] = "Print";
$language['io/print.php']['table'] = "Table";
$language['io/print.php']['no datasets found'] = "No datasets found";


//--------------------- Query -------------------------

//query/query.php
$language['query/query.php']['title'] = "MySQL query";
$language['query/query.php']['query results'] = "Query results:";
$language['query/query.php']['query'] = "Query:";
$language['query/query.php']['status'] = "Status:";
$language['query/query.php']['executed queries'] = "Executed queries: ";
$language['query/query.php']['errors'] = "Error: ";
$language['query/query.php']['output'] = "Output:";
$language['query/query.php']['on data available'] = "No data to this query available.";
$language['query/query.php']['edit query'] = "Edit query";


//--------------------- Library ------------------------

//lib/errors.php
$lib_errors['while executing query'] = "while executing query:";
$lib_errors['error, no rows affected'] = "Changed no dataset";
$lib_errors['error'] = "Error:";
$lib_errors['no permission'] = "You have no permission for this operation.";
$lib_errors['in query'] = "in query:";
$lib_errors['unauthorized access'] = "Unauthorized access";
$lib_errors['log on new'] = "Please log on new.";
$lib_errors['bad access violation'] = "Bad access violation";
$lib_errors['session expired'] = "The session expired.";
$lib_errors['loginerror'] = "Loginerror";
$lib_errors['wrong username or password'] = "Wrong username or password";
$lib_errors['incomplete form'] = "Please fill in the username.";
$lib_errors['back'] = "Back";

//lib/querys.lib.php
$lib_errors['file not found'] = "No file found to import";

//lib/sql.lib.php
$lib_errors['connection to mainserver failed'] = "Connection failed";
$lib_errors['error while executing query'] = "Error executing a query";
$lib_errors['error choosing database'] = "Error connecting to database:";
$lib_errors['connection error'] = "Connection failed:"; 


//------------------ Installation ----------------------

//install/index.php
$language['install/index.php']['title'] = "Installation";
$language['install/index.php']['installation step'] = "Installation - Step 1 of 5 - Language";
$language['install/index.php']['select language'] = "Please select a language:";
$language['install/index.php']['note'] = "Please set the MySQL-Admin directory for the time of the installation for PHP writeable.";
$language['install/index.php']['go on'] = "Next step";

//install/license.php
$language['install/license.php']['title'] = "Installation";
$language['install/license.php']['installation step'] = "Installation - Step 1 of 5 - License";
$language['install/license.php']['show gpl'] = "Show GNU General Public License";
$language['install/license.php']['accept'] = "Accept license";
$language['install/license.php']['decline'] = "Decline license";
$language['install/license.php']['go on'] = "Next step";

//install/create_tables.php
$language['install/create_tables.php']['title'] = "Installation";
$language['install/create_tables.php']['installation step'] = "Installation - Step 1 of 5 - Create tables";
$language['install/create_tables.php']['info text'] = "MySQL-Admin needs two tables to work correctly, in which all user settings are saved until the end of each session. To keep the volume of this tables as small as possible all unneeded entries will be deleted automatically.<br><br>If you have the possibility you should create this tables in a separate database.";
$language['install/create_tables.php']['connection settings'] = "Connection settings:";
$language['install/create_tables.php']['username'] = "Username:";
$language['install/create_tables.php']['password'] = "Password:";
$language['install/create_tables.php']['server'] = "Server:";
$language['install/create_tables.php']['database'] = "Database:";
$language['install/create_tables.php']['create database if not exists'] = "Create database if not exists";
$language['install/create_tables.php']['error'] = "Error:";
$language['install/create_tables.php']['connection ready'] = "Connection ready.";
$language['install/create_tables.php']['created database'] = "Created database successful.";
$language['install/create_tables.php']['created tables'] = "Created tables successful.";
$language['install/create_tables.php']['overwrite info'] = "Tables with the name sql_iden and sql_user will be overwritten.<br><br> Other copies of MySQL-Admin that work with those tables won't be affected if you overwrite the tables.";     
$language['install/create_tables.php']['go on'] = "Next step";
$language['install/create_tables.php']['check connection'] = "Create tables";

//install/write_config.php
$language['install/write_config.php']['title'] = "Installation";
$language['install/write_config.php']['installation step'] = "Installation - Step 1 of 5 - Write configuration";
$language['install/write_config.php']['info text'] = "MySQL-Admin is now going to try to write the configuration file 'PASS.php' with the MySQL account data. If it is possible set the 'PASS.php' file for PHP writeable";
$language['install/write_config.php']['write config'] = "Write configuration";
$language['install/write_config.php']['wrote config'] = "Wrote configuration successful";
$language['install/write_config.php']['check config'] = "Check configuration file.";
$language['install/write_config.php']['config file wrong'] = "Configuration file wrong.";
$language['install/write_config.php']['unable to write config'] = "Unable to write configuration file.<br><br>Please change the file manual.<br>Open the file 'PASS.php' in MySQL-Admin's base directory, insert the following code into the file and save it again.";
$language['install/write_config.php']['go on'] = "Next step";

//install/delete_files.php
$language['install/delete_files.php']['title'] = "Installation";
$language['install/delete_files.php']['installation step'] = "Installation - Step 1 of 5 - Delete installation files";
$language['install/delete_files.php']['info text'] = "MySQL-Admin is now going to try to delete the install directory to avoid a security risk.";
$language['install/delete_files.php']['installer deleted'] = "Files deleted, installation complete.";
$language['install/delete_files.php']['delete installer'] = "Delete install files";
$language['install/delete_files.php']['unable to delete install files'] = "Unable to delete the 'install' folder. Please delete it manual to complete the installation.";
$language['install/delete_files.php']['go on'] = "To MySQL-Admin";

//install/update.php
$language['install/update.php']['title'] = "Installation";
$language['install/update.php']['message'] = "Update database";
$language['install/update.php']['unable to update database'] = "Database update failed, please update the database manually";
$language['install/update.php']['unable to delete install folder'] = "Unable to delete the install folder(\"./install/\") please delete it.";
$language['install/update.php']['created tables'] = "Database update finished";
?>