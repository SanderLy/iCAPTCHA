<?php 
    class dbfunctions{
    	var $ipaddress = '';
    	var $servername = 'localhost';
    	var $username = 'root';
    	var $password = '';
    	var $indices = array();
    	var $sql_query;
    	var $retrieve_query;
		var $row_query;

		#<--------------------check the connection of the server---------------------------->	
    	function checkConnection(){
       	$conn = new mysqli($this->servername,$this->username,$this->password);
      	if ($conn->connect_error) {
      		die("Connection failed: " . $conn->connect_error);
      		}
    	}
    	
    	#<--------------------Getting the IP address of the client-------------------------->
    	function getIPAddress (){
    		$this->ipaddress;
		    if (getenv('HTTP_CLIENT_IP'))
		        $ipaddress = getenv('HTTP_CLIENT_IP');
		    else if(getenv('HTTP_X_FORWARDED_FOR'))
		        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		    else if(getenv('HTTP_X_FORWARDED'))
		        $ipaddress = getenv('HTTP_X_FORWARDED');
		    else if(getenv('HTTP_FORWARDED_FOR'))
		        $ipaddress = getenv('HTTP_FORWARDED_FOR');
		    else if(getenv('HTTP_FORWARDED'))
		        $ipaddress = getenv('HTTP_FORWARDED');
		    else if(getenv('REMOTE_ADDR'))
		        $ipaddress = getenv('REMOTE_ADDR');
          return $ipaddress;
    	}

    	#<-------------------------Check the record of IP in the DB------------------------->
    	function searchIP(){
   			$this->ipaddress;
   			$this->sql_query;
    		$this->retrieve_query;
        $this->row_query;
   			$conn = new mysqli($this->servername,$this->username,$this->password);
   			$ipaddress = $this->getIPAddress();
   			mysqli_select_db($conn,'questions');
   			$sql_query= 'SELECT * from used WHERE id="'.$ipaddress.'"';
   			if(mysqli_query($conn, $sql_query)){
          $retrieve_query = mysqli_query($conn, $sql_query);
          if($row_query = mysqli_fetch_row($retrieve_query)){
            return True;
          }else{
            return False;
          }
        }else{
          die("Error in database: ". mysqli_error($conn));
        }
    	}    	

    	#<--------------------Getting of number of records in database---------------------->
    	function getNumberOfQuestions(){
    		$conn = new mysqli($this->servername,$this->username,$this->password);
    		mysqli_select_db($conn,'questions');
    		$this->sql_query;
        $this->retrieve_query;
			  $this->row_query;
        $sql_query = 'SELECT COUNT(*) from captchaq';
        if(mysqli_query($conn, $sql_query)){
          $retrieve_query = mysqli_query($conn, $sql_query);
          $row_query  = mysqli_fetch_row($retrieve_query);
          return $row_query[0]; 
        }else{
          die("Error in database: ". mysqli_error($conn));
        }
        
    	}
    	#<----------Populate the array according to the number of Questions----------------->
    	function populateArray(){
    		$this->indices;
    		$len = $this->getNumberOfQuestions();
    		for ($i=0; $i < $len; $i++) { 
		    	$indices[$i] = $i;
		    	$indices[$i];
  			}
  			return $indices;
    	}
    	#<--------------------------Fisher-Yates Shuffle Algorithm-------------------------->
    	function FisherYatesShuffle(){
    		$this->indices = $this->populateArray();
    		print_r ($this->indices);
    		for ($i=count($this->indices) - 1; $i > 0 ; $i--) { 
  		  	$prng = rand(0, $i); #randomization max value is decreased
    		  #swapping
	    	  $temp = $this->indices[$prng]; #store before overwrite
	    	  $this->indices[$prng] = $this->indices[$i]; #swap randomized index with last index
	    	  $this->indices[$i] = $temp; #swap last index with randomized index stored in temp before theswap   
	  		}
        return $this->indices;
    	}
      #<--------------------------Insert a record inside the DB--------------------------->    
      function insertRecord($strIndices){
        echo '<br><br>'. $this->searchIP();
        $conn = new mysqli($this->servername,$this->username,$this->password);
        mysqli_select_db($conn,'questions');
        $this->sql_query;
        $this->retrieve_query;
        $this->row_query;
        $sql_query = 'INSERT INTO used (id,current_index,stack_indices) VALUES ("'.$this->getIPAddress().'",0,"'.$strIndices.'")';
        if(mysqli_query($conn, $sql_query)){

        }else{
          die("Error in database: ". mysqli_error($conn));
        }
      }
    }

 ?>