<?php 

session_start();
include 'core/config.php';
include 'core/functions.php';
if(admin_login_check($mysqli) == true) {

	$active="applications";

	$id="";
	if(!empty($_GET['id'])){$id=mysqli_real_escape_string($mysqli, $_GET['id']);}
	if(!$id){ header("Location:".$site_url."/applications/"); exit();}
	
	if(isset($_POST['pipedrive'])){
		$dealid = $_POST['dealid'];
		if($dealid){
			$pdurl = "https://api.pipedrive.com/v1/deals/".$dealid."?api_token=f6372ae7757e04f1297d8ab93c811cff33bfd008";
			$data = file_get_contents($pdurl);
			$data = json_decode($data);
			$save = array();
			
			if($data->data->{'org_name'}){
				$save['q80']=$data->data->{'org_name'};
			}
			
			if($data->data->{'d0c7f45879a3f65ce8f887abfca9a8c51c7665f6'}){
				$save['q116']=$data->data->{'d0c7f45879a3f65ce8f887abfca9a8c51c7665f6'};
			}


			if($data->data->{'961a9926671f02ed01f503d63d3ed1d955530b4d'}){
				$save['q117']=$data->data->{'961a9926671f02ed01f503d63d3ed1d955530b4d'};
			}



			if($data->data->{'b987aca4f3afdafc33cbdde9b3fb5b66cf066cdb'}){
				$save['q117b']=$data->data->{'b987aca4f3afdafc33cbdde9b3fb5b66cf066cdb'};
			}

			if($data->data->{'b38933c265863489114ca9afe67643d8313590b7'}){
				$save['q117a']=$data->data->{'b38933c265863489114ca9afe67643d8313590b7'};
			}

			if($data->data->{'b15a004610a2b406b570b94ddabe8466b38167da'}){
				$save['qn2a']=$data->data->{'b15a004610a2b406b570b94ddabe8466b38167da'};
			}


			if($data->data->{'83045df2b77104a9a5ad0daf788a2c524048158d'}){
				$save['q109']=$data->data->{'83045df2b77104a9a5ad0daf788a2c524048158d'};
			}

			if($data->data->{'54de7bc9f9a9154460edcefaeffba2ccfcf2d28e'}){
				$save['q112']=$data->data->{'54de7bc9f9a9154460edcefaeffba2ccfcf2d28e'};
			}
			
			
			$insert_data = mysql_update_array('user_answers', $save, $id, array('FormSubmit'));
			$info = "Pipedrive data synchronization successful!";
			
		} else {
			$error = "Something went wrong, please try again!";
		}
	}
	
	if ($_FILES['docusign']['size'] == 0 && $_FILES['docusign']['error'] == 0 && !$row['docusign']){

	} else {
		$path = $_FILES['docusign']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$uploaddir = "uploads/docusign/";
		$name = $id."-".time()."-docusign.".$ext;
		$uploadfile = $uploaddir.$name;
		move_uploaded_file($_FILES['docusign']['tmp_name'], $uploadfile);
		
		$update = "UPDATE user_answers SET docusign='$name' WHERE id='$id'";
		$update = mysqli_query($mysqli, $update);
		
	}
	
	$query = "SELECT * FROM user_answers WHERE id='$id'";
	$result=mysqli_query($mysqli,$query);
	$row = mysqli_fetch_assoc($result);
	
	if($admin_row['type']==2 && $row['cal_gen_id']!=$admin_row['id']) {
		header("Location:".$site_url."/applications/"); exit();
	}
	
	include("template/header.html");
	include("template/applications-view.html");
	include("template/footer.html");

}
else {
	
	$length = 200;
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header("Location:".$site_url."/login/?ref=".$actual_link);
}

?>