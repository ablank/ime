(function($, Drupal, undefined){
  /**
   * When set to enable mediaelement for all audio/video files add it to the page.
   */
  Drupal.behaviors.imediaelement = {
    attach: function(context, settings) {
      if (settings.imediaelement !== undefined) {
        // @todo Remove anonymous function.
        $.each(settings.imediaelement, function(selector, options) {
          var opts;
          $(selector, context).once('mediaelement', function() {
            if (options.controls) {
              $(this).mediaelementplayer(options.opts);
            }
            else {
              $(this).mediaelement();
            }
          });
        });
      }
      // The global option is seperate from the other selectors as it should be
      // run after any other selectors.
      if (settings.imediaelementAll !== undefined) {
        $('video,audio', context).once('mediaelement', function() {
          $(this).mediaelementplayer();
        });
      }
    }
  };
})(jQuery, Drupal);
