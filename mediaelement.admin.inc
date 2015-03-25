<?php
/**
 * @file
 * Admin only functionality for the mediaelement module.
 */

/**
 * Menu form callback; Display the MediaElement admin form.
 */
function mediaelement_admin_form() {
  //variable_del('mediaelement_default_skin');
  $form = array();
  $libraries = libraries_get_libraries();
  $libpath = libraries_get_path('mediaelement', FALSE);

  // Detect if the library is available. If it is not available display message.
  if (!isset($libraries['mediaelement'])) {
    $form['message'] = array(
      '#markup' => '<p>' . t('The MediaElement.js library is not installed. Please download the library from <a href="!url">MediaElementjs.com</a> and place it in your libraries folder.', array('!url' => 'http://mediaelementjs.com')) . '</p>',
    );
  }
  $form['mediaelement_default_skin'] = array(
    '#title' => t('Player Skin'),
    '#type' => 'select',
    '#options' => [
      $libpath . '/build/mediaelementplayer.min.css' => t('Default'),
      $libpath . '/build/mediaelementplayer_light.min.css' => t('ME Light'),
      $libpath . '/build/mediaelementplayer_dark.min.css' => t('ME Dark'),
      $libpath . '/build/mediaelementplayer_large_light.min.css' => t('ME Large Light'),
      $libpath . '/build/mediaelementplayer_large_dark.min.css' => t('ME Large Dark'),
      //$libpath . '/build/mediaelementplayer_ted.min.css' => t('TED'),
      //$libpath . '/build/mediaelementplayer_wmp.min.css' => t('WMP'),
    ],
    '#default_value' => variable_get('mediaelement_default_skin'),
  );

  $form['mediaelement_sitewide'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable MediaElement.js site wide'),
    '#default_value' => variable_get('mediaelement_sitewide', FALSE),
  );

  // Display a sample video. We add the library here because we cannot be sure
  // it is otherwise included in the page.
  drupal_add_library('mediaelement', 'mediaelement');
  drupal_add_js(drupal_get_path('module', 'mediaelement') . '/mediaelement.js');
  drupal_add_js(array('mediaelementAll' => TRUE), array('type' => 'setting'));
  $form['test'] = array(
    '#markup' => '<video width="360" height="203" id="player1" src="'. base_path(). '/' . $libpath . '/media/echo-hereweare.mp4"><p>Your browser leaves much to be desired.</p></video>',
  );

  return system_settings_form($form);
}
