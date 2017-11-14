<?php 

/*-----------------------------//
// NULL STRINGS                //
//-----------------------------*/

$user_id="";
$admin_id="";

/*-----------------------------//
// Admin Login Check Function  //
//-----------------------------*/

function admin_login_check($mysqli) {
	   if(isset($_SESSION['admin_id'], $_SESSION['admin_string'])) {
		 $user_id = $_SESSION['admin_id'];
		 $login_string = $_SESSION['admin_string'];
		 $ip_address = $_SERVER['REMOTE_ADDR'];
		 $user_browser = $_SERVER['HTTP_USER_AGENT'];
		 if ($stmt = $mysqli->prepare("SELECT password FROM admin WHERE id = ? LIMIT 1")) {
			$stmt->bind_param('i', $user_id);
			$stmt->execute();
			$stmt->store_result();

			if($stmt->num_rows == 1) {
			   $stmt->bind_result($password);
			   $stmt->fetch();
			   $login_check = md5($password.$ip_address.$user_browser);
			   if($login_check == $login_string) {
				  // Logged In!!!!
				  return true;
			   } else {
				  // Not logged in
				  return false;
			   }
			} else {
				// Not logged in
			  return false;
			}
		 } else {
			// Not logged in
			return false;
		 }
	   } else {
		 // Not logged in
		 return false;
	   }
}


/*-----------------------------//
// Insti Login Check Function  //
//-----------------------------*/

function inst_login_check($mysqli) {
	   if(isset($_SESSION['inst_id'], $_SESSION['inst_string'])) {
		 $user_id = $_SESSION['inst_id'];
		 $login_string = $_SESSION['inst_string'];
		 $ip_address = $_SERVER['REMOTE_ADDR'];
		 $user_browser = $_SERVER['HTTP_USER_AGENT'];
		 if ($stmt = $mysqli->prepare("SELECT password FROM institute WHERE id = ? LIMIT 1")) {
			$stmt->bind_param('i', $user_id);
			$stmt->execute();
			$stmt->store_result();

			if($stmt->num_rows == 1) {
			   $stmt->bind_result($password);
			   $stmt->fetch();
			   $login_check = md5($password.$ip_address.$user_browser);
			   if($login_check == $login_string) {
				  // Logged In!!!!
				  return true;
			   } else {
				  // Not logged in
				  return false;
			   }
			} else {
				// Not logged in
			  return false;
			}
		 } else {
			// Not logged in
			return false;
		 }
	   } else {
		 // Not logged in
		 return false;
	   }
}


/*-----------------------------//
// User Login Check Function   //
//-----------------------------*/

function login_check($mysqli) {
	   if(isset($_SESSION['user_id'], $_SESSION['user_string'])) {
		 $user_id = $_SESSION['user_id'];
		 $login_string = $_SESSION['user_string'];
		 $ip_address = $_SERVER['REMOTE_ADDR'];
		 $user_browser = $_SERVER['HTTP_USER_AGENT'];
		 $status = 1;
		 if ($stmt = $mysqli->prepare("SELECT password FROM users WHERE id = ? AND status = ? LIMIT 1")) {
			$stmt->bind_param('ii', $user_id, $status);
			$stmt->execute();
			$stmt->store_result();

			if($stmt->num_rows == 1) {
			   $stmt->bind_result($password);
			   $stmt->fetch();
			   $login_check = md5($password.$ip_address.$user_browser);
			   if($login_check == $login_string) {
				  // Logged In!!!!
				  return true;
			   } else {
				  // Not logged in
				  return false;
			   }
			} else {
				// Not logged in
			  return false;
			}
		 } else {
			// Not logged in
			return false;
		 }
	   } else {
		 // Not logged in
		 return false;
	   }
}



/*-----------------------------//
// Staff Login Check Function  //
//-----------------------------*/

function staff_login_check($mysqli) {
	   if(isset($_SESSION['staff_id'], $_SESSION['staff_string'])) {
		 $user_id = $_SESSION['staff_id'];
		 $login_string = $_SESSION['staff_string'];
		 $ip_address = $_SERVER['REMOTE_ADDR'];
		 $user_browser = $_SERVER['HTTP_USER_AGENT'];
		 $status = 1;
		 if ($stmt = $mysqli->prepare("SELECT password FROM staff WHERE id = ? AND status = ? LIMIT 1")) {
			$stmt->bind_param('ii', $user_id, $status);
			$stmt->execute();
			$stmt->store_result();

			if($stmt->num_rows == 1) {
			   $stmt->bind_result($password);
			   $stmt->fetch();
			   $login_check = md5($password.$ip_address.$user_browser);
			   if($login_check == $login_string) {
				  // Logged In!!!!
				  return true;
			   } else {
				  // Not logged in
				  return false;
			   }
			} else {
				// Not logged in
			  return false;
			}
		 } else {
			// Not logged in
			return false;
		 }
	   } else {
		 // Not logged in
		 return false;
	   }
}



/*-----------------------------//
// MAKE SLUGS                  //
//-----------------------------*/


function my_str_split($string)
{
	$slen=strlen($string);
	for($i=0; $i<$slen; $i++)
	{
		$sArray[$i]=$string{$i};
	}
	return $sArray;
}

function noDiacritics($string)
{
	//cyrylic transcription
	$cyrylicFrom = array('?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
	$cyrylicTo   = array('A', 'B', 'W', 'G', 'D', 'Ie', 'Io', 'Z', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Ch', 'C', 'Tch', 'Sh', 'Shtch', '', 'Y', '', 'E', 'Iu', 'Ia', 'a', 'b', 'w', 'g', 'd', 'ie', 'io', 'z', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'ch', 'c', 'tch', 'sh', 'shtch', '', 'y', '', 'e', 'iu', 'ia'); 

	
	$from = array("Á", "À", "Â", "Ä", "A", "A", "Ã", "Å", "A", "Æ", "C", "C", "C", "C", "Ç", "D", "Ð", "Ð", "É", "È", "E", "Ê", "Ë", "E", "E", "E", "?", "G", "G", "G", "G", "á", "à", "â", "ä", "a", "a", "ã", "å", "a", "æ", "c", "c", "c", "c", "ç", "d", "d", "ð", "é", "è", "e", "ê", "ë", "e", "e", "e", "?", "g", "g", "g", "g", "H", "H", "I", "Í", "Ì", "I", "Î", "Ï", "I", "I", "?", "J", "K", "L", "L", "N", "N", "Ñ", "N", "Ó", "Ò", "Ô", "Ö", "Õ", "O", "Ø", "O", "Œ", "h", "h", "i", "í", "ì", "i", "î", "ï", "i", "i", "?", "j", "k", "l", "l", "n", "n", "ñ", "n", "ó", "ò", "ô", "ö", "õ", "o", "ø", "o", "œ", "R", "R", "S", "S", "Š", "S", "T", "T", "Þ", "Ú", "Ù", "Û", "Ü", "U", "U", "U", "U", "U", "U", "W", "Ý", "Y", "Ÿ", "Z", "Z", "Ž", "r", "r", "s", "s", "š", "s", "ß", "t", "t", "þ", "ú", "ù", "û", "ü", "u", "u", "u", "u", "u", "u", "w", "ý", "y", "ÿ", "z", "z", "ž");
	$to   = array("A", "A", "A", "A", "A", "A", "A", "A", "A", "AE", "C", "C", "C", "C", "C", "D", "D", "D", "E", "E", "E", "E", "E", "E", "E", "E", "G", "G", "G", "G", "G", "a", "a", "a", "a", "a", "a", "a", "a", "a", "ae", "c", "c", "c", "c", "c", "d", "d", "d", "e", "e", "e", "e", "e", "e", "e", "e", "g", "g", "g", "g", "g", "H", "H", "I", "I", "I", "I", "I", "I", "I", "I", "IJ", "J", "K", "L", "L", "N", "N", "N", "N", "O", "O", "O", "O", "O", "O", "O", "O", "CE", "h", "h", "i", "i", "i", "i", "i", "i", "i", "i", "ij", "j", "k", "l", "l", "n", "n", "n", "n", "o", "o", "o", "o", "o", "o", "o", "o", "o", "R", "R", "S", "S", "S", "S", "T", "T", "T", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "W", "Y", "Y", "Y", "Z", "Z", "Z", "r", "r", "s", "s", "s", "s", "B", "t", "t", "b", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "w", "y", "y", "y", "z", "z", "z");
	
	
	$from = array_merge($from, $cyrylicFrom);
	$to   = array_merge($to, $cyrylicTo);
	
	$newstring=str_replace($from, $to, $string);   
	return $newstring;
}

function makeSlugs($string, $maxlen=0)
{
	$newStringTab=array();
	$string=strtolower(noDiacritics($string));
	if(function_exists('str_split'))
	{
		$stringTab=str_split($string);
	}
	else
	{
		$stringTab=my_str_split($string);
	}

	$numbers=array("0","1","2","3","4","5","6","7","8","9","-");
	//$numbers=array("0","1","2","3","4","5","6","7","8","9");

	foreach($stringTab as $letter)
	{
		if(in_array($letter, range("a", "z")) || in_array($letter, $numbers))
		{
			$newStringTab[]=$letter;
			//print($letter);
		}
		elseif($letter==" ")
		{
			$newStringTab[]="-";
		}
	}

	if(count($newStringTab))
	{
		$newString=implode($newStringTab);
		if($maxlen>0)
		{
			$newString=substr($newString, 0, $maxlen);
		}
		
		$newString = removeDuplicates('--', '-', $newString);
	}
	else
	{
		$newString='';
	}      
	
	return $newString;
}


function checkSlug($sSlug)
{
	if(ereg ("^[a-zA-Z0-9]+[a-zA-Z0-9\_\-]*$", $sSlug))
	{
		return true;
	}
	
	return false;
}

function removeDuplicates($sSearch, $sReplace, $sSubject)
{
	$i=0;
	do{
		
		$sSubject=str_replace($sSearch, $sReplace, $sSubject);         
		$pos=strpos($sSubject, $sSearch);
		
		$i++;
		if($i>100)
		{
			die('removeDuplicates() loop error');
		}
		
	}while($pos!==false);
	
	return $sSubject;
}


/*-----------------------------//
// GENERATE LINKS              //
//-----------------------------*/

function generatelink($name, $id, $page){
	 Global $site_url;
	 $link = makeSlugs($name);
	 $link = rtrim($link,"-");
	 // add deal id to link
	 if($id){
		 $link = $link.".".$id;
		}
	 $link = $site_url.'/'.$page.'/'.$link.'/';
	 return $link;
}



/*-----------------------------//
// Logged in user details      //
//-----------------------------*/

if(login_check($mysqli) == true) {
	$user_id=$_SESSION['user_id'];
	$user_query = "SELECT * FROM users WHERE id='$user_id'";
	$uuser_result=mysqli_query($mysqli,$user_query);
	$user_row = mysqli_fetch_assoc($uuser_result);
}


/*-----------------------------//
// Logged in staff details      //
//-----------------------------*/

if(staff_login_check($mysqli) == true) {
	$staff_id=$_SESSION['staff_id'];
	$staff_query = "SELECT * FROM staff WHERE id='$staff_id'";
	$staff_result=mysqli_query($mysqli,$staff_query);
	$staff_row = mysqli_fetch_assoc($staff_result);
}


/*-----------------------------//
// Truncate                    //
//-----------------------------*/

function truncate($text, $chars = 25) {
	$total = strlen($text);
	if($total>$chars){
		$chars=$chars-3;
		$text = substr($text,0,$chars).'...';
	}
	return $text;
}

/*-----------------------------//
// PAGINATION                  //
//-----------------------------*/

function pagination($total, $per_page = 10,$page = 1){      
	//clearfix
	//echo "<span class='clearfix'></span>";
	
	$cr_url = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$cr_url_core = explode("&page=", $cr_url);
	$cr_url = $cr_url_core[0];
	if (strpos($cr_url, '?') !== false) {
		$url = $cr_url."&page=";
	}
	 else {
		$url = $cr_url."?page=";
	}
						 
	$adjacents = "2"; 
	$page = ($page == 0 ? 1 : $page);  
	$start = ($page - 1) * $per_page;                               
	$prev = $page - 1;                          
	$next = $page + 1;
	$lastpage = ceil($total/$per_page);
	$lpm1 = $lastpage - 1;
	$pagination = "";
	if($lastpage > 1)
	{  
		$pagination .= '<nav><ul class="pagination">';
		
		if ($lastpage < 7 + ($adjacents * 2))
		{   
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
				$pagination.= "<li class='active'><a href='{$url}$counter'>$counter</a></li>";
				else
				$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";             
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))
		{
			if($page < 1 + ($adjacents * 2))     
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
					$pagination.= "<li class='active'><a href='{$url}$counter'>$counter</a></li>";
					else
					$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";                
				}
				$pagination.= "<li><a>...</a></li>";
				$pagination.= "<li><a href='{$url}$lpm1'>$lpm1</a></li>";
				$pagination.= "<li><a href='{$url}$lastpage'>$lastpage</a></li>";      
			}
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li><a href='{$url}1'>1</a></li>";
				$pagination.= "<li><a href='{$url}2'>2</a></li>";
				$pagination.= "<li><a>...</a></li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
					$pagination.= "<li class='active'><a href='{$url}$counter'>$counter</a></li>";
					else
					$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";                    
				}
				$pagination.= "<li><a>...</a></li>";
				$pagination.= "<li><a href='{$url}$lpm1'>$lpm1</a></li>";
				$pagination.= "<li><a href='{$url}$lastpage'>$lastpage</a></li>";        
			}
			else
			{
				$pagination.= "<li><a href='{$url}1'>1</a></li>";
				$pagination.= "<li><a href='{$url}2'>2</a></li>";
				$pagination.= "<li><a>...</a></li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
					$pagination.= "<li class='active'><a href='{$url}$counter'>$counter</a></li>";
					else
					$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";                   
				}
			}
		}
		
		if ($page < $counter - 1){ 
			$pagination.= "<li><a href='{$url}$next'>Next</a></li>";
			$pagination.= "<li><a href='{$url}$lastpage'>Last</a></li>"; 
		}
		$pagination.= "</ul></nav>";      
	}
	
	
	return $pagination;
}


/*-----------------------------//
// MYSQLI REAL ESCAPE          //
//-----------------------------*/

function mysqli_escape($a)
{
  global $mysqli;
  return mysqli_real_escape_string($mysqli, $a);
}


/*-----------------------------//
// INSERT INTO MYSQL           //
//-----------------------------*/

function mysql_insert_array($table, $data, $exclude = array()) {
	Global $mysqli;
    $fields = $values = array();
    if( !is_array($exclude) ) $exclude = array($exclude);
    foreach( array_keys($data) as $key ) {
        if( !in_array($key, $exclude) ) {
            $fields[] = "`$key`";
            $values[] = "'" . mysqli_real_escape_string($mysqli, $data[$key]) . "'";
        }
    }
    $fields = implode(",", $fields);
    $values = implode(",", $values);
    if( mysqli_query($mysqli, "INSERT INTO `$table` ($fields) VALUES ($values)") ) {
        return array( "mysqli_error" => false,
                      "mysqli_insert_id" => mysqli_insert_id($mysqli),
                      "mysqli_affected_rows" => mysqli_affected_rows($mysqli),
                      "mysqli_info" => mysqli_info($mysqli)
                    );
    } else {
        return array( "mysqli_error" => mysqli_error($mysqli) );
    }
}


/*-----------------------------//
// UPDATE MYSQL                //
//-----------------------------*/

function mysql_update_array($table, $data, $id, $exclude = array()) {
	Global $mysqli;

    if( !is_array($exclude) ) $exclude = array($exclude);
	$query ='';
	$i=1;
    foreach( array_keys($data) as $key ) {
        if( !in_array($key, $exclude) ) {
			if($i==1){
				$query.=$key."='" . mysqli_real_escape_string($mysqli, $data[$key]) . "'";
			} else {
				$query.=", ".$key."='" . mysqli_real_escape_string($mysqli, $data[$key]) . "'";
			}
            $i++;
        }
    }

    if( mysqli_query($mysqli, "UPDATE `$table` SET $query WHERE id='$id'") ) {
        return array( "mysqli_error" => false,
                      "mysqli_insert_id" => mysqli_insert_id($mysqli),
                      "mysqli_affected_rows" => mysqli_affected_rows($mysqli),
                      "mysqli_info" => mysqli_info($mysqli),
					  "query" => $query,
                    );
    } else {
        return array( "mysqli_error" => mysqli_error($mysqli) );
    }
}


/*-----------------------------//
// CHECK IF EMPTY              //
//-----------------------------*/

function IfEmpty($data) {
	$error ='';
    foreach( array_keys($data) as $key ) {
		if(empty($data[$key])){
			$error = "'".$key."' value is required.";
		}
    }
	return $error;
}



/*-----------------------------//
// FORMAT DATETIME            //
//-----------------------------*/
function formatdate($date, $type=''){
	if(!$date || $date=='0000-00-00'){
		return "-";
	} else {
		if($type){
			return date("d/m/Y", strtotime($date));
		} else {
			return date("d/m/Y - h:i A", strtotime($date));
		}
	}
}


/*-----------------------------//
// IMAGE RESIZE                //
//-----------------------------*/

function ak_img_resize($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
      $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
      $img = imagecreatefrompng($target);
    } else { 
      $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 80);
}


/*-----------------------------//
// STATUS                      //
//-----------------------------*/

function status($status) {
   if($status==0){
	   return '<span class="label label-warning">Inactive</span>';
   }
   if($status==1){
	   return '<span class="label label-success">Active</span>';
   }
   if($status==2){
	   return '<span class="label label-danger">Deleted</span>';
   }
}		


/*-----------------------------//
// INSTITUTE DETAILS           //
//-----------------------------*/

if(inst_login_check($mysqli) == true) {
	$inst_id=$_SESSION['inst_id'];
	$inst_query = "SELECT * FROM institute WHERE id='$inst_id'";
	$inst_result=mysqli_query($mysqli,$inst_query);
	$inst_row = mysqli_fetch_assoc($inst_result);
}


/*-----------------------------//
// USERS DETAILS               //
//-----------------------------*/

if(login_check($mysqli) == true) {
	$user_id=$_SESSION['user_id'];
	$user_query = "SELECT * FROM users WHERE id='$user_id'";
	$user_result=mysqli_query($mysqli,$user_query);
	$user_row = mysqli_fetch_assoc($user_result);
}



/*-----------------------------//
// LIST SECTIONS               //
//-----------------------------*/
function list_section($inst_id, $select='') {
    Global $mysqli;
	$query = "SELECT * FROM sections WHERE institute='$inst_id' ORDER BY name ASC";
	$result=mysqli_query($mysqli,$query);
	$data='<option value="">Select Section</option>';
	$selected='';
	while($row = mysqli_fetch_assoc($result)){
		if($row['id']==$select) {$selected="selected";}
		$data.='<option value="'.$row['id'].'" '.$selected.'>'.$row['name'].'</option>';
		$selected='';
	}
	return $data;
	mysqli_free_result($result);
}


function list_sectiona($inst_id, $select=array()) {
    Global $mysqli;
	$query = "SELECT * FROM sections WHERE institute='$inst_id' ORDER BY name ASC";
	$result=mysqli_query($mysqli,$query);
	$data='<option value="">Select Section</option>';
	$selected='';
	while($row = mysqli_fetch_assoc($result)){
		if (in_array($row['id'], $select)) { $selected="selected"; }
		$data.='<option value="'.$row['id'].'" '.$selected.'>'.$row['name'].'</option>';
		$selected='';
	}
	return $data;
	mysqli_free_result($result);
}


function list_teachers($inst_id, $select="") {
    Global $mysqli;
	$query = "SELECT * FROM staff WHERE institute='$inst_id' AND type='1' ORDER BY name ASC";
	$result=mysqli_query($mysqli,$query);
	$data='<option value="">Select Teacher</option>';
	$selected='';
	while($row = mysqli_fetch_assoc($result)){
		if ($row['id']==$select) { $selected="selected"; }
		$data.='<option value="'.$row['id'].'" '.$selected.'>'.$row['name'].' '.$row['lastname'].'</option>';
		$selected='';
	}
	return $data;
	mysqli_free_result($result);
}




/*-----------------------------//
// SECTIONS                    //
//-----------------------------*/
function section_info($id) {
    Global $mysqli;
	$query = "SELECT * FROM sections WHERE id='$id'";
	$result=mysqli_query($mysqli,$query);
	$row = mysqli_fetch_assoc($result);
	return $row;
	mysqli_free_result($result);
}



function userinfo($id) {
    Global $mysqli;
	$query = "SELECT * FROM users WHERE id='$id'";
	$result=mysqli_query($mysqli,$query);
	$row = mysqli_fetch_assoc($result);
	return $row;
	mysqli_free_result($result);
}


function instinfo($id) {
    Global $mysqli;
	$query = "SELECT * FROM institute WHERE id='$id'";
	$result=mysqli_query($mysqli,$query);
	$row = mysqli_fetch_assoc($result);
	return $row;
	mysqli_free_result($result);
}


/*-----------------------------//
// QUESTION TYPE	           //
//-----------------------------*/
function question_type($type) {
    if($type==1){
		return "Objective";
    }
	if($type==2){
		return "Descriptive";
    }
}


function BDates($strDateFrom,$strDateTo) {
    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}


/*-----------------------------//
// Leave Application           //
//-----------------------------*/
function leavestatus($status) {
   if($status==1){
	   return '<span class="label label-warning">Pending</span>';
   }
   if($status==2){
	   return '<span class="label label-success">Approved</span>';
   }
   if($status==3){
	   return '<span class="label label-danger">Rejected</span>';
   }
}

function attendancestatus($status) {
   if($status==1){
	   return '<span class="label label-success">Present</span>';
   }
   if($status==2){
	   return '<span class="label label-danger">Absent</span>';
   }
   if($status==3){
	   return '<span class="label label-warning">Leave</span>';
   } else {
		return '<span class="label label-info">NP</span>';
   }
}	

?>