<?php

namespace Drupal\imediaelement\Plugin\Field\FieldFormatter;

use Drupal\file\Plugin\Field\FieldFormatter\FileAudioFormatter;

/**
 * Plugin implementation of the 'imediaelement_file_audio' formatter.
 *
 * @FieldFormatter(
 *   id = "imediaelement_file_audio",
 *   label = @Translation("imediaelement.js Audio"),
 *   field_types = {
 *     "file"
 *   }
 * )
 */
class IMediaElementFieldFormatterAudio extends FileAudioFormatter {
  
  use IMediaElementFieldFormatter;

}
