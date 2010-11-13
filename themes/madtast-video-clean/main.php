<?php
  header('Content-type: text/html; charset=UTF-8'); /*Ensuring Content Type*/
  $pType = plug_body(); $banner = plug_banner(); $nav = plug_navbar(); /*Load Plug Values to Vars*/
  /*Define footer Var*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head profile="http://gmpg.org/xfn/11">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <style type="text/css">
    <!--
      @import url("themes/<?=plug_theme(); ?>/style.css");
      @import url("themes/<?=plug_theme(); ?>/nav.css");
      @import url("themes/<?=plug_theme(); ?>/pages.css");
    -->
  </style>
  <link rel="stylesheet" href="resources/thickbox/thickbox.css" type="text/css" media="screen" />
  <script type="text/javascript" src="resources/libraries/jquery/jquery.js"></script>
  <script type="text/javascript" src="resources/libraries/jquery/cycle.js"></script>
  <script type="text/javascript" src="resources/thickbox/thickbox.js"></script>
  <script type="text/javascript" src="resources/libraries/madtast/master.js"></script> <!-- Include Madtast ShowContent -->
  <title><?=$banner?></title>
  <?=plug_head()?>
</head>
<body>
  <div class="div_l">
    <div class="div_r">
      <table id="master">
        <tbody>
          <tr>
            <td id="header">
	      <div class="banner">
                <?=$banner?>
	      </div>
            </td>
          </tr>
          <tr>
            <td id="navabar_a">
	      <div class="top_nav">
                <ul><?=plugin($nav, $TACK['Blank']); ?></ul>
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
              <?php /*plugin("Sponsors", $TACK['Blank']); (Edit the sponsors plugin) */ ?>
              <div class="footer_area">
                <?=$footer?>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
