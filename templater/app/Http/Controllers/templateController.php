<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index($page = 1, $pageLimit = 5){
        $articles = $this->mergeArticlesToAuthors();
        // $pageLimit = $pageSize;
        $data["totalItems"] = count($articles);
        $data["totalPages"] = ceil($data["totalItems"]/$pageLimit);
        $data["currentPage"] = $page;

        $start = (($page-1)*$pageLimit);
        $end = ($page*$pageLimit)-1;

        for ($i=$start; $i <= $end ; $i++) {
            if ($i <= $data["totalItems"]) {
                $data["postData"][] = $articles[$i];
            } else {
                $data["postData"][] = null;
                break;
            }
        }
        // print_r(json_encode($data));
        // die;
        return view("welcome")->with('data', $data);
    }

    public function getAuthors() {
        $content = file_get_contents('https://maqe.github.io/json/authors.json');
        return json_decode($content, 1);
    }

    public function getArticles() {
        $content = file_get_contents('https://maqe.github.io/json/posts.json');
        return json_decode($content, 1);
    }

    private function mergeArticlesToAuthors(){
        $posts = $this->getArticles();
        $auths = $this->getAuthors();
        $mergedCont = array();
        foreach ($posts as $postKey => $post) {
            foreach ($auths as $authKey => $auth) {
                if ($post["author_id"] == $auth["id"]) {
                    unset($auth["id"]);
                    $item = $post;
                    $item['created_time_ago'] = $this->humanTime($post['created_at'])." ago";
                    $mergedCont[] = array_merge($item, $auth);
                }
            }
        }
        return $mergedCont;
    }

    private function humanTime ($time){
        $time = strtotime($time);
        $time = time() - $time;
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );
        foreach ($tokens as $unit => $text) {
            if ($time < $unit) 
                continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }
    }
}
