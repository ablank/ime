/**
 * @file
 * Javascript integration between Drupal & Mediaelement.js.
 */

(function ($, Drupal, undefined) {
  Drupal.behaviors.imediaelement = {
    attach: function (context, settings) {
      if (settings.imediaelement !== undefined) {
        $.each(settings.imediaelement, function (selector, options) {
          var opts = $.extend({
            // The order of controls (+ other plugins) on the control bar.
            features: [
              'playpause',
              'volume',
              'current',
              'progress',
              'duration',
              'fullscreen'
            ],
            // Source URL of poster image.
            poster: '',
            // Fixed player dimension.
            setDimensions: true,
            // Hide controls when playing and mouse is not over the video.
            alwaysShowControls: false,
            // Width of audio player.
            audioWidth: 240,
            // Height of audio player.
            audioHeight: 32,
            // If the <video width> is not specified, this is the default.
            defaultVideoWidth: 480,
            // If the <video height> is not specified, this is the default.
            defaultVideoHeight: 270,
            // Initial volume when the player starts.
            startVolume: 0.75,
            // Useful for <audio> player loops.
            loop: false,
            // When this player starts, it will pause other players.
            pauseOtherPlayers: true,
            // Enables Flash and Silverlight to resize to content size.
            enableAutosize: true,
            // Forces the hour marker (##:00:00).
            // alwaysShowHours: false,
            // Show framecount in timecode (##:00:00:00).
            // showTimecodeFrameCount: false,
            // Used when showTimecodeFrameCount is set to true.
            // framesPerSecond: 25,
            // Turns keyboard support on and off for this instance.
            enableKeyboard: true,
            // Array of keyboard commands.
            // keyActions: [],
            // Force Android's native controls.
            AndroidUseNativeControls: false,
            // Force iPad's native controls.
            iPadUseNativeControls: false,
            // Force iPhone's native controls.
            iPhoneUseNativeControls: false

          }, options.opts);

          $(selector, context).once('mediaelement', function () {
            // console.log(opts);
            if (opts.controls) {
              $(this).mediaelementplayer(opts);
            }
            else {
              var mediaelement = new MediaElement($(this).get(0), {
                startVolume: opts.startVolume
              });
              mediaelement.play();
            }
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
