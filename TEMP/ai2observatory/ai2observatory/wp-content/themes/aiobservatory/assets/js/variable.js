/*=================================================
true = enable
false = disable
1000 = 1 second

be careful, each var must have ; at the end of the line
=================================================*/

/*=================================================
preloader
=================================================*/

var __preloaderFadeOut = 1200; // fadeout
var __preloaderDelay = 800; // delay

/*=================================================
fullpage
=================================================*/

var __desktopVersion = 1; // desktop scroll version,     1 = scrolling, 2 = normal

/*=================================================
countdown
=================================================*/

var __countdown = true; // enable countdown
var __countdownDate = "12/24/2015 23:59:59"; // 2015-12-24 23:59:59
var __countdownTimezone = "-8"; // timezone

/*=================================================
background, set one of below to true
the first true will be enable
=================================================*/

var __videoHeader = true; // video background toggle
var __slideshowHeader = false; // image background toggle

/*=================================================
background config
=================================================*/

var __imageNumber = 1; // how many slideshow image to show, 1 for static image background, please view document for more info about image name format
var __vegasStatic = false; // true for fade effect slideshow, false for css3 effect slideshow
var __vegasShuffle = false; // random image
var __vegasDelay = 8000; // slideshow delay
var __vegasTransitionDuration = 2500; // transition duration
var __vegasAnimationDuration = 12000; // animation duration, __vegasDelay + 2000 for better fadeout timing
var __vegasAnimationSet = [ // animation effect, read document for more info
        'kenburnsUp',
        'kenburnsDown',
        'kenburnsLeft',
        'kenburnsRight'
      ];
var __vegasTransitionSet = [ // transition effect, read document for more info
        'fade'
      ];

// video header setting
var __youtubeUrl = 'https://www.youtube.com/watch?v=59zjsmEABOE'; // youtube video url
var __videoStartTime = 70; // video start time, 70 mean 70 seconds
var __videoEndTime = 180; // video end time, 180 mean 180 seconds
var __videoMute = false; // mute video on start

/*=================================================
overlay and background music
=================================================*/

var __pattern = true; // png overlay
var __gradient = true; // gradient overlay
var __gradientAnimaton = true; // gradient animation overlay, need __gradient = true
var __audio = true; // audio background toggle

/*=================================================
firefly
=================================================*/

var __firefly = true; // firefly effect
var __fireflyColor = '#fff'; // firefly color
var __fireflyAmount = 30; // firefly amount, recommend set under 40



/*=================================================
***do not edit below code***
=================================================*/

if (__vegasStatic) {
  var __vegasAnimation = '';
  var __vegasTransition = 'fade';
} else {
  var __vegasAnimation = __vegasAnimationSet;
  var __vegasTransition = __vegasTransitionSet;
}

