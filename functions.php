<?php

function password_equals($pass1,$pass2){

if($pass1 != $pass2)
{
  return false;
}
else
{
  return true;
}

}
  

function validate_password($pass1){

$reg_pass = '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
if(!preg_match($reg_pass,$pass1))
{
  return false;
}
else
{
  return true;
}
}

function clean($data){
$data=trim(htmlspecialchars($data));
$data2=stripslashes($data);
return $data2;
}


function redirect_if_already_loged_in()
{
    if(isset($_SESSION['id']))
    {
        
        header("location:home.php");
    }
}

?>