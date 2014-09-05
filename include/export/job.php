<?php
/*
* SlideAlive - Automatic Presentation Generation Software
* --------------
* export/job.php - Uses python script to process an input job.
* Created by William Teder using PHPstorm on 7/21/14 at 2:28 PM.
*/

class exportJob {
    public $jobID;
    public $cmdOutput;

    public function __construct($data, $sentences) {
        $this->jobID = $this->mkJobID();
        exec("cd /var/www/html");
        exec("mkdir jobs/".$this->jobID);
        exec("chmod -R 777 jobs/".$this->jobID);

        foreach($data as $key => $url) {
            exec("wget ".$url." -O jobs/".$this->jobID."/image$key.jpg");
        }

        $argstr = "";
        foreach($data as $key => $url) {
            $argstr .= "/var/www/html/jobs/".$this->jobID."/image$key.jpg ".'"'.$this->sanitize($sentences[$key]).'" ';
        }

        $this->cmdOutput = exec("python /var/www/html/include/export/make_ppt.py /var/www/html/jobs/".$this->jobID."/output.pptx $argstr");
    }

    private function sanitize($input) {
        $string = $input;
        $blacklist = array(
            '</span>',
            '"',
            '<span class="highlight">'
        );
        foreach($blacklist as $item) {
            $string = str_replace($item,'',$string);
        }

        return $string;
    }

    private function mkJobID(){
        $id = false;
        while($id === false) {
            $id = rand(1,10000000000000);
            if(file_exists('/var/www/html/jobs/'.$id)) {
                $id = false;
            }
        }

        return $id;
    }
} 
