<?php


    function testEmptyHome($p,$default)
    {
        if(empty($p))
        {
            header('location: ./?page='.$default);
        }
    }


    function protect($p)
    {
        $p = trim(htmlspecialchars($p));
        return $p;
    }
    
     
function str_truncate($text, $length){
    if(strlen($text) <= $length) return $text;
    return trim(substr($text, 0, $length));
}
    

?>