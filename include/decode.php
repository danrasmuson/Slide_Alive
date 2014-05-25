<?php
	function decodeText() {
		global $inputText, $wordData;
		$nouns = explode("\n",file_get_contents("nounlist.txt"));
		$throwaway_words = array("me", "my", "mine", "hers", "his", "the", "to", "and", "of", "in", "a", "her", "was", "on", "that", "she", "he", "is", "from", "as", "with", "said", "you", "for", "will", "not", "have", "who", "i", "also", "at", "had", "like", "my", "so", "one", "has", "where", "your", "but", "over", "what", "be", "it", "about", "are", "told", "been", "may", "by", "an", "those", "time", "their", "our", "since", "while");
		$split = array("!",'%0D%0A',"?");
		$sentences = explode(".",str_replace($split,".",$inputText));
		$Flickr = new Flickr; 
		$final_data = array();
		$sent = array();
		$queries = array();
		$done = 0;
		foreach($sentences as $sentence) {
			$rough = explode(" ",$sentence);
			$query = "";
			foreach($rough as $word) {
				if(in_array(strtolower($word),$throwaway_words) == false && in_array(strtolower($word),$nouns)) {
					$query .= " ".trim(strtolower($word),'.!/\[]{}(),",:;');
				}
			}
			$queries[] = $query;
		}
		foreach($queries as $item) {
			$finalquery = "";
			$words = explode(" ",$item);
			foreach($words as $word) {
				if(in_array($word,$sent) == false) {
					$finalquery .= " ".$word;
					$sent[] = $word;
				}
			}
			$final_data = $Flickr->search($finalquery);
			$count = 0;
			foreach($final_data as $data) {
				$done++;
				echo toWords():
				foreach($data['photos']['photo'] as $photo) { 
					$count++;
					if(($count % 3) == 1) {
						$checked = " checked";
					} else {
						$checked = "";
					}
					echo '<div class="col-md-4"><div class="chkcontainer"><img src="http://farm' . $photo["farm"] . '.static.flickr.com/' . $photo["server"] . '/' . $photo["id"] . '_' . $photo["secret"] . '.jpg" width="300px" height="300px"><input type="checkbox" class="checkbox" id="check'.$count.'" '.$checked.'></div></div>'; 
				}
			}
		}
		
		foreach($final_data as $data) {
			foreach($data['photos']['photo'] as $photo) { 
				$count++;
				if(($count % 3) == 1) {
					
					$checked = " checked";
				} else {
					$checked = "";
				}
				// the image URL becomes somthing like 
				// http://farm{farm-id}.static.flickr.com/{server-id}/{id}_{secret}.jpg  
				echo '<div class="col-md-4"><div class="chkcontainer"><img src="http://farm' . $photo["farm"] . '.static.flickr.com/' . $photo["server"] . '/' . $photo["id"] . '_' . $photo["secret"] . '.jpg" width="300px" height="300px"><input type="checkbox" class="checkbox" id="check'.$count.'" '.$checked.'></div></div>'; 
			}
		}
	}
?>