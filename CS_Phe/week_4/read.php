<?php
    if (isset($_POST['val']))
    {
        $myJSON = json_encode($_POST['val']);

        echo $myJSON;
    }
?>