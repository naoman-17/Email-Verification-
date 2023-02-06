<?php

    include("connection.php");

    if(isset($_GET['vemail']) && isset($_GET['vcode']))
    {
        $query="SELECT * FROM verified where email='$_GET[vemail]' AND verifyc='$_GET[vcode]'";
        $result=mysqli_query($conn,$query);
        if($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                $update="UPDATE verified SET status='1' WHERE email='$_GET[vemail]' ";
                if(mysqli_query($conn,$update))
                {
                    echo
                    "<script>
                    alert('VERIFICATION DONE ;-)');
                    window.location.href='../login.html';
                    </script>";
                }
            }
        }
    }

?>