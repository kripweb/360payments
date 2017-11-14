<?php
session_start();
include '../core/config.php';
include '../core/functions.php';

// DB table to use
$table = 'merchants';
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    
	array(
        'db'        => 'name',
        'dt'        => 0,
        'formatter' => function( $d, $row ) {
			return $d;
        }
    ),
	
	array(
        'db'        => 'url',
        'dt'        => 1,
        'formatter' => function( $d, $row ) {
			return $d;
        }
    ),
	array(
        'db'        => 'url',
        'dt'        => 2,
        'formatter' => function( $d, $row ) {
			return '<a href="https://www.360payments.com/partnercalculator/'.$d.'/" target="_blank">https://www.360payments.com/partnercalculator/'.$d.'/</a>';
        }
    ),
	
	array(
        'db'        => 'id',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
			Global $site_url;
			if($d==1) {
				return '<a class="btn btn-primary btn-xs"  href="'.$site_url.'/partners/view/'.$d.'/">View</a>';
			} else {
				return '<a class="btn btn-primary btn-xs"  href="'.$site_url.'/partners/view/'.$d.'/">View</a>
					<a class="btn btn-danger btn-xs" href="'.$site_url.'/partners/delete/'.$d.'/" onclick="return confirm(\'Do you really want to delete?\');" >Delete</a>';
			}
			
        }
    ),
);
 
// SQL server connection information
$sql_details = array(
    'user' => $dbuser,
    'pass' => $dbpass,
    'db'   => $dbname,
    'host' => $dbhost
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );

$extra="id>0";
if(!empty($_GET['type'])){
	$extra.= " AND (status='".$_GET['type']."' OR pay_status='".$_GET['type']."')";
}

if(!empty($_GET['uid'])){
	$extra.= " AND uid='".$_GET['uid']."'";
}

echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, "".$extra."" )
);

?>