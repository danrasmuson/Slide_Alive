<?php
	$job = rand(1,10000000000000);
	exec("sshpass -p sjuxmtukgdfr ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no root@127.0.0.1 mkdir /var/www/html/jobs/$job; chmod -R 777 /var/www/html/jobs/$job");
	$data = json_decode($_GET['args'],true);
	foreach($data as $key => $url) {
		exec("sshpass -p sjuxmtukgdfr ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no root@127.0.0.1 wget ".$url." -O /var/www/html/jobs/$job/image".$key.".jpg");
	}
	$argstr = "";
	$sentences = json_decode($_GET['sentences'],true);
	foreach($data as $key => $url) {
		$argstr .= "/var/www/html/jobs/$job/image".$key.".jpg ".'"'.str_replace('</span>','',str_replace('"',"",str_replace('<span class="highlight">','',json_decode($_GET['sentences'],true)[$key]))).'" ';
	}
	exec("sshpass -p sjuxmtukgdfr ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no root@127.0.0.1 python /var/www/html/make_ppt.py /var/www/html/jobs/$job/output.pptx $argstr");
	//echo "sshpass -p sjuxmtukgdfr ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no root@127.0.0.1 python /var/www/html/make_ppt.py /var/www/html/jobs/$job/output.pptx $argstr";
	exec("sshpass -p sjuxmtukgdfr ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no root@127.0.0.1 chmod 777 /var/www/html/jobs/$job");
	exec("sshpass -p sjuxmtukgdfr ssh -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no root@127.0.0.1 chmod 777 /var/www/html/jobs/$job/output.pptx");
	header("Location: jobs/$job/output.pptx");
?>