var selectors = ".wolf-core-video-opener, .wolf-core-video-opener-container a";

document.querySelectorAll( selectors ).forEach( ( el ) => {

	//$(document).on("click", ".wolf-core-video-opener, .wolf-core-video-opener-container a", lity);
	var videoUrl = el.dataset.videoUrl

	el.addEventListener( 'click', (e) => {
		e.preventDefault()
		//console.log( videoUrl )
		jQuery.fancybox.open({
	        src: videoUrl,
	        //modal: true
	    });
	} )
} )
