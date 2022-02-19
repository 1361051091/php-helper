<?php 

namespace param;

/*
** 操作参数
** pl：参数列表
** cml：检测规则，支持：
******  name（参数名，必传） 
******  type（类型转换） 
******  default（默认值填充） 
******  mustSet（必填检测） 
******  notEmpty（非空检测） 
*/
function Handle(array $pl, array $cml){
    $r = ["error"=>"", "data"=>array()];
    try{
        foreach ($cml as $cmd){
            if (empty($cmd["name"])){
                $r["error"] = "参数名必传";
                return $r;
            }else{
                if (!empty($cmd["mustSet"]) && !isset($pl[$cmd["name"]])){
                    $r["error"] = "参数".$cmd["name"]."不存在";
                    return $r;
                }
                if (!empty($cmd["notEmpty"]) && empty($pl[$cmd["name"]])){
                    $r["error"] = "参数".$cmd["name"]."不能为空";
                    return $r;
                }
                if (isset($cmd["type"]) && isset($pl[$cmd["name"]])){
                    switch ($cmd["type"]){
                        case "int":{
                            $pl[$cmd["name"]] = intval($pl[$cmd["name"]]);
                        }break;
                        case "string":{
                            $pl[$cmd["name"]] = strval($pl[$cmd["name"]]);
                        }break;
                        case "bool":{
                            $pl[$cmd["name"]] = boolval($pl[$cmd["name"]]);
                        }break;
                        case "float":{
                            $pl[$cmd["name"]] = floatval($pl[$cmd["name"]]);
                        }break;
                    }
                }
                if (isset($pl[$cmd["name"]])){
                    $r['data'][] = array($cmd["name"]=>$pl[$cmd["name"]]);
                }else if (isset($cmd["default"])){
                    $r['data'][] = array($cmd["name"]=>$cmd["default"]);
                }
            }
        }
    }catch(Exception $e){
        $r["error"] = $e->getMessage();
        return $r;
    }

    return $r;
}






?>  