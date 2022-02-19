<?php 
namespace demo;

require_once('param.php');

use function param\Handle as handleParam;

//操作参数
function handle(){
    $pl = ["a"=>1, "b"=>"2.01", "c"=>"abc", "d"=>""];
    $cml = [
        ["name"=>"a", "mustSet"=>true, "notEmpty"=>true, "type"=>"string", "default"=>""],
        ["name"=>"b", "mustSet"=>true, "notEmpty"=>true, "type"=>"float", "default"=>""],
        ["name"=>"c", "mustSet"=>true, "notEmpty"=>true, "type"=>"float", "default"=>""],
        ["name"=>"d", "type"=>"bool", "default"=>""],
        ["name"=>"e", "type"=>"int", "default"=>123]
    ];

    $r = handleParam($pl, $cml);
    var_dump($r);
}

checkParam();

?>