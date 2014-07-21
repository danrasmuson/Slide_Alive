<?php
/*
* SlideAlive - Automatic Presentation Generation Software
* --------------
* export.php - References backend to process and return job.
* Created by William Teder using PHPstorm on 7/21/14 at 2:28 PM.
*/
    include('include/export/job.php');

    $data = json_decode($_GET['args'],true);
    $sentences = json_decode($_GET['sentences'],true);

    $job = new exportJob($data,$sentences);

	header("Location: http://sa.lbsg.net/jobs/".$job->jobID."/output.pptx");
?>