<?php
  include 'database.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
  $db = new dbfunctions;
  $shuffled_indices = array();
  if(!($db->searchIP())){
      $shuffled_indices = $db->FisherYatesShuffle();
      print_r($shuffled_indices);
      $strIndices =  implode( " ", $shuffled_indices); #convert the shuffled array in
      $db->insertRecord($strIndices);
	}else{
    #if the ip address exists in the db

    $arrayVal = array_merge(array(),$db->getValuesInDB());#converts the content of record into array
    print_r($arrayVal);
  }  
?>
</body>
</html>