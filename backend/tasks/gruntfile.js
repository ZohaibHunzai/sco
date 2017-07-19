module.exports = function(grunt) {
// hafleet build tool grutn settings.
  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      coffee: {
        // expand: true,
        // cwd: '../',
        files: ['../views/**/*.coffee', '../modules/**/*.coffee' ],
        tasks: ['coffee'],
      },
      stylus: {
        files: ['../views/**/*.styl', '../modules/**/*.styl'],
        tasks: ['stylus'],
      },
      options: {
        spawn: false,
      }
    },
    stylus: {
      compile: {
        options : {
            compress : false,
        },
        files: {
          '../web/css/funar.css': ['../views/**/*.styl', '../modules/**/*.styl'] // compile and concat into single file
        }
      }
    },
    coffee: {
      files: {
        options: {
          join: true
        },
        files: {
          // 'path/to/result.js': 'path/to/source.coffee', // 1:1 compile, identical output to join = false 
          '../web/js/funar.js': ['../views/**/*.coffee', '../modules/**/*.coffee'] // concat then compile into single file 
        }
      }
    }
   
  });

  grunt.loadNpmTasks ('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.loadNpmTasks('grunt-contrib-stylus');
  // Default task(s).
  // grunt.registerTask('default', ['autoprefixer:dist','sass:dev', 'concat', 'watch']);
  // grunt.registerTask('dist', ['autoprefixer:dist','sass:dist','concat', 'uglify']);

};