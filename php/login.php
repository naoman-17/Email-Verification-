<?php

    include("connection.php");

    $user=$_GET["email"];
    $query="select * from verified where email='$user'";
    $chkstatus="select * from verified where email='$user' && status='1'";
    $data=mysqli_query($conn,$query);
    $data1=mysqli_query($conn,$chkstatus);
    $total=mysqli_num_rows($data);
    $total1=mysqli_num_rows($data1);
    if($total1==1)
    {
        if($total==1)
        {
            header('Location:../welcome.html');
        }
        else
        {
            $alert=
                "<script>
                    alert('NO USER FOUND');
                    window.location.href='../index.html';
                </script>";
            echo $alert;
        }
    }
    else{
        $alert=
        "<script>
            alert('EMAIL VERIFICATION NOT COMPLETED');
            window.location.href='../login.html';
        </script>";
    echo $alert;
    }
?>