<?php
    require('db.php');
    $namefull='';
    $email='';
    $payam='';
    $filename='';

    if (isset($_POST['namefull'])){
        $namefull=$_POST['namefull'];
        $email=$_POST['email'];
        $payam=$_POST['payam'];
        $filename=$_POST['filename'];
        if ($filename=='nazar.html'){
            mysqli_query($db," INSERT INTO `payam_user`(`namefull`, `email`, `payam`) VALUES ('$namefull','$email','$payam') ");
        }else{
            mysqli_query($db," INSERT INTO `nazar_user`(`namefull`, `email`, `nazar`) VALUES ('$namefull','$email','$payam') ");
        }
        echo $namefull;
        
    }
?>