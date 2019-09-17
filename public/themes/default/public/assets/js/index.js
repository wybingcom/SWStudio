$('.index_banner').slick({autoplay:true,arrows:false,dots:false,infinite:true,speed:500,autoplaySpeed:5000,pauseOnHover:false,fade:true,responsive:[{breakpoint:992,settings:{dots:true}}]});$('.index_banner').init(function(slick){$('.index_banner .item.slick-current').addClass('active').siblings().removeClass('active')})
$('.index_banner').on('afterChange',function(slick,currentSlide){$('.index_banner .item.slick-current').addClass('active').siblings().removeClass('active');var _index=$('.index_banner').slick('slickCurrentSlide')
$('.section1 .number span').eq(_index).addClass('active').siblings().removeClass('active')})
$('.section1 .number span').click(function(){var _index=$(this).index();$('.index_banner').slick('slickGoTo',_index);$(this).addClass("active").siblings().removeClass("active")});$('.section1 .prev').click(function(){$('.index_banner').slick('slickPrev')})
$('.section1 .next').click(function(){$('.index_banner').slick('slickNext');});var nav=$("header");var win=$(window);var sc=$(document);win.scroll(function(){if(sc.scrollTop()>=100){nav.addClass("on");}else{nav.removeClass("on");}})
$('#navToggle').on('click',function(){$('.m_nav').addClass('open');})
$('.m_nav .top .closed').on('click',function(){$('.m_nav').removeClass('open');})
$(".m_nav .ul li").click(function(){$(this).children("div.dropdown_menu").slideToggle('slow')
$(this).siblings('li').children('.dropdown_menu').slideUp('slow');});$('#index_main').fullpage({'navigation':true,slidesNavigation:true,controlArrows:false,continuousHorizontal:true,scrollingSpeed:1000,showActiveTooltip:true,anchors:['hero','one','two','three'],loopHorizontal:true,afterLoad:function(anchorLink,index){if(index==1){$('header').removeClass('on');}
if(index==2){$('header').addClass('on');$('.section2 h3').addClass('animated fadeInUp').css('animation-delay','.1s');}
if(index==3){$('header').addClass('on');$('.section3 h3').addClass('animated fadeInUp').css('animation-delay','.1s');}
if(index==4){$('header').addClass('on');$('.section4 h3').addClass('animated fadeInUp').css('animation-delay','.1s');}},onLeave:function(index,direction){}})