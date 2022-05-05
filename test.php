<?php

$fromdate = '06/05/2022';
var_dump($fromdate); 
var_dump(strtotime(date("d/m/Y"))); 
var_dump(strtotime($fromdate)); 


if(strtotime(date("d/m/Y")) > strtotime($fromdate)){
    echo "true";
}
else{
    echo "false";
    var_dump(strtotime("03/05/2022"));
}
?>