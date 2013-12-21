<?php
/********************************************************************************/
/* 			Configuration file of MySQL-Admin			*/
/* 	For the database connection settings open the file "PASS.php"		*/
/* If there are anx problems, look at MySQL-Admin.org for more information	*/
/********************************************************************************/


/********************************************************************************/
/* 			Language and Design 					*/
/* Normally there are three different templates "modern"(default), 		*/
/* "blue_white" and the "red_black" template.					*/
/* The value $template_dir specifies the default template.			*/
$template_dir = "modern";
/* The $templates array contains all available templates and there names	*/
$templates = array(
	'modern' => 'Modern',
	'blue_white' => 'Blue and White',
	'red_black' => 'Red and Black'
);
/* Color for the most errors given by MySQL-Admin				*/
$error_color = "red";
/* The Version of MySQL-Admin shown in the title line of the browser		*/
/* For example you may change it to "- BWAs edition" and the title will be  	*/
/* "MySQL-Admin - BWAs edition"							*/
$version = "3.4"; 
/* The $default_language set the default language, but if your browser		*/
/* language for example is german, and the german language file is present  	*/
/* MySQL-Admin will use german instead of the default value			*/
/* I NEED PEOPLE TO TRANSLATE MYSQL-ADMIN INTO OTHER LANGUAGES!			*/
$default_language = "english";
/* The $lang_config array contains all available languages and charsets		*/
$lang_config = array(
	array(
		'Deutsch',
		'german',
		array('iso-8859-1', 'utf-8'),
		'de'
	),
	array(
		'English',
		'english', 
		array('iso-8859-1', 'utf-8'), 
		'en')
);
/********************************************************************************/


/********************************************************************************/
/*			MySQL Connection and Login				*/
/* The $sql_library value specifies the PHP library used for the connection	*/
/* to the server.								*/
/* Value may be xsql_mysql_auto, xsql_mysql or xsql_mysqli			*/
$sql_library = xsql_mysql_auto;
/* This settings are for only for developers, mysql-admin will print any 	*/
/* error given by the mysql server immediately					*/
$sql_debug_server_connection = false;
$sql_debug_user_connection = false;
/* You can change any default value given in the login form			*/
/* Default server use at login, if the value is set, for example if the 	*/
/* $default_server is set to "localhost" the "Server" field will be hidden, 	*/
/* and you`ll automatically connect to localhost				*/
$default_server = "";
/* This feature is currently not avialable					*/
$show_shared_user_login = false;
/* If $remember_value is set, the "Remember username,...." checkbox will be 	*/
/* checked									*/
$remember_values = true;
/* Set this value to check the "Activate cookies" checkbox			*/
$check_session_cookie = true;
/* Set this to enable the "IP lock" checkbox					*/
$ip_lock = true; 
/* Default session expiration time in minutes, (false no expiration		*/
$session_timeout = 30;
/********************************************************************************/


/********************************************************************************/
/*			CSV, SQL highlighting and parsing			*/
/* The $csv_endLine value is the line seperator in CSV files(read/write)	*/
/* This should normally be "\r", "\n\r" or only "\n"				*/
$csv_endLine = "\r";
/* The $csv_nextElement spcifies the seperator between the elements		*/
$csv_nextElement = ";";
/* The $csv_limiter specifies the limiter of the content("myCSV"; "myCSV2") */
$csv_limiter = "\"";
/* The $csv_ecapedBy value is the char or string to escape chars in a 		*/
/* content area in a csv file ("myCSV"; "myCSV2"; "my\"own\"CSV")		*/
$csv_escapedBy = "\"";
/* Some of the color setting for the sql highlighter may be overwritten by	*/
/* templates. Colors may be like "black", "red", ... or hex value (#000000)	*/
/* Base color for the highlighter						*/
$sql_color_normal = "black";
/* Comment color (-- comment)							*/
$sql_color_comment = "orange";
/* MySQL comment color (like php comments)					*/
$sql_color_sql_comment = "darkorange";
/* Color of values between ticks like 'i am a value'				*/ 
$sql_color_values = "red";
/* Color of field names between backticks like `mycol`				*/ 
$sql_color_fields = "blue";
/* Color of recognised keywords like SELECT, GRAN,..				*/
$sql_color_keyword = "#009900";
/* The $sql_value array contains values like " or ' or ` all values between 	*/
/* a pair of this chars will be recognised as value and colored like thats  	*/
$sql_values = array('"', '\'', '`');
/* Char to escape chars in value blocks						*/
$sql_escape_char = '\\';
/* Keywords to be highlighted							*/
$sql_keywords = array(
	'ADD', 'ANALYZE', 'ASC', 'TABLES', 'BETWEEN', 'CHANGE', 'DATABASE', 
	'DEFAULT', 'DESC', 'DISTINCT', 'FOREIGN', 'GRANT', 'IN', 'UNLOCK', 'INNER',
	'INSERT', 'INTO', 'JOIN', 'LEFT', 'ON', 'REGEXP', 'RIGHT', 'SHOW', 'TABLE',
	'TO', 'TRUE', 'ZEROFILL', 'ALL','ALTER','AND','AS','BEFORE','BY','COLUMN',
	'CREATE', 'DATABASES', 'DELETE', 'DESC', 'DESCRIBE', 'DROP', 'DUAL', 'FALSE',
	'FROM', 'FULLTEXT', 'GROUP', 'INDEX', 'IS', 'KEY', 'LIKE', 'LIMIT',
	'LOCK', 'NULL', 'OPTIMIZE', 'OPTION', 'OR', 'NOT', 'ORDER', 'OUTER',
	'PRIMARY', 'REPLACE', 'RENAME', 'SELECT', 'SET', 'STRAIGHT_JOIN', 'TERMINATED', 
	'UNION', 'USING' , 'UPDATE', 'WHERE', 'WITH', 'XOR'
);
/********************************************************************************/

/********************************************************************************/
/* 				Charsets, collations, datatypes and attributes	*/ 
/* If you create a new column or a new table it will be set to the		*/
/* $default_col_type value							*/
$default_col_type = "VARCHAR";
/* All known datatypes ar specified in the following array			*/
$global_types = array(
	"TINYINT", "SMALLINT", "MEDIUMINT", "INT", "BIGINT", "FLOAT", "DOUBLE",
	"DECIMAL", "DATE", "DATETIME", "TIMESTAMP", "TIME", "YEAR", "CHAR", 
	"VARCHAR", "TINYBLOB", "MEDIUMBLOB", "BLOB", "LONGBLOB", "TINYTEXT", 
	"MEDIUMTEXT", "TEXT", "LONGTEXT", "ENUM", "SET"
);
/* The $numeric_types array contains all known numeric fields			*/
$numeric_types = array(
	"TINYINT", "SMALLINT", "MEDIUMINT", "INT",
	"BIGINT", "FLOAT", "DOUBLE", "DECIMAL"
);
/* The $field_attributes array contains the avialable attributes		*/
$field_attributes = array("","UNSIGNED", "UNSIGNED ZEROFILL");
/* If MySQL-Admin is unable to get Charset and/or Collation it will 		*/
/* use this values								*/
$database_default_charsets = array(
	'big5','dec8','cp850','hp8','koi8r','latin1','latin2','swe7','ascii',
	'ujis','sjis','hebrew','tis620','euckr','koi8u','gb2312','greek','cp1250',
	'gbk','latin5','armscii8','utf8','ucs2','cp866','keybcs2','macce','macroman',
	'cp852','latin7','cp1251','cp1256','cp1257','binary','geostd8','cp932','eucjpms'
);
$database_default_collations = array('
	big5_chinese_ci','big5_bin','dec8_swedish_ci','dec8_bin','cp850_general_ci',
	'cp850_bin','hp8_english_ci','hp8_bin','koi8r_general_ci','koi8r_bin',
	'latin1_german1_ci','latin1_swedish_ci','latin1_danish_ci','latin1_german2_ci',
	'latin1_bin','latin1_general_ci','latin1_general_cs','latin1_spanish_ci',
	'latin2_czech_cs','latin2_general_ci','latin2_hungarian_ci','latin2_croatian_ci',
	'latin2_bin','swe7_swedish_ci','swe7_bin','ascii_general_ci','ascii_bin','ujis_japanese_ci',
	'ujis_bin','sjis_japanese_ci','sjis_bin','hebrew_general_ci','hebrew_bin','tis620_thai_ci',
	'tis620_bin','euckr_korean_ci','euckr_bin','koi8u_general_ci','koi8u_bin',
	'gb2312_chinese_ci','gb2312_bin','greek_general_ci','greek_bin','cp1250_general_ci',
	'cp1250_czech_cs','cp1250_croatian_ci','cp1250_bin','gbk_chinese_ci','gbk_bin',
	'latin5_turkish_ci','latin5_bin','armscii8_general_ci','armscii8_bin','utf8_general_ci',
	'utf8_bin','utf8_unicode_ci','utf8_icelandic_ci','utf8_latvian_ci','utf8_romanian_ci',
	'utf8_slovenian_ci','utf8_polish_ci','utf8_estonian_ci','utf8_spanish_ci','utf8_swedish_ci',
	'utf8_turkish_ci','utf8_czech_ci','utf8_danish_ci','utf8_lithuanian_ci','utf8_slovak_ci',
	'utf8_spanish2_ci','utf8_roman_ci','utf8_persian_ci','utf8_esperanto_ci','ucs2_general_ci',
	'ucs2_bin','ucs2_unicode_ci','ucs2_icelandic_ci','ucs2_latvian_ci','ucs2_romanian_ci',
	'ucs2_slovenian_ci','ucs2_polish_ci','ucs2_estonian_ci','ucs2_spanish_ci','ucs2_swedish_ci',
	'ucs2_turkish_ci','ucs2_czech_ci','ucs2_danish_ci','ucs2_lithuanian_ci','ucs2_slovak_ci',
	'ucs2_spanish2_ci','ucs2_roman_ci','ucs2_persian_ci','ucs2_esperanto_ci','cp866_general_ci',
	'cp866_bin','keybcs2_general_ci','keybcs2_bin','macce_general_ci','macce_bin','macroman_general_ci',
	'macroman_bin','cp852_general_ci','cp852_bin','latin7_estonian_cs','latin7_general_ci',
	'latin7_general_cs','latin7_bin','cp1251_bulgarian_ci','cp1251_ukrainian_ci','cp1251_bin',
	'cp1251_general_ci','cp1251_general_cs','cp1256_general_ci','cp1256_bin','cp1257_lithuanian_ci',
	'cp1257_bin','cp1257_general_ci','binary','geostd8_general_ci','geostd8_bin','cp932_japanese_ci',
	'cp932_bin','eucjpms_japanese_ci','eucjpms_bin'
);
/* If you create a new database you can preset the collation and		*/
/* charset with the following values						*/
$database_default_charset = '';
$database_default_collation = '';
/********************************************************************************/


/***********************************THE END**************************************/
?>