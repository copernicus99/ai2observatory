(function($) {
  'use strict';

/*=================================================
IE10 viewport fix
=================================================*/

  (function() {
    'use strict';
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
      var msViewportStyle = document.createElement('style')
      msViewportStyle.appendChild(
        document.createTextNode(
          '@-ms-viewport{width:auto!important}'
        )
      )
      document.querySelector('head').appendChild(msViewportStyle)
    }
  })();

/*=================================================
platform detect
=================================================*/
  var isMobile = /Android|iPhone|iPod|Blackberry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                //Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
  if (isMobile) {
    $('body').addClass('is-mobile');
    $('#video-jsi').remove();
    $('#audio-control').remove();
    $('.menu-toggle').show();
    $('.full-nav').hide();
    $('#wrapper').hide();
    $('header#header').addClass('transparent-header');


  }


/*=================================================
preloader
=================================================*/

  function _preloader() {

    $('#preloader-img').fadeOut(__preloaderFadeOut);
    $('#preloader').delay(__preloaderDelay).fadeOut(__preloaderFadeOut, function(){
      // function that after preloader
    });

  }

/*=================================================
set height
=================================================*/

  function _setHeight() {
    var $social = $('.social');
    var socialHeight = $social.height();
    var headerHeight = $('#header').outerHeight();

    $('.section-entry').css({
      'padding-top': headerHeight + 'px',
      'padding-bottom': headerHeight + 'px'
    });

    $social.css({'margin-top' : - (socialHeight / 2)});
  }

/*=================================================
fullpage
=================================================*/
  function _fullPage() {

    if (isMobile) { // mobile config - do not edit

      var __navigation = true;
      var __autoScrolling = false;
      var __scrollBar = false;
      var __scrollOverflow = false;

    } else { // desktop config - do not edit

      var __navigation = true;

      if (__desktopVersion == 1) {
        var __autoScrolling = false;
        var __scrollBar = false;
        var __scrollOverflow = true;
      } else if (__desktopVersion == 2) {
        var __autoScrolling = false;
        var __scrollBar = true;
        var __scrollOverflow = false;
      }

    }

    $('#fullpage').fullpage({
      anchors: ['home', 'services', 'newsletter', 'contact'],

      navigation: __navigation,
      navigationPosition: 'left',
      navigationTooltips: ['Home', 'Services', 'Newsletter', 'Contact'],
      showActiveTooltips: false,
      scrollingSpeed: 1000, // page scroll speed
      autoScrolling: __autoScrolling,
      fitToSection: false,
      scrollBar: __scrollBar,
      easing: 'easeInExpo', // jquery easing
      easingcss3: 'cubic-bezier(1.000, 0.000, 0.465, 0.880)', // css easing
      scrollOverflow: __scrollOverflow,
      touchSensitivity: 5,
      recordHistory: false,
      paddingTop: '0',
      paddingBottom: '0',

      onLeave: function(index, nextIndex, direction) {
        // all function at afterLoad
        //  $('body').removeClass('open');
      },

      afterLoad: function(anchorLink, index) {
        if (!isMobile){
        _leftNavToggle();
        }
        if(isMobile){
        $('.mob-nav').html($('#fp-nav').html());
        $('.mob-nav').attr('id','fp-nav');
        $('.mob-nav').addClass('manu-nav');
        $('.mob-nav').find('ul').addClass('menu');
        $('#fp-nav.left').hide();
      }
        if (!isMobile && !$('html').hasClass('ie9')) {

          $(this).find('.animated').each(function() {
            
            var $this = $(this); // $this mean .animated at active section
            var animation = 'fadeInUp'; // default animation
            var delay = 0; // default delay

            if ($this.data('animation')) {
              animation = $this.data('animation');
            }
            if ($this.data('delay')) {
              delay = $this.data('delay');
            }

            var delayTime = $('body').hasClass('is-loaded') ? delay : __preloaderFadeOut + 200 + delay;

            setTimeout(function() {
              $this.addClass('in' + ' ' + animation);
              $('body').addClass('is-loaded');
            }, delayTime);

          });

          $('.section:not(".active")').find('.animated').each(function() {

            var $this = $(this);
            var animation = 'fadeInUp';
            var delay = 0;

            if ($this.data('animation')) {
              animation = $this.data('animation');
            }
            if ($this.data('delay')) {
              delay = $this.data('delay');
            }

            $this.removeClass('in' + ' ' + animation);

          });

        }

      },
      
      afterRender: function(index) {

        if (!isMobile && !$('html').hasClass('ie9')) {

          $('.home-section, #footer').find('.animated').each(function() {
            

            var $this = $(this);
            var animation = 'fadeInUp';
            var delay = 0;

            if ($this.data('animation')) {
              animation = $this.data('animation');
            }
            if ($this.data('delay')) {
              delay = $this.data('delay');
            }

            setTimeout(function() {
              $this.addClass('in' + ' ' + animation);
              $('body').addClass('is-loaded');
            }, __preloaderFadeOut + 200 + delay);

          });

        }
        
        

      },

      afterResize: function(){},
      afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex){},
      onSlideLeave: function(anchorLink, index, slideIndex, direction){}

    });

    if(isMobile) {
      $('#footer, .social').detach().insertAfter('.section:last-child .section-entry');
    }

   $('a[data-move-to]').each(function() {
      var $this = $(this);
      var section = $this.data('move-to');
      $this.on('click', function(e) {
        e.preventDefault();
        if (section > 0) {
          $.fn.fullpage.moveTo(section);
        }
      });
    });

  }

/*=================================================
click link
=================================================*/

  function _clickLink() {
    $('a[href="#"]').on('click',function(e) {
      e.preventDefault();
    });
  }



/*=================================================
youtube video background header and video/audio controls
=================================================*/

  function _videoHeader() {

    var $body = $('body');

    if (isMobile) {
    }
    
    else {

      var $volume = $('#volume');
      $('#video-control').show();
      
      var $jsivideo = document.getElementById("video-jsi");
      $jsivideo.muted = true

    
      //if muted varialbe on, show the initial speaker setting as muted else show as on
      if ($jsivideo.muted) {
        $volume.addClass('fa-volume-off');
      } else {
        $volume.addClass('fa-volume-up');
      }

    //Play and pause button toggle behavior when clicked...I added ref to my vid instead of youtube payer
      $('#play').on('click', function() {
        var $this = $(this);
        $this.toggleClass('fa-play fa-pause', function() {
          ($this.hasClass('fa-play')) ? $jsivideo.pause() : $jsivideo.play();
        });
      });
    
    
      //Speaker button toggle behavior when clicked...I added ref to my vid instead of youtube payer
      $volume.on('click', function() {
        var $this = $(this);
        $this.toggleClass('fa-volume-off fa-volume-up', function() {
          ($this.hasClass('fa-volume-off')) ? $jsivideo.muted = true : $jsivideo.muted = false;
        });
      });
    }

  }


/*==============================================================================================================
audio control - see video section for ai2 audio seetings....i dont this there are used
=================================================*/

  function _mobileAudioPlayer() {
    if (__audio) {
      var $audioPlayer = document.getElementById('audio-player');
      var $audioPlay = $('#audio-play');
     $('#audio-control').show();
      $audioPlay.addClass('fa-pause');    
      $audioPlayer.pause();
      $audioPlay.on('click', function() {  
        var $this = $(this);
        $this.toggleClass('fa-play fa-pause', function() {    
          ($this.hasClass('fa-play')) ? $audioPlayer.pause() : $audioPlayer.play();
        });
      });
    }
  }

  function _audioPlayer() {
    if (!__videoHeader && __audio) {
      var $audioPlayer = document.getElementById('audio-player');
      var $audioPlay = $('#audio-play');  
     $('#audio-control').show();
      $audioPlay.addClass('fa-pause');   
      $audioPlayer.pause();
      $audioPlay.on('click', function() {
        var $this = $(this);
        $this.toggleClass('fa-play fa-pause', function() {     
          ($this.hasClass('fa-play')) ? $audioPlayer.pause() : $audioPlayer.play();
        });
      });
    }
  }



/*=================================================
nav
=================================================*/

  function _leftNavToggle() {

    if ($(window).width() < 980) {
        $('#video-control').css({'margin-left':'40px'});
        $('.mob-nav').show();
        $('.mob-nav').html($('#fp-nav').html());
        $('.mob-nav').attr('id','fp-nav');
        $('.mob-nav').addClass('manu-nav');
        $('.mob-nav').find('ul').addClass('menu');
        $('#fp-nav.left').hide();
        //$('#fp-nav.left').html('');
    }
    else {
       $('#video-control').css({'margin-left':'0px'});
      $('#fp-nav.left').show();
      $('.mob-nav').hide();
      $('.mob-nav').removeAttr('id');
      //$('#p-nav').html($('.mob-nav').html());
      //$('.mob-nav').html('');
    }
  }
  
  function _leftNavLoadToggle() {
    if ($(window).width() < 980) {
    
        $('#video-control').css({'margin-left':'40px'});
        $('.mob-nav').html($('#fp-nav').html());
        //$('.mob-nav').attr('id','fp-nav');
        $('.mob-nav').addClass('manu-nav');
        $('.mob-nav').find('ul').addClass('menu');
        $('#fp-nav.left').hide();
        //$('#fp-nav.left').html('');
    }
    else {
       $('#video-control').css({'margin-left':'0px'});
      $('#fp-nav.left').show();
      $('.mob-nav').removeAttr('id');
      //$('#p-nav').html($('.mob-nav').html());
      //$('.mob-nav').html('');
    }
}


/*=================================================
shuffle text
=================================================*/

  function _shuffleText() {
    if (!isMobile) {
      $('.shuffle').each(function() {
        var $this = $(this);
        var delay = $this.data('shuffle');
        var text = $this.text();
        
        $this.shuffleLetters();
        setInterval(function(){
          $this.shuffleLetters({
            'text' : text
          });
        },delay);
      });
    }
  }

/*=================================================
header and overlay style
=================================================*/

  function _headerStyleToggle() {

    var $body = $('body');

    if (__videoHeader) {
      _videoHeader();
    } else if (__slideshowHeader) {
 
    }
    if (!__pattern) {
      $('.pattern').hide();
    }
    if (__gradient) {
      $body.addClass('gradient');
    }
    if (!__videoHeader && __gradientAnimaton && !isMobile) {
      $body.addClass('gradient-animation');
    }
    
  }

/*=================================================
form validation
=================================================*/

  function _formValidation(emailAddress) {
    var emailRegex = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return emailRegex.test(emailAddress);
  }



/*=================================================
countdown
=================================================*/

  function _countdown() {

    var $countdownContainer = $("#countdown");

    if (__countdown) {
      $countdownContainer.downCount({
        date: __countdownDate,
        offset: __countdownTimezone
      });
    } else {
      $countdownContainer.hide();
    }

  }

/*=======================================
window scroll text fadeOut
=========================================*/

  function _contentFadeOut(){
    $(window).on('scroll', function () {
        $('.section .col-md-4, .section .col-md-12').each(function (index, item) {
            $(item).children().each(function (indexChild, child) {
                var st = $(window).scrollTop();
                st = $(window).scrollTop() - $(child).offset().top +150;
                
                $(child).css({ 'opacity': (1 - st / 100) });
            });

        });
    });
  }

/*=================================================
window on load
=================================================*/

  $(window).on('load', function() {

    _preloader();
    _setHeight();

  });

/*=================================================
document on ready
=================================================*/

  $(document).on('ready', function() {
    console.log(window.orientation);
    if (!isMobile){
    _leftNavLoadToggle();
    _contentFadeOut();
     }
    _fullPage();
    _headerStyleToggle();
    _countdown();
    _clickLink();
    _shuffleText();
    if (!isMobile){
      _audioPlayer();
    } else {
      _mobileAudioPlayer();
    }
  });

/*=================================================
window on resize
=================================================*/

var i = 1;
  $(window).on('resize', function() {
  if($(window).width() > $(window).height()){
      //$('#wrapper').show();
    } else {
      //$('#wrapper').hide();
    }
    _setHeight();
    if (!isMobile){
    if( i != 1 ) {
       _leftNavToggle();
    }
    i++;
    }

  }).trigger('resize');

/*============= START COMMENT OUT FOR NEW SLIDER ========
  $(window).on('resize', function() {
  if($(window).width() > $(window).height()){
      //$('#wrapper').show();
    } else {
      //$('#wrapper').hide();
    }
    _setHeight();
    if (!isMobile){
   _leftNavToggle();
    }

  }).trigger('resize');
============= END COMMENT OUT FOR SLIDER ===========*/

})(jQuery);




/*=================================================
If vid playing....hide poster
If vid paused...show poster
I added this whole piece
=================================================*/
$(function(){
    
    var video = $('#video-jsi')[0];
    if(video){
    $('.poster').fadeOut();
  } else {
     $('.poster').fadeIn();
  }

  if(video){
    video.addEventListener('playing', function(){
           $('.poster').fadeOut();
     //  alert("in play method");
     //  $('.poster').css('z-index','850');
    })
  
  
  
     video.addEventListener('pause', function(){
       $('.poster').fadeIn();

      //  alert("AL7    after poster");
        //  $('.poster').css('z-index','950');
    }) 
   }
  
  
  
    
}) 



/*========================================================================================================
fade sound just before pause
=================================================*/
function FadeAudio () {
      
    var video = document.getElementById("video-jsi");

    
   // video.volume = 0;    //this sets volume to zero.....remove this line to allow audio
    



    // Set the point in playback that fadeout begins. The fadeout at .01 units @ .07 secs loop takes @ 8 secs
    var fadePoint = 40;     //length of vid - 8
    
if(video){


    var fadeAudio = setInterval(function () {

        // Only fade if past the fade out point or not at zero already
        if ((video.currentTime >= fadePoint) && (video.volume > 0.0)) {
               video.volume -= 0.01; //Keep units set as is
        }
    
        // When volume at zero stop all the intervalling
        if (video.volume <= 0.02) {

            clearInterval(fadeAudio);
        }
    }, 70);  //keep loop set as is
  }

}


/*=================================================
hide controls at end of video
=================================================*/

function hideControls() {

      var video = document.getElementById("video-jsi");
      if(video){
      video.addEventListener("timeupdate", function () {
        if (video.currentTime >= 46) {
          document.getElementById("video-control").style.visibility = "hidden";  


      $('video').each( function () {
          if (this.pause) {  //use it as a truthy check
              
              this.pause();
          }
      });
         
        }
    }, false);  
    }

}

