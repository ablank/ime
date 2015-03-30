(function ($, Drupal, undefined) {
  /**
   * When set to enable mediaelement for all audio/video files add it to the page.
   */
  Drupal.behaviors.imediaelement = {
    attach: function (context, settings) {
      if (settings.imediaelement !== undefined) {
        // @todo Remove anonymous function.
        $.each(settings.imediaelement, function (selector, options) {
          var opts = $.extend({
            // the order of controls you want on the control bar (and other plugins below)
            features: [
              'playpause',
              'volume',
              'current',
              'progress',
              'duration',
              'fullscreen'
            ],
            // Hide controls when playing and mouse is not over the video
            alwaysShowControls: false,
            // width of audio player
            audioWidth: 240,
            // height of audio player
            audioHeight: 32,
            // if the <video width> is not specified, this is the default
            defaultVideoWidth: 480,
            // if the <video height> is not specified, this is the default
            defaultVideoHeight: 270,
            // initial volume when the player starts
            startVolume: 0.8,
            // useful for <audio> player loops
            loop: false,
            // when this player starts, it will pause other players
            pauseOtherPlayers: true,
            // enables Flash and Silverlight to resize to content size
            enableAutosize: true,
            // forces the hour marker (##:00:00)
            // alwaysShowHours: false,
            // show framecount in timecode (##:00:00:00)
            // showTimecodeFrameCount: false,
            // used when showTimecodeFrameCount is set to true
            // framesPerSecond: 25,
            // turns keyboard support on and off for this instance
            enableKeyboard: true,
            // array of keyboard commands
            // keyActions: [],
            // force Android's native controls
            AndroidUseNativeControls: false,
            // force iPad's native controls
            iPadUseNativeControls: false,
            // force iPhone's native controls
            iPhoneUseNativeControls: false

          }, options.opts);

          $(selector, context).once('mediaelement', function () {
            //console.log(opts);

            if (opts.controls == false) {
              opts.features = [];
              /*
              $(this).parents().find('.mejs-controls').css({
                'display': 'none',
                'visibility': 'hidden',
                'left': '-999999em'
              });
              */
              // console.log($(this).parent().siblings());
            }
            
            $(this).mediaelementplayer(opts);
          });
        });
      }
      // The global option is seperate from the other selectors as it should be
      // run after any other selectors.
      if (settings.imediaelementAll !== undefined) {
        $('video,audio', context).once('mediaelement', function () {
          $(this).mediaelementplayer();
        });
      }
    }
  };
})(jQuery, Drupal);