<?php

//header('Content-type: application/json');

// Array 3 dimensi

$test = array(
    array("nama" => "amy", 
          "umur" => "21",
          "mapel" => array("mtk", "bindo")),
    array("name" => "ghazi",
          "umur" => "21",
          "mapel" => array("mtk", "bindo")),
    array("name" => "arhab",
          "umur" => "5",
          "mapel" => array("mtk", "bindo"))
    );

$datas = array("data" => $test);

$test1 = array(
        "nama" => "ghazi",
        "umur" => "21",
        "name" => "annazmy"
        );

//echo json_encode($datas);

foreach ($test1 as $key => $val) {
    echo $key['nama'];
}
?>