$(document).ready(function(){

$(function(){
 
    $(document).on( 'scroll', function(){
 
    	if ($(window).scrollTop() > 100) {
			$('.scroll-top-wrapper').addClass('show');
		} else {
			$('.scroll-top-wrapper').removeClass('show');
		}
	});
 
	$('.scroll-top-wrapper').on('click', scrollToTop);
});


 
function scrollToTop() {
	verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
	element = $('body');
	offset = element.offset();
	offsetTop = offset.top;
	$('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}

});

$(document).on('click', '#createAccount', function(){
    $(this).parents('div.modal-body').find('.login-form').addClass('hidden');
    $(this).parents('div.modal-body').find('.signup-form').removeClass('hidden');
});

$(document).on('click', '#logIn', function(){
    $(this).parents('div.modal-body').find('.login-form').removeClass('hidden');
    $(this).parents('div.modal-body').find('.signup-form').addClass('hidden');
});

function addtocart(id,name,price,qtyid){
  quantity=document.getElementById(qtyid).value;
  var html="";
  $.ajax(
	   {
		  type:'GET',
		  url:'/addtocart.php',
		  data:"id="+id+"&name="+name+"&price="+price+"&quantity="+quantity,
		  success: function(data){
			//alert(data);
			html=html+"<li class='cart-single' id='navli"+id+"'";
            html=html+"<span class='cart-item-title'>"+name+"</span>";
            html=html+"<span class='cart-item-price'>"+price+"</span>";
            html=html+"<span class='remove-from-cart'>";
            //html=html+" <a href='javascript:removefromcart("+id+")' class='itemDelete'><i class='fa fa-times'></i></a></span></li>";
			html=html+" <a href='javascript:removefromcart("+id+")' class='itemDelete'>X</li>";
			html=html+"</span>";
			$('#linkedEventList').append(html);
			document.getElementById("cartcount").innerHTML=data;
			//$('#cartcount').html(data);
		  }
	   }
	);
}

function removefromcart(id){
  $.ajax(
	   {
		  type:'GET',
		  url:'/removefromcart.php',
		  data:"id="+id,
		  success: function(data){
			  //alert(data);
			  document.getElementById("cartcount").innerHTML=data;
			//$('#linkedEventList').on('click', '.itemDelete', function(){
				//$(this).parents('.cart-single').remove();
				
				//$('#itemDelete').closest('.cart-single').remove();
				//alert('navli'+id);
				$('#navli'+id).remove();
				
			//});
		  }
	   }
	);
}

function Register(){
	//alert("registration");
	var email2 = $('#email2').val();
	var name = $('#name').val();
	var phone = $('#phone').val();
	var password2 = $('#password2').val();
	var repassword = $('#repassword').val();
	var address = $('#address').val();
	$.ajax({
		url: '/userregistration.php',
		type: 'POST',
		data: "email="+email2+"&name="+name+"&phone="+phone+"&password="+password2+"&repassword="+repassword+"&address="+address,
		success: function (response) {
			if(parseInt(response)==1)
			{
				location.href = 'http://dealon.live/index.php';
			}
			else
			{
				alert(response);
			}
		},
		error: function (response) {
			alert("Some error occured"+response);
		}
	});
  
}

function Login(){
	var email1 = $('#email1').val();
	var password1 = $('#password1').val();
	$.ajax({
		url: '/userlogin.php',
		type: 'POST',
		data:  "email="+email1+"&password="+password1,
		//contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		success: function (response) {
			alert(response);
			if(parseInt(response)==1)
			{
				location.href = 'http://dealon.live/index.php';
			}
			else
			{
				alert("Email address and password does not match");
			}
		},
		error: function (response) {
			alert("Some error occured"+response);
		}
	});
}

$(document).on('click','.btn-claim',function(){

  $(this).addClass('disabled');

});




