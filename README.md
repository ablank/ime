# A better mediaelement for Drupal 7

This module is functionally the same as the [mediaelement module](https://www.drupal.org/project/mediaelement) for Drupal 7 but uses an [improved mediaelement library](https://github.com/ablank/imediaelement) and provides some super-useful features not found in the drupal.org module:

- Simple integration with 3rd party media providers (YouTube, Vimeo, etc.)

- Player skin selection.

- `autoplay`, `preload`, and `loop` media attributes.

- ~20% smaller player filesize.

## Installation and Usage

1. Download/git the [improved mediaelement library](https://github.com/ablank/imediaelement) and extract to `$base_url/sites/all/libraries/imediaelement`

-  *Optional* Customize mediaelement.js for your specific needs (*i18n or other features*) by editing the `grunt/concat` task or editing the `/src/` assets and rebuilding the script.
    - `cd path/to/imediaelement`
    - `npm install` : installs grunt & tasks.
    - `grunt` : compiles all `/src/` assets to `/local-build/`.
    - `grunt build` : copies the `/local-build/` to `/build/`.

2. Download/git the mediaelement module and extract to `$base_url/sites/$site/modules/imediaelement`

3. Enable the module.

### Configure global settings

 Select the player skin and sitewide use options that make you happy: `$base_url/admin/config/media/imediaelement`

### Configure field settings

1. Add fields to a content type

  - `File` : *media hosted on your server*.

  - `Link` : *media hosted on another domain, i.e. YouTube, Vimeo, etc.*

___
 ![alt](https://github.com/ablank/ablank.github.io/blob/master/imediaelement/fields.png)

2. Manage Display: Set the Format to `MediaElement Audio` or `MediaElement Video`

  - The Format settings allow you to manage attributes specific to that field (*i.e. width, height, autoplay, etc.*).

___

![alt](https://github.com/ablank/ablank.github.io/blob/master/imediaelement/formatsettings.png)

### Player Skins

![alt](https://github.com/ablank/ablank.github.io/blob/master/imediaelement/ME_dark.png)

![alt](https://github.com/ablank/ablank.github.io/blob/master/imediaelement/ME_light.png)

![alt](https://github.com/ablank/ablank.github.io/blob/master/imediaelement/ME_dark_large.png)

![alt](https://github.com/ablank/ablank.github.io/blob/master/imediaelement/ME_light_large.png)

![alt](https://github.com/ablank/ablank.github.io/blob/master/imediaelement/Original_ME.png)
