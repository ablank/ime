/**
 * @file
 * Configure grunt uglify.
 */

module.exports = {
  options: {
    preserveComments: "some",
    compress: true,
    mangle: true
  },
  base: {
    options: {
      banner: 'src/js/me-header.js'
    },
    files: {
      'local-build/mediaelement.base.min.js': ['local-build/mediaelement.base.js']
    }
  },
  player: {
    options: {
      banner: 'src/js/mep-header.js'
    },
    files: {
      'local-build/mediaelement.player.min.js': ['local-build/mediaelement.player.js']
    }
  },
  bundle: {
    files: {
      'local-build/mediaelement.min.js': ['local-build/mediaelement.js']
    }
  }
};
