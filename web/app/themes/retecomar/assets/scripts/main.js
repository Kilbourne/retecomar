/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    'rete_comar':{
      init:function(){
        $('.discs-list').slick({slidesToShow:3,prevArrow:'<button type="button" class="slick-prev"></button>',nextArrow:'<button type="button" class="slick-next"></button>',
      responsive: [{

      breakpoint: 1015,
      settings: {
        slidesToShow: 2
      }

    },{

      breakpoint: 576,
      settings: {
        slidesToShow: 1
      }

    }]});
        $('.componente-link').click(ajaxDisco);
         History.Adapter.bind(window,'statechange',function statechangeCallback (){ // Note: We are using statechange instead of popstate
           var State = History.getState(); // Note: We are using History.getState() instead of event.state
           var data=State.data.data,

           p=$('#'+State.data.target);

                                       $('.extended-disc-panel').fadeOut('400', function() {
                                        
                              $('.slick-track>li.active').add(p).toggleClass('active');
                            $(".extended-disc-panel>h1").text(data.title);
                            $(".extended-disc-panel>h2").text(data.strumento);
                            var src= $(".extended-disc-panel>.details>img");
                            src.remove();
                            $(".extended-disc-panel>.details").prepend(data.thumb);
                            //$(target).children('img').remove()
                            //$(target).append(src);
                            
                            $(".extended-disc-panel .desc-wrap").html(data.excerpt);
                            $('.extended-disc-panel').fadeIn('400',function(){
                                     $('.extended-disc-panel').removeClass('not-visible');
                            });
                            });

           //if(State.data.disco){
            //$('.disco-link[href="'+State.data.disco+'"').click();
           //}
          } );
                    if(document.location.toString().indexOf('?componente=')>-1){
            var searched=document.location.toString().split('?componente=')[1];
            $('.componente-link').filter(function(){
              var splitted =this.href.split('/'),
                            location=splitted[splitted.length-1]!==''?splitted[splitted.length-1]:splitted[splitted.length-2];
                            return location === searched;
                          }).click();
            History.Adapter.trigger(window,'statechange')
          }else{
            $('.extended-disc-panel').removeClass('not-visible');
          }
          function ajaxDisco(e){
            e.preventDefault();
            var cached;
            var target=e.currentTarget,url=target.href;
            cached=JSON.parse(localStorage.getItem(url));
var splitted=url.split('/'),
                            location=splitted[splitted.length-1]!==''?splitted[splitted.length-1]:splitted[splitted.length-2];
            if(cached !==null){
              History.pushState(cached, cached.data.title, '?componente='+location);
            }else{
            $.post( gesualdi.ajaxurl, {
                            action: 'gesualdi_disco',
                            postlink: url ,
                            nonce:gesualdi.nonce
                        },

                        function(response) {
                          if(response.success){
                            var data=response.data;
                            var obj ={disco:url,data:data,target:target.parentElement.id};
                            localStorage.setItem(url, JSON.stringify(obj));
                             History.pushState(obj, data.title, '?componente='+location);

                          }
                        });
          }
        }
           function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
