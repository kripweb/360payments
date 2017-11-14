<?php
session_start();
include '../core/config.php';
include '../core/functions.php';

// DB table to use
$table = 'admin';
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array(
        'db'        => 'avatar',
        'dt'        => 0,
        'formatter' => function( $d, $row ) {
			return $d;
        }
    ),
	array(
        'db'        => 'gender',
        'dt'        => 0,
        'formatter' => function( $d, $row ) {
			Global $site_url;
			return '<img class="avatar" src="'.$site_url.'/uploads/avatar/'.avatar($row['avatar'], $d).'" alt="Avatar">';
        }
    ),
	
	array(
        'db'        => 'type',
        'dt'        => 1,
        'formatter' => function( $d, $row ) {
			return usertype($d);
        }
    ),
	
	array(
        'db'        => 'name',
        'dt'        => 2,
        'formatter' => function( $d, $row ) {
			return $d;
        }
    ),
	
	array(
        'db'        => 'username',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
			return $d;
        }
    ),
	
	array(
        'db'        => 'email',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
			return $d;
        }
    ),
	
	array(
        'db'        => 'id',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
			global $site_url;
			return '<a class="btn btn-primary btn-xs"  href="'.$site_url.'/users/view/'.$d.'/">View</a>
					<a class="btn btn-danger btn-xs" href="'.$site_url.'/users/delete/'.$d.'/" onclick="return confirm(\'Do you really want to delete?\');" >Delete</a>';
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