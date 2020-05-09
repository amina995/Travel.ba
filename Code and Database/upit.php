<?php 
  if (isset($_POST["name"])){
    $userInfo=$_POST["name"];
    $pieces = explode(":", $userInfo);
    $relacija=@$pieces[1];
    $cijena=@$pieces[0];
    echo '<div id="podaci">'.'<span id="rel">'.$relacija.'</span>';
    echo '<br>';
    echo 'Max. cijena: ' .$cijena.' KM </div>';
    echo '<hr>';
    echo "Rezultat upita:<br>";
    $sql = "SELECT * FROM relacija WHERE cijena<= '".$cijena."'  ORDER BY cijena";
    $result = $conn->query($sql);
    $id=0;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $ime=$row['od'].' - '.$row['do'];
        $counter=0;
        if($ime==$relacija){ 
          //echo 'hi';
          $counter=$counter+1;
          $ll=$row['odLatLng'].' - '.$row['doLatLng'];
            if (isset($_POST["gotovo"])){
              $prva=explode(",", $row['odLatLng']);
              $druga=explode(",", $row['doLatLng']);
              echo '<div class="none" id="prvaLat">'.@$prva[0].'</div>';
              echo '<div class="none" id="prvaLng">'.@$prva[1].'</div>';
              echo '<div class="none" id="drugaLat">'.@$druga[0].'</div>';
              echo '<div class="none" id="drugaLng">'.@$druga[1].'</div>';
            }
            $agencija=$row['agencija'];
            $cijenaRelacije=$row['cijena'];
            $autobus=$row['tipAutobusa'];
            //echo '<option selected="selected" value= "'.$ime.'" id="'.$id.'" id="'.$ime.'">' .$ime. '</option>';
            $sql1 = "SELECT * FROM agencija WHERE aID= ".$agencija;
            $result1 = $conn->query($sql1);
            $id=0;
            if ($result1->num_rows > 0) {
              while($row1 = $result1->fetch_assoc()) {
                if ($cijenaRelacije==0){
                  $cijenaRelacije="Kontaktirati agenciju.";
                }
                else
                  $cijenaRelacije=$cijenaRelacije.' KM';
                  $agencija=$row1['ime'];
                  $stranica=$row1['stranica'];
                  echo '<div id="informacije">';
                  echo '<div id="red"><b>AGENCIJA<br></b> '.$agencija.'</div>';
                  echo '<div id="red"><b>CIJENA<br></b> '.$cijenaRelacije.'</div>';
                  echo '<div id="red"><b>TELEFON</b><br> '.$row1['telefon'].'</div>';
                  echo '<div id="red1"><b>INFO<br></b><i><a href="'.$stranica.'">'.$stranica.'</a></i></div></div>';
                  
                  $sql2 = "SELECT * FROM autobus WHERE bID=".$autobus;
                  $result2 = $conn->query($sql2);
                  $id=0;
                  if ($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) {
                      echo '<div id="informacije1">';
                      if($row2['punjac']==1)
                        echo '<img id="slicice" src="images/punjac.png">';
                      if($row2['hrana']==1)
                        echo '<img id="slicice" src="images/hrana.png">';
                      if($row2['internet']==1)
                        echo '<img id="slicice" src="images/internet.png">';
                        echo '</div>';
                    }
                  }
                  
                }
              }
               $id=$id+1;
            }
          }
          if($id!=0)
            echo '<button id="ruta" onClick="mapa()">'.'Pokaži na mapi'.'</button><br>';
          echo '</select>';
        } 
        else {
          echo "0 results";
      }                 
    }
?>