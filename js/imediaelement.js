(function ($, Drupal) {
  Drupal.behaviors.imediaelement = {
    attach(context, settings) {
      $('.mediaelementjs', context).once('mediaelement').each(function () {
        $(this).mediaelementplayer(settings.imediaelement);
      });
    }
  };
})(jQuery, Drupal);
