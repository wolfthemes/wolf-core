var selectors = ".wolf-core-video-opener, .wolf-core-video-opener-container a";

Array.prototype.forEach.call(document.querySelectorAll(selectors), function (el) {
    var videoUrl = el.dataset.videoUrl;

    el.addEventListener('click', function (e) {
        e.preventDefault();

        if (videoUrl) {
            jQuery.fancybox.open({
                src: videoUrl
                // Uncomment the following line if modal behavior is needed
                // modal: true
            });
        } else {
            console.error("Video URL is missing for this element:", el);
        }
    });
});
