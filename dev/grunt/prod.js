module.exports = function(grunt) {

	grunt.registerTask( 'prod', function() {
		grunt.task.run( [
			//'rsync:newold',
			//'rsync:new',
			//'rsync:demo',
			'rsync:envato',
			// 'rsync:wolf',
			// 'rsync:help',
			'notify:prod'
		] );
	} );