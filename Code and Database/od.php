<?php 
  $sql = "SELECT * FROM relacija ORDER BY od";
  $result = $conn->query($sql);
  $id=0;
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $ime=$row['od'];
      $ll=$row['odLatLng'].' - '.$row['doLatLng'];
      echo '<option value= "'.$ime.'" id="'.$id.'" id="'.$ime.'">' .$ime. '</option>';
      $id=$id+1;
    }
    echo '</select>';
   } 
  else {
    echo "0 results";
  }
?>