<?php
    ini_set("sendmail_from","jaykradadiya2001@gmail.com");
    $to="jayradadiya8@gmail.com";
    $sub="this is subject";
    $mess="thia is a message";
    $header="From:jaykradadiya2001@gmail.com \r\n";
    
    $res=mail($to,$sub,$mess,$header);
    if($res==true)
    {
        echo "true";
    }
    else
    {
        echo "fail";
    }

?>