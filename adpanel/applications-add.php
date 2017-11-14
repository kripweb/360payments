<?php 

session_start();
include 'core/config.php';
include 'core/functions.php';
if(admin_login_check($mysqli) == true) {

	$active="calculator";
	$title="Merchants Add";
	
	$info="";
	$error="";
	
	if(isset($_POST['FormSubmit'])){
		extract($_POST);
		$check['email']=$_POST['email'];
		$error = IfEmpty($check);
		if($error){
			echo $error;
		} else {
			$query = "SELECT * FROM user_answers WHERE email='$email'";
			$query=mysqli_query($mysqli,$query);
			$total_email=mysqli_num_rows($query);
			if($total_email>=1 && ($email!='ddistenfield@360payments.com' && $email!='derekbelldistenfield@gmail.com' && $email!='KRussell@360payments.com' && $email!='derekdistenfield@hotmail.com')){
				$error="This email is already associated with a quote.";
			} else {
				
				$save['firstname']=$firstname;
				$save['lastname']=$lastname;
				$save['q111']=$firstname." ".$lastname;
				$save['email']=$email;
				$save['password']=$pass;
				$save['q80']=$name;
				$save['qn1']=$email;
				$save['q114a']=$contact;
				$save['q85a']=$contact;
				$save['cal_contact']=$contact;
				$save['cal_gen_id']=$admin_row['id'];
				$save['cal_gen_name']=$admin_row['name'];
				$save['addedon']=date("Y-m-d H:i:s");
				$insert_data = mysql_insert_array('user_answers', $save, array(''));
				if($insert_data['mysqli_error']==false){
					$info = "Merchant added successfully!";
					$_POST = array();
					
				} else {
					$error = $insert_data['mysqli_error'];
				}
			}
			
		}
	}	
	
	
	include("template/header.html");
	include("template/applications-add.html");
	include("template/footer.html");

}
else {
	
	$length = 200;
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header("Location:".$site_url."/login/");
}

?>