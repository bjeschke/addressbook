<?php

require_once(dirname(dirname(__FILE__))."/_config/_settings.php");

class UserDataBase
{

  function UserDataBase()
  {
    $this->db_host = const_db_host;
    $this->db_name = const_db_name; 
    $this->user_name = const_user_name;
    $this->user_password = const_user_password;
  }// datenbank()

 /*
  *  Stellt eine Verbindung zur Datenbank her
  */  
  function open_db()
  {
    $bit_return = 0;
    
    $con = mysqli_connect($this->db_host, $this->user_name, $this->user_password);
  
    if(false === $con)
      die(mysql_connect_error());
    
    return $con;
  }// open_db()
    
    
 /*
  *  Wählt die Datenbank aus
  */  
  function select_db($str_db_name)
  {
    $con = $this->open_db();
      
    mysqli_select_db($con, $str_db_name );
      
    return $con;
  }// select_db

     
 /*
  *  
  */  
  function insert($str_query)
  {
    $con= $this->select_db($this->db_name);
       
    $res = mysqli_query($con, $str_query);
         
    if(false === $res)
      {
      mysqli_rollback($con);
      die(mysqli_error()); 
      $bit_return = false;       
    }
       
    $bit_return = mysqli_commit($con);        
    $this->close_db($con);  
      
    return $bit_return;
  }// get_result()
      
 /*
  *  
  */      
  function get_result($str_query)
  {
    $array_zeile = array();
    $array_result = array();
        
    $con = $this->select_db($this->db_name);
              
    $result = mysqli_query($con, $str_query);
    $counter = 0;
    if($result)
      while($array_zeile = mysqli_fetch_assoc($result))
      {             
        foreach($array_zeile as $str_feld_name => $str_wert)
              $array_result[$counter][$str_feld_name] = $str_wert;
                $counter++;
      }
    $this->close_db($con);
          
    return $array_result;
  }// get_result()

  function update($str_query)
  {
    $con = $this->select_db($this->db_name);
              
    mysqli_query($con, $str_query);

    $this->close_db($con);
  }

  function delete($str_query)
  {
        
    $con = $this->select_db($this->db_name);
              
    mysqli_query($con, $str_query);

    $this->close_db($con);
  }

  function countData($str_query){
    $con = $this->select_db($this->db_name);      
        
    $result = mysql_query($str_query);
    $anzahl=mysql_fetch_row($result);

    $this->close_db($con);
        
    return $result;
  }
      
  function close_db($con)
  {
    $bit_return = mysqli_close($con);
        
    return $bit_return;
  }// close_db

}// datenbank

?>

