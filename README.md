# imediaelement.js

Provides HTML5 video and audio elements using imediaelement.js for HTML4 browsers.

## Installation

1. Download imediaelement from [http://imediaelementjs.com/](http://imediaelementjs.com/)
2. Unzip into a libraries directory as supported by the libraries module with
   the name imediaelement (e.g., /sites/all/libraries/imediaelement).
3. Install the libraries and imediaelement modules.

## Usage

Set a file field or link field to use video (or audio) as its display formatter.
Or use the [media module](http://drupal.org/project/media) if you want to have your
file field display images and video.

## API

This module supplies the imediaelement library as a Drupal library and has some
helper functions if you want to use it independently of fields. To add the
library into a page use the command:

```
drupal_add_library('imediaelement', 'imediaelement');
```

If you want to use the helper scripts include the script imediaelement.js included
with the module. You can do it using a command like:

```
drupal_add_js(drupal_get_path('module', 'imediaelement') . '/imediaelement.js');
```

Then you need to add settings for the script. They are a selector for jQuery and
settings. For example:

```
$settings = array('imediaelement' => array(
  '.class-name' => array(
    'controls' => TRUE,
    'opts' => array(), // This is the imediaelement scripts options.
  )
));
drupal_add_js($settings, 'setting');
```

For more details on the imediaelement API see [http://imediaelementjs.com](http://imediaelementjs.com)
