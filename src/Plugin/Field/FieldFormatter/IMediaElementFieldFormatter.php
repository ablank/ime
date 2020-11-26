<?php

namespace Drupal\imediaelement\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
/**
 * Base class for imediaelement.js fields.
 */
trait IMediaElementFieldFormatter {

    /**
     * {@inheritdoc}
     */
    public static function defaultSettings() {
        return [
                //'download_link' => FALSE,
                //'download_text' => '',
                ] + parent::defaultSettings();
    }

    /**
     * {@inheritdoc}
     */
    public function settingsForm(array $form, FormStateInterface $form_state) {
        return parent::settingsForm($form, $form_state) + [
            'download_link' => [
                '#title' => $this->t('Download Link'),
                '#type' => 'checkbox',
                '#default_value' => $this->getSetting('download_link'),
            ],
            'download_text' => [
                '#title' => $this->t('Download Text'),
                '#type' => 'textfield',
                '#default_value' => $this->getSetting('download_text'),
                '#states' => [
                    'visible' => [
                        ':input[name*="download_link"]' => ['checked' => TRUE],
                    ],
                ],
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];
        //$summary[] = $this->t('Displays the random string.');
        /*
        $summary = parent::settingsSummary();
        $for_download = $this->settings['download_link'];

        $summary[] = $this->t('Provide Download Link: %download', [
            '%download' => $for_download ? $this->t('yes') : $this->t('no'),
        ]);

        if ($for_download) {
            $summary[] = $this->t('Download Link Text: %link_text', [
                '%link_text' => $this->settings['download_text'],
            ]);
        }
        */
        return $summary;
    }
    
    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $element = [];

        foreach ($items as $delta => $item) {
            // Render each element as markup.
            $element[$delta] = ['#markup' => $item->value];
        }

        /*
        $elements = parent::viewElements($items, $langcode);
        $library_source = \Drupal::config('imediaelement.settings')
                ->get('library_settings.library_source');

        // Attach the imediaelement library to the elements as well as settings.
        foreach ($elements as &$element) {
            $element['#download_link'] = $this->settings['download_link'];
            $element['#download_text'] = $this->settings['download_text'];
        }*/

        return $elements;
    }

}
