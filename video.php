<script>


    var $inreadContainer = $('#inreadContainer');
    var inreadRedirection = "http://www.gamekult.com";
    var inread_movie = "movie.mp4";
    var inread_autoplay = true;
    var inread_soundOff = true;
    var inread_hideControls = false;
    var inread_autopromo = 0;


    var ofTopInreadContainer = $inreadContainer.offset().top;

    var vid = document.createElement('video');
    vid.id = "inread-video";
    vid.src = inread_movie;
    var $vid = $(vid);


    var inreadJqueryUiCss = document.createElement('link');
    inreadJqueryUiCss.href = "http://cdn.cupinteractive.com/ads/all/inread/jquery-ui-1.11.4/jquery-ui.css";
    inreadJqueryUiCss.rel = "stylesheet";

    var inreadJquery = document.createElement('script');
    inreadJquery.src = "http://cdn.cupinteractive.com/ads/all/inread/jquery-ui-1.11.4/external/jquery/jquery.js";

    var inreadJqueryUi = document.createElement('script');
    inreadJqueryUi.src = "http://cdn.cupinteractive.com/ads/all/inread/jquery-ui-1.11.4/jquery-ui.js";


    var inread_style = '#inreadContainer{margin-bottom:45px;}#inread-video{height:100%;max-width:100%;cursor:pointer}#abs_inread,#controlBar{position:absolute}#playButton,#pauseButton,#stopButton,#volumeButton,#volumeBar,#inread_controlTime{cursor:pointer}#playButton,#volumeButton,#volumeBar,#timeInfo{position:absolute}#abs_inread{width:100%;height:100%}#controlBar{height:25px;width:100%;bottom:-25px;background-color:#404040}.inread_icons{background:url(img/sprite.png) no-repeat}#volumeButton{height:15px;width:16px;left:53px;top:50%;margin-top:-7.5px}#playButton{width:17px;height:15px;margin-top:-7.5px;left:20px;top:50%}.inread_icons.inread_play{background-position:-25px -93px}.inread_icons.inread_play:hover{background-position:0 -93px}.inread_icons.inread_pause{background-position:-25px -66px}.inread_icons.inread_pause:hover{background-position:0 -66px}.inread_icons.inread_replay{background-position:-23px -44px}.inread_icons.inread_replay:hover{background-position:0 -44px}.inread_icons.volume_on{background-position:-25px -22px}.inread_icons.volume_on:hover{background-position:0 -22px}.inread_icons.volume_off{background-position:-25px 0}.inread_icons.volume_off:hover{background-position:0 0}#timeInfo{position:absolute;font-size:12px;line-height:17px;height:17px;top:50%;margin-top:-7.5px;right:10px;color:#d4d4d4}#timeInfoC{color:#e18c16}#inread_controlTime{height:5px;position:absolute;border-radius:0;border:0;bottom:0;cursor:pointer;background-color:#d4d4d4;width:100%;opacity:.5;transition:ease height .5s}#ad_inread:hover #inread_controlTime{transition:ease height .5s;height:10px;opacity:.7}#volumeBar{width:65px;height:5px;top:50%;margin-top:-4px;left:75px;background-color:#d4d4d4;border-radius:0}.ui-progressbar .ui-progressbar-value{background-color:#e18c16}#volumeBar.ui-slider .ui-slider-handle{cursor:pointer;height:10px;width:3px;top:-3px;margin-left:-1px;border-radius:0;background-color:#d4d4d4}.ui-slider-range-min{background-color:#d1800f}#mentionpub_inread,#skip_inread{position:absolute;font-family:arial;}#mentionpub_inread{left:0;top:0;color:#fff;text-align:center;background-color:#000;padding:2px 10px;font-size:12px;opacity:.5}#skip_inread{cursor:pointer;right:0;top:0;color:#fff;text-align:center;background-color:#000;padding:10px 20px;opacity:.5;font-size:15px}#skip_inread:hover{opacity:1}';
    var inreadBStyle = document.createElement('style');
    inreadBStyle.innerHTML = inread_style;


    $('head').append($(inreadJqueryUiCss));
    $('head').append($(inreadJquery));
    $('head').append($(inreadJqueryUi));
    $('head').append($(inreadBStyle));



    displayVideo($inreadContainer,$vid);


    function displayVideo(container,video) {

        container.hide();

        var inread_target = inread_autopromo ? '_self' : '_blank';
        video.on('click', function () {
            window.open(encodeURI(inreadRedirection), inread_target);
        });

        $vid.on('loadedmetadata', function () {


            var width = this.videoWidth;
            var height = this.videoHeight;
            var ratio = height / width * 100;


            var ad_inread = document.createElement('div');
            ad_inread.id = "ad_inread";
            var $ad_inread = $(ad_inread);
            $ad_inread.css({
                margin: 'auto',
                maxWidth: width
            });


            var rel_inread = document.createElement('div');
            rel_inread.id = "rel_inread";
            var $rel_inread = $(rel_inread);
            $rel_inread.css({
                position: 'relative',
                paddingBottom: ratio + '%'
            });

            var abs_inread = document.createElement('div');
            abs_inread.id = "abs_inread";
            var $abs_inread = $(abs_inread);

            var mentionpub_inread = document.createElement('div');
            mentionpub_inread.id = "mentionpub_inread";
            var $mentionpub_inread = $(mentionpub_inread);
            $mentionpub_inread.html('Publicité');

            var skip_inread = document.createElement('div');
            skip_inread.id = "skip_inread";
            var $skip_inread = $(skip_inread);
            $skip_inread.html('Fermer');
            $skip_inread.click(function () {
                removeVideo($('#inreadContainer'))
            });


            container.append($ad_inread);
            $ad_inread.append($rel_inread);
            $rel_inread.append($abs_inread);
            $abs_inread.append(video);
            $abs_inread.append(mentionpub_inread);
            $abs_inread.append(skip_inread);

            controls($rel_inread, video, $abs_inread);

        });

        var  called = false;
        $( window ).on( "scroll", function() {
            if(($(window).scrollTop() > ofTopInreadContainer-300) && !called)
            {
                called = true;
                container.slideDown();
            }
        });

    }

    function controls(controlContainer, video, conteneurTimeBar)
    {
        var controlBar = document.createElement('div');
        controlBar.id = "controlBar";var $controlBar = $(controlBar);

        var playButton = document.createElement('div');var $playButton = $(playButton);
        playButton.id = 'playButton';
        $playButton.addClass('inread_icons');

        video.on('play',function(){

            $playButton.removeClass('inread_replay inread_play')
                       .addClass('inread_pause');
        });
        video.on('pause',function(){

            $playButton.removeClass('inread_pause inread_replay')
                        .addClass('inread_play');
        });
        video.on('ended',function(){

            $playButton.removeClass('inread_play inread_pause')
                        .addClass('inread_replay');
        });

        if(inread_autoplay){
            video[0].play();
        }else{
            $playButton.addClass('inread_play');

        }

        $(document).on('click' , '#playButton.inread_pause' ,function(){
            video[0].pause();
        });
        $(document).on('click' , '#playButton.inread_play' ,function(){
            video[0].play();
        });
        $(document).on('click' , '#playButton.inread_replay' ,function(){
            video[0].currentTime = 0;
            video[0].play();
        });



        var volumeButton = document.createElement('div');var $volumeButton = $(volumeButton);
        volumeButton.id = "volumeButton";
        $volumeButton.addClass('inread_icons');
        
        var volumeBar = document.createElement('div');var $volumeBar = $(volumeBar);
        volumeBar.id = "volumeBar";


        $volumeBar.slider({
            orientation: "horizontal",
            range: "min",
            slide: function(event, ui) {
                var volume = ui.value/100;
                setVolume(volume,$volumeButton,$vid[0]);
            },
            create: function(event, ui) {
                var volume = inread_soundOff ? 0 : 0.5;
                setVolume(volume,$volumeButton,$vid[0]);
            }
        });

        function setVolume(volume,bouton,video)
        {
            if(volume == 0){
                bouton.removeClass('volume_on').addClass('volume_off');
            }
            else{
                bouton.removeClass('volume_off').addClass('volume_on');
            }

            $volumeBar.slider("value", volume*100);
            video.volume = volume;
        }
        $volumeButton.click(function(){

            var volume = $volumeBar.slider("value");
            if(volume > 0){
               setVolume(0,$volumeButton,$vid[0]);
            }
            else{
               setVolume(0.5,$volumeButton,$vid[0]);
            }
         });



        var controlTime = document.createElement('div');var $controlTime = $(controlTime);
        controlTime.id = 'inread_controlTime';


        setInterval(function(){
                $controlTime.progressbar({ value: video[0].currentTime*100/video[0].duration });
                } , 1000
        );

        $controlTime.click(function(e) {
            var ev = e || window.event;
            var pos = $(this).offset();
            var diffx = ev.clientX - pos.left;
            $(this).progressbar({value: diffx*100/$(this).width()});
            var duration = video[0].duration;
            video[0].currentTime = diffx*duration/$(this).width();

        });

        var timeInfo = document.createElement('div');var $timeInfo = $(timeInfo);
        timeInfo.id = "timeInfo";
        $timeInfo.html('<span id="timeInfoC">00:00</span> / <span id="timeInfoD">00:00</span>');

        setInterval(function()
                    {
                      $('#timeInfoC').text(getTime(video[0].currentTime).minutes +':'+ getTime(video[0].currentTime).secondes);
                      $('#timeInfoD').text(getTime(video[0].duration).minutes+':'+getTime(video[0].duration).secondes);

                    } , 1000
        );

        function getTime(temps)
        {
            var minutes = Math.floor(temps/60);
            var secondes = Math.floor(temps%60);
            return {secondes: (secondes < 10? '0' : '')+secondes , minutes : (minutes < 10? '0' : '')+minutes}
        }

        if(!inread_hideControls)
        {
            $controlBar.append($playButton);
            $controlBar.append($volumeButton);
            $controlBar.append($volumeBar);
            $controlBar.append($timeInfo);
            conteneurTimeBar.append($controlTime);
            controlContainer.append($controlBar);
        }else{
            $controlBar.hide();
        }
    }


    function removeVideo(format){
        format.slideUp('fast',function(){format.remove()});
    }

</script>
