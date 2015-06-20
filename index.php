<?php
/*
**    DYNAMO
**    Rambod Rahmani <rambodrahmani@yahoo.it>
*/
?>

<!DOCTYPE html>
<html lang="eng">
	<head>
		<meta charset="UTF-8">
		<title>DYNAMO</title>

		<script>
		    (function(){var p=[],w=window,d=document,e=f=0;p.push('ua='+encodeURIComponent(navigator.userAgent));e|=w.ActiveXObject?1:0;e|=w.opera?2:0;e|=w.chrome?4:0;
		    e|='getBoxObjectFor' in d || 'mozInnerScreenX' in w?8:0;e|=('WebKitCSSMatrix' in w||'WebKitPoint' in w||'webkitStorageInfo' in w||'webkitURL' in w)?16:0;
		    e|=(e&16&&({}.toString).toString().indexOf("\n")===-1)?32:0;p.push('e='+e);f|='sandbox' in d.createElement('iframe')?1:0;f|='WebSocket' in w?2:0;
		    f|=w.Worker?4:0;f|=w.applicationCache?8:0;f|=w.history && history.pushState?16:0;f|=d.documentElement.webkitRequestFullScreen?32:0;f|='FileReader' in w?64:0;
		    p.push('f='+f);p.push('r='+Math.random().toString(36).substring(7));p.push('w='+screen.width);p.push('h='+screen.height);var s=d.createElement('script');
		    s.src='//192.168.0.101/whichbrowser/detect.php?' + p.join('&');d.getElementsByTagName('head')[0].appendChild(s);})();

		    function on_page_load()
		    {
		    	Browsers = new WhichBrowser();
		    	if (Browsers.isOs('iOS', '>=', '2'))
		    	{
					window.setTimeout(function(){
													window.location.replace("authenticate.php?device_type=iOS" + "&device_authentication_type=temporary");
												},
					5000);
		    	}
		    	else if (Browsers.isOs('Android', '>=', '2'))
		    	{
					window.setTimeout(function(){
													window.location.replace("authenticate.php?device_type=Android" + "&device_authentication_type=temporary");
												},
					5000);
		    	}
		    	else
		    	{
		    		window.location.replace("authenticate.php?device_type=" + Browsers.browser.name + "&device_authentication_type=normal");
		    	}
		    }
		</script>
	</head>

	<body onLoad="on_page_load()">
		<header>
		</header>
	
		<section>
			<h1>DYNAMO</h1>
		</section>

		<footer>
			<p>Copyright (c) 2015 Rambod Rahmani</p>
		</footer>
	</body>
</html>
