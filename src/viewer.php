<?php

$file = 'credentials/CURL.pdf';
header('Content-type:application/pdf');
header('Contetnt-Description:inline;filename="' .$file .'"');
header('Content-Transfer-Encoding:binary');
header('Accept-ranges:bytes');
@readfile($file);

?>  