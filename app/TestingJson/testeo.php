<?php


$content =     file_get_contents("https://jsonplaceholder.typicode.com/posts/");

$result  = json_decode($content);




foreach($result as $item=>$it){
    var_dump($result);

    echo ($result->result[0]->userId);

}
