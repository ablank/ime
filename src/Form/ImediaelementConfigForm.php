<?php

namespace Drupal\imediaelement\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Configuration form for imediaelement.js module.
 */
class IMediaElementConfigForm extends ConfigFormBase {
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
    return 'imediaelement_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [static::SETTINGS];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);
    // Configuration that applies to all players.
    $player_config = $config->get('imediaelement_settings.player_settings');
    // Configuration for audio players.
    $audio_settings = $config->get('imediaelement_settings.audio_settings');
    // Configuration for video players.
    $video_settings = $config->get('imediaelement_settings.video_settings');

    /*
     * General settings
     *
    'skin',
    'classPrefix',
    'enableKeyboard',
    'setDimensions',
    'enableAutosize',
    'timeFormat',
    'alwaysShowHours',
    'secondsDecimalLength',
    'pauseOtherPlayers',
    'defaultSeekInterval',
    'featureText',
     */
    $form['imediaelement'] = [
      '#type' => 'fieldset',
      // '#title' => $this->t('Default Settings'),
    ];

    $form['imediaelement']['player_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('General Player Settings'),
      '#weight' => 1,
    ];

    $form['imediaelement']['player_settings']['skin'] = [
      '#type' => 'select',
      '#title' => $this->t('Player Skin'),
      '#description' => $this->t('Select skin style for mediaplayer elements.'),
      '#options' => [
        'default' => $this->t('Default'),
        'dark' => $this->t('Dark'),
        'dark_large' => $this->t('Dark [Large]'),
        'light' => $this->t('Light'),
        'light_large' => $this->t('Light [Large]'),
      ],
      '#default_value' => 'default',
    ];

    $form['imediaelement']['player_settings']['classPrefix'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Class Prefix'),
      '#description' => $this->t('Class prefix for player elements.'),
      '#default_value' => 'mejs__',
      '#placeholder' => $player_config['classPrefix'],
    ];

    $form['imediaelement']['player_settings']['setDimensions'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Set Dimensions'),
      '#description' => $this->t('Set dimensions via JS instead of CSS.'),
      '#default_value' => TRUE,
    ];
    
    $form['imediaelement']['player_settings']['controlsTimeoutDefault'] = [
      '#type' => 'number',
      '#title' => $this->t('Timeout Default'),
      '#description' => $this->t('Default timeout (in ms) before controls are hidden.'),
      '#default_value' => 1000,
      '#placeholder' => $player_config['controlsTimeoutDefault'],
    ];

    $form['imediaelement']['player_settings']['controlsTimeoutMouseEnter'] = [
      '#type' => 'number',
      '#title' => $this->t('mouseEnter Timeout'),
      '#description' => $this->t('Time to wait (in ms) after the mouseEnter event is fired.'),
      '#default_value' => 1000,
      '#placeholder' => $player_config['controlsTimeoutMouseEnter'],
    ];
    
    $form['imediaelement']['player_settings']['controlsTimeoutMouseLeave'] = [
      '#type' => 'number',
      '#title' => $this->t('mouseLeave Timeout'),
      '#description' => $this->t('Time to wait (in ms) after the mouseLeave event is fired.'),
      '#default_value' => 1000,
      '#placeholder' => $player_config['controlsTimeoutMouseLeave'],
    ];
    
    /*
     * Audio Settings
     *
    'audioWidth',
    'audioHeight',
    'features',
    'loop',
    'autoRewind',
     */
    $form['imediaelement']['audio_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Audio Player Settings'),
      '#weight' => 3,
    ];

    $form['imediaelement']['audio_settings']['audioWidth'] = [
      '#type' => 'number',
      '#title' => $this->t('Audio Width'),
      '#description' => $this->t('If set, overrides <code>&#60;audio&#62;</code> width'),
      '#default_value' => 400,
      '#placeholder' => $audio_settings['audioWidth'],
    ];

    $form['imediaelement']['audio_settings']['audioHeight'] = [
      '#type' => 'number',
      '#title' => $this->t('Audio Height'),
      '#description' => $this->t('If set, overrides <code>&#60;audio&#62;</code> height'),
      '#default_value' => 40,
      '#placeholder' => $audio_settings['audioHeight'],
    ];

    /*
     * Video Settings
     *
    'videoWidth',
    'videoHeight',
    'features',
    'stretching',
    'framesPerSecond',
    'showTimecodeFrameCount',
    'hideVideoControlsOnLoad',
    'hideVideoControlsOnPause',
    'clickToPlayPause',
     */
    $form['imediaelement']['video_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Video Player Settings'),
      '#weight' => 2,
    ];

    $form['imediaelement']['video_settings']['videoWidth'] = [
      '#type' => 'number',
      '#title' => $this->t('Video Width'),
      '#description' => $this->t('If set, overrides <code>&#60;video&#62;</code> width'),
      '#default_value' => 480,
      '#placeholder' => $video_settings['videoWidth'],
    ];

    $form['imediaelement']['video_settings']['videoHeight'] = [
      '#type' => 'number',
      '#title' => $this->t('Video Height'),
      '#description' => $this->t('If set, overrides <code>&#60;video&#62;</code> height'),
      '#default_value' => 270,
      '#placeholder' => $video_settings['videoHeight'],
    ];

    $form['imediaelement']['video_settings']['features'] = [
      '#type' => 'checkboxes',
      '#options' => [
        'playpause' => $this->t('Play / Pause'),
        'progress' => $this->t('Progress'),
        'volume' => $this->t('Volume'),
        'time' => $this->t('Time'),
        'fullscreen' => $this->t('Fullscreen'),
        'tracks' => $this->t('Track List'),
        'i18n' => $this->t('UI Language Switcher'),
      ],
      '#title' => $this->t('Video UI controls to implement.'),
      '#default_value' => [
        'playpause',
        'progress',
        'volume',
        'time',
        'fullscreen'
      ],
    ];

    $form['imediaelement']['video_settings']['stretching'] = [
      '#type' => 'select',
      '#title' => $this->t('Video Stretching Mode'),
      '#description' => $this->t('If set, overrides <code>&#60;video&#62;</code> height'),
      '#options' => [
        'auto', 
        'fill', 
        'responsive', 
        'none', 
      ],
      '#default_value' => 'auto',
    ];

    $form['imediaelement']['player_settings']['clickToPlayPause'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Click To Play Pause'),
      '#description' => $this->t('Click on video to play or pause'),
      '#default_value' => TRUE,
    ];

    $form['imediaelement']['player_settings']['hideVideoControlsOnLoad'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide Video Controls On Load'),
      '#description' => $this->t('Hide Video Controls On Load'),
      '#default_value' => TRUE,
    ];
    
    $form['imediaelement']['player_settings']['hideVideoControlsOnPause'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide Video Controls On Pause'),
      '#description' => $this->t('Hide Video Controls On Pause'),
      '#default_value' => FALSE,
    ];

    $form['imediaelement']['video_settings']['framesPerSecond'] = [
      '#type' => 'number',
      '#title' => $this->t('Frames Per Second'),
      '#description' => $this->t('Video frames per second'),
      '#default_value' => 24,
      '#placeholder' => $video_settings['framesPerSecond'],
    ];

    $form['imediaelement']['player_settings']['showTimecodeFrameCount'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show Timecode Frame Count'),
      '#description' => $this->t(''),
      '#default_value' => FALSE,
    ];
    /*
    'clickToPlayPause',
    'controlsTimeoutDefault',
    'controlsTimeoutMouseEnter',
    'controlsTimeoutMouseLeave',
    'features', */

    /*
     * Help / Documentation
     */
    $api_link = Link::fromTextAndUrl(
      $this->t('API Documentation'),
      Url::fromUri('https://github.com/imediaelement/imediaelement/blob/master/docs/api.md#imediaelementplayer')
    );

    $form['imediaelement']['api_link'] = [
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
  private function getFormValues(array $fields, FormStateInterface $form_state) {
    $form_values = [];

    foreach ($fields as $field) {
      $value = $form_state->getValue($field);

      if (!empty($value) || $value === 0) {
        $form_values[$field] = $value;
      }
    }

    return $form_values;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $getFormValues = $this->configFactory->getEditable(static::SETTINGS);

    // $imediaelement_settings = [];
    $player_settings_fields = [
      'skin',
      'classPrefix',
      'enableKeyboard',
      'setDimensions',
      'enableAutosize',
      'timeFormat',
      'alwaysShowHours',
      'secondsDecimalLength',
      'pauseOtherPlayers',
      'defaultSeekInterval',
      'featureText',
    ];

    $audio_settings_fields = [
      'audioWidth',
      'audioHeight',
      'loop',
      'autoRewind',
      'features',
    ];

    $video_settings_fields = [
      'videoWidth',
      'videoHeight',
      'stretching',
      'framesPerSecond',
      'showTimecodeFrameCount',
      'hideVideoControlsOnLoad',
      'hideVideoControlsOnPause',
      'clickToPlayPause',
      'controlsTimeoutDefault',
      'controlsTimeoutMouseEnter',
      'controlsTimeoutMouseLeave',
      'features',
    ];

    foreach ($player_settings_fields as $field) {
      $getFormValues->set($field, $form_state->getValue($field));
    }

    foreach ($audio_settings_fields as $field) {
      $getFormValues->set($field, $form_state->getValue($field));
    }

    foreach ($video_settings_fields as $field) {
      $getFormValues->set($field, $form_state->getValue($field));
    }

    $getFormValues->save();

    parent::submitForm($form, $form_state);
  }

  /**
   * Gets the list of available version numbers for the library.
   *
   * @return string[]
   *   The array of version strings.
   */
  /*
  protected function getVersionList() {
  $data = $this->getApiData(['fields' => 'assets']);
  return array_map(function ($asset) {
  return $asset->version;
  }, $data->assets);
  }*/
}
