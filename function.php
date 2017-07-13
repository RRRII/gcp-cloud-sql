<?php

function get_total_all_records()
{
 include('db.php');
 $statement = $connection->prepare("SELECT list_name, list_zip, list_services FROM stores");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}

?>
