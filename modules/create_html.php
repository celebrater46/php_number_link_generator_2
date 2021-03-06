<?php

namespace php_number_link_generator\modules;

use fp_common_modules as cm;
use php_number_link_generator\classes\Article;
use php_number_link_generator\classes\NumberLink;

require_once(dirname(__FILE__) . '/../classes/NumberLink.php');
require_once(dirname(__FILE__) . '/../classes/Article.php');
require_once(dirname(__FILE__) . '/../init.php');
require_once PNLG_HCM_PATH;

function get_p_lines_html($lines){
    $html = "";
    foreach ($lines as $line){
        $html .= cm\space_br("<p>" . $line . "</p>", 2);
    }
    return $html;
}

// 記事
function get_articles_html($link, $articles){
    $html = "";
    for($i = $link->start; $i < $link->start + $link->max_texts_per_page; $i++){
        if($i < $link->text_sum){
            $html .= cm\space_br("<hr>", 1);
            $html .= cm\space_br("<h2>" . $articles[$i]->title . "</h2>", 1);
            $html .= cm\space_br("<div>", 1);
            $html .= get_p_lines_html($articles[$i]->lines);
            $html .= cm\space_br("</div>", 1);
        }
    }
    return $html;
}

function get_link($file_names, $max){
    return new NumberLink(count($file_names), $max);
}

function get_articles($file_names){
    $articles = [];
    for ($i = 0; $i < count($file_names); $i++){
        array_push(
            $articles,
            new Article(
                $i,
                "Sample title " . ($i + 1),
                file($file_names[$i])
            )
        );
    }
    return $articles;
}

//function pnlg_get_html(){
//    $file_names = glob('files/*.txt'); // ファイル名一覧
//    $link = get_link($file_names);
//    $articles = get_articles($file_names);
//    $html = cm\space_br("<p>page_num: " . $link->page_num . "</p>", 1);
//    $html .= cm\space_br("<p>current_link_page: " . $link->current_link_page . "</p>", 1);
//    $html .= cm\space_br("<p>start_page_num: " . $link->start_page_num . "</p>", 1);
//    $html .= cm\space_br("<h1>" . PNLG_SITE_NAME . "</h1>", 1);
//    $html .= get_articles_html($link, $articles);
//    $html .= $link->get_page_links_html("");
//    return $html;
//}