# A better mediaelement for Drupal 7

Why use this instead of the standard mediaelement module?

 - `autoplay`, `preload`, and `loop` media attributes.

 - Player skin selection.

 - ~20% smaller player filesize


## Installation and Usage
This is a drop-in replacement for the standard mediaelement.js library. To integrate with the mediaelement or improved mediaelement module for Drupal:

1. Download/git this library and extract to `$base_url/sites/all/libraries/mediaelement`

2. Customize the build for your specific needs by configuring the grunt tasks or editing the `/src/` assets.

 - `grunt` : compiles all `/src/` assets to `/local-build/`.
 - `grunt build` : copies the `/local-build/` to `/build/`.

3. Download/git the mediaelement module and extract to `$base_url/sites/$site/modules/mediaelement`

4. Enable the module.

5. Configure module.

 - global settings : `$base_url/admin/config/media/mediaelement`.

 - field format settings :  `$base_url/admin/structure/types/manage/$content_type/display`.
