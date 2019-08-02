 					
				</div>
			</div>
		</div>
	</div>

   <footer>
   <div class='container-fluid'>
     <div class='row'>
       <div class='col-md-2 col-sm-2 col-xs-2 col-lg-2'>
         <a style='padding-left:  5px; font-size: 10px; font-style: italic;' href='mailto:sl147@ukr.net'>розробка сайту <br> sl147 studio</a>
       </div>
       <div class='col-md-2 col-sm-2 col-xs-2 col-lg-2'>
         &copy; <address style='color: blue; padding-left:  5px;'>Арт маркет<br>2015-16</address>
       </div>
       <div class='col-md-2 col-sm-2 col-xs-2 col-lg-2'>
			<div class='grup'>

</div>
       </div>
       <div class='col-md-2 col-sm-2 col-xs-2 col-lg-2'>
           <p style='padding-right: 1px;'><a style='font-style: italic;font-size: 10px;' href='mailto:admin@artargus.in.ua'>написати до<br>адміністратора</a></p>
       </div>
       <div class='col-md-2 col-sm-2 col-xs-2 col-lg-2'>
			<a class='btn btn-primary' href='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2599.1836464774824!2d23.501452115393146!3d49.34867257933855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473a4ea75da1af95%3A0x34285f31c87ed517!2z0JLRgdC1INC00LvRjyDRhdGD0LTQvtC20L3QuNC60LA!5e0!3m2!1suk!2sua!4v1508955277680' title='Шукати на карті' target='_blank'>Шукати на карті</a>
 		</div>  
 
     </div>
	</div>
</footer>

<script src="/libs/jquery/jquery-1.11.3.min.js"></script>
<script defer  src="/libs/jquery-mousewheel/jquery.mousewheel.min.js"></script>
<script defer src="/libs/fancybox/jquery.fancybox.pack.js"></script>
<script defer src="/js/velocity.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/vue.min.js"></script>
<script src="/js/vue-resource.min.js"></script>
<script src="../js/vue/basketCount.js"></script>
<script defer src="//unpkg.com/babel-polyfill@latest/dist/polyfill.min.js"></script>
<script defer src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
<script src="/js/vue/vueFind.js"></script> 

<!-- <script>
  $(function() {
      $('.table').footable({});
  });
</script> -->
<!-- <script>
jQuery(function () {
  jQuery('.table').footable({
    calculateWidthOverride: function() {
      return {width: jQuery(window).width()};
    }
  });
})
</script> -->

<script>
$(document).ready(function() {
 
 //  $('.table').footable({});
// Use display:none optionn to hide the element once the scale animation is complete.
$(".velocityProduct1").velocity(
  { 
    scale: 0
  },
  { 
    duration: 800,
    display: "none"
  });

// Use the display:block option to show the element before the new scale animation starts.
$(".velocityProduct1").velocity(
  { 
    scale: 1
  },
  { 
    duration: 800,
    display: "block"
  });

  $('[data-toggle="popover"]').popover({
  });

if ($(window).width() < 768) {
    $('.menuMain').remove();
    //$('#find').remove();
    //$('.tit').remove();
    $('.leftSide').remove();
    $('.brandGroup').remove();
    $('.listImgNav').remove(); 
};

$(".velocityProduct").velocity(
  { 
    scale: 0.5
  },
  { 
    duration: 400,
    loop: 1 // Loop one time (animate scale to 1.5 then back to its original value).
  });
});
</script>

</body>
</html>
<?php
/*function startCron($file)
{
  global $URL;
  $fp = fsockopen(getenv('HTTP_HOST'), 80);
  if($fp)
  {
    fputs($fp,"GET http://".getenv('HTTP_HOST').'/'.$URL."$file HTTP/1.0\nHost: ".getenv('HTTP_HOST')."\n\n");
    fclose($fp);
    echo "is fp:$fp    getenv:".getenv('HTTP_HOST')."   url:$URL     file:$file<br>";
    echo "fpu:"."GET http://".getenv('HTTP_HOST').'/'.$URL."$file HTTP/1.0\nHost: ".getenv('HTTP_HOST')."\n\n";
  }
  else echo "no fp";
} 
echo "startCron";
startCron('sitemap.xml.php');?>*/