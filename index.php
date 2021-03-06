<?php
    $video_url = $_GET['src'];
    $poster_url = $_GET['poster'];
?><!DOCTYPE html>
<html>
<head>
    <title>VideoPlayer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="HandheldFriendly" content="true" />
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
            src: "<?php echo $video_url; ?>",
            autoPlay: false,
            plugin_hls: "flashls/flashlsOSMF.swf",
            hls_minbufferlength: -1,
            hls_maxbufferlength: 30,
            hls_lowbufferlength: 3,
            hls_seekmode: "SEGMENT",
            hls_startfromlevel: -1,
            hls_seekfromlevel: -1,
            hls_live_flushurlcache: false,
            hls_info: true,
            hls_debug: false,
            hls_debug2: false,
            hls_warn: true,
            hls_error: true,
            hls_fragmentloadmaxretry : -1,
            hls_manifestloadmaxretry : -1,
            hls_capleveltostage : false,
            hls_maxlevelcappingmode : "downscale"
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
            <?php if(strtolower(substr($video_url,-5))=='.m3u8') {?>
            document.write('<video id="my-video" class="video-js" controls="controls" width="'+windowwidth+'" height="'+(windowheight-4)+'" data-setup="{}" <?php if($poster_url) { ?>poster="<?php echo $poster_url ?>"<?php } ?>><source src="<?php echo $video_url; ?>" type="application/x-mpegURL"></video>');
            <?php } else { ?>
            document.write('<video id="my-video" class="video-js" src="<?php echo $video_url; ?>" controls="controls" width="'+windowwidth+'" height="'+(windowheight-4)+'" data-setup="{}" <?php if($poster_url) { ?>poster="<?php echo $poster_url ?>"<?php } ?>></video>');
            <?php } ?>
        }
    </script>
    
</body>
</html>