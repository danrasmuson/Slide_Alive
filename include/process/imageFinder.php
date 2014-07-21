<?php
/*
 * SlideAlive - Automatic Presentation Generation Software
 * --------------
 * imageFinder.php - Find images to use for a given body of text.
 * Created by William Teder using PHPstorm on 7/21/14 at 3:04 PM.
 */

require('flickr.php');


class imageFinder {
    public $output1 = array();
    public $output2 = array();
    private $imgurlcache = array();
    private $iteration = 0;
    private $flickr;
    private $done = 0;

    public function __construct($input) {
        $this->flickr = new Flickr();
        foreach($input as $key => $item) {
            $this->iteration++;
            $finalquery = "";
            $words = explode(" ",$item);
            foreach($words as $word) {
                if(in_array($word,$sent) == false) {
                    $finalquery .= " ".$word;
                    $sent[] = $word;
                }
            }
            $urls = array();
            $data = $this->flickr->search($finalquery);
            if(isset($data['photos']['photo'][0]["server"])) {
                $urls[] = 'http://farm' . $data['photos']['photo'][0]["farm"] . '.static.flickr.com/' . $data['photos']['photo'][0]["server"] . '/' . $data['photos']['photo'][0]["id"] . '_' . $data['photos']['photo'][0]["secret"] . '.jpg';
            }
            if(count(explode(" ",$finalquery)) < 2)  {
                $search = 'http://flickr.com/services/rest/?method=flickr.photos.search&api_key=c8914ccb88aa42f695cb103739a584a1&text=' . urlencode($finalquery) . '&per_page=2&format=php_serial&sort=relevance';
                $data = unserialize(file_get_contents($search));
                if(isset($data['photos']['photo'][1]["server"])) {
                    $urls[] = 'http://farm' . $data['photos']['photo'][1]["farm"] . '.static.flickr.com/' . $data['photos']['photo'][1]["server"] . '/' . $data['photos']['photo'][1]["id"] . '_' . $data['photos']['photo'][1]["secret"] . '.jpg';
                }

                $search = 'http://flickr.com/services/rest/?method=flickr.photos.search&api_key=c8914ccb88aa42f695cb103739a584a1&text=' . urlencode($finalquery) . '&per_page=3&format=php_serial&sort=relevance';
                $data = unserialize(file_get_contents($search));
                if(isset($data['photos']['photo'][2]["server"])) {
                    $urls[] = 'http://farm' . $data['photos']['photo'][2]["farm"] . '.static.flickr.com/' . $data['photos']['photo'][2]["server"] . '/' . $data['photos']['photo'][2]["id"] . '_' . $data['photos']['photo'][2]["secret"] . '.jpg';
                }
            }
            $count = count($urls);
            if($count < 3) {
                foreach(explode(" ",$finalquery) as $dataset) {
                    if($count < 3) {
                        $search = 'http://flickr.com/services/rest/?method=flickr.photos.search&api_key=c8914ccb88aa42f695cb103739a584a1&text=' . urlencode($dataset) . '&per_page=1&format=php_serial&sort=relevance';
                        $data = unserialize(file_get_contents($search));
                        if(isset($data['photos']['photo'][0]["server"])) {
                            $urls[] = 'http://farm' . $data['photos']['photo'][0]["farm"] . '.static.flickr.com/' . $data['photos']['photo'][0]["server"] . '/' . $data['photos']['photo'][0]["id"] . '_' . $data['photos']['photo'][0]["secret"] . '.jpg';
                        }
                    }
                    $count = count($urls);
                }
            }
            $count = 0;
            $this->done++;
            foreach(explode(" ",$item) as $elem) {
                $key = str_ireplace($elem,'<span class="highlight">'.$elem.'</span>',$key);
            }
            if(count($input) === $this->iteration) {
                $output[] = array("sentance" => trim(str_replace('\"','"',$key)," "), "number" => convert_number_to_words($this->done), "image" => $urls[0]);
                $this->output1 = array(json_encode($output));
            } else {
                $output[] = array("sentance" => trim(str_replace('\"','"',$key)," "), "number" => convert_number_to_words($this->done), "image" => $urls[0]);
            }
            $this->imgurlcache[convert_number_to_words($this->done)] = array();
            foreach($urls as $url) {
                $this->imgurlcache[convert_number_to_words($this->done)][] = $url;
            }
        }
        foreach($this->imgurlcache as $key => $value) {
            $str = "";
            $str .= '$scope.backup["'.$key.'"] = [';
            if(count($value) > 0) {
                foreach($value as $val) {
                    $str .= '"'.$val.'",';
                }
                $newstr = substr($str,0,-1);
                $newstr .= "];";
                $this->output2[] = $newstr;
            }
        }
    }
}

