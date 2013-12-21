<?php
session_start();

//Search Filters from database

         $query = "select * from usercategory";
         $query2 = "select distinct type from markers";
         $query3 = "select distinct type from track";
         $_SESSION['Groups']= mysql_query($query);
         $_SESSION['Groups2']= mysql_query($query2);
         $_SESSION['Groups3']= mysql_query($query3);
        
?>
