



$('.feat-pres-link').each(function(){
	$(this).click(function(){
		$('html,body').animate({ scrollTop: 1000
		}, 'slow'); return true;
	});
});


$('.feat-elevator').each(function(){
    $(this).click(function(){
        $('html,body').animate({ scrollTop: 400
        }, 'slow'); return true;
    });
});


$(' button.btn-link').on({
    'click': function(){
        var imagechange = $(this).data('img');
        $('#imgclick').attr('src','img/article'+imagechange);
    }
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