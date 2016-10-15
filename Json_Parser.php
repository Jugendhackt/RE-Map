<?php
header('charset: UTF-8');
$url = "http://www.berlin.de/umwelt/themen/abfall/verschenken-statt-wegwerfen/index.php/index.json?q=";
if(!empty($_GET['q'])){
    $url = $url . $_GET['q'];
}
$final_json = [];

// Read Json and print better Json
function read_json($json, $final_json){
    $object = json_decode($json, true);
    if($object['results']['count'] === 0){
        echo("False");
        die();
    }

    foreach($object['index'] as $item){
        $final_array['name'] = "Keine Angabe";
        $final_array['gueter'] = "Keine Angabe";
        $final_array['transport'] = "Keine Angabe";
        $final_array['time'] = "Keine Angabe";
        $final_array['street'] = "Keine Angabe";

        if(!empty($item['name'])) $final_array['name'] = $item['name'];
        if(!empty($item['gueter'])) $final_array['gueter'] = $item['gueter'];
        if(!empty($item['transport'])) $final_array['transport'] = $item['transport'];
        if(!empty($item['zeit'])) $final_array['time'] = $item['zeit'];
        if(!empty($item['adresse'])) $final_array['street'] = $item['adresse'];
        $final_array['streetDisplay'] = $final_array['street'];
        array_push($final_json, $final_array);
    }
    return $final_json;
}
$tested_sites = 0;
$object = json_decode(file_get_contents($url), true);
while($object['results']['items_per_page'] * $tested_sites < (int)$object['results']['count']){
    $tested_sites += 1;
    $final_json = read_json(file_get_contents($url . "&page=" . $tested_sites), $final_json);
}

echo(json_encode($final_json));