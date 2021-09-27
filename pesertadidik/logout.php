<?php

session_start();
session_destroy();
echo "
    <script>
        alert('Logout Success');
        document.location.href='../'
    </script>
";

?>