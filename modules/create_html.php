<?php

namespace php_number_link_generator\modules;

require_once "html_common_module.php";
require_once( dirname(__FILE__) . '/../init.php');

function get_page_links_html($link){
    $html = space_br("<p class='links'>", 1);
    if($link->current_link_page > 1){
        $html .= space_br('<a href="' . PNLG_INDEX_FILE_NAME . '?page=' . ($link->current_link_page - 1) . '">＜＜</a>', 2);
    }
    for($i = $link->start_page_num; $i <= $link->current_link_page * PNLG_MAX_LINK_NUM; $i++){
        if($i <= $link->page_num){
            $html .= space_br('<a href="' . PNLG_INDEX_FILE_NAME . '?page=' . $i . '">' . $i . '</a>', 2);
        }
    }
    if($link->pagenum > $link->current_link_page * PNLG_MAX_LINK_NUM){
        $html .= space_br('<a href="' . PNLG_INDEX_FILE_NAME . '?page=' . ($link->current_link_page * PNLG_MAX_LINK_NUM + 1) . '">＞＞</a>', 2);
    }
    $html .= space_br("</p>", 1);
    return $html;
}

function get_p_lines_html($lines){
    $html = "";
    foreach ($lines as $line){
        $html .= space_br("<p>" . $line . "</p>", 2);
    }
    return $html;
}

function get_articles_html($link, $articles){
    $html = "";
    for($i = $link->start; $i < $link->start + PNLG_MAX_TEXT_NUM; $i++){
        if($i < $link->text_sum){
            $html .= space_br("<hr>", 1);
            $html .= space_br("<h2>" . $articles[$i]->title . "</h2>", 1);
            $html .= space_br("<div>", 1);
            $html .= get_p_lines_html($articles[$i]->lines);
            $html .= space_br("</div>", 1);
        }
    }
    return $html;
}

function pnlg_get_html(){
    $file_names = glob('files/*.txt'); // ファイル名一覧
    $link = get_link($file_names);
    $articles = get_articles($link);
    $html = space_br("<p>page_num: " . $link->page_num . "</p>", 1);
    $html .= space_br("<p>current_link_page: " . $link->current_link_page . "</p>", 1);
    $html .= space_br("<p>start_page_num: " . $link->start_page_num . "</p>", 1);
    $html .= space_br("<h1>" . PNLG_SITE_NAME . "</h1>", 1);
    $html .= get_articles_html($link, $articles);
    $html .= get_p_lines_html($link);
    return $html;
}