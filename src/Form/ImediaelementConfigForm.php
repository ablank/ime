<?php

namespace Drupal\imediaelement\Form;

use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for imediaelement.js module.
 */
class ImediaelementConfigForm extends ConfigFormBase {
/** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'imediaelement.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'imediaelement_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [static::SETTINGS];
  }

  /**
   * Gets the list of available version numbers for the library.
   *
   * @return string[]
   *   The array of version strings.
   *//*
  protected function getVersionList() {
    $data = $this->getApiData(['fields' => 'assets']);
    return array_map(function ($asset) {
      return $asset->version;
    }, $data->assets);
  }*/

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);
    
    $form['default_settings'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Default Settings'),
    ];

    // Configuration that applies to all types of players.
    $player_config = $config->get('default_settings');

    $form['default_settings']['player_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('General Player Settings'),
      '#weight' => 1,
    ];

    $form['default_settings']['player_settings']['class_prefix'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Class Prefix'),
      '#description' => $this->t('Class prefix for player elements.'),
      '#default_value' => $player_config['class_prefix'] ?? '',
      '#placeholder' => 'mejs__',
    ];

    $form['default_settings']['player_settings']['set_dimensions'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Set Dimensions'),
      '#description' => $this->t('Set dimensions via JS instead of CSS.'),
      '#default_value' => $player_config['set_dimensions'] ?? TRUE,
    ];

    // Configuration for video players.
    $video_settings = $config->get('default_settings.video_settings');

    $form['default_settings']['video_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Video Player Settings'),
      '#weight' => 2,
    ];

    $form['default_settings']['video_settings']['default_video_width'] = [
      '#type' => 'number',
      '#title' => $this->t('Default Video Width'),
      '#description' => $this->t('Default width if the <code>&#60;video&#62;</code> width is not specified'),
      '#default_value' => $video_settings['default_video_width'] ?? '',
      '#placeholder' => '480',
    ];

    $form['default_settings']['video_settings']['default_video_height'] = [
      '#type' => 'number',
      '#title' => $this->t('Default Video Height'),
      '#description' => $this->t('Default width if the <code>&#60;video&#62;</code> height is not specified'),
      '#default_value' => $video_settings['default_video_height'] ?? '',
      '#placeholder' => '270',
    ];

    $form['default_settings']['video_settings']['video_width'] = [
      '#type' => 'number',
      '#title' => $this->t('Video Width'),
      '#description' => $this->t('If set, overrides <code>&#60;video&#62;</code> width'),
      '#default_value' => $video_settings['video_width'] ?? '',
      '#placeholder' => '-1',
    ];

    $form['default_settings']['video_settings']['video_height'] = [
      '#type' => 'number',
      '#title' => $this->t('Video Height'),
      '#description' => $this->t('If set, overrides <code>&#60;video&#62;</code> height'),
      '#default_value' => $video_settings['video_height'] ?? '',
      '#placeholder' => '-1',
    ];

    // Configuration for audio players.
    $audio_settings = $config->get('default_settings.audio_settings');

    $form['default_settings']['audio_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Audio Player Settings'),
      '#weight' => 3,
    ];

    $form['default_settings']['audio_settings']['default_audio_width'] = [
      '#type' => 'number',
      '#title' => $this->t('Default Audio Width'),
      '#description' => $this->t('Default width if the <code>&#60;audio&#62;</code> width is not specified'),
      '#default_value' => $audio_settings['default_audio_width'] ?? '',
      '#placeholder' => '400',
    ];

    $form['default_settings']['audio_settings']['default_audio_height'] = [
      '#type' => 'number',
      '#title' => $this->t('Default Audio Height'),
      '#description' => $this->t('Default width if the <code>&#60;audio&#62;</code> height is not specified'),
      '#default_value' => $audio_settings['default_audio_height'] ?? '',
      '#placeholder' => '30',
    ];

    $form['default_settings']['audio_settings']['audio_width'] = [
      '#type' => 'number',
      '#title' => $this->t('Audio Width'),
      '#description' => $this->t('If set, overrides <code>&#60;audio&#62;</code> width'),
      '#default_value' => $audio_settings['audio_width'] ?? '',
      '#placeholder' => '-1',
    ];

    $form['default_settings']['audio_settings']['audio_height'] = [
      '#type' => 'number',
      '#title' => $this->t('Audio Height'),
      '#description' => $this->t('If set, overrides <code>&#60;audio&#62;</code> height'),
      '#default_value' => $audio_settings['audio_height'] ?? '',
      '#placeholder' => '-1',
    ];
/*
    poster: ""
  # When the video is ended, show the poster.
  showPosterWhenEnded: false
  # When the video is paused, show the poster.
  showPosterWhenPaused: false
  # Default if the <video width> is not specified
  defaultVideoWidth: 480
  # Default if the <video height> is not specified
  defaultVideoHeight: 270
  # If set, overrides <video width>
  videoWidth: -1
  # If set, overrides <video height>
  videoHeight: -1
  # Default if the user doesn't specify
  defaultAudioWidth: 400
  # Default if the user doesn't specify
  defaultAudioHeight: 40
  # Default amount to move forward or backward when left/right key is pressed = duration * this val
  defaultSeekInterval: 0.05
  # Set dimensions via JS instead of CSS
  setDimensions: true
  # Width of audio player
  audioWidth: -1
  # Height of audio player
  audioHeight: -1
  # Useful for <audio> player loops
  loop: false
  # Rewind to beginning when media ends
  autoRewind: true
  # Resize to media dimensions
  enableAutosize: true
   # Time format to use. Default: 'mm:ss'
   # Supported units:
   #   h: hour
   #   m: minute
   #   s: second
   #   f: frame count
   # When using 'hh', 'mm', 'ss' or 'ff' we always display 2 digits.
   # If you use 'h', 'm', 's' or 'f' we display 1 digit if possible.
   #
   # Example to display 75 seconds:
   # Format 'mm:ss': 01:15
   # Format 'm:ss': 1:15
   # Format 'm:s': 1:15
  timeFormat: ""
  # Force the hour marker (##:00:00)
  alwaysShowHours: false
  # Show framecount in timecode (##:00:00:00)
  showTimecodeFrameCount: false
  # Used when showTimecodeFrameCount is set to true
  framesPerSecond: 25
  # Hide controls when playing and mouse is not over the video
  alwaysShowControls: false
  # Display the video control when media is loading
  hideVideoControlsOnLoad: false
  # Display the video controls when media is paused
  hideVideoControlsOnPause: false
  # Enable click video element to toggle play/pause
  clickToPlayPause: true
  # Time in ms to hide controls
  controlsTimeoutDefault: 1500
  # Time in ms to trigger the timer when mouse moves
  controlsTimeoutMouseEnter: 2500
  # Time in ms to trigger the timer when mouse leaves
  controlsTimeoutMouseLeave: 1000
  # Force iPad's native controls
  iPadUseNativeControls: false
  # Force iPhone's native controls
  iPhoneUseNativeControls: false
  # Force Android's native controls
  AndroidUseNativeControls: false
  # If set to `true`, all the default control elements listed in features above will be used, and the features will
  # add other features
  useDefaultControls: false
  # Only for dynamic
  isVideo: true
  # Stretching modes (auto, fill, responsive, none)
  stretching: auto
  # Prefix class names on elements
  classPrefix: mejs__
  # Turn keyboard support on and off for this instance
  enableKeyboard: true
  # When this player starts, it will pause other players
  pauseOtherPlayers: true
  # Number of decimal places to show if frames are shown
  secondsDecimalLength: 0
  # Features to show
  features: 
    - playpause
    - current
    - progress
    - duration
    - tracks
    - volume
    - fullscreen
  featureText: 
    # core/mediaelement.js
    downloadFile: Download File
    # core/player.js
    videoPlayer: Video Player
    audioPlayer: Audio Player
    # renderers/flash.js
    flashRequired: You are using a browser that does not have Flash player enabled or installed. Please turn on your Flash player plugin or download the latest version from https:#get.adobe.com/flashplayer/
    # features/playpause.js
    play: Play
    pause: Pause
    # features/progress.js
    current: Current
    progress: Progress
    duration: Duration
    tracks: Tracks
    # features/volume.js
    volumeSlider: Volume Control
    volumeHelpText: Use Up/Down Arrow keys to increase or decrease volume.
    mute: Mute
    unmute: Unmute
    # features/fullscreen.js
    fullscreen: Fullscreen
    # features/progress.js
    timeSlider: Play Time
    timeHelpText: Use Left/Right Arrow keys to advance one second, Up/Down arrows to advance ten seconds.
    liveBroadcast: Live Broadcast
    # features/tracks.js
    captionsSubtitles: Captions/Subtitles
    captionsChapters: Chapters
    none: None
    # features/i18n.js
    languages: 
*/

/*
    // Create configurations for where the library is loaded from.
    $library_config = $config->get('library_settings');

    $form['library_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Library Settings'),
      '#open' => TRUE,
    ];

    $form['library_settings']['library_source'] = [
      '#type' => 'radios',
      '#title' => $this->t('Library Source'),
      '#options' => [
        'local' => $this->t('Local Download'),
        'cdnjs' => $this->t('CDN (Provided by CDNJS.com)'),
      ],
      '#default_value' => $library_config['library_source'] ?? 'local',
      '#required' => TRUE,
    ];

    $form['library_settings']['cdnjs_settings'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('CDNJS Settings'),
      '#states' => [
        'visible' => [
          ':input[name="library_source"]' => ['value' => 'cdnjs'],
        ],
      ],
    ];

    $version_options = $this->getVersionList();
    $form['library_settings']['cdnjs_settings']['library_version'] = [
      '#type' => 'select',
      '#title' => $this->t('Library Version'),
      '#options' => array_combine($version_options, $version_options),
      '#default_value' => $library_config['cdnjs_settings']['library_version'] ?? $version_options[0],
    ];

    // Global configuration items for player functionality.
    $global_config = $config->get('default_settings.global');

    $form['default_settings']['attach_sitewide'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable imediaelement.js site wide'),
      '#description' => $this->t('Attach the imediaelement.js library throughtout the entire site. Any <code>audio</code> or <code>video</code> HTML tag will have the player applied to them.'),
      '#default_value' => $global_config['attach_sitewide'] ?? FALSE,
      '#weight' => 0,
    ];
 */



    $api_link = Link::fromTextAndUrl(
      $this->t('API Documentation'),
      Url::fromUri('https://github.com/imediaelement/imediaelement/blob/master/docs/api.md#imediaelementplayer')
    );

    $form['default_settings']['api_link'] = [
      '#markup' => $this->t('<small>For a full explaination of configuration options, see the @api_link.</small>', [
        '@api_link' => $api_link->toString(),
      ]),
      '#weight' => 10,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Prepare our configuration items for saving.
   *
   * @param array $fields
   *   The field names we want to parse.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The submitted form state.
   *
   * @return array
   *   The settings to save keyed by their name.
   */
  private function getConfigurationValues(array $fields, FormStateInterface $form_state) {
    $values = [];

    foreach ($fields as $field) {
      $value = $form_state->getValue($field);

      if (!empty($value) || $value === 0) {
        $values[$field] = $value;
      }
    }

    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->configFactory->getEditable(static::SETTINGS);

    $player_settings_fields = ['class_prefix', 'set_dimensions'];

    $default_settings = [];

    $default_settings['player_settings'] = $this->getConfigurationValues(
      $player_settings_fields,
      $form_state
    );

    $video_settings_fields = [
      'default_video_width',
      'default_video_height',
      'video_width',
      'video_height',
    ];

    $default_settings['video_settings'] = $this->getConfigurationValues(
      $video_settings_fields,
      $form_state
    );

    $audio_settings_fields = [
      'default_audio_width',
      'default_audio_height',
      'audio_width',
      'audio_height',
    ];
    $default_settings['audio_settings'] = $this->getConfigurationValues(
      $audio_settings_fields,
      $form_state
    );

    $config->set('default_settings', $default_settings);
    $config->save();

    parent::submitForm($form, $form_state);
  }

}
