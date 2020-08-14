module.exports = {

	build: {
		// Target-specific file lists and/or options go here.
		options: {
			singleline: true,
			multiline: false,
			keepSpecialComments: true
		},
		src: [
			'<%= app.root %>/pack/<%= app.slug %>/inc/**/*.php',
			'<%= app.root %>/pack/<%= app.slug %>/assets/js/*.js'
		] // files to remove comments from
	},
};