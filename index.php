<?php
    $video_url = $_GET['src'];
?><!DOCTYPE html>
<html>
<head>
    <title>VideoPlayer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="video-js-5.17.0/video-js.min.css" rel="stylesheet">
    <script type="text/javascript" src="swfobject.js"></script>
    <!-- If you'd like to support IE8 -->
    <script src="video-js-5.17.0/video.min.js"></script>
    <script src="video-js-5.17.0/videojs-contrib-hls.min.js"></script>
    <script type="text/javascript">
        var windowheight=window.innerHeight
            || document.documentElement.clientHeight
            || document.body.clientHeight;
        var windowwidth=window.innerWidth
            || document.documentElement.clientWidth
            || document.body.clientWidth;
        var flashvars = {
            src: "<?php echo $video_url; ?>"
            , autoPlay: false
        };
        var params = {
            allowFullScreen: true
            , allowScriptAccess: "always"
            , bgcolor: "#000000"
        };
        var attrs = {
            name: "player"
        };

        var hasFlash = false;
        try {
            hasFlash = Boolean(new ActiveXObject('ShockwaveFlash.ShockwaveFlash'));
        } catch(exception) {
            hasFlash = ('undefined' != typeof navigator.mimeTypes['application/x-shockwave-flash']);
        }

        function support_video(){
            return !!document.createElement('video').canPlayType;
        }

        if(hasFlash&&!support_video()) {
            swfobject.embedSWF("GrindPlayer.swf", "player", "100%", windowheight-4, "10.2", null, flashvars, params, attrs);
        }
    </script>
    <style type="text/css">
        * {
            padding: 0;
            margin: 0;
        }
        html, body {
            height: 100%;
        }
    </style>
</head>
<body>
    <div id="player"></div>
    <script type="text/javascript">
        if(!hasFlash||support_video()) {
            document.write('<video id="my-video" class="video-js" src="<?php echo $video_url; ?>" controls="controls" width="'+windowwidth+'" height="'+(windowheight-4)+'" data-setup="{}"></video>');
        }
    </script>
    
</body>
</html>