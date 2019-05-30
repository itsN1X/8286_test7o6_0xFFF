  var tag = document.createElement('script');

  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  var data_vid = jQuery('#player').data('vid');

  if(data_vid) {

  var videoIDs = [data_vid];

  var player, currentVideoId = 0;

  function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
  playerVars: {
    controls: 0,
    showinfo: 0,
    modestbranding: 0,
  },
  events: {
  'onReady': onPlayerReady,
  'onStateChange': onPlayerStateChange
  }
  });
  }

  function onPlayerReady(event) {
  event.target.loadVideoById(videoIDs[currentVideoId]);
  player.mute();
  }

  function onPlayerStateChange(event) {
  if (event.data == YT.PlayerState.ENDED) {

  event.target.loadVideoById(videoIDs[currentVideoId]);

  }
  }

  }
jQuery(document).ready(function(){
  jQuery('a.arrow').on('click',function (e) {
      e.preventDefault();

      var target = this.hash,
      jQuerytarget = jQuery(target);

      jQuery('html, body').stop().animate({
          'scrollTop': jQuerytarget.offset().top
      }, 900, 'swing', function () {
         window.location.href.split('#')[0] = target;
      });
  });
});