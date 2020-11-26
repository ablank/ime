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
    /*
     * General settings
     */
    $form['imediaelement'] = [
      '#type' => 'fieldset',
    ];

    $form['imediaelement']['player_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('General Player Settings'),
      '#weight' => 1,
    ];

    $form['imediaelement']['player_settings']['skin'] = [
      '#type' => 'select',
      '#title' => $this->t('Player Skin'),
      '#options' => [
        'native' => $this->t('Native'),
        'default' => $this->t('Default'),
        'dark' => $this->t('Dark'),
        'light' => $this->t('Light'),
        'bright' => $this->t('Bright'),
      ],
      '#default_value' => $config->get('skin'),
    ];
    
    $form['imediaelement']['player_settings']['setDimensions'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Set dimensions via JS instead of CSS.'),
      '#default_value' => $config->get('setDimensions'),
    ];

    $form['imediaelement']['player_settings']['classPrefix'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Class Prefix'),
      '#default_value' => $config->get('classPrefix'),
      '#placeholder' => $config->get('classPrefix'),
    ];
    
    $form['imediaelement']['player_settings']['controlsTimeoutDefault'] = [
      '#type' => 'number',
      '#title' => $this->t('Timeout Default'),
      '#description' => $this->t('Default timeout (in ms) before controls are hidden.'),
      '#default_value' => $config->get('controlsTimeoutDefault'),
      '#placeholder' => $config->get('controlsTimeoutDefault'),
    ];

    
    $form['imediaelement']['player_settings']['features'] = [
      '#type' => 'container',
      '#title' => $this->t('Player Features'),
    ];

    $form['imediaelement']['player_settings']['features']['features'] = [
      '#type' => 'checkboxes',
      '#options' => [
        'playPause' => $this->t('Play / Pause'),
        'progress' => $this->t('Progress'),
        'volume' => $this->t('Volume'),
        'time' => $this->t('Time'),
        'fullscreen' => $this->t('Fullscreen'),
        'tracks' => $this->t('Track List'),
        //'i18n' => $this->t('UI Language Switcher'),
      ],
      '#title' => $this->t('Media Controls to Display'),
      '#default_value' => $config->get('features'),
    ];
    
    $form['imediaelement']['player_settings']['features']['featureText'] = [
      '#type' => 'details',
      '#title' => $this->t('Player UI Text'),
    ];
    
    $form['imediaelement']['player_settings']['features']['featureText']['play'] = [
      '#type' => 'string',
      '#title' => $this->t('Play'),
      '#default_value' => $config->get('featureText.play'),
      '#placeholder' => $config->get('featureText.play'),
    ];
    
    $form['imediaelement']['player_settings']['features']['featureText']['pause'] = [
      '#type' => 'string',
      '#title' => $this->t('Pause'),
      '#default_value' => $config->get('featureText.pause'),
      '#placeholder' => $config->get('featureText.pause'),
    ];


    /*
     * Audio Settings
     */
    $form['imediaelement']['audio_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Audio Player Settings'),
      '#weight' => 2,
    ];

    $form['imediaelement']['audio_settings']['audioWidth'] = [
      '#type' => 'number',
      '#title' => $this->t('Player Width'),
      '#default_value' => $config->get('audioWidth'),
      '#placeholder' => $config->get('audioWidth'),
    ];

    $form['imediaelement']['audio_settings']['audioHeight'] = [
      '#type' => 'number',
      '#title' => $this->t('Player Height'),
      '#default_value' => $config->get('audioHeight'),
      '#placeholder' => $config->get('audioHeight'),
    ];

    /*
     * Video Settings
     */
    $form['imediaelement']['video_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Video Player Settings'),
      '#weight' => 3,
    ];

    $form['imediaelement']['video_settings']['videoWidth'] = [
      '#type' => 'number',
      '#title' => $this->t('Player Width'),
      '#default_value' => 480,
      '#placeholder' => $config->get('videoWidth'),
    ];

    $form['imediaelement']['video_settings']['videoHeight'] = [
      '#type' => 'number',
      '#title' => $this->t('Player Height'),
      '#default_value' => 270,
      '#placeholder' => $config->get('videoHeight'),
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
      '#default_value' => $config->get('stretching'),
    ];

    $form['imediaelement']['video_settings']['clickToPlayPause'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Click To Play Pause'),
      '#description' => $this->t('Click on video / poster to play or pause media.'),
      '#default_value' => $config->get('clickToPlayPause'),
    ];

    $form['imediaelement']['video_settings']['hideVideoControlsOnLoad'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide Video Controls On Load'),
      '#default_value' => $config->get('hideVideoControlsOnLoad'),
    ];
    
    $form['imediaelement']['video_settings']['hideVideoControlsOnPause'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide Video Controls On Pause'),
      '#default_value' => $config->get('hideVideoControlsOnPause'),
    ];

    $form['imediaelement']['video_settings']['showTimecodeFrameCount'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show Timecode Frame Count'),
      '#default_value' => $config->get('showTimecodeFrameCount'),
    ];

    $form['imediaelement']['video_settings']['framesPerSecond'] = [
      '#type' => 'number',
      '#title' => $this->t('Frames Per Second'),
      '#default_value' => $config->get('framesPerSecond'),
      '#placeholder' => $config->get('framesPerSecond'),
    ];

    $form['imediaelement']['video_settings']['controlsTimeoutMouseEnter'] = [
      '#type' => 'number',
      '#title' => $this->t('controlsTimeoutMouseEnter'),
      '#default_value' => $config->get('controlsTimeoutMouseEnter'),
      '#placeholder' => $config->get('controlsTimeoutMouseEnter'),
    ];
    
    $form['imediaelement']['video_settings']['controlsTimeoutMouseLeave'] = [
      '#type' => 'number',
      '#title' => $this->t('controlsTimeoutMouseLeave'),
      '#default_value' => $config->get('controlsTimeoutMouseLeave'),
      '#placeholder' => $config->get('controlsTimeoutMouseLeave'),
    ];

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
  private function formValues(array $fields, FormStateInterface $form_state) {
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

    $formValues = $this->configFactory->getEditable(static::SETTINGS);

    $player_settings_fields = [
      'skin',
      'classPrefix',      
      'audioWidth',
      'audioHeight',
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
      'enableKeyboard',
      'setDimensions',
      'enableAutosize',
      'timeFormat',
      'alwaysShowHours',
      'secondsDecimalLength',
      'pauseOtherPlayers',
      'defaultSeekInterval',
      'loop',
      'autoRewind',
      'features',
      'featureText',
    ];

    foreach ($player_settings_fields as $field) {
      $formValues->set($field, $form_state->getValue($field));
    }


    $formValues->save();

    parent::submitForm($form, $form_state);
  }
}
