<?php
require_once "cssPropertyCheck.php";

$result=CPC::cssPropCheck("div","font-color");
if(is_string($result)){
    echo $result;
}else{
    echo "CSSプロパティは正しいです<br>Correct CSS property.";
}
?>
