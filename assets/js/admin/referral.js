class WolfReferrals{
	constructor() {
		var urls = [];
		for(var i = document.links.length; i --> 0;) {

			if(document.links[i].hostname === "smashballoon.com") {
				let param = "smashid=5118"
				let url = document.links[i].href

				document.links[i].href = document.links[i].href + (url.split('?')[1] ? '&':'?') + param;

				//console.log( document.links[i].href )
			 	//urls.push(document.links[i].href);
			}
		}

		//console.log( urls )
	}
}
new WolfReferrals()



