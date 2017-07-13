<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT list_name, list_zip, list_services FROM stores ";
if(isset($_POST["search"]["value"]))
{
$query .= 'WHERE list_name LIKE "%'.$_POST["search"]["value"].'%" ';
$query .= 'OR list_zip LIKE "%'.$_POST["search"]["value"].'%" ';
$query .= 'OR list_services LIKE "%'.$_POST["search"]["value"].'%" ';
}
// if(isset($_POST["order"]))
// {
// $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
// }
// else
// {
// $query .= 'ORDER BY id DESC ';
// }
// if($_POST["length"] != -1)
// {
// $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
// }
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
$sub_array = array();
$sub_array[] = $row["list_name"];
$sub_array[] = $row["list_zip"];
$sub_array[] = $row["list_services"];
$data[] = $sub_array;
}
$output = array(
"draw"    => intval($_POST["draw"]),
"recordsTotal"  =>  $filtered_rows,
"recordsFiltered" => get_total_all_records(),
"data"    => $data
);
echo json_encode($output);
?>
