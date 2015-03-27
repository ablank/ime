# A better mediaelement for Drupal 7

This module is a fork of the mediaelement module for Drupal- It is functionally the same, but uses an improved mediaelement library and provides a bunch of super-useful features not found in the drupal.org module.

- `autoplay`, `preload`, and `loop` media attributes.

- Simple integration with 3rd party media providers (YouTube, Vimeo, etc.)

- Player skin selection.

- ~20% smaller player filesize


![alt](https://github.com/ablank/ablank.github.io/blob/master/imediaelement/ME_dark.png)

![alt](https://github.com/ablank/ablank.github.io/blob/master/imediaelement/ME_light.png)

![alt](https://github.com/ablank/ablank.github.io/blob/master/imediaelement/ME_dark_large.png)

![alt](https://github.com/ablank/ablank.github.io/blob/master/imediaelement/ME_light_large.png)

![alt](https://github.com/ablank/ablank.github.io/blob/master/imediaelement/Original_ME.png)

## Installation and Usage

1. Download/git the [improved mediaelement library](https://github.com/ablank/imediaelement) and extract to `$base_url/sites/all/libraries/mediaelement`

-  *Optional* Customize the build for your specific needs (i18n or other features) by editing the `grunt/concat` task or editing the `/src/` assets and rebuilding the library.

    - `grunt` : compiles all `/src/` assets to `/local-build/`.
    - `grunt build` : copies the `/local-build/` to `/build/`.

2. Download/git the mediaelement module and extract to `$base_url/sites/$site/modules/mediaelement`

3. Enable the module.

4. Configure global settings: `$base_url/admin/config/media/imediaelement`.

5. Add fields to a content type: `File` (*for media hosted on your server*) or `Link` (*for media hosted on another domain, i.e. YouTube.*).

6. Manage Display: Set the Format to `MediaElement Audio` or `MediaElement Video`

- The Format settings allow you to manage attributes specific to that field (*i.e. width, height, autoplay, etc.*).

![alt](https://github.com/ablank/ablank.github.io/blob/master/imediaelement/formatsettings.png)
