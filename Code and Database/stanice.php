 <?php
            $sql = "SELECT * FROM stanica";
            $result = $conn->query($sql);
            $id=0;
            $brojstanica=0;
            $slike=array();
            $mjesta=array();
            $adrese=array();
            $natkriveno=array();
            $telefon=array();
            if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
            
            
                 $sql5 = "SELECT  distinct do  from relacija WHERE od='".$row['mjesto']."' order by do";
               // $sql5 = "SELECT do FROM relacija where od='".$row['od']."'";
                $result5 = $conn->query($sql5);
                  if ($result5->num_rows > 0) {
               while($row5 = $result5->fetch_assoc()) {
                echo  '<span style="display: none;" class="tacke'.$id.'">'.$row5['do']. '</span><br>';
            
            
               }
            
             }
            
                $loc=$row['latlng'];
                echo  '<span class="none" id="s'.$id.'">'.$loc. '</span><br>';
                $slike[$i]=$row['slika'];
                echo  '<span class="none" id="slika'.$id.'">'.$slike[$i]. '</span><br>';
                $mjesta[$i]=$row['mjesto'];
                echo  '<span class="none" id="adresa'.$id.'">'.$adrese[$i]. '</span><br>';
                $adrese[$i]=$row['adresa'];
                echo  '<span class="none" id="telefon'.$id.'">'.$telefon[$i]. '</span><br>';
                $telefon[$i]=$row['telefon'];
                 echo  '<span class="none" id="mjesto'.$id.'">'.$mjesta[$i]. '</span><br>';
                  $natkriveno[$i]=$row['natkriveno'];
                 echo  '<span class="none" id="natkriveno'.$id.'">'.$natkriveno[$i]. '</span><br>';
                $brojstanica=$brojstanica+1;
            
                $id=$id+1;
               }
               $brojstanica=$brojstanica-1;
               echo  '<span class="none" id="brojs">'.$brojstanica. '</span><br>';
             }
            
            ?>