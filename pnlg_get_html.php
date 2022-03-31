<?php

namespace php_number_link_generator;

use php_number_link_generator\modules as modules;

require_once "modules/create_html.php";

function pnlg_get_html($max){
    $file_names = glob('files/*.txt'); // ファイル名一覧
    $link = modules\get_link($file_names, $max);
    $articles = modules\get_articles($file_names);
    $html = cm\space_br("<p>page_num: " . $link->page_num . "</p>", 1);
    $html .= cm\space_br("<p>current_link_page: " . $link->current_link_page . "</p>", 1);
    $html .= cm\space_br("<p>start_page_num: " . $link->start_page_num . "</p>", 1);
    $html .= cm\space_br("<h1>" . PNLG_SITE_NAME . "</h1>", 1);
    $html .= modules\get_articles_html($link, $articles);
    $html .= $link->get_page_links_html("");
    return $html;
}