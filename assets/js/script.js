let start = null;
let element = document.querySelector('.mockup');
element.style.position = 'absolute';

function step(timestamp){
	if (!start) start = timestamp;
	let progress = timestamp - start;
	element.style.left = Math.min(progress / 20, 20) + 'px';
	if (progress < 1500){
		window.requestAnimationFrame(step);
	}
}

window.requestAnimationFrame(step);

//getobjectboundingclientrect


$(window).on("load",function() {
    $(window).scroll(function() {
        var windowBottom = $(this).scrollTop() + $(this).innerHeight();
        $(".fade").each(function() {
            /* Check the location of each desired element */
            var objectBottom = $(this).offset().top + $(this).outerHeight();

            /* If the element is completely within bounds of the window, fade it in */
            if (objectBottom < windowBottom) { //object comes into view (scrolling down)
                if ($(this).css("opacity")==0) {$(this).fadeTo(400,1);}
            } else { //object goes out of view (scrolling up)
                if ($(this).css("opacity")==1) {$(this).fadeTo(400,0);}
            }
        });
    }).scroll(); //invoke scroll-handler on page-load
});





