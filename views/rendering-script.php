<?php
	$trimmed = trim($this->settings['beeline_included_cats']);
        $trimmed = strtolower($trimmed);
	$included_cats = preg_split("/[\s,]+/", $trimmed);

        if (is_single() && (in_category($included_cats) || empty($trimmed))) 
	{
		$publisherid = $this->settings['beeline_publisher_id'];
                echo '<![if !IE]>';
                echo '<script type="text/javascript"> var xnosis_mode; var xnosis = {siteid: "' .$publisherid. '"}; document.write(unescape("%3Cscript src=%22http://data.xnosis.com.s3.amazonaws.com/client/js/xnosis.js%22 type=%22text/javascript%22%3E%3C/script%3E")); </script>';
                echo '<![endif]>';
		echo '<!--[if gt IE 6]>';
		echo '<script type="text/javascript"> var xnosis_mode; var xnosis = {siteid: "' .$publisherid. '"}; document.write(unescape("%3Cscript src=%22http://data.xnosis.com.s3.amazonaws.com/client/js/xnosis.js%22 type=%22text/javascript%22%3E%3C/script%3E")); </script>';
		echo '<![endif]-->';
        }
?>
