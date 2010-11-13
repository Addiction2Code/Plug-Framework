<?php

global $config;
if(!empty($config['plugin_back_color']))
	$bcolor = $config['plugin_back_color'];
else
	$bcolor = "#FFFFFF";

//$player_location = "http://mtserver.ath.cx/video/resources/videoPlayer"; /*For Madtast.com*/
$player_location = "resources/videoPlayer"; /*Locally and MTServer*/

plug_headline('
<script src="'.$player_location.'/swfobject.js" type="text/javascript"></script>
<script type="text/javascript">
// <![CDATA[	
var flashvars = {
	skinURL: "'.$player_location.'/SkinOverPlaySeekFullscreen.swf",
	videoURL: "'.$argument[0].'",
	autoPlay: "true",
	autoRewind: "false"
};

var params = {
	bgcolor: "'.$bcolor.'",
	allowfullscreen: "true",
	salign: "tl"
};

var attributes = {
	id: "main",
	name: "main"
};

swfobject.embedSWF(
				   "'.$player_location.'/videoplayer.swf",
				   "flashcontent",
				   "480",
				   "360",
				   "9.0.28",
				   "'.$player_location.'/expressInstall.swf",
				   flashvars,
				   params,
				   attributes
				  );
// ]]>
</script>
<script type="text/javascript">
$(document).ready(function(){

	$(".btn-slide").click(function(){
		$(this).toggleClass("active");
		$("#panel").show(); return false;
	});
	
	 
});
</script>


<style type="text/css">

#video_holder {
	margin: 0 auto;
	padding: 0;
	width: 480px;
}

#panel {
	height: 360px;
	display: none;
}

a:focus {
	outline: none;
}

.slide {
	margin: 0;
	padding: 0;
}

.btn-slide {
	text-align: center;
	margin: 0 auto;
	display: block;
	color: #fff;
	height: 244px;
	width: 244px;
	background-image: url("resources/images/play_button.png");
	background-repeat: no-repeat;
	text-decoration: none;
}

.active {
	height: 0;
	width: 0;
	overflow: hidden;
}

</style>
');


$content .= '
<div id="video_holder">
	<div id="panel">
		<div class="content">
			<div id="flashcontent">
				<p><strong>You need to upgrade your Flash Player.</strong><br/>
				This is replaced by the Flash content. <br/>
				Place your alternate content here and users without the Flash plugin or with <br/>
				Javascript turned off will see this. Content here allows you to leave out <code>noscript</code> <br/>
				tags. To bypass Flash Player detection, <a href="videoplayer_params_swfobject_fp9.html?detectflash=false">click here</a>.</p>
			</div>
		</div>
	</div>
	<p class="slide"><a href="#" class="btn-slide"></a></p>
</div>
';

?>
