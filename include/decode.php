<?php
	function convert_number_to_words($number) {
		
		$hyphen      = '-';
		$conjunction = ' and ';
		$separator   = ', ';
		$negative    = 'negative ';
		$decimal     = ' point ';
		$dictionary  = array(
			0                   => 'zero',
			1                   => 'one',
			2                   => 'two',
			3                   => 'three',
			4                   => 'four',
			5                   => 'five',
			6                   => 'six',
			7                   => 'seven',
			8                   => 'eight',
			9                   => 'nine',
			10                  => 'ten',
			11                  => 'eleven',
			12                  => 'twelve',
			13                  => 'thirteen',
			14                  => 'fourteen',
			15                  => 'fifteen',
			16                  => 'sixteen',
			17                  => 'seventeen',
			18                  => 'eighteen',
			19                  => 'nineteen',
			20                  => 'twenty',
			30                  => 'thirty',
			40                  => 'fourty',
			50                  => 'fifty',
			60                  => 'sixty',
			70                  => 'seventy',
			80                  => 'eighty',
			90                  => 'ninety',
			100                 => 'hundred',
			1000                => 'thousand',
			1000000             => 'million',
			1000000000          => 'billion',
			1000000000000       => 'trillion',
			1000000000000000    => 'quadrillion',
			1000000000000000000 => 'quintillion'
		);
		
		if (!is_numeric($number)) {
			return false;
		}
		
		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}

		if ($number < 0) {
			return $negative . convert_number_to_words(abs($number));
		}
		
		$string = $fraction = null;
		
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
		
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . convert_number_to_words($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= convert_number_to_words($remainder);
				}
				break;
		}
		
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
		
		return $string;
	}

	function decodeText() {
		global $inputText, $wordData,$output1,$output2;
		$nouns = explode("\n",file_get_contents("nounlist.txt"));
		$throwaway_words = array("me", "my", "mine", "hers", "his", "the", "to", "and", "of", "in", "a", "her", "was", "on", "that", "she", "he", "is", "from", "as", "with", "said", "you", "for", "will", "not", "have", "who", "i", "also", "at", "had", "like", "my", "so", "one", "has", "where", "your", "but", "over", "what", "be", "it", "about", "are", "told", "been", "may", "by", "an", "those", "time", "their", "our", "since", "while", "this","if","can","use","does","only","get","using","ensure","all","or","represents","more","than","which","after","they'd","all,");
		$split = array("!",'\n',"?");
		$sentences = preg_split('/[.?!\n-]/',$inputText);;
		$Flickr = new Flickr; 
		$final_data = array();
		$sent = array();
		$queries = array();
		$done = 0;
		$imgurlcache = array();
		$output1 = array();
		$output2 = array();
		$output = array();
		foreach($sentences as $sentence) {
			$rough = explode(" ",$sentence);
			if(count($rough) == 1) {
				$rough = array(str_replace(' ','',$rough[0]));
				$sentence = str_replace(' ','',$rough[0]);
			}
			if(count($rough) == 0) {
				$rough = array($sentence);
			}
			$query = "";
			foreach($rough as $word) {
				if(in_array(strtolower(preg_replace( "/\r|\n/", "", $word)),$throwaway_words) == false && in_array(strtolower(preg_replace( "/\r|\n/", "", $word)),$nouns) == false) {
					$query .= " ".strtolower(preg_replace( "/\r|\n/", "", trim($word,',"'."'".';<>')));
				}
			}
			if($query != "" && $query !== " " && $query !== "\n") {
				$queries[$sentence] = $query;
			}
		}
		$on = 0;
		foreach($queries as $key => $item) {
			$on++;
			$finalquery = "";
			$words = explode(" ",$item);
			foreach($words as $word) {
				if(in_array($word,$sent) == false) {
					$finalquery .= " ".$word;
					$sent[] = $word;
				}
			}
			$urls = array();
			$data = $Flickr->search($finalquery);
			if(isset($data['photos']['photo'][0]["server"])) {
				$urls[] = 'http://farm' . $data['photos']['photo'][0]["farm"] . '.static.flickr.com/' . $data['photos']['photo'][0]["server"] . '/' . $data['photos']['photo'][0]["id"] . '_' . $data['photos']['photo'][0]["secret"] . '.jpg';
			}
			if(count(explode(" ",finalquery)) < 2)  {
				$search = 'http://flickr.com/services/rest/?method=flickr.photos.search&api_key=c8914ccb88aa42f695cb103739a584a1&text=' . urlencode($finalquery) . '&per_page=2&format=php_serial&sort=relevance';
				$result = file_get_contents($search); 
				$data = unserialize($result);
				if(isset($data['photos']['photo'][1]["server"])) {
					$urls[] = 'http://farm' . $data['photos']['photo'][1]["farm"] . '.static.flickr.com/' . $data['photos']['photo'][1]["server"] . '/' . $data['photos']['photo'][1]["id"] . '_' . $data['photos']['photo'][1]["secret"] . '.jpg';
				}
				$search = 'http://flickr.com/services/rest/?method=flickr.photos.search&api_key=c8914ccb88aa42f695cb103739a584a1&text=' . urlencode($finalquery) . '&per_page=3&format=php_serial&sort=relevance';
				$result = file_get_contents($search); 
				$data = unserialize($result);
				if(isset($data['photos']['photo'][2]["server"])) {
					$urls[] = 'http://farm' . $data['photos']['photo'][2]["farm"] . '.static.flickr.com/' . $data['photos']['photo'][2]["server"] . '/' . $data['photos']['photo'][2]["id"] . '_' . $data['photos']['photo'][2]["secret"] . '.jpg';
				}
			}
			$count = count($urls);
			if($count < 3) {
				foreach(explode(" ",$finalquery) as $dataset) {
					if($count < 3) {
						$search = 'http://flickr.com/services/rest/?method=flickr.photos.search&api_key=c8914ccb88aa42f695cb103739a584a1&text=' . urlencode($dataset) . '&per_page=1&format=php_serial&sort=relevance';
						$result = file_get_contents($search); 
						$data = unserialize($result);
						if(isset($data['photos']['photo'][0]["server"])) {
							$urls[] = 'http://farm' . $data['photos']['photo'][0]["farm"] . '.static.flickr.com/' . $data['photos']['photo'][0]["server"] . '/' . $data['photos']['photo'][0]["id"] . '_' . $data['photos']['photo'][0]["secret"] . '.jpg';
						}
					}
					$count = count($urls);
				}
			}
			$count = 0;
			$done++;
			foreach(explode(" ",$item) as $elem) {
				$key = str_ireplace($elem,'<span class="highlight">'.$elem.'</span>',$key);
			}
			if(count($queries) === $on) {
				$output[] = array("sentance" => trim(str_replace('\"','"',$key)," "), "number" => convert_number_to_words($done), "image" => $urls[0]);
				$output1 = array(json_encode($output));
			} else {
				$output[] = array("sentance" => trim(str_replace('\"','"',$key)," "), "number" => convert_number_to_words($done), "image" => $urls[0]);
			}
			$imgurlcache[convert_number_to_words($done)] = array();
			foreach($urls as $url) {
				$imgurlcache[convert_number_to_words($done)][] = $url;
			}
		}
		foreach($imgurlcache as $key => $value) {
			$str = "";
			$str .= '$scope.backup["'.$key.'"] = [';
			if(count($value) > 0) {
				foreach($value as $val) {
					$str .= '"'.$val.'",';
				}
				$newstr = substr($str,0,-1);
				$newstr .= "];";
				$output2[] = $newstr;
			}
		}
	}
?>
