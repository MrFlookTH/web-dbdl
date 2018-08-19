<?php
    function alert($message){
        echo "<script>alert('".$message."')</script>";
    }
    function alertGoTo($message, $url){
        echo "<script>alert('".$message."'); window.location='".$url."'</script>";
    }
    function stripTagBr($text) {
        return strip_tags($text, '<p><a><span>');
    }
?>