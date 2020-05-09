<?php
  $brojB=0;
  $sql = "SELECT distinct do from relacija";
  $result = $conn->query($sql);
  $id=0;
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $sql1 = "SELECT distinct od  from relacija WHERE do='".$row['do']."'";
      $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
          echo '<div class="none" id="popup'.$id.'">Lokacija:';
          $sql2 = "SELECT distinct doLatLng  from relacija WHERE do='".$row['do']."'";
          $result2 = $conn->query($sql2);
          if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
              $loc=$row2['doLatLng'];
              echo '<span class="marginbottom" id="p'.$id.'">'.$loc.'</span>Grad: ';
            }
          }
        echo $row['do'].'<br>'.'<br>';
        echo 'Moguća odredista:'.'<br>';
        echo '<div id="premabih">';
        $ii=0;
        // echo  '<span id="popup'.$id.'">'.$loc.'</span><br>';
        while($row1 = $result1->fetch_assoc()) {
          if($ii%2==0)
            echo "<div style='background-color:#ffffff ;color: #24344b;text-align: center;'>".$row1['od']."</div>";
          else
            echo "<div style='ackground-color: #e7e7e7 ;color: #fffff;text-align: center;'>".$row1['od']."</div>";
         $ii=$ii+1;
        }
        echo'</div>';
        echo '</div>';
       }
       $id=$id+1;
      }
      $brojB=$id;
      echo '<span style="display: none;" id="bb">'.$brojB.'</span>';
    }
?>