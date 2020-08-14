module.exports = {

	options: {
		args: ["--verbose", "--chmod=Du=rwx,Dg=rx,Do=rx,Fu=rw,Fg=r,Fo=r"],
		//args: ["--verbose", "ssh 'C:/Program Files/Git/usr/bin/ssh.exe -p 18765'"],
		//args: ["--verbose"],
		recursive: true
	},

	envato: {
		options: {
			src: [ '<%= app.root %>/pack/<%= app.slug %>/' ],
			dest: "/home/customer/www/envato.constantins2.sg-host.com/public_html/wp-content/plugins/<%= app.slug %>",
			host: "sg", // set in ~/.ssh config
			syncDestIgnoreExcl: true,
			port: '18765'
 		}
	},

	// wolf
	wolf: {
		options: {
			src: [ '<%= app.root %>/pack/<%= app.slug %>/' ],
			dest: "/home/customer/www/constantins2.sg-host.com/public_html/wp-content/plugins/<%= app.slug %>",
			host: "wolf",
			syncDestIgnoreExcl: true
		}
	},

	dist: {
		options: {
			src: [ '<%= app.root %>/pack/dist/' ],
			dest: "/home/customer/www/plugins.constantins2.sg-host.com/public_html/<%= app.slug %>",
			host: "sg", // set in ~/.ssh config
			syncDestIgnoreExcl: true,
			port: '18765'
		}
	}
};