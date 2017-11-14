<?php
session_start();
include '../core/config.php';
include '../core/functions.php';

// DB table to use
$table = 'user_answers';
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
	array( 'db' => 'q80', 'dt' => 1 ),
	array( 'db' => 'q111', 'dt' => 2 ),
	array( 'db' => 'merchant_name', 'dt' => 3 ),
	array( 'db' => 'cal_gen_name', 'dt' => 4 ),
	array(
        'db'        => 'status',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
			Global $admin_row;
			if($admin_row['type']==2){
				
				if($d==3) { 
					$data.='<span class="label label-success">DS Added</span>';
				
				} else if($d==4) { 
					$data.='<span class="label label-danger">In App que</span>';
				
				} else if($d==5) { 
					$data.='<span class="label label-success">DS & MOF added</span>';
				
				} else if($d==6) { 
					$data.='<span class="label label-warning">Incomplete App</span>';
				
				} else { 
					$data.='<span class="label label-default">Completed App</span>';
				}
				
			} else {
				
				$data='<select class="form-control input-xs" id="st'.$row[id].'" onchange="savestatus('.$row[id].')">';
				if($d==3) { 
					$data.='
						<option value="6">Incomplete App</option>
						<option value="2">Completed App</option>
						<option value="3" selected>DS Added</option>
						<option value="5">DS & MOF added</option>
						<option value="4">In App que</option>
					';
				
				} else if($d==4) { 
					$data.='
						<option value="6">Incomplete App</option>
						<option value="2">Completed App</option>
						<option value="3">DS Added</option>
						<option value="5">DS & MOF added</option>
						<option value="4" selected>In App que</option>
					';
				
				} else if($d==5) { 
					$data.='
						<option value="6">Incomplete App</option>
						<option value="2">Completed App</option>
						<option value="3">DS Added</option>
						<option value="5" selected>DS & MOF added</option>
						<option value="4">In App que</option>
					';
				
				} else if($d==6) { 
					$data.='
						<option value="6" selected>Incomplete App</option>
						<option value="2">Completed App</option>
						<option value="3">DS Added</option>
						<option value="5" >DS & MOF added</option>
						<option value="4">In App que</option>
					';
				
				} else { 
					$data.='
						<option value="6">Incomplete App</option>
						<option value="2" selected>Completed App</option>
						<option value="3">DS Added</option>
						<option value="5">DS & MOF added</option>
						<option value="4">In App que</option>
					';
				}
				
				$data.='</select>';
				
			}
			return $data;
        }
    ),
	array(
        'db'        => 'id',
        'dt'        => 6,
        'formatter' => function( $d, $row ) {
			Global $site_url;
			Global $admin_row;
			if($admin_row['type']==2){
				return '<a class="btn btn-primary btn-xs" target="_blank" href="'.$site_url.'/applications/view/'.$d.'/">View</a>
				<a class="btn btn-warning btn-xs" target="_blank" href="'.$site_url.'/applications/login/'.$d.'/">Login</a>
				';
			} else {
			return '<a class="btn btn-primary btn-xs" target="_blank" href="'.$site_url.'/applications/view/'.$d.'/">View</a>
					<a class="btn btn-warning btn-xs" target="_blank" href="'.$site_url.'/applications/login/'.$d.'/">Login</a>
					<a class="btn btn-danger btn-xs" target="_blank" href="'.$site_url.'/applications/delete/'.$d.'/" onclick="return confirm(\'Do you really want to delete?\');" >Delete</a>';
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

$extra="";
if($admin_row['type']==2) {
	$extra.= " AND cal_gen_id='".$admin_row['id']."'";
}

if(!empty($_GET['status'])){
		$status=$_GET['status'];
		if($status>=2) {
			$extra.= " AND status='".$status."'";
		}
}
echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, "q80!=''".$extra )
);

?>