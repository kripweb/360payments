<?php
session_start();
include '../core/config.php';
include '../core/functions.php';

// DB table to use
$table = 'transactions';
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    
	array(
        'db'        => 'addedon',
        'dt'        => 0,
        'formatter' => function( $d, $row ) {
			return $d;
        }
    ),
	
	array(
        'db'        => 'uid',
        'dt'        => 1,
        'formatter' => function( $d, $row ) {
			$userinfo = userinfo($d);
			return '<a target="_blank" href="users-view.php?id='.$d.'">'.$userinfo['first_name'].' '.$userinfo['last_name'].'</a>';
        }
    ),
	
	array(
        'db'        => 'id',
        'dt'        => 2,
        'formatter' => function( $d, $row ) {
			return "W".$d;
        }
    ),
	array(
        'db'        => 'type',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
			return type($d);
        }
    ),
	array( 'db' => 'provider', 'dt' => 4 ),
	array( 'db' => 'number', 'dt' => 5 ),
	array(
        'db'        => 'amount',
        'dt'        => 6,
        'formatter' => function( $d, $row ) {
			return "INR ".number_format($d, 2);
        }
    ),
	array( 'db' => 'details', 'dt' => 7 ),
	array(
        'db'        => 'pay_status',
        'dt'        => 8,
        'formatter' => function( $d, $row ) {
			return status($d);
        }
    ),
	array(
        'db'        => 'status',
        'dt'        => 9,
        'formatter' => function( $d, $row ) {
			return status($d);
        }
    ),
	array( 'db' => 'joloid', 'dt' => 10 ),
	array( 'db' => 'contact_name', 'dt' => 11 ),
	array( 'db' => 'contact_email', 'dt' => 11 ),
	array(
        'db'        => 'contact_number',
        'dt'        => 11,
        'formatter' => function( $d, $row ) {
			return $row['contact_name'].', '.$row['contact_email'].', '.$row['contact_number'];
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