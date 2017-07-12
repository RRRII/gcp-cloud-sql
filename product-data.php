<?php
/* Database connection start */
$dsn = getenv('MYSQL_DSN');
$user = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');

$pdo = new PDO($dsn, $user, $password);

/* Database connection end */


// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

// class Products {
//     public $list_name;
//     public $list_price;
//     public $list_upc;
//
//     public function info()
//     {
//         return '#'.$this->list_name.': '.$this->list_price.' '.$this->last_upc;
//     }
// }

$columns = array(
// datatable column index  => database column name
	0 => 'list_name',
	1 => 'list_price',
	2 => 'list_upc'
);

// getting total number records without any search
// $query = "SELECT DISTINCT list_name, list_price, list_upc FROM products";
// $result = $pdo->prepare($query);
// $result->setFetchMode(PDO::FETCH_CLASS, 'Products');

$allquery = "SELECT DISTINCT * FROM products";
$allstmt = $pdo->query($allquery);
$totalData = $allstmt->rowCount();
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


// if( !empty($requestData['search']['value']) ) {
// 	// if there is a search parameter
// 	$sql = "SELECT DISTINCT list_name, list_price, list_upc FROM products ";
// 	$sql.=" WHERE list_name LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
// 	$sql.=" OR list_price LIKE '".$requestData['search']['value']."%' ";
// 	$sql.=" OR list_upc LIKE '".$requestData['search']['value']."%' ";
// 	$query=mysqli_query($conn, $sql) or die("product-data.php: get products");
// 	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query
//
// 	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
// 	$query=mysqli_query($conn, $sql) or die("product-data.php: get products"); // again run query with limit
//
// } else {
//
// 	$sql = "SELECT DISTINCT list_name, list_price, list_upc FROM products ";
// 	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
// 	$query=mysqli_query($conn, $sql) or die("product-data.php: get products");
//
// }

$data = array();
$stmt = $pdo->prepare('SELECT DISTINCT list_name FROM products');
$stmt->execute();
while($row = $stmt->fetch()) {  // preparing an array
	// $nestedData=array();
  //
	// $nestedData[] = $row['list_name'];
	// $nestedData[] = $row['list_price'];
	// $nestedData[] = $row['list_upc'];
  //
	// $data[] = $nestedData;
  $data[] = $row['list_name'];
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
