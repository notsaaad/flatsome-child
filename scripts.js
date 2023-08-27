(function ($){

    window.onload = function() {

        setTimeout(function() {



            var current_page = 1;
            var pages = document.querySelectorAll(".wizard-page");

            function showPage(n) {
                pages[current_page - 1].style.display = "none";
                pages[n - 1].style.display = "block";
                current_page = n;
            }

            function next() {
                if (current_page < pages.length) {
                    showPage(current_page + 1);
                }
            }

            function prev() {
                if (current_page > 1) {
                    showPage(current_page - 1);
                }
            }

            var nextButton = document.querySelector(".next-button");
            if (nextButton) {
                nextButton.addEventListener("click", next);
            }

            var prevButton = document.querySelector(".prev-button");
            if (prevButton) {
                prevButton.addEventListener("click", prev);
            }

            $('.sam-cats .sam-main-cat').on( 'click' , function () {

                let mKey = $(this).data('key');
                console.log( mKey );

                $('.sam-main-cats').css('display','none');
                $('.sam-sub-cats').css('display','none');
                $(`.sam-sub-cats-${mKey}`).css('display','block');
                $('.sam-product-weight').css('display','none');
                $('label.sam-default-cat + input').prop('checked', false);

            });

            $('.sam-sub-cats .sam-sub-cat').on( 'click' , function () {

                let sKey = $(this).data('sub-key');
                console.log( sKey );

                $('.sam-sub-cats').css('display','none');
                $(`.sam-products-weights-${sKey}`).css('display','block');
                $('.sam-product-weight').css('display','none');
                $('.sam-default-cat-input').prop('checked', false);

            });

            $('.sam-products-weights .sam-sub-product-weight').on( 'click' , function () {


                let weight = $(this).data('weight');

                $('#field_text_2427494984').val(weight);
                $('#sam_weight_kg').val(weight);
                $('.sam-product-weight').css('display','none');
                $('.sam-default-cat-input').prop('checked', false);

            });



            $('.sam-main-select').on('click', function () {


                $('.sam-main-cats').css('display','flex');
                $('.sam-sub-cats').css('display','none');
                $('.sam-product-weight').css('display','none');
                $('.sam-default-cat-input').prop('checked', false);

            });

            $('.sam-sub-select').on('click', function () {

                let key = $(this).data('key');
                console.log( key );

                $('.sam-products-weights').css('display','none');
                $(`.${key}`).css('display','block');
                $('.sam-product-weight').css('display','none');
                $('.sam-default-cat-input').prop('checked', false);

            });

            $('label.sam-default-cat').on('click', function () {

                $('.sam-product-weight').css('display','block');

            });

            $('.sam-product-weight').on('change', function () {

                $('#field_text_2427494984').val( $(this).val() );

            });
// 	      $('#field_wcpa-number-1684405924719').toFixed(2);

        }, 100 );

    };

})(jQuery);



						//		Buy for Me titlte Change
(function($){


	let titleProductName = $(".page-id-6959 .product-title");
	titleProductName.remove();
$(".page-id-6959 .product-container").before("<h3 class='product-title product_title entry-title' >خدمة اشتريلي واشحن</h3>");


})(jQuery);

    // for Cart Image Hatem

try{
(function($){


$('.page-id-9 .cart-container').before(`<div class="Hatem-cart"><h3>اذا واجهتك مشاكل في الصورة يرجي <button id="hatem-return">الضغط هنا</button></h3></div>`);

	$('#hatem-return').click(function(){
		location.reload();
	});




	let pageID9 =$(".page-id-9");

	if (pageID9){

	let tabel= document.getElementsByTagName('tbody');
	let tabelRow = tabel[0].getElementsByTagName('tr');

	jQuery.each(tabelRow,function(i,val){
		let ProductName= $("product-name a");

	});

	for(let i =0; i<=(tabelRow.length - 2); i++){
			//Here to change Div att to Go to Link



					//Photo
		let ProducNameDiv = tabelRow[i].getElementsByClassName("product-name");

		let ProducNameA = ProducNameDiv[0].getElementsByTagName("a");
		let ProductName = ProducNameA[0].innerHTML;


				if(ProductName=="خدمة اشتريلي واشحن"){
					ProducNameA[0].innerHTML=`<a href="https://sawyancom.com/#buy">خدمة اشتريلي و اشحن</a>`;
					//Contnet Section

															//for URL
				let innerContnet =	tabelRow[i].getElementsByClassName("wcpa_cart_meta");
				let Product_div = innerContnet[0].getElementsByTagName('li');
				let	Product_div_url2 = Product_div[0].getElementsByTagName('p');
				let ProductURL = Product_div_url2[1].innerText;

														//for ImageLink
					let Image_product_div = Product_div[1].getElementsByTagName('p');
					let Image_link =Image_product_div[1].innerText;


			//Change Product URL to A

					Product_div_url2[1].innerHTML =`<a href="${ProductURL}" class="Hatem-link" target="_blank" >${ProductURL}</a>`;


		//For Image
					let Image_div = tabelRow[i].getElementsByClassName("product-thumbnail");
					Image_div[0].innerHTML=`<a href="${ProductURL}" target="_blank"  class="Hatem-cart-not-mobile" ><img src="${Image_link}"></a>`;
// // 					$('.buttons_added').before(`<a href="${ProductURL}" target="_blank" class="Hatem-cart-mobile" ><img src="${Image_link}"></a>`);

					let product_quantity = tabelRow[i].getElementsByClassName("product-quantity");
// 					product_quantity[0].innerHTML +=`<a href="${ProductURL}" target="_blank" class="Hatem-cart-mobile" ><img src="${Image_link}"></a>`;


// 				let buttons_added =  tabelRow[i].getElementsByClassName('buttons_added');

// 					let IMGIMG =`<a href="${ProductURL}" target="_blank" class="Hatem-cart-mobile" ><img src="${Image_link}"></a>`;
// 					let buttons_addedClone= buttons_added[0].innerHTMl;
// 					buttons_added[0].innerHTML=`<div class="hatemDiv" </div>`;
// 				console.log(`${IMGIMG} + ${buttons_addedClone}`);
// 					$(".hatemDiv").innerHTML = IMGIMG + buttons_addedClone;
			} //  close IF خدمة اشتريلي



		//frist
		let Image_div = tabelRow[i].getElementsByClassName("product-thumbnail");
		let ALinkElmenet = Image_div[0].getElementsByTagName('a');
		let MoblileSectionImage =Image_div[0].innerHTML;


		let product_quantity = tabelRow[i].getElementsByClassName("product-quantity");
		product_quantity[0].innerHTML +=`<div class="Hatem-For-Mobile">${MoblileSectionImage}</div>`;


// 	     let LinkA =	ALinkElmenet[0];
// 		console.log(ALinkElmenet[0].innerHTML);
// 		console.log(ALinkElmenet[0].innerHTMl);
// 		console.log(ALinkElmenet[0].attr('href'))
// 	console.log(Image_div[0]);
// Image_div[0].innerHTML=`<a href="${ProductURL}" target="_blank"  class="Hatem-cart-not-mobile" ><img src="${Image_link}"></a>`;


		}// Close For Loop

	}// Close IF page-id-9



})(jQuery);
}
catch(e){
	console.log("No Problem");
}

		// button-continue-shopping at Cart Page-id-9

(function($){

	let button_continue_shopping = $(".button-continue-shopping");


	button_continue_shopping.attr("href","https://sawyancom.com/%d9%85%d8%aa%d8%ac%d8%b1-%d8%b3%d9%88%d9%8a%d8%a7/")
	let button_continue_shopping_Div = $(".continue-shopping pull-left");


  let button_continue_shoppingClone=  button_continue_shopping.clone();
	button_continue_shoppingClone.attr("href","https://sawyancom.com/#buy");
	button_continue_shoppingClone.html("→&nbsp;متابعة خدمة اشتريلي ")
  button_continue_shopping.after(button_continue_shoppingClone);


})(jQuery);


			//Funcation Cart Empty Button Go To Store And New One Go to Home

(function($){

	let Empty_Cart_btn = $(".wc-backward");

		Empty_Cart_btn.attr("href","https://sawyancom.com/%d9%85%d8%aa%d8%ac%d8%b1-%d8%b3%d9%88%d9%8a%d8%a7/")
	let Empty_Cart_btnClone = Empty_Cart_btn.clone();
	Empty_Cart_btnClone.attr("href","https://sawyancom.com/#buy");
	Empty_Cart_btnClone.html("العودة الي خدمة اشتريلي");
	Empty_Cart_btn.after(Empty_Cart_btnClone);



})(jQuery);

// 				//Change Mini-cart at PC Respnosive

try{
(function($){






	let tabel= document.getElementsByClassName('mini_cart_item');

	let ProductRow = tabel;

	for(let i =0; i<ProductRow.length; i++){
			//Here to change Div att to Go to Link
					let ProductName_and_img = ProductRow[i].getElementsByTagName('a');

					let Product_ID = ProductName_and_img[0].getAttribute("data-gtm4wp_product_id");




				if(Product_ID==275){





					ProductName_and_img[1].setAttribute("href","https://sawyancom.com/#buy");





					//Contnet Section

															//for URL
				let innerContnet =	ProductRow[i].getElementsByClassName("wcpa_cart_meta");
				let Product_div = innerContnet[0].getElementsByTagName('li');
				let	Product_div_url2 = Product_div[0].getElementsByTagName('p');
				let ProductURL = Product_div_url2[1].innerHTML;

// 														//for ImageLink
					let Image_product_div = Product_div[1].getElementsByTagName('p');


					let Image_link =Image_product_div[1].innerText;


// 			//Change Product URL to A

					Product_div_url2[1].innerHTML =`<a href="${ProductURL}" class="Hatem-link" target="_blank" >${ProductURL}</a>`;




// 		//For Image

				let imgDiv 	 = ProductRow[i].getElementsByTagName('a');

					let Image_div =ProductName_and_img[1].getElementsByTagName('img');

					Image_div[0].setAttribute('src',Image_link);
					Image_div[0].setAttribute('data-src',Image_link);



			} //  close IF خدمة اشتريلي



		}// Close For Loop






})(jQuery);
}
catch(e){
console.log("mini-cart");
}

(function($){


// 	console.log("======================================================");
// 	console.log("test");
})(jQuery);



	//Hide Header(سجل الان و احصل علي خصم مدي الحياة) For User Log In accounts

(function($){

let Body = document.getElementsByTagName("body");
let Login =Body[0].classList.contains('logged-in');
	if (Login){
		let Header = $('.my-account .wp-block-heading');
		Header.remove();

	}

})(jQuery);


		//Show Buy For Me At Orders (Profile page)
try{
(function($){


      let tabel = document.getElementsByClassName('woocommerce-table__product-name product-name');


  for (let i=1 ; i<tabel.length; i++){
	 let CheckBuyForME = tabel[i].getElementsByTagName('ul');
	  let goAhead;

	  if (CheckBuyForME.length>0){
		  goAhead=true;
	  }else{
		  goAhead=false;
	  }



      if(goAhead){


          let ProductsDetails =tabel[i].getElementsByClassName('wc-item-meta');
		let List = ProductsDetails[0].getElementsByTagName('li');
		  let img_link_div = List[1].getElementsByTagName('p');
		  let img_Main_div = img_link_div[0].getElementsByTagName('a');
		  let img_link = img_Main_div[0].innerHTML;
	   	  let Main_img_div = tabel[i].getElementsByClassName('item-thumbnail');
		  let Main_img = Main_img_div[0].getElementsByTagName('img');
			Main_img[0].setAttribute('src', img_link);
		  Main_img[0].setAttribute('data-src', img_link);
      }
  }



})(jQuery);
}catch(e){
	console.log("order-photo");
}

(function($){

})(jQuery);





  // Body = document.getElementsByName('body');

  // if(Body[0].classList.contains('page-id-11')){



    // }


    //بينات مخزني
(function($){
	try{
// 	    let HatemCopy1 = document.getElementById("hatem-copy-1");
//   HatemCopy1.onclick=function(){
//     HatemCopyTrue();
//     navigator.clipboard.writeText("İnönü, Belde Cd., 34510 Beylikdüzü Osb/Esenyurt/İstanbul, Türkiye Box");
//   };

  let HatemCopy2 = document.getElementById("hatem-copy-2");
  HatemCopy2.onclick=function(){
    HatemCopyTrue();
    navigator.clipboard.writeText("AL BAWABAH");
  };

  let HatemCopy3 = document.getElementById("hatem-copy-3");
  HatemCopy3.onclick=function(){
    HatemCopyTrue();
    navigator.clipboard.writeText("TICARET");
  };

  let HatemCopy4 = document.getElementById("hatem-copy-4");
  HatemCopy4.onclick=function(){
    HatemCopyTrue();
    navigator.clipboard.writeText("AL BAWABAH TICARET");
  };

  let HatemCopy5 = document.getElementById("hatem-copy-5");
  HatemCopy5.onclick=function(){
    HatemCopyTrue();
    navigator.clipboard.writeText("05541870582");
  };

  let HatemCopy6 = document.getElementById("hatem-copy-6");
  HatemCopy6.onclick=function(){
    HatemCopyTrue();
    navigator.clipboard.writeText("İstanbul");
  };


  let HatemCopy7 = document.getElementById("hatem-copy-7");
  HatemCopy7.onclick=function(){
    HatemCopyTrue();
    navigator.clipboard.writeText("ESENYURT");
  };


  let HatemCopy8 = document.getElementById("hatem-copy-8");
  HatemCopy8.onclick=function(){
    HatemCopyTrue();
    navigator.clipboard.writeText("0471119092");
  };

  let HatemCopy9 = document.getElementById("hatem-copy-9");
  HatemCopy9.onclick=function(){
    HatemCopyTrue();
    navigator.clipboard.writeText("AVCILAR");
  };
  let HatemCopy10 = document.getElementById("hatem-copy-10");
  HatemCopy10.onclick=function(){
    HatemCopyTrue();
    navigator.clipboard.writeText("AL BAWABAH TICARET GAYRIMENKUL DANISMANLIGI TURIZM SAGLIK VE EGITIM HIZMETLERI LIMITED SIRKETI");
  };
  let HatemCopy11 = document.getElementById("hatem-copy-11");
  HatemCopy11.onclick=function(){
    HatemCopyTrue();
    navigator.clipboard.writeText("AL BAWABAH TICARET");
  };
  let HatemCopy12 = document.getElementById("hatem-copy-12");
  HatemCopy12.onclick=function(){
    HatemCopyTrue();
    navigator.clipboard.writeText("İnönü MAH");
  };



function HatemCopyTrue(){
  let HatemCopy = document.getElementsByClassName("hatem-Copy-true");
  HatemCopy[0].style.display="flex";
  setTimeout(function(){
    HatemCopy[0].style.display="none";
  },2000);
}

}catch(e){
	console.log("hatemCopy");
}
})(jQuery);




  try{
  //append بيانات مخزنني الي nav Header
  (function($){

    // let AccountDropDown = document.getElementsByClassName('account-item');
    // let UlList = AccountDropDown[0].getElementsByTagName('ul')
    // let Item = AccountDropDown[0].getElementsByTagName('li')
    // let LastItem = Item[Item.length-1];

    // let Clone = LastItem;
    // let Shaping= LastItem;
    // // Clone.innerHTML=`<a href ="https://sawyancom.com/%d8%a8%d9%8a%d8%a7%d9%86%d8%a7%d8%aa-%d9%85%d8%ae%d8%b2%d9%86%d9%8a/">بيانات مخزني</a>`;
    // Shaping.innerHTML=`<a href ="https://sawyancom.com/%d8%a7%d8%b3%d8%aa%d9%84%d9%85%d9%84%d9%8a-%d9%88%d8%a7%d8%b4%d8%ad%d9%86/">اشحنلي</a>`;
    // // Clone.setAttribute('href','https://sawyancom.com/%d8%a8%d9%8a%d8%a7%d9%86%d8%a7%d8%aa-%d9%85%d8%ae%d8%b2%d9%86%d9%8a/');
    // Shaping.setAttribute('href','https://sawyancom.com/%d8%a7%d8%b3%d8%aa%d9%84%d9%85%d9%84%d9%8a-%d9%88%d8%a7%d8%b4%d8%ad%d9%86/');
    // // UlList[0].appendChild(Clone);
    // // UlList[0].appendChild(Shaping);

  })(jQuery);
}
catch(e){
  console.log();
}
 //append بيانات مخزنني الي  Profile navBar
try{
(function($){



  let Manu = $('#my-account-nav');

  let li = $('#my-account-nav li:last-child');
  // let NewLI = li.clone();
  // NewLI.html(`<a href ="https://sawyancom.com/%d8%a8%d9%8a%d8%a7%d9%86%d8%a7%d8%aa-%d9%85%d8%ae%d8%b2%d9%86%d9%8a/">بيانات مخزني</a>`);
  // let Shaping = li.clone();
  let Shaping = `<li class="Hatem-Shpping"><a href ="https://sawyancom.com/%d8%a7%d8%b3%d8%aa%d9%84%d9%85%d9%84%d9%8a-%d9%88%d8%a7%d8%b4%d8%ad%d9%86/">اشحنلي</a></li>`;

  // Manu.append(NewLI);
  // let Shaping = Manu.eq(2);
  $('.woocommerce-MyAccount-navigation-link.woocommerce-MyAccount-navigation-link--customer-logout').before(Shaping);
  // Manu.append(Shaping);
  $('.woocommerce-MyAccount-navigation-link.woocommerce-MyAccount-navigation-link--customer-logout a').attr('href','https://sawyancom.com/?customer-logout=true');
  // $('.woocommerce-MyAccount-navigation-link--customer-logout').remove();

})(jQuery);
}
catch(e){

}
try{
 //append بيانات مخزنني الي  my account
(function($){



  let Manu = $('.woocommerce-MyAccount-content .dashboard-links');
  let li = $('.woocommerce-MyAccount-content .dashboard-links li').eq(2);

  let NewLI = li.clone();
  let Shaping = li.clone();
  // NewLI.html(`<a href ="https://sawyancom.com/%d8%a8%d9%8a%d8%a7%d9%86%d8%a7%d8%aa-%d9%85%d8%ae%d8%b2%d9%86%d9%8a/">بيانات مخزني</a>`);
  Shaping.html(`<a href ="https://sawyancom.com/%d8%a7%d8%b3%d8%aa%d9%84%d9%85%d9%84%d9%8a-%d9%88%d8%a7%d8%b4%d8%ad%d9%86/">اشحنلي</a>`);

  // Manu.append(NewLI);
  Manu.append(Shaping);

})(jQuery);
}catch(e){
  console.log();
}



try{

(function($){

  // $('.woocommerce-MyAccount-navigation-link--customer-logout a').attr('href','https://sawyancom.com/my-account/customer-logout/?_wpnonce=b2a9bac964');


})(jQuery);


}catch(e){

}


//function to append button shipping

try{
  (function($){
    $('.woocommerce-MyAccount-orders').after(`<div class="Hatem-order-shpipping"><div class="des"><p>يمكنك بدأ عملية شحن منتجاتك من المخزن بمجرد الضغط علي اشحنلي</p></div><button class="button button-primary">اشحنلي </button></div>`);

    $('.Hatem-order-shpipping button').click(function(){
      location.href="https://sawyancom.com/%d8%a7%d8%b3%d8%aa%d9%84%d9%85%d9%84%d9%8a-%d9%88%d8%a7%d8%b4%d8%ad%d9%86/";
    });
  })(jQuery);
}catch(e){

}


// تعليمات ل خدمة Buy for me يدوي

(function($){
  $('.postid-9640 #product-9640').before("<h3 style='margin:10px; padding:5px; display:flex; justify-content: center; align-items: center; color:#082241;'>تعذر سحب البيانات يرجي ادخال البيانات يدويا </h3>");
})(jQuery);


// change Store Header To Menu

(function($){
  $('.shop-page-title').html(
  `<ul class="Hatem-map-store">
  <li><a id="hatem-store-cat1-a" href="https://sawyancom.com/product-category/%d8%a7%d8%af%d9%88%d8%a7%d8%aa-%d9%85%d9%86%d8%b2%d9%84%d9%8a%d8%a9/">أدوات منزلية</a></li>
  <li><a id="hatem-store-cat2-a"  href="https://sawyancom.com/product-category/%d8%a7%d8%ba%d8%b0%d9%8a%d8%a9/">أغذية</a></li>
  <li><a id="hatem-store-cat3-a"  href="https://sawyancom.com/product-category/%d8%a7%d8%ad%d8%b0%d9%8a%d8%a9-%d9%88%d8%b4%d9%86%d8%b7-2/">أحذية و شنط</a></li>
  <li><a id="hatem-store-cat4-a"  href="https://sawyancom.com/product-category/%d9%85%d9%84%d8%a7%d8%a8%d8%b3/">ملابس</a></li>
  <li><a id="hatem-store-cat5-a"  href="https://sawyancom.com/product-category/%d8%aa%d8%ac%d9%85%d9%8a%d9%84/">مستحضرات تجميل</a></li>
</ul>`

  );
})(jQuery);

//change my Order Name to طلباتي
try{
(function($){

  $('#my-account-nav .woocommerce-MyAccount-navigation-link--orders a').html('طلباتي');
  $('.dashboard-links .woocommerce-MyAccount-navigation-link--orders a').html('طلباتي');


})(jQuery);
}catch(e){

}


//append text to اسألة شائعة and etc
try{
  (function($){

    // ================== Start اسألة شائعة ====================

    $('.page-id-8419 h1').after(`<ul>
    <li><h4 style="color:#082241;">جميع الأوزان تقريبية وغير ملزمة وسيتم وزن المنتجات عند وصولها مخزن سويا وإعادة إرسال التكلفة لسيادتكم بدقة</h4></li>
    <li><h4 style="color:#082241;">كل ما زاد الوزن قل سعر شحن الكيلو الواحد</h4></li>
    </ul>`);

    // ================== Endاسألة شائعة =======================



        // ================== Start cart =======================

        $('.page-id-9 td.product-price').append(`<div><span style="color: #082241; font-weight: bold;">كل ما زاد الوزن قل سعر شحن الكيلو الواحد</span></div>`)

        //-------- Change Form change Country------

        // $('.page-id-9 .shipping-calculator-button').html(`<a href="#" style="font-size:18px;" class="shipping-calculator-button">ادخل العنوان</a>`);
        $('.page-id-9 .shipping-calculator-button').html(`<button style="width:30%;" class="button button-primary">ادخل العنوان</button>`);

        // ================== End cart =======================




  })(jQuery);
  }catch(e){

  }



try{
  (function($){

    let Caption_div_id = $('.hatem-store-caption').attr('id');

    Caption_div_id+='-a';
    console.log(Caption_div_id);  //hatem-store-cat1

    $(`#${Caption_div_id}`).addClass('Hatem-current-store-cat');

    if (location.href == "https://sawyancom.com/product-category/%d8%a7%d8%af%d9%88%d8%a7%d8%aa-%d9%85%d9%86%d8%b2%d9%84%d9%8a%d8%a9/"){
      $('#hatem-store-cat1-a').addClass('Hatem-current-store-cat');
    }



  })(jQuery)
}catch(e){

}


try{
  (function($){

      $('.Hatem-AFF-new-Link').click(function(){
    let Link = $(this).text();
    navigator.clipboard.writeText(Link);
    alert("تم النسخ بنجاح");
  });



  })(jQuery)
}catch(e){

}


//Function to Change Phone At Aff-signup to others Filed styles By Class uap-form-text

// try{
//   (function($){
//     $('div.uap-form-number').addClass('uap-form-text');
//     $('div.uap-form-number').after(`<div class="Hatem-aff-subAff subaffphone">يرجي ادخال كود الدولة مصاحب برقم الهاتف</div>`);


//     //Change defulat country

//     $('.select2-selection__rendered').remove();
//   })(jQuery);

// }catch(e){

// }


// //Change Country at Reig From Woocommerce


// try{
//   (function($){

//     $('#billing_country').focusout(function(){
//       if ($('#billing_country').val() == 'EG'){

//         let PhoneNumber = $('#reg_billing_phone').val();
//         if (PhoneNumber[0] == '0'){
//           PhoneNumber= PhoneNumber.substring(1);;
//         }
//         $('#reg_billing_phone').val('+20 ' + PhoneNumber  );

//       }else if($('#billing_country').val() == 'EG'){



//       }


//     });



//   })(jQuery);

// }catch(e){

// }