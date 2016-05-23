<?php

class HomeController extends BaseController {

    public function __construct() {
        
    }

    public function dashBoard() {
        return View::make('dashboard');
    }

    public function getOssToken() {
        $token = App::make('QiNiu\Auth')->uploadToken('lanwen');
        return Response::json(['uptoken' => $token]);
    }

    public function test() {
        return View::make('test');
    }

    public function postTest() {
        $content = Input::get('short'); // '<p class="l1">text1</p><p class="l2"><img alt="" src="http://img.qqcdn.cn/1212.jpg"></p><p>text2</p>';
        $dom = new DOMDocument();
        $dom->loadHTML($content);
        return json_encode($this->getDom($dom->documentElement));
    }

    public function getDom($node) {
        $tempArray = false;

        //遍历所有节点
        $childs = $node->getElementsByTagName('p');
        foreach ($childs as $child) {

            //文字
            if ($child->nodeValue) {
                $tempArray[] = ['object' => $child->nodeValue, 'type' => 2];
            }

            //图片
            $imgs = $child->getElementsByTagName('img');
            if ($imgs) {
                foreach ($imgs as $img) {
                    $tempArray[] = ['object' => $img->attributes->getNamedItem('src')->nodeValue, 'type' => 3];
                }
            }
        }

//        //过滤所有节点
//        $res = false;
//        for ($index = 0; $index < count($tempArray); $index++) {
//
//            //文字
//            if ($tempArray[$index]['type'] == 2) {
//                $res[] = $tempArray[$index];
//            }
//
//            //图片
//            if ($tempArray[$index]['type'] == 3) {
//                echo 'img';
//            }
//        }

        return $tempArray;
    }

}
