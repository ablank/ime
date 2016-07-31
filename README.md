# A better mediaelement for Drupal 7

This module is started as a fork of the [mediaelement module](https://www.drupal.org/project/mediaelement) for Drupal 7 but ended up creating/implementing an [improved mediaelement](https://github.com/ablank/imediaelement) library instead to provide greater functionality and performance. The module provides deeper integration with drupal and expands control in several key areas to provide some super-useful features not found in the mediaelement project on drupal.org:

- Simple integration with 3rd party media providers (YouTube, Vimeo, etc.)

- Player skin selection.

- `autoplay`, `preload`, and `loop` media attributes.

- i18n integration with drupal.

- ~20% smaller player filesize.

## Installation and Usage

1. Download/git the [improved mediaelement library](https://github.com/ablank/imediaelement) and extract to `$base_url/sites/all/libraries/imediaelement`

-  *Optional* Extend mediaelement.js by uncommenting features in the `grunt/concat` task, or edit the `/src/` assets, and rebuild the script.
    - `cd path/to/imediaelement`
    - `npm install` : installs grunt & tasks.
    - `grunt` : compiles all `/src/` assets to `/local-build/`.
    - `grunt build` : copies the `/local-build/` to `/build/`.

2. Download/git the imediaelement module and extract to `$base_url/sites/$site/modules/imediaelement`

3. Enable the module.

### Configure global settings

 Select the player skin and sitewide use options that make you happy: `$base_url/admin/config/media/imediaelement`

### Configure content fields

**Add fields** : Your content type should include some type of media that can be displayed as a mediaelement.

  - `File` : *media hosted on your web server*.

  - `Link` : *media hosted on another domain, i.e. YouTube, Vimeo, etc.*
  
  - `Image` *[optional]* : *image fields can be set as the poster image for a mediaelement player*.

___
 ![alt](https://rawgit.com/ablank/imediaelement.module/gh-pages/images/fields.png)
___

**Manage Display:** Set the Format to `MediaElement Audio` or `MediaElement Video`

  - The Format settings allow you to manage attributes specific to the mediaelement as it is being used in that instance. i.e. A content type's field display, panels, views, etc. can independently set the mediaelement width, height, autoplay, etc.
  
  - To use an image field as a poster image, select the image field to be used and the desired image style in the MediaElement format settings.

___

![alt](https://rawgit.com/ablank/imediaelement.module/gh-pages/images/formatsettings.png)
___

### 3rd Party Sources

Streaming media from 3rd party sources is accomplished by adding a `link` field displayed as Mediaelement Audio/Video. Youtube & Vimeo are explicitly supported, though other providers may also be used as long as they provide public file access.

The link may reference either the Embed (`https://www.youtube.com/embed/mUPyVAdbnag`) or Share (`http://youtu.be/mUPyVAdbnag`) source.

It's best to use protocol agnostic (`//youtu.be/mUPyVAdbnag`) links, although that isn't a requirement.

### Player Skins

![alt](https://rawgit.com/ablank/imediaelement.module/gh-pages/images/ME_dark.png)

![alt](https://rawgit.com/ablank/imediaelement.module/gh-pages/images/ME_light.png)

![alt](https://rawgit.com/ablank/imediaelement.module/gh-pages/images/ME_dark_large.png)

![alt](https://rawgit.com/ablank/imediaelement.module/gh-pages/images/ME_light_large.png)

![alt](https://rawgit.com/ablank/imediaelement.module/gh-pages/images/Original_ME.png)
