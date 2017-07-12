<!DOCTYPE html>
<html>
	<title>Product Search Example</title>
	<head>
		<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#product-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"product-data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".product-grid-error").html("");
							$("#product-grid").append('<tbody class="product-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#product-grid_processing").css("display","none");

						}
					}
				} );
			} );
		</script>
		<style>
			div.container {
			    margin: 0 auto;
			    max-width:760px;
			}
			div.header {
			    margin: 100px auto;
			    line-height:30px;
			    max-width:760px;
			}
			body {
			    background: #f7f7f7;
			    color: #333;
			    font: 90%/1.45em "Helvetica Neue",HelveticaNeue,Verdana,Arial,Helvetica,sans-serif;
			}
		</style>
	</head>
	<body>
		<div class="header"><h1>Autocomplete Demo Using GCP and Cloud SQL</h1></div>
		<div class="container">
			<table id="product-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
					<thead>
						<tr>
							<th>Product Name</th>
							<th>Price</th>
							<th>UPC</th>
						</tr>
					</thead>
			</table>
		</div>
	</body>
</html>
