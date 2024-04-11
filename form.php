<?php
  
    if (isset($_POST['s1'])) {
      echo "Thanks for submitting your information, We will contact you as soon as possible. ";
      $myfile = fopen("data.xls", "a") or die("Unable to open file");
      $name = $_POST['name']."\n";
      fwrite($myfile, $name);

      $phone = $_POST['phone']."\n";
      fwrite($myfile, $phone);

      $id = $_POST['id']."\n";
      fwrite($myfile, $id);

      $email = $_POST['email']."\n";
      fwrite($myfile, $email);

      $optional = $_POST['optional']."\n"."\n";
      fwrite($myfile, $optional);


      fclose($myfile);
    }
  ?>
