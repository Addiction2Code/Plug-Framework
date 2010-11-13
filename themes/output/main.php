<?php $pType = plug_body(); /* $banner = plug_banner(); $nav = plug_navbar(); */
/*Define footer Var*/
$css = $_GET['css'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <style>
    <!--
      @import url("<?=$css?>");
    -->
  </style>
  <title></title>
<script src="resources/videoPlayer/swfobject.js" type="text/javascript"></script>
<script type="text/javascript">
// <![CDATA[	
var flashvars = {
	skinURL: "resources/videoPlayer/SkinOverPlaySeekFullscreen.swf",
	videoURL: "http%3A%2F%2Fmtserver.ath.cx%2Fmedia%2Fvideos%2Fmovies%2FAndreaRicca%2Fufo_race.mp4",
	autoPlay: "false",
	autoRewind: "false"
};

var params = {
	bgcolor: "#FFFFFF",
	allowfullscreen: "true",
	salign: "tl"
};

var attributes = {
	id: "main",
	name: "main"
};

swfobject.embedSWF(
				   "resources/videoPlayer/videoplayer.swf",
				   "flashcontent",
				   "480",
				   "360",
				   "9.0.28",
				   "resources/videoPlayer/expressInstall.swf",
				   flashvars,
				   params,
				   attributes
				  );
// ]]>
</script>
</head>
<body>
  <div class="div_l">
    <div class="div_r">
      <table id="master">
        <tr>
          <td id="header">
	    <div class="banner">
	    </div>
          </td>
        </tr>
        <tr>
          <td id="navabar_a">
	    <div class="top_nav">
            </div>
          </td>
        </tr>
        <tr>  
          <td id="output">
	    <div class="output_area">
              <?=$output?>
	    </div>
          </td>
        </tr>
        <tr>
          <td id="footer">
            <div class="footer_area">
            </div>
          </td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>
