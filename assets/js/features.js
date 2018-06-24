//elevator DESC button
$('.feat-pres-link').each(function () {
    $(this).click(function () {
        $('html').animate({
            scrollTop: $(".feat-functionality").offset().top
        }, 'slow');
    });
});

//elevator UP button
$('.feat-elevator').click(function () {
    $('html').animate({
        scrollTop: $(".feat-elevator").offset().top
    }, 'slow');
})


//change image on click
$(' button.btn-link').on('click', function () {
    var imageId = $(this).data('img-id');
    $('#imgclick').attr('src', 'assets/img/article/Power28-catalogue-' + imageId + '.png');
});



/*

let changeimage=document.querySelector("#button1");

changeimage.addEventListener("click",function () {
	console.log(this);
	document.querySelector("#imgClickAndChange").src="../image/Power28-catalogue-1.png"
});


let changeimage2=document.querySelector("#button2");

changeimage2.addEventListener("click",function () {
    document.querySelector("#imgClickAndChange").src="../image/Power28-catalogue-2.png"
});


let changeimage3=document.querySelector("#button3");

changeimage3.addEventListener("click",function () {
    document.querySelector("#imgClickAndChange").src="../image/Power28-catalogue-3.png"
});


let changeimage4=document.querySelector("#button4");

changeimage4.addEventListener("click",function () {
    document.querySelector("#imgClickAndChange").src="../image/Power28-catalogue-4.png"
});
*/