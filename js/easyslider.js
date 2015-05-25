/**
 * Easy Gallery for jQuery
 * Create your web gallery with easy layout and easy configuration.
 * @url http://www.freelancer-id.com/easy-gallery/
 * @version 2.0
 * CopyRight: GNU General Public License v2
 * 
 * Developed by: Alaa Badran
 * http://www.freelancer-id.com/
 * Email alaa@freelancer-id.com
 *
 */
(function($) {
$.fn.egallery = function (options){
    // Default settings.
    var settings = {
    animation: 'scroll',
    width: 400, // Width for gallery holder, li
    height: 400, // Height for each element
    speed: 500, // Animation speed in MS
    delay: 4000, // delay for auto play to transact.
    easing: 'swing', // Easing animation. require to include easing plugin http://gsgd.co.uk/sandbox/jquery/easing/
    thumbs: 'none', //  Thumbs: none, numbers, image OR custom
    thumbClass: '', // Thumb CSS class
    thumbImage: '', // Image url for thumbs.
    aClass: '', // Thumb active class
    auto: true // True to enable auto play
    };
    // Exteding options
    settings = $.extend(settings, options);
    
    // sgObj is a holder for #gallery container.. Cashing it.
    var sgObj = $(this);
    // anim used for animation.. to stop any action while animating.
    var anim = false;
    // li items count handler
    var licount = 0;
    // Auto play handler.
    var ap = null;
    // Item index for autoplay
    var aind = 0;
    
    /**
     * This function applies CSS for container and inside elements.
     */
    function _css(){
        $(sgObj).css({'overflow':'hidden','width':settings.width+'px','height':settings.height+'px','position':'relative'});
        $(sgObj).find("ul").css({'list-style':'none','position':'absolute','top':0,'left':0,'width':(settings.width * $(sgObj).find("li").length)+'px','height':settings.height+'px'});
        $(sgObj).find("li").css({"float":"left",'width':settings.width+'px'});
    }
    
    /**
     * Creating numeric thumbs. Depending on elements count.
     */
    function _createThumbsNumbers(){
        var n_all = $(sgObj).find("li").length;
        if(settings.animation == "slide");
            --n_all;
        var htm = '<ul>';
        for (i=0;i<n_all; i++){
            htm += '<li class="'+settings.thumbClass+'">'+ (i+1) +'</'+'li>';
        }
        htm += '</'+'ul>';
        return htm;
    }
    
    function _createThumbsImage(){
        var htm = '<ul>';
        var n_all = $(sgObj).find("li").length;
        if(settings.animation == "slide");
            --n_all;
        for (i=0;i<n_all; i++){
            htm += '<li class="'+settings.thumbClass+'" style="background:url(\''+ settings.thumbImage +'\') center 0 no-repeat;"></'+'li>';
        }
        htm += '</'+'ul>';
        return htm;
    }
    
    /**
     * This function calls functions to generate thumbs depending on the settings.
     */
    function _thumbs(th){
        if($("#ssgThumbs").length < 1){
            return false;
        }
        var animated = false;
        switch(th){
            case "numbers":
                $("#ssgThumbs").html(_createThumbsNumbers());
                break;
            case "image":
                $("#ssgThumbs").html(_createThumbsImage());
                break;
            case "custom":
                // do nothing.
                break;
            default:
                return false;
                break;
        }
        $("#ssgThumbs li").click(function (){_cthumbs($("#ssgThumbs li").index(this),true);});
        $("#ssgThumbs li").eq(0).addClass(settings.aClass);
    }
    
    /**
     * This function animates the gallery to the clicked thumb OR animate the gallery for AutoPlay
     * @param ind index of clicked object
     */
    function _cthumbs(ind,c){
        if(anim==false){
            clearInterval(ap);
            anim = true;
            if(settings.thumbs != "none"){
            $("#ssgThumbs li").removeClass(settings.aClass);//alert(settings.aClass);
            if(ind>=licount)
                lind = 0;
            else

                lind = ind;
            $("#ssgThumbs li").eq(lind).addClass(settings.aClass);
            $(sgObj).find('ul').animate({'left':-(ind * settings.width)+'px'},settings.speed, settings.easing, function (){anim = false;
                if(c==true){
                    aind = ind;
                }
                if(settings.auto==true){ap=setInterval(function (){_autoplay();}, settings.delay)}
            });
            } else {
                $(sgObj).find('ul').animate({'left':-(ind * settings.width)+'px'},settings.speed, settings.easing, function (){anim = false;
                    if(settings.auto==true){ap=setInterval(function (){_autoplay();}, settings.delay)}
                });
            }
        }
    }
    
    /**
     * This function adds the first item (duplicate it) at the end WHEN using slide animation.
     * 
     */
    function _prepareGallery(){
        var first_item = $(sgObj).find("li").eq(0).html();
        licount = $(sgObj).find("li").length;
        $(sgObj).find("ul").eq(0).append("<li>"+first_item+"</li>");
    }
    
    /**
     * calls the thumb creator function
     */
    function _prepare(){
        _thumbs(settings.thumbs);
    }
    
    /**
     * Starts the auto play.
     */
    function _run(){
        // Runs autoplay
        ap = setInterval(function (){
            _autoplay();
        },settings.delay);
    }
    
    /**
     * Animate the gallery on Auto play
     */
    function _autoplay(){
        aind++;//alert("Ok: "+aind);
        if(aind>licount){
            if(settings.animation == "slide") {
                $(sgObj).find("ul").css("left",0);
                aind = 1;
                _cthumbs(aind,false);
                return false;
            } else {
                aind = 0;
            }
        }
        _cthumbs(aind,false);
    }
    
    /**
     * The initializer for this plugin.
     */
    function _init(){
        if(settings.animation == "slide")
            _prepareGallery();
        _css();
        _prepare();
        if(settings.auto==true){
            _run();
        }
    }
    
    return _init();
    
};
});
