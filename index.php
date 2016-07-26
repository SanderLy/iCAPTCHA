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
    $arrayVal = $db->getValuesInDB();#store the content of record into array
    $arrayIndices = explode(" ", $arrayVal[2]);#converts the content of str content of arrayVal into array

    #Load the question from the db based on the shuffled indices
    $question = $db->loadQuestion($arrayIndices[$arrayVal[1]]);
    print_r($arrayVal);echo '<br>';
    print_r($arrayIndices); echo '<br>';
    print_r($question);echo '<br>';
  }
  ?>
  <br>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    Question: <?php echo $question[1]; ?><br>
    Current Index: <?php echo $arrayVal[1]?><br>
    Answer: <input type="text" name="answer" placeholder="Type your answer here"><br>
    <input type="submit">
  </form>
  <?php  echo $_POST['answer'];?>
</body>
</html>