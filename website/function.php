<?php

function getToken()
{
    if(!isset($_SESSION['user_token']))
    {
       $_SESSION['user_token'] = md5(uniqid());
    }
}
       
function checkToken ($token)
{
        if($token != $_SESSION['user_token']) 
        {
            header('location: 404.php');
            exit;
        }
}
                   
function getTokenField()
{
    return '<input type="hidden" name="token" value="'.$_SESSION['user_token']. '" />';
}
       
function destroyToken()
{
     unset($_SESSION['user_token']);
{
  
 function ProcessLogin($post)
{
   
      checkToken($post['token']);
      $conn = GetConnection();
  
      $username = mysql_real_escape_string($post['username']);
      $password = mysql_real_escape_string($post['pass']);
      //username = "' or 1=1#";
      $query = "Select * from user where username = '".$username.
      "' and password = sha1('".$password."') Limit 1 ";
   
      $results = mysql_query($query);
   
      if(mysql_numrows($results)>0)
      {
          $row = mysql_fetch_assoc($results);
          $_SESSIONS['LoggedIn'] = true;
          $_SESSIONS['id'] = $row['id'];
          $_SESSIONS['username'] = $row['username'];
        
          return true;
      }
      
      return false;
}
  
function UpdateContact($post)
{
    checkToken($post['token']);
    $conn = GetConnection();
  
    $fname = mysql_real_escape_string($post['fname']);
    $lname = mysql_real_escape_string($post['lname']);
    $email = mysql_real_escape_string($post['email']);
    $phone = mysql_real_escape_string($post['phone']);
    $catid = intval($post['catid']);
    $id = intval($post['id']);
  
    $query = 'update contact set fname = '".$fname."', lname = '".$lname.
    "', email = '".$email."', phone = '".$phone.
    "', catid = '".$catid."', where id = '".$id."'";
    
    $results = mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        return true;
    }
    
    return false;
}

function SaveContact($post)
{
    checkToken($post['token']);
    $conn = Getconnection();
    
    $fname = mysql_real_escape_string($post['fname']);
    $lname = mysql_real_escape_string($post['lname']);
    $email = mysql_real_escape_string($post['email']);
    $phone = mysql_real_escape_string($post['phone']);
    $catid = intval($post['catid']);
    
    $query = "insert into contacts(fname, lname, email, phone, catid) values(".
    "'".$fname."', '"$lname."', '".$email."', '".$phone.
    "', '".$catid."')";
    
    $results = mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        return true;
    }
    
    return false;
    
}

function UpdateCatergory($post)
{
    checkToken($post['token']);
    $conn = GetConnection();
    
    $catname = mysql_real_escape_string($post['catname']);
    $id = intval($post['id']);
    
    $query = "update categories set catname = '".$catname."' where id ='".$id."'";
    $results = mysql_query($query);
    
    if(mysql_affected_rows()>0)
    {
        return true;
    }
    return false;
}

function SaveCategory($post)
{
    checkToken($post['token']);
    $conn = GetConnection();
    
    $catname = mysql_real_escape_string($post['catname']);
    
    $query = "insert into catergories (catname) values('".$catname."')";
    
    $results = mysql_query($query);
    if(mysql_affected_rows()>0)
    {
          return true;
    }
    return false;
 }
 
 Function GetCategories()
 {
     $conn = GetConnection();
     
     $query = "select * from categories";
     $results = mysql_query($query);
     
     return $results;
}

function GetContacts(catId)
{
    $conn = GetConnection();
    
    $catId = intval ($catId);
    
    $query = "select * from contacts where catid = '$catId'";
    $results = mysql_query($query);
    return $results;
}

function GetContact($id)
{
    $conn = GetConnection();
    
    $id = intval($id)
{
    $query = "select * from contacts where id='$id'";
}
    ?>
