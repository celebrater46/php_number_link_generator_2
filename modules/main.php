<?php

namespace php_number_link_generator\modules;

use php_number_link_generator\classes\Article;
use php_number_link_generator\classes\NumberLink;

require_once( dirname(__FILE__) . '/../init.php');

function get_link($file_names){
    return new NumberLink(PNLG_MAX_TEXT_NUM, PNLG_MAX_LINK_NUM, count($file_names));
}

function get_articles($names){
    $articles = [];
    for ($i = 0; $i < count($names); $i++){
        array_push(
            $articles,
            new Article(
                $i,
                "Sample title " . ($i + 1),
                file($names[$i])
            )
        );
    }
    return $articles;
}

//function create_titles($sum){
//    $array = [];
//    for($i = 0; $i < $sum; $i++){
//        array_push($array, "sample title " . ($i + 1));
//    }
//    return $array;
//}

//function get_texts($names){
//    $texts = [];
//    for ($i = 0; $i < count($names); $i++){
//        array_push($texts, file($names[$i]));
//    }
//    return $texts;
//}