module.exports = {
	options: {
		remove: false,
		browsers: ['last 3 versions', 'bb 10', 'android 3', 'ie 10']
	},
	no_dest: {
		src: '<%= app.cssPath %>/*.css',
	}
};