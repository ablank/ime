(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.imediaelement = {
    attach: function attach(context) {
      var $context = $(context);

      console.log(drupalSettings);
      //console.log(drupalSettings.imediaelement);
      $context.find('.mediaelementjs').once('mediaelement').each(function () {
        $(this).mediaelementplayer(drupalSettings.imediaelement);
      });

    }
  };
})(jQuery, Drupal, drupalSettings);