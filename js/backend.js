(function ($) {
    $(function () {
        //var numItems=0;
        var numItems = $('.nb-each-slider').length;
        $('.nb-new-slide-trigger').click(function () {
            var input_name = $(this).data('slide-name');
            //alert(numItems);
            var slide_html = '<div class="nb-each-slider"><textarea name="nb_settings' + input_name + '[textarea]['+numItems+']"></textarea><a href="javascript:void(0);" title="Delete Slide" class="nb-remove-slide">x</a></div>';
            

            $(this).closest('.nb-option-field').find('.nb-slides-append').append(slide_html);
            $(this).closest('.nb-option-field').find('.nb-slides-append .nb-each-slide textarea').last().focus();
            numItems++;
        });

        $('body').on('click', '.nb-remove-slide', function () {
            $(this).parent().fadeOut(300, function () {
                $(this).remove();
            });

        });
        
        $('.nb-new-ticker-trigger').click(function () {
            var input_name = $(this).data('ticker-name');
            var slide_html = '<div class="nb-each-slide"><input type="text" name="nb_settings' + input_name + '"/><a href="javascript:void(0);" title="Delete Slide" class="nb-remove-slide">x</a></div>';
            $(this).closest('.nb-option-field').find('.nb-ticker-append').append(slide_html);
            $(this).closest('.nb-option-field').find('.nb-ticker-append .nb-each-slide input[type="text"]').last().focus();
        });

        
        $('.nb-colorpicker').wpColorPicker();


        $('.nb-tab-trigger').click(function(){
           $('.nb-tab-trigger').removeClass('nav-tab-active');
           $(this).addClass('nav-tab-active');
           var configuration = $(this).data('configuration');
           $('.nb-configurations').hide();
           $('.nb-'+configuration+'-configurations').show();
        });
    });//document.ready close
}(jQuery));

jQuery(document).ready(function($){

    if ($('#marquee-checkbox').is(':checked')) {
         $('.nb-option-field-wrap.marqueedir').show();
         
     }
     else{

            $('.nb-option-field-wrap.marqueedir').hide();
            
     }
    
    $('#marquee-checkbox').change(function(){
        if(this.checked)
            $('.nb-option-field-wrap.marqueedir').fadeIn('slow');
        else
            $('.nb-option-field-wrap.marqueedir').fadeOut('slow');

    });

    if ($('#entire-select').is(':checked')){
            $('#other-select').hide();
        }
        else{
            $('#other-select').show();
        }

    $('#entire-select').change(function(){
        if(this.checked)
            $('#other-select').fadeOut('slow');
        else
            $('#other-select').fadeIn('slow');

    });

    $('.blink-option').hide();
    $('.marquee-option').hide();

    if($('#nb-animate option:selected').text()=="Marquee")

        {
            $('.marquee-option').show();
            $('.blink-option').hide();   
        }
        else{
            $('.blink-option').show();
            $('.marquee-option').hide();
        }

    $('#nb-animate').change(function(){
        //alert($('#nb-animate option:selected').text());
        if($('#nb-animate option:selected').text()=="Marquee")

        {
            $('.marquee-option').fadeIn('slow');
            $('.blink-option').hide();   
        }
        else{
            $('.blink-option').fadeIn('slow');
            $('.marquee-option').hide();
        }

    });

    if($('#display-position option:selected').text()=="Left") 
        {
            $('li.plain-text,li.nb-slider,li.twitter-tweets,li.cta,li.nb-shortcodes,li.news-ticker').hide();   
        }

        else if($('#display-position option:selected').text()=="Right") 
        {
            $('li.plain-text,li.nb-slider,li.twitter-tweets,li.cta,li.nb-shortcodes,li.news-ticker').hide();   
        }
        else{
            $('li.plain-text,li.nb-slider,li.twitter-tweets,li.cta,li.nb-shortcodes,li.news-ticker,li.nb-subscribe,li.social_icons').show();
        }

    $('#display-position').change(function(){
        if($('#display-position option:selected').text()=="Left") 
        {
            $('li.plain-text,li.nb-slider,li.twitter-tweets,li.cta,li.nb-shortcodes,li.news-ticker').hide();   
        }

        else if($('#display-position option:selected').text()=="Right") 
        {
            $('li.plain-text,li.nb-slider,li.twitter-tweets,li.cta,li.nb-shortcodes,li.news-ticker').hide();   
        }
        else{
            $('li.plain-text,li.nb-slider,li.twitter-tweets,li.cta,li.nb-shortcodes,li.news-ticker,li.nb-subscribe,li.social_icons').show();
        }

    });

    $('.nb-option-cookie').hide();

    if($('#nb-settings-close option:selected').text()!="Close Button")

        {
            $('.nb-option-cookie').hide();   
        }
        else{
            $('.nb-option-cookie').show();
        }

    $('#nb-settings-close').change(function(){
        //alert($('#nb-animate option:selected').text());
        if($('#nb-settings-close option:selected').text()!="Close Button")

        {
            $('.nb-option-cookie').hide();   
        }
        else{
            $('.nb-option-cookie').fadeIn('slow');
        }

    });

});

jQuery(document).ready(function($){
$('.toggle').next().hasClass('show');
$('.toggle').next().removeClass('show');
$('.toggle').next().slideUp(350);
    $('.toggle-social').next().hasClass('show');
    $('.toggle-social').next().removeClass('show');
    $('.toggle-social').next().slideUp(350);
        $('.toggle-basic').next().hasClass('show');
        $('.toggle-basic').next().removeClass('show');
        $('.toggle-basic').next().slideUp(350);
            $('.toggle-settings').next().hasClass('show');
            $('.toggle-settings').next().removeClass('show');
            $('.toggle-settings').next().slideUp(350);

$('.toggle').click(function(e) {
    e.preventDefault();
    var $this = $(this);
  
    if ($this.next().hasClass('show')) {
        $this.next().removeClass('show');
        $this.next().slideUp(350);
        //alert($this);
        $this.find('.dashicons.dashicons-arrow-down.custom-toggle').toggleClass("rotator")  ;

    } else {
        $this.parent().parent().find('li .inner').removeClass('show');
        $this.parent().parent().find('li .inner').slideUp(350);
        $this.next().toggleClass('show');
        $this.next().slideToggle(350);
        //alert($this);
        $this.find('.dashicons.dashicons-arrow-down.custom-toggle').toggleClass("rotator")  ;
    }

})

$('.toggle-social').click(function(e) {


    e.preventDefault();
  
    var $this = $(this);
  
    if ($this.next().hasClass('show')) {
        $this.next().removeClass('show');
        $this.next().slideUp(350);
        $this.find('.dashicons.dashicons-arrow-down.custom-toggle-social').toggleClass("rotator")  ;

    } else {
        $this.parent().parent().find('li .inner').removeClass('show');
        $this.parent().parent().find('li .inner').slideUp(350);
        $this.next().toggleClass('show');
        $this.next().slideToggle(350);
        $this.find('.dashicons.dashicons-arrow-down.custom-toggle-social').toggleClass("rotator")  ;


    }
})


$('.toggle-basic').click(function(e) {


    e.preventDefault();
  
    var $this = $(this);
  
    if ($this.next().hasClass('show')) {
        $this.next().removeClass('show');
        $this.next().slideUp(350);
        $this.find('.dashicons.dashicons-arrow-down.custom-toggle-basic').toggleClass("rotator")  ;

    } else {
        $this.parent().parent().find('li .inner').removeClass('show');
        $this.parent().parent().find('li .inner').slideUp(350);
        $this.next().toggleClass('show');
        $this.next().slideToggle(350);
        $this.find('.dashicons.dashicons-arrow-down.custom-toggle-basic').toggleClass("rotator")  ;


    }
})


$('.toggle-settings').click(function(e) {


    e.preventDefault();
  
    var $this = $(this);
  
    if ($this.parent().next().hasClass('show')) {
        $this.parent().next().removeClass('show');
        $this.parent().next().slideUp(350);
        $this.find('.dashicons.dashicons-arrow-down.custom-toggle-settings').toggleClass("rotator") ;

    } else {
        $this.parent().next().addClass('show');
        $this.parent().next().slideDown(350);
        $this.find('.dashicons.dashicons-arrow-down.custom-toggle-settings').toggleClass("rotator");
    }
})

});

jQuery(document).ready(function($){

    $('#notice-enable-check').change(function(){
        if(this.checked)
        {
            $('.nb-option-info').fadeIn(500);
            $('.nb-option-info').delay(3000).fadeOut(500);
        }
        else
            $('.nb-option-info').fadeOut(500);

    });


    if ($('.custom-page-list').is(':checked')) {
         $('.custom-pages').show();
     }
     else{
            $('.custom-pages').hide();
     }
    
    $('.custom-page-list').change(function(){
        if(this.checked)
            $('.custom-pages').fadeIn('slow');
        else
            $('.custom-pages').fadeOut('slow');

    });

    $('input.custom-page-list-pages').click(function(e){
      $check = $('input.custom-page-list-pages').filter(':checked').length;
      no_checked=$check;

      if(no_checked=='0'){
        $('input.custom-page-list').prop('checked',false);
      }
      else{
        $('input.custom-page-list').prop('checked',true);
      }

    });


    $('.social-accordion').sortable({
            handle: '.toggle-social,.nb-drag-icon'
        });

});

jQuery(document).ready(function($) {
$('#datetimepicker1').datetimepicker();
$('#datetimepicker2').datetimepicker();
$(document).on('click', 'input', function(){
    console.log($(this).siblings('div').html())
});
});

jQuery(document).ready(function($){
    $('#reset-dtp1').click(function(e)
    {
        $('#datetimepicker1').val('');
        e.preventDefault();
    });
     $('#reset-dtp2').click(function(e)
    {
        $('#datetimepicker2').val('');
        e.preventDefault();
    });
});