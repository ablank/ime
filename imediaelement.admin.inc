<?php
/**
 * @file
 * Admin only functionality for the imediaelement module.
 */

/**
 * Menu form callback; Display the MediaElement admin form.
 */
function imediaelement_admin_form() {
  $form = array();
  $libraries = libraries_get_libraries();
  $libpath = libraries_get_path('imediaelement', FALSE);

  // Detect if the library is available. If it is not available display message.
  if (!isset($libraries['imediaelement'])) {
    $form['message'] = array(
      '#markup' => '<p>' . t('The "imediaelement" library is not installed. Please download the library from <a href="!url">MediaElementjs.com</a> and place it in your libraries folder.', array('!url' => 'http://mediaelementjs.com')) . '</p>',
    );
  }

  $form['imediaelement_skin'] = array(
    '#title' => t('Player Skin'),
    '#type' => 'select',
    '#options' => [
      $libpath . '/build/mediaelement_dark.min.css' => t('ME Dark'),
      $libpath . '/build/mediaelement_light.min.css' => t('ME Light'),
      $libpath . '/build/mediaelement_large_dark.min.css' => t('ME Large Dark'),
      $libpath . '/build/mediaelement_large_light.min.css' => t('ME Large Light'),
      $libpath . '/build/mediaelementplayer.min.css' => t('Original ME'),
    ],
    '#default_value' => variable_get('imediaelement_skin', $libpath . '/build/mediaelement_dark.min.css'),
  );

  $form['imediaelement_sitewide'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable MediaElement site wide'),
    '#default_value' => variable_get('imediaelement_sitewide', FALSE),
  );

  // Display a sample video. We add the library here because we cannot be sure
  // it is otherwise included in the page.
  drupal_add_library('imediaelement', 'imediaelement');
  drupal_add_js(drupal_get_path('module', 'imediaelement') . '/imediaelement.min.js');
  drupal_add_js(array('imediaelementAll' => TRUE), array('type' => 'setting'));
  $form['test'] = array(
    '#markup' => '<video width="360" height="203" id="player1" src="'. base_path(). '/' . $libpath . '/media/echo-hereweare.mp4"><p>Your browser leaves much to be desired.</p></video>',
  );

  return system_settings_form($form);
}
