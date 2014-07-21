<?php

class database
{
   private $con;
   private $host = "localhost";
   private $user = "root"; 
   private $passwd = "tguh";
   private $db = "php_map";
   
   function __construct(){
        $this->start_con();
   }
   function start_con(){
       if(!$this->con = mysql_connect($this->host,$this->user,$this->passwd))
              die('Can not connect mysql server local');
   }
   function close_con(){
       return mysql_close($this->con);
   }
   function sqlquery($sql){
       if(!$this->con = mysql_connect($this->host,$this->user,$this->passwd))
              die('Can not connect mysql server local');
       mysql_select_db($this->db);
	return mysql_query($sql);
   }
   function jumrec($sql){ //jumlah hasil
	   if($hasil=$this->sqlquery($sql))
	   		$jum=mysql_num_rows($hasil);
		else
			$jum=0;
	   return $jum;
   }
   function datasql($sql){
            $data = array();
	     if($hasil=$this->sqlquery($sql))
		 	$data=mysql_fetch_array($hasil,MYSQL_BOTH);
            return $data;
   }
   function fetchdata($sql){
   		 $res = array();
	     if($hasil=$this->sqlquery($sql))
			 while($data=mysql_fetch_array($hasil)){
				$res[] = $data;
			 }
		 return $res;
   }

}
?>
