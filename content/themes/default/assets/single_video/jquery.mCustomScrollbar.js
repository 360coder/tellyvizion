(function(d,u,D,N){(function(u){var K="https:"==D.location.protocol?"https:":"http:";"function"===typeof define&&define.amd||d.event.special.mousewheel||d("head").append(decodeURI("%3Cscript src="+K+"//cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.11/jquery.mousewheel.min.js%3E%3C/script%3E"));u()})(function(){var M={setWidth:!1,setHeight:!1,setTop:0,setLeft:0,axis:"y",scrollbarPosition:"inside",scrollInertia:950,autoDraggerLength:!0,autoHideScrollbar:!1,autoExpandScrollbar:!1,alwaysShowScrollbar:0,
snapAmount:null,snapOffset:0,mouseWheel:{enable:!0,scrollAmount:"auto",axis:"y",preventDefault:!1,deltaFactor:"auto",normalizeDelta:!1,invert:!1,disableOver:["select","option","keygen","datalist","textarea"]},scrollButtons:{enable:!1,scrollType:"stepless",scrollAmount:"auto"},keyboard:{enable:!0,scrollType:"stepless",scrollAmount:"auto"},contentTouchScroll:25,advanced:{autoExpandHorizontalScroll:!1,autoScrollOnFocus:"input,textarea,select,button,datalist,keygen,a[tabindex],area,object,[contenteditable='true']",
updateOnContentResize:!0,updateOnImageLoad:!0,updateOnSelectorChange:!1,releaseDraggableSelectors:!1},theme:"light",callbacks:{onInit:!1,onScrollStart:!1,onScroll:!1,onTotalScroll:!1,onTotalScrollBack:!1,whileScrolling:!1,onTotalScrollOffset:0,onTotalScrollBackOffset:0,alwaysTriggerOffsets:!0,onOverflowY:!1,onOverflowX:!1,onOverflowYNone:!1,onOverflowXNone:!1},live:!1,liveSelector:null},K=0,I={},J=function(a){I[a]&&(clearTimeout(I[a]),h._delete.call(null,I[a]))},H=u.attachEvent&&!u.addEventListener?
1:0,C=!1,F={init:function(a){a=d.extend(!0,{},M,a);var c=h._selector.call(this);if(a.live){var b=a.liveSelector||this.selector||".mCustomScrollbar",f=d(b);if("off"===a.live){J(b);return}I[b]=setTimeout(function(){f.mCustomScrollbar(a);"once"===a.live&&f.length&&J(b)},500)}else J(b);a.setWidth=a.set_width?a.set_width:a.setWidth;a.setHeight=a.set_height?a.set_height:a.setHeight;a.axis=a.horizontalScroll?"x":h._findAxis.call(null,a.axis);a.scrollInertia=0<a.scrollInertia&&17>a.scrollInertia?17:a.scrollInertia;
"object"!==typeof a.mouseWheel&&1==a.mouseWheel&&(a.mouseWheel={enable:!0,scrollAmount:"auto",axis:"y",preventDefault:!1,deltaFactor:"auto",normalizeDelta:!1,invert:!1});a.mouseWheel.scrollAmount=a.mouseWheelPixels?a.mouseWheelPixels:a.mouseWheel.scrollAmount;a.mouseWheel.normalizeDelta=a.advanced.normalizeMouseWheelDelta?a.advanced.normalizeMouseWheelDelta:a.mouseWheel.normalizeDelta;a.scrollButtons.scrollType=h._findScrollButtonsType.call(null,a.scrollButtons.scrollType);h._theme.call(null,a);return d(c).each(function(){var b=
d(this);if(!b.data("mCS")){b.data("mCS",{idx:++K,opt:a,scrollRatio:{y:null,x:null},overflowed:null,contentReset:{y:null,x:null},bindEvents:!1,tweenRunning:!1,sequential:{},langDir:b.css("direction"),cbOffsets:null,trigger:null});var c=b.data("mCS").opt,f=b.data("mcs-axis"),m=b.data("mcs-scrollbar-position"),p=b.data("mcs-theme");f&&(c.axis=f);m&&(c.scrollbarPosition=m);p&&(c.theme=p,h._theme.call(null,c));h._pluginMarkup.call(this);F.update.call(null,b)}})},update:function(a){a=a||h._selector.call(this);
return d(a).each(function(){var a=d(this);if(a.data("mCS")){var b=a.data("mCS"),f=b.opt,g=d("#mCSB_"+b.idx+"_container"),e=[d("#mCSB_"+b.idx+"_dragger_vertical"),d("#mCSB_"+b.idx+"_dragger_horizontal")];g.length&&(b.tweenRunning&&h._stop.call(null,a),a.hasClass("mCS_disabled")&&a.removeClass("mCS_disabled"),a.hasClass("mCS_destroyed")&&a.removeClass("mCS_destroyed"),h._maxHeight.call(this),h._expandContentHorizontally.call(this),"y"===f.axis||f.advanced.autoExpandHorizontalScroll||g.css("width",h._contentWidth(g.children())),
b.overflowed=h._overflowed.call(this),h._scrollbarVisibility.call(this),f.autoDraggerLength&&h._setDraggerLength.call(this),h._scrollRatio.call(this),h._bindEvents.call(this),g=[Math.abs(g[0].offsetTop),Math.abs(g[0].offsetLeft)],"x"!==f.axis&&(b.overflowed[0]?e[0].height()>e[0].parent().height()?h._resetContentPosition.call(this):(h._scrollTo.call(this,a,g[0].toString(),{dir:"y",dur:0,overwrite:"none"}),b.contentReset.y=null):(h._resetContentPosition.call(this),"y"===f.axis?h._unbindEvents.call(this):
"yx"===f.axis&&b.overflowed[1]&&h._scrollTo.call(this,a,g[1].toString(),{dir:"x",dur:0,overwrite:"none"}))),"y"!==f.axis&&(b.overflowed[1]?e[1].width()>e[1].parent().width()?h._resetContentPosition.call(this):(h._scrollTo.call(this,a,g[1].toString(),{dir:"x",dur:0,overwrite:"none"}),b.contentReset.x=null):(h._resetContentPosition.call(this),"x"===f.axis?h._unbindEvents.call(this):"yx"===f.axis&&b.overflowed[0]&&h._scrollTo.call(this,a,g[0].toString(),{dir:"y",dur:0,overwrite:"none"}))),h._autoUpdate.call(this))}})},
scrollTo:function(a,c){if("undefined"!=typeof a&&null!=a){var b=h._selector.call(this);return d(b).each(function(){var b=d(this);if(b.data("mCS")){var g=b.data("mCS"),e=g.opt,k=d.extend(!0,{},{trigger:"external",scrollInertia:e.scrollInertia,scrollEasing:"mcsEaseInOut",moveDragger:!1,timeout:60,callbacks:!0,onStart:!0,onUpdate:!0,onComplete:!0},c),m=h._arr.call(this,a),p=0<k.scrollInertia&&17>k.scrollInertia?17:k.scrollInertia;m[0]=h._to.call(this,m[0],"y");m[1]=h._to.call(this,m[1],"x");k.moveDragger&&
(m[0]*=g.scrollRatio.y,m[1]*=g.scrollRatio.x);k.dur=p;setTimeout(function(){null!==m[0]&&"undefined"!==typeof m[0]&&"x"!==e.axis&&g.overflowed[0]&&(k.dir="y",k.overwrite="all",h._scrollTo.call(this,b,m[0].toString(),k));null!==m[1]&&"undefined"!==typeof m[1]&&"y"!==e.axis&&g.overflowed[1]&&(k.dir="x",k.overwrite="none",h._scrollTo.call(this,b,m[1].toString(),k))},k.timeout)}})}},stop:function(){var a=h._selector.call(this);return d(a).each(function(){var a=d(this);a.data("mCS")&&h._stop.call(null,
a)})},disable:function(a){var c=h._selector.call(this);return d(c).each(function(){var b=d(this);b.data("mCS")&&(b.data("mCS"),h._autoUpdate.call(this,"remove"),h._unbindEvents.call(this),a&&h._resetContentPosition.call(this),h._scrollbarVisibility.call(this,!0),b.addClass("mCS_disabled"))})},destroy:function(){var a=h._selector.call(this);return d(a).each(function(){var c=d(this);if(c.data("mCS")){var b=c.data("mCS"),f=b.opt,g=d("#mCSB_"+b.idx),e=d("#mCSB_"+b.idx+"_container"),k=d(".mCSB_"+b.idx+
"_scrollbar");f.live&&J(a);h._autoUpdate.call(this,"remove");h._unbindEvents.call(this);h._resetContentPosition.call(this);c.removeData("mCS");h._delete.call(null,this.mcs);k.remove();g.replaceWith(e.contents());c.removeClass("mCustomScrollbar _mCS_"+b.idx+" mCS-autoHide mCS-dir-rtl mCS_no_scrollbar mCS_disabled").addClass("mCS_destroyed")}})}},h={_selector:function(){return"object"!==typeof d(this)||1>d(this).length?".mCustomScrollbar":this},_theme:function(a){a.autoDraggerLength=-1<d.inArray(a.theme,
["rounded","rounded-dark","rounded-dots","rounded-dots-dark"])?!1:a.autoDraggerLength;a.autoExpandScrollbar=-1<d.inArray(a.theme,"rounded-dots rounded-dots-dark 3d 3d-dark 3d-thick 3d-thick-dark inset inset-dark inset-2 inset-2-dark inset-3 inset-3-dark".split(" "))?!1:a.autoExpandScrollbar;a.scrollButtons.enable=-1<d.inArray(a.theme,["minimal","minimal-dark"])?!1:a.scrollButtons.enable;a.autoHideScrollbar=-1<d.inArray(a.theme,["minimal","minimal-dark"])?!0:a.autoHideScrollbar;a.scrollbarPosition=
-1<d.inArray(a.theme,["minimal","minimal-dark"])?"outside":a.scrollbarPosition},_findAxis:function(a){return"yx"===a||"xy"===a||"auto"===a?"yx":"x"===a||"horizontal"===a?"x":"y"},_findScrollButtonsType:function(a){return"stepped"===a||"pixels"===a||"step"===a||"click"===a?"stepped":"stepless"},_pluginMarkup:function(){var a=d(this),c=a.data("mCS"),b=c.opt,f=b.autoExpandScrollbar?" mCSB_scrollTools_onDrag_expand":"",f=["<div id='mCSB_"+c.idx+"_scrollbar_vertical' class='mCSB_scrollTools mCSB_"+c.idx+
"_scrollbar mCS-"+b.theme+" mCSB_scrollTools_vertical"+f+"'><div class='mCSB_draggerContainer'><div id='mCSB_"+c.idx+"_dragger_vertical' class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>","<div id='mCSB_"+c.idx+"_scrollbar_horizontal' class='mCSB_scrollTools mCSB_"+c.idx+"_scrollbar mCS-"+b.theme+" mCSB_scrollTools_horizontal"+f+"'><div class='mCSB_draggerContainer'><div id='mCSB_"+c.idx+
"_dragger_horizontal' class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>"],g="yx"===b.axis?"mCSB_vertical_horizontal":"x"===b.axis?"mCSB_horizontal":"mCSB_vertical",f="yx"===b.axis?f[0]+f[1]:"x"===b.axis?f[1]:f[0],e="yx"===b.axis?"<div id='mCSB_"+c.idx+"_container_wrapper' class='mCSB_container_wrapper' />":"",k=b.autoHideScrollbar?" mCS-autoHide":"",m="x"!==b.axis&&"rtl"===c.langDir?" mCS-dir-rtl":
"";b.setWidth&&a.css("width",b.setWidth);b.setHeight&&a.css("height",b.setHeight);b.setLeft="y"!==b.axis&&"rtl"===c.langDir?"989999px":b.setLeft;a.addClass("mCustomScrollbar _mCS_"+c.idx+k+m).wrapInner("<div id='mCSB_"+c.idx+"' class='mCustomScrollBox mCS-"+b.theme+" "+g+"'><div id='mCSB_"+c.idx+"_container' class='mCSB_container' style='position:relative; top:"+b.setTop+"; left:"+b.setLeft+";' dir="+c.langDir+" /></div>");g=d("#mCSB_"+c.idx);k=d("#mCSB_"+c.idx+"_container");"y"===b.axis||b.advanced.autoExpandHorizontalScroll||
k.css("width",h._contentWidth(k.children()));"outside"===b.scrollbarPosition?("static"===a.css("position")&&a.css("position","relative"),a.css("overflow","visible"),g.addClass("mCSB_outside").after(f)):(g.addClass("mCSB_inside").append(f),k.wrap(e));h._scrollButtons.call(this);a=[d("#mCSB_"+c.idx+"_dragger_vertical"),d("#mCSB_"+c.idx+"_dragger_horizontal")];a[0].css("min-height",a[0].height());a[1].css("min-width",a[1].width())},_contentWidth:function(a){return Math.max.apply(Math,a.map(function(){return d(this).outerWidth(!0)}).get())},
_expandContentHorizontally:function(){var a=d(this).data("mCS"),c=a.opt,a=d("#mCSB_"+a.idx+"_container");c.advanced.autoExpandHorizontalScroll&&"y"!==c.axis&&a.css({position:"absolute",width:"auto"}).wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />").css({width:Math.ceil(a[0].getBoundingClientRect().right+.4)-Math.floor(a[0].getBoundingClientRect().left),position:"relative"}).unwrap()},_scrollButtons:function(){var a=d(this).data("mCS"),c=a.opt,a=d(".mCSB_"+
a.idx+"_scrollbar:first"),b=["<a href='#' class='mCSB_buttonUp' oncontextmenu='return false;' />","<a href='#' class='mCSB_buttonDown' oncontextmenu='return false;' />","<a href='#' class='mCSB_buttonLeft' oncontextmenu='return false;' />","<a href='#' class='mCSB_buttonRight' oncontextmenu='return false;' />"],b=["x"===c.axis?b[2]:b[0],"x"===c.axis?b[3]:b[1],b[2],b[3]];c.scrollButtons.enable&&a.prepend(b[0]).append(b[1]).next(".mCSB_scrollTools").prepend(b[2]).append(b[3])},_maxHeight:function(){var a=
d(this),c=a.data("mCS"),c=d("#mCSB_"+c.idx),b=a.css("max-height"),f=-1!==b.indexOf("%"),g=a.css("box-sizing");"none"!==b&&(b=f?a.parent().height()*parseInt(b)/100:parseInt(b),"border-box"===g&&(b-=a.innerHeight()-a.height()+(a.outerHeight()-a.innerHeight())),c.css("max-height",Math.round(b)))},_setDraggerLength:function(){var a=d(this).data("mCS"),c=d("#mCSB_"+a.idx),b=d("#mCSB_"+a.idx+"_container"),a=[d("#mCSB_"+a.idx+"_dragger_vertical"),d("#mCSB_"+a.idx+"_dragger_horizontal")],c=[c.height()/b.outerHeight(!1),
c.width()/b.outerWidth(!1)],c=[parseInt(a[0].css("min-height")),Math.round(c[0]*a[0].parent().height()),parseInt(a[1].css("min-width")),Math.round(c[1]*a[1].parent().width())],b=H&&c[3]<c[2]?c[2]:c[3];a[0].css({height:H&&c[1]<c[0]?c[0]:c[1],"max-height":a[0].parent().height()-10}).find(".mCSB_dragger_bar").css({"line-height":c[0]+"px"});a[1].css({width:b,"max-width":a[1].parent().width()-10})},_scrollRatio:function(){var a=d(this).data("mCS"),c=d("#mCSB_"+a.idx),b=d("#mCSB_"+a.idx+"_container"),f=
[d("#mCSB_"+a.idx+"_dragger_vertical"),d("#mCSB_"+a.idx+"_dragger_horizontal")],c=[b.outerHeight(!1)-c.height(),b.outerWidth(!1)-c.width()],f=[c[0]/(f[0].parent().height()-f[0].height()),c[1]/(f[1].parent().width()-f[1].width())];a.scrollRatio={y:f[0],x:f[1]}},_onDragClasses:function(a,c,b){b=b?"mCSB_dragger_onDrag_expanded":"";var d=["mCSB_dragger_onDrag","mCSB_scrollTools_onDrag"],g=a.closest(".mCSB_scrollTools");"active"===c?(a.toggleClass(d[0]+" "+b),g.toggleClass(d[1]),a[0]._draggable=a[0]._draggable?
0:1):a[0]._draggable||("hide"===c?(a.removeClass(d[0]),g.removeClass(d[1])):(a.addClass(d[0]),g.addClass(d[1])))},_overflowed:function(){var a=d(this).data("mCS"),c=d("#mCSB_"+a.idx),b=d("#mCSB_"+a.idx+"_container"),f=null==a.overflowed?b.height():b.outerHeight(!1),a=null==a.overflowed?b.width():b.outerWidth(!1);return[f>c.height(),a>c.width()]},_resetContentPosition:function(){var a=d(this),c=a.data("mCS"),b=c.opt,f=d("#mCSB_"+c.idx),g=d("#mCSB_"+c.idx+"_container"),e=[d("#mCSB_"+c.idx+"_dragger_vertical"),
d("#mCSB_"+c.idx+"_dragger_horizontal")];h._stop(a);if("x"!==b.axis&&!c.overflowed[0]||"y"===b.axis&&c.overflowed[0])e[0].add(g).css("top",0),h._scrollTo(a,"_resetY");if("y"!==b.axis&&!c.overflowed[1]||"x"===b.axis&&c.overflowed[1])b=dx=0,"rtl"===c.langDir&&(b=f.width()-g.outerWidth(!1),dx=Math.abs(b/c.scrollRatio.x)),g.css("left",b),e[1].css("left",dx),h._scrollTo(a,"_resetX")},_bindEvents:function(){var a=d(this),c=a.data("mCS"),b=c.opt;if(!c.bindEvents){h._draggable.call(this);b.contentTouchScroll&&
h._contentDraggable.call(this);if(b.mouseWheel.enable){var f=function(){g=setTimeout(function(){d.event.special.mousewheel?(clearTimeout(g),h._mousewheel.call(a[0])):f()},1E3)},g;f()}h._draggerRail.call(this);h._wrapperScroll.call(this);b.advanced.autoScrollOnFocus&&h._focus.call(this);b.scrollButtons.enable&&h._buttons.call(this);b.keyboard.enable&&h._keyboard.call(this);c.bindEvents=!0}},_unbindEvents:function(){var a=d(this),c=a.data("mCS"),b=c.opt,f="mCS_"+c.idx,g=".mCSB_"+c.idx+"_scrollbar",
g=d("#mCSB_"+c.idx+",#mCSB_"+c.idx+"_container,#mCSB_"+c.idx+"_container_wrapper,"+g+" .mCSB_draggerContainer,#mCSB_"+c.idx+"_dragger_vertical,#mCSB_"+c.idx+"_dragger_horizontal,"+g+">a"),e=d("#mCSB_"+c.idx+"_container");b.advanced.releaseDraggableSelectors&&g.add(d(b.advanced.releaseDraggableSelectors));c.bindEvents&&(d(D).unbind("."+f),g.each(function(){d(this).unbind("."+f)}),clearTimeout(a[0]._focusTimeout),h._delete.call(null,a[0]._focusTimeout),clearTimeout(c.sequential.step),h._delete.call(null,
c.sequential.step),clearTimeout(e[0].onCompleteTimeout),h._delete.call(null,e[0].onCompleteTimeout),c.bindEvents=!1)},_scrollbarVisibility:function(a){var c=d(this),b=c.data("mCS"),f=b.opt,g=d("#mCSB_"+b.idx+"_container_wrapper"),g=g.length?g:d("#mCSB_"+b.idx+"_container"),e=[d("#mCSB_"+b.idx+"_scrollbar_vertical"),d("#mCSB_"+b.idx+"_scrollbar_horizontal")],h=[e[0].find(".mCSB_dragger"),e[1].find(".mCSB_dragger")];"x"!==f.axis&&(b.overflowed[0]&&!a?(e[0].add(h[0]).add(e[0].children("a")).css("display",
"block"),g.removeClass("mCS_no_scrollbar_y mCS_y_hidden")):(f.alwaysShowScrollbar?(2!==f.alwaysShowScrollbar&&h[0].add(e[0].children("a")).css("display","none"),g.removeClass("mCS_y_hidden")):(e[0].css("display","none"),g.addClass("mCS_y_hidden")),g.addClass("mCS_no_scrollbar_y")));"y"!==f.axis&&(b.overflowed[1]&&!a?(e[1].add(h[1]).add(e[1].children("a")).css("display","block"),g.removeClass("mCS_no_scrollbar_x mCS_x_hidden")):(f.alwaysShowScrollbar?(2!==f.alwaysShowScrollbar&&h[1].add(e[1].children("a")).css("display",
"none"),g.removeClass("mCS_x_hidden")):(e[1].css("display","none"),g.addClass("mCS_x_hidden")),g.addClass("mCS_no_scrollbar_x")));b.overflowed[0]||b.overflowed[1]?c.removeClass("mCS_no_scrollbar"):c.addClass("mCS_no_scrollbar")},_coordinates:function(a){switch(a.type){case "pointerdown":case "MSPointerDown":case "pointermove":case "MSPointerMove":case "pointerup":case "MSPointerUp":return[a.originalEvent.pageY,a.originalEvent.pageX,!1];case "touchstart":case "touchmove":case "touchend":var c=a.originalEvent.touches[0]||
a.originalEvent.changedTouches[0];return[c.pageY,c.pageX,1<(a.originalEvent.touches.length||a.originalEvent.changedTouches.length)];default:return[a.pageY,a.pageX,!1]}},_draggable:function(){function a(a){var b=m.find("iframe");b.length&&b.css("pointer-events",a?"auto":"none")}function c(a,c,d,e){m[0].idleTimer=233>g.scrollInertia?250:0;if(n.attr("id")===k[1]){var p="x";a=(n[0].offsetLeft-c+e)*f.scrollRatio.x}else p="y",a=(n[0].offsetTop-a+d)*f.scrollRatio.y;h._scrollTo(b,a.toString(),{dir:p,drag:!0})}
var b=d(this),f=b.data("mCS"),g=f.opt,e="mCS_"+f.idx,k=["mCSB_"+f.idx+"_dragger_vertical","mCSB_"+f.idx+"_dragger_horizontal"],m=d("#mCSB_"+f.idx+"_container"),p=d("#"+k[0]+",#"+k[1]),n,l,z,B=g.advanced.releaseDraggableSelectors?p.add(d(g.advanced.releaseDraggableSelectors)):p;p.bind("mousedown."+e+" touchstart."+e+" pointerdown."+e+" MSPointerDown."+e,function(f){f.stopImmediatePropagation();f.preventDefault();if(h._mouseBtnLeft(f)){C=!0;H&&(D.onselectstart=function(){return!1});a(!1);h._stop(b);
n=d(this);var k=n.offset(),p=h._coordinates(f)[0]-k.top;f=h._coordinates(f)[1]-k.left;var m=n.height()+k.top,k=n.width()+k.left;p<m&&0<p&&f<k&&0<f&&(l=p,z=f);h._onDragClasses(n,"active",g.autoExpandScrollbar);d(D).bind("mousemove."+e+" pointermove."+e+" MSPointerMove."+e,function(a){if(n){var b=n.offset(),d=h._coordinates(a)[0]-b.top;a=h._coordinates(a)[1]-b.left;l!==d&&c(l,z,d,a)}}).add(B).bind("mouseup."+e+" touchend."+e+" pointerup."+e+" MSPointerUp."+e,function(b){n&&(h._onDragClasses(n,"active",
g.autoExpandScrollbar),n=null);C=!1;H&&(D.onselectstart=null);a(!0)})}}).bind("touchmove."+e,function(a){a.stopImmediatePropagation();a.preventDefault();var b=n.offset(),d=h._coordinates(a)[0]-b.top;a=h._coordinates(a)[1]-b.left;c(l,z,d,a)}).bind("mousemove."+e,function(a){if(n){var b=n.offset(),d=h._coordinates(a)[0]-b.top;a=h._coordinates(a)[1]-b.left;l!==d&&c(l,z,d,a)}});d(D).bind("mousemove."+e+" pointermove."+e+" MSPointerMove."+e,function(a){if(n){var b=n.offset(),d=h._coordinates(a)[0]-b.top;
a=h._coordinates(a)[1]-b.left;l!==d&&c(l,z,d,a)}}).add(B).bind("mouseup."+e+" touchend."+e+" pointerup."+e+" MSPointerUp."+e,function(b){n&&(h._onDragClasses(n,"active",g.autoExpandScrollbar),n=null);C=!1;H&&(D.onselectstart=null);a(!0)})},_contentDraggable:function(){function a(a,b){var c=[1.5*b,2*b,b/1.5,b/2];return 90<a?4<b?c[0]:c[3]:60<a?3<b?c[3]:c[2]:30<a?8<b?c[1]:6<b?c[0]:4<b?b:c[2]:8<b?b:c[3]}function c(a,c,d,f,e,g){a&&h._scrollTo(b,a.toString(),{dur:c,scrollEasing:d,dir:f,overwrite:e,drag:g})}
var b=d(this),f=b.data("mCS"),g=f.opt,e="mCS_"+f.idx,k=d("#mCSB_"+f.idx),m=d("#mCSB_"+f.idx+"_container"),p=[d("#mCSB_"+f.idx+"_dragger_vertical"),d("#mCSB_"+f.idx+"_dragger_horizontal")],n,l,z,B,t=[],v=[],q,x,w,y,r,A,E,L="yx"===g.axis?"none":"all",G=[];m.bind("touchstart."+e+" pointerdown."+e+" MSPointerDown."+e,function(a){if(h._pointerTouch(a)&&!C&&!h._coordinates(a)[2]){var b=m.offset();n=h._coordinates(a)[0]-b.top;l=h._coordinates(a)[1]-b.left;G=[h._coordinates(a)[0],h._coordinates(a)[1]]}}).bind("touchmove."+
e+" pointermove."+e+" MSPointerMove."+e,function(a){if(h._pointerTouch(a)&&!C&&!h._coordinates(a)[2]){a.stopImmediatePropagation();x=h._getTime();var b=k.offset(),d=h._coordinates(a)[0]-b.top,b=h._coordinates(a)[1]-b.left;t.push(d);v.push(b);G[2]=Math.abs(h._coordinates(a)[0]-G[0]);G[3]=Math.abs(h._coordinates(a)[1]-G[1]);if(f.overflowed[0])var e=p[0].parent().height()-p[0].height(),e=0<n-d&&d-n>-(e*f.scrollRatio.y)&&(2*G[3]<G[2]||"yx"===g.axis);if(f.overflowed[1])var E=p[1].parent().width()-p[1].width(),
E=0<l-b&&b-l>-(E*f.scrollRatio.x)&&(2*G[2]<G[3]||"yx"===g.axis);(e||E)&&a.preventDefault();A="yx"===g.axis?[n-d,l-b]:"x"===g.axis?[null,l-b]:[n-d,null];m[0].idleTimer=250;f.overflowed[0]&&c(A[0],0,"mcsLinearOut","y","all",!0);f.overflowed[1]&&c(A[1],0,"mcsLinearOut","x",L,!0)}});k.bind("touchstart."+e+" pointerdown."+e+" MSPointerDown."+e,function(a){if(h._pointerTouch(a)&&!C&&!h._coordinates(a)[2]){a.stopImmediatePropagation();h._stop(b);q=h._getTime();var c=k.offset();z=h._coordinates(a)[0]-c.top;
B=h._coordinates(a)[1]-c.left;t=[];v=[]}}).bind("touchend."+e+" pointerup."+e+" MSPointerUp."+e,function(b){if(h._pointerTouch(b)&&!C&&!h._coordinates(b)[2]){b.stopImmediatePropagation();w=h._getTime();var d=k.offset(),e=h._coordinates(b)[0]-d.top,d=h._coordinates(b)[1]-d.left;if(!(30<w-x)){r=1E3/(w-q);var n=(b=2.5>r)?[t[t.length-2],v[v.length-2]]:[0,0];y=b?[e-n[0],d-n[1]]:[e-z,d-B];e=[Math.abs(y[0]),Math.abs(y[1])];r=b?[Math.abs(y[0]/4),Math.abs(y[1]/4)]:[r,r];b=[Math.abs(m[0].offsetTop)-y[0]*a(e[0]/
r[0],r[0]),Math.abs(m[0].offsetLeft)-y[1]*a(e[1]/r[1],r[1])];A="yx"===g.axis?[b[0],b[1]]:"x"===g.axis?[null,b[1]]:[b[0],null];E=[4*e[0]+g.scrollInertia,4*e[1]+g.scrollInertia];b=parseInt(g.contentTouchScroll)||0;A[0]=e[0]>b?A[0]:0;A[1]=e[1]>b?A[1]:0;f.overflowed[0]&&c(A[0],E[0],"mcsEaseOut","y",L,!1);f.overflowed[1]&&c(A[1],E[1],"mcsEaseOut","x",L,!1)}}})},_mousewheel:function(){var a=d(this),c=a.data("mCS");if(c){var b=c.opt,f="mCS_"+c.idx,g=d("#mCSB_"+c.idx),e=[d("#mCSB_"+c.idx+"_dragger_vertical"),
d("#mCSB_"+c.idx+"_dragger_horizontal")],k=d("#mCSB_"+c.idx+"_container").find("iframe"),m=g;k.length&&k.each(function(){var a=null;try{a=(this.contentDocument||this.contentWindow.document).body.innerHTML}catch(b){}null!==a&&(m=m.add(d(this).contents().find("body")))});m.bind("mousewheel."+f,function(f,k){h._stop(a);if(!h._disableMousewheel(a,f.target)){var l="auto"!==b.mouseWheel.deltaFactor?parseInt(b.mouseWheel.deltaFactor):H&&100>f.deltaFactor?100:f.deltaFactor||100;if("x"===b.axis||"x"===b.mouseWheel.axis)var m=
"x",l=[Math.round(l*c.scrollRatio.x),parseInt(b.mouseWheel.scrollAmount)],l="auto"!==b.mouseWheel.scrollAmount?l[1]:l[0]>=g.width()?.9*g.width():l[0],B=Math.abs(d("#mCSB_"+c.idx+"_container")[0].offsetLeft),t=e[1][0].offsetLeft,v=e[1].parent().width()-e[1].width(),q=f.deltaX||f.deltaY||k;else m="y",l=[Math.round(l*c.scrollRatio.y),parseInt(b.mouseWheel.scrollAmount)],l="auto"!==b.mouseWheel.scrollAmount?l[1]:l[0]>=g.height()?.9*g.height():l[0],B=Math.abs(d("#mCSB_"+c.idx+"_container")[0].offsetTop),
t=e[0][0].offsetTop,v=e[0].parent().height()-e[0].height(),q=f.deltaY||k;if(("y"!==m||c.overflowed[0])&&("x"!==m||c.overflowed[1])){b.mouseWheel.invert&&(q=-q);b.mouseWheel.normalizeDelta&&(q=0>q?-1:1);if(0<q&&0!==t||0>q&&t!==v||b.mouseWheel.preventDefault)f.stopImmediatePropagation(),f.preventDefault();h._scrollTo(a,(B-q*l).toString(),{dir:m})}}})}},_disableMousewheel:function(a,c){var b=c.nodeName.toLowerCase(),f=a.data("mCS").opt.mouseWheel.disableOver,h=["select","textarea"];return-1<d.inArray(b,
f)&&!(-1<d.inArray(b,h)&&!d(c).is(":focus"))},_draggerRail:function(){var a=d(this),c=a.data("mCS"),b="mCS_"+c.idx,f=d("#mCSB_"+c.idx+"_container"),g=f.parent();d(".mCSB_"+c.idx+"_scrollbar .mCSB_draggerContainer").bind("touchstart."+b+" pointerdown."+b+" MSPointerDown."+b,function(a){C=!0}).bind("touchend."+b+" pointerup."+b+" MSPointerUp."+b,function(a){C=!1}).bind("click."+b,function(b){if(d(b.target).hasClass("mCSB_draggerContainer")||d(b.target).hasClass("mCSB_draggerRail")){h._stop(a);var k=
d(this),m=k.find(".mCSB_dragger");if(0<k.parent(".mCSB_scrollTools_horizontal").length){if(!c.overflowed[1])return;k="x";b=b.pageX>m.offset().left?-1:1;b=Math.abs(f[0].offsetLeft)-.9*b*g.width()}else{if(!c.overflowed[0])return;k="y";b=b.pageY>m.offset().top?-1:1;b=Math.abs(f[0].offsetTop)-.9*b*g.height()}h._scrollTo(a,b.toString(),{dir:k,scrollEasing:"mcsEaseInOut"})}})},_focus:function(){var a=d(this),c=a.data("mCS"),b=c.opt,f="mCS_"+c.idx,g=d("#mCSB_"+c.idx+"_container"),e=g.parent();g.bind("focusin."+
f,function(c){var f=d(D.activeElement);c=g.find(".mCustomScrollBox").length;f.is(b.advanced.autoScrollOnFocus)&&(h._stop(a),clearTimeout(a[0]._focusTimeout),a[0]._focusTimer=c?17*c:0,a[0]._focusTimeout=setTimeout(function(){var c=[f.offset().top-g.offset().top,f.offset().left-g.offset().left],d=[g[0].offsetTop,g[0].offsetLeft],d=[0<=d[0]+c[0]&&d[0]+c[0]<e.height()-f.outerHeight(!1),0<=d[1]+c[1]&&d[0]+c[1]<e.width()-f.outerWidth(!1)],k="yx"!==b.axis||d[0]||d[1]?"all":"none";"x"===b.axis||d[0]||h._scrollTo(a,
c[0].toString(),{dir:"y",scrollEasing:"mcsEaseInOut",overwrite:k,dur:0});"y"===b.axis||d[1]||h._scrollTo(a,c[1].toString(),{dir:"x",scrollEasing:"mcsEaseInOut",overwrite:k,dur:0})},a[0]._focusTimer))})},_wrapperScroll:function(){var a=d(this).data("mCS"),c="mCS_"+a.idx,b=d("#mCSB_"+a.idx+"_container").parent();b.bind("scroll."+c,function(c){0===b.scrollTop()&&0===b.scrollLeft()||d(".mCSB_"+a.idx+"_scrollbar").css("visibility","hidden")})},_buttons:function(){var a=d(this),c=a.data("mCS"),b=c.opt,
f=c.sequential,g="mCS_"+c.idx;d("#mCSB_"+c.idx+"_container");d(".mCSB_"+c.idx+"_scrollbar>a").bind("mousedown."+g+" touchstart."+g+" pointerdown."+g+" MSPointerDown."+g+" mouseup."+g+" touchend."+g+" pointerup."+g+" MSPointerUp."+g+" mouseout."+g+" pointerout."+g+" MSPointerOut."+g+" click."+g,function(e){function g(c,d){f.scrollAmount=b.snapAmount||b.scrollButtons.scrollAmount;h._sequentialScroll.call(this,a,c,d)}e.preventDefault();if(h._mouseBtnLeft(e)){var m=d(this).attr("class");f.type=b.scrollButtons.scrollType;
switch(e.type){case "mousedown":case "touchstart":case "pointerdown":case "MSPointerDown":if("stepped"===f.type)break;C=!0;c.tweenRunning=!1;g("on",m);break;case "mouseup":case "touchend":case "pointerup":case "MSPointerUp":case "mouseout":case "pointerout":case "MSPointerOut":if("stepped"===f.type)break;C=!1;f.dir&&g("off",m);break;case "click":if("stepped"!==f.type||c.tweenRunning)break;g("on",m)}}})},_keyboard:function(){var a=d(this),c=a.data("mCS"),b=c.opt,f=c.sequential,g="mCS_"+c.idx,e=d("#mCSB_"+
c.idx),k=d("#mCSB_"+c.idx+"_container"),m=k.parent();e.attr("tabindex","0").bind("blur."+g+" keydown."+g+" keyup."+g,function(e){function g(d,e){f.type=b.keyboard.scrollType;f.scrollAmount=b.snapAmount||b.keyboard.scrollAmount;"stepped"===f.type&&c.tweenRunning||h._sequentialScroll.call(this,a,d,e)}switch(e.type){case "blur":c.tweenRunning&&f.dir&&g("off",null);break;case "keydown":case "keyup":var l=e.keyCode?e.keyCode:e.which,z="on";if("x"!==b.axis&&(38===l||40===l)||"y"!==b.axis&&(37===l||39===
l)){if((38===l||40===l)&&!c.overflowed[0]||(37===l||39===l)&&!c.overflowed[1])break;"keyup"===e.type&&(z="off");d(D.activeElement).is("input,textarea,select,datalist,keygen,[contenteditable='true']")||(e.preventDefault(),e.stopImmediatePropagation(),g(z,l))}else if(33===l||34===l){if(c.overflowed[0]||c.overflowed[1])e.preventDefault(),e.stopImmediatePropagation();"keyup"===e.type&&(h._stop(a),l=34===l?-1:1,"x"===b.axis||"yx"===b.axis&&c.overflowed[1]&&!c.overflowed[0]?(e="x",l=Math.abs(k[0].offsetLeft)-
.9*l*m.width()):(e="y",l=Math.abs(k[0].offsetTop)-.9*l*m.height()),h._scrollTo(a,l.toString(),{dir:e,scrollEasing:"mcsEaseInOut"}))}else if((35===l||36===l)&&!d(D.activeElement).is("input,textarea,select,datalist,keygen,[contenteditable='true']")){if(c.overflowed[0]||c.overflowed[1])e.preventDefault(),e.stopImmediatePropagation();"keyup"===e.type&&("x"===b.axis||"yx"===b.axis&&c.overflowed[1]&&!c.overflowed[0]?(e="x",l=35===l?Math.abs(m.width()-k.outerWidth(!1)):0):(e="y",l=35===l?Math.abs(m.height()-
k.outerHeight(!1)):0),h._scrollTo(a,l.toString(),{dir:e,scrollEasing:"mcsEaseInOut"}))}}})},_sequentialScroll:function(a,c,b){function f(b){var c="stepped"!==k.type,d=b?c?e.scrollInertia/1.5:e.scrollInertia:1E3/60,p=b?c?7.5:40:2.5,t=[Math.abs(m[0].offsetTop),Math.abs(m[0].offsetLeft)],v=[10<g.scrollRatio.y?10:g.scrollRatio.y,10<g.scrollRatio.x?10:g.scrollRatio.x],p="x"===k.dir[0]?t[1]+k.dir[1]*v[1]*p:t[0]+k.dir[1]*v[0]*p,v="x"===k.dir[0]?t[1]+k.dir[1]*parseInt(k.scrollAmount):t[0]+k.dir[1]*parseInt(k.scrollAmount),
p="auto"!==k.scrollAmount?v:p;b&&17>d&&(p="x"===k.dir[0]?t[1]:t[0]);h._scrollTo(a,p.toString(),{dir:k.dir[0],scrollEasing:b?c?"mcsLinearOut":"mcsEaseInOut":"mcsLinear",dur:d,onComplete:b?!0:!1});b?k.dir=!1:(clearTimeout(k.step),k.step=setTimeout(function(){f()},d))}var g=a.data("mCS"),e=g.opt,k=g.sequential,m=d("#mCSB_"+g.idx+"_container"),p="stepped"===k.type?!0:!1;switch(c){case "on":k.dir=["mCSB_buttonRight"===b||"mCSB_buttonLeft"===b||39===b||37===b?"x":"y","mCSB_buttonUp"===b||"mCSB_buttonLeft"===
b||38===b||37===b?-1:1];h._stop(a);if(h._isNumeric(b)&&"stepped"===k.type)break;f(p);break;case "off":clearTimeout(k.step),h._stop(a),(p||g.tweenRunning&&k.dir)&&f(!0)}},_arr:function(a){var c=d(this).data("mCS").opt,b=[];"function"===typeof a&&(a=a());a instanceof Array?b=1<a.length?[a[0],a[1]]:"x"===c.axis?[null,a[0]]:[a[0],null]:(b[0]=a.y?a.y:a.x||"x"===c.axis?null:a,b[1]=a.x?a.x:a.y||"y"===c.axis?null:a);"function"===typeof b[0]&&(b[0]=b[0]());"function"===typeof b[1]&&(b[1]=b[1]());return b},
_to:function(a,c){if(null!=a&&"undefined"!=typeof a){var b=d(this),f=b.data("mCS"),g=f.opt,f=d("#mCSB_"+f.idx+"_container"),e=f.parent(),k=typeof a;c||(c="x"===g.axis?"x":"y");var m="x"===c?f.outerWidth(!1):f.outerHeight(!1),g="x"===c?f.offset().left:f.offset().top,p="x"===c?f[0].offsetLeft:f[0].offsetTop,n="x"===c?"left":"top";switch(k){case "function":return a();case "object":if(a.nodeType)var l="x"===c?d(a).offset().left:d(a).offset().top;else if(a.jquery){if(!a.length)break;l="x"===c?a.offset().left:
a.offset().top}return l-g;case "string":case "number":if(h._isNumeric.call(null,a))return Math.abs(a);if(-1!==a.indexOf("%"))return Math.abs(m*parseInt(a)/100);if(-1!==a.indexOf("-="))return Math.abs(p-parseInt(a.split("-=")[1]));if(-1!==a.indexOf("+="))return b=p+parseInt(a.split("+=")[1]),0<=b?0:Math.abs(b);if(-1!==a.indexOf("px")&&h._isNumeric.call(null,a.split("px")[0]))return Math.abs(a.split("px")[0]);if("top"===a||"left"===a)return 0;if("bottom"===a)return Math.abs(e.height()-f.outerHeight(!1));
if("right"===a)return Math.abs(e.width()-f.outerWidth(!1));if("first"===a||"last"===a)return b=f.find(":"+a),l="x"===c?d(b).offset().left:d(b).offset().top,l-g;if(d(a).length)return l="x"===c?d(a).offset().left:d(a).offset().top,l-g;f.css(n,a);F.update.call(null,b[0])}}},_autoUpdate:function(a){function c(){clearTimeout(n[0].autoUpdate);n[0].autoUpdate=setTimeout(function(){if(p.advanced.updateOnSelectorChange&&(v=g(),v!==t)){e();t=v;return}p.advanced.updateOnContentResize&&(x=[n.outerHeight(!1),
n.outerWidth(!1),l.height(),l.width(),u()[0],u()[1]],x[0]!==q[0]||x[1]!==q[1]||x[2]!==q[2]||x[3]!==q[3]||x[4]!==q[4]||x[5]!==q[5])&&(e(),q=x);p.advanced.updateOnImageLoad&&(y=b(),y!==w&&(n.find("img").each(function(){f(this.src)}),w=y));(p.advanced.updateOnSelectorChange||p.advanced.updateOnContentResize||p.advanced.updateOnImageLoad)&&c()},60)}function b(){var a=0;p.advanced.updateOnImageLoad&&(a=n.find("img").length);return a}function f(a){var b=new Image;b.onload=function(a,b){return function(){return b.apply(a,
arguments)}}(b,function(){this.onload=null;e()});b.src=a}function g(){!0===p.advanced.updateOnSelectorChange&&(p.advanced.updateOnSelectorChange="*");var a=0,b=n.find(p.advanced.updateOnSelectorChange);p.advanced.updateOnSelectorChange&&0<b.length&&b.each(function(){a+=d(this).height()+d(this).width()});return a}function e(){clearTimeout(n[0].autoUpdate);F.update.call(null,k[0])}var k=d(this),m=k.data("mCS"),p=m.opt,n=d("#mCSB_"+m.idx+"_container");if(a)clearTimeout(n[0].autoUpdate),h._delete.call(null,
n[0].autoUpdate);else{var l=n.parent(),z=[d("#mCSB_"+m.idx+"_scrollbar_vertical"),d("#mCSB_"+m.idx+"_scrollbar_horizontal")],u=function(){return[z[0].is(":visible")?z[0].outerHeight(!0):0,z[1].is(":visible")?z[1].outerWidth(!0):0]},t=g(),v,q=[n.outerHeight(!1),n.outerWidth(!1),l.height(),l.width(),u()[0],u()[1]],x,w=b(),y;c()}},_snapAmount:function(a,c,b){return Math.round(a/c)*c-b},_stop:function(a){a=a.data("mCS");d("#mCSB_"+a.idx+"_container,#mCSB_"+a.idx+"_container_wrapper,#mCSB_"+a.idx+"_dragger_vertical,#mCSB_"+
a.idx+"_dragger_horizontal").each(function(){h._stopTween.call(this)})},_scrollTo:function(a,c,b){function f(a){return e&&k.callbacks[a]&&"function"===typeof k.callbacks[a]}function g(){var c=[n[0].offsetTop,n[0].offsetLeft],d=[t[0].offsetTop,t[0].offsetLeft],f=[n.outerHeight(!1),n.outerWidth(!1)],e=[p.height(),p.width()];a[0].mcs={content:n,top:c[0],left:c[1],draggerTop:d[0],draggerLeft:d[1],topPct:Math.round(100*Math.abs(c[0])/(Math.abs(f[0])-e[0])),leftPct:Math.round(100*Math.abs(c[1])/(Math.abs(f[1])-
e[1])),direction:b.dir}}var e=a.data("mCS"),k=e.opt;b=d.extend({trigger:"internal",dir:"y",scrollEasing:"mcsEaseOut",drag:!1,dur:k.scrollInertia,overwrite:"all",callbacks:!0,onStart:!0,onUpdate:!0,onComplete:!0},b);var m=[b.dur,b.drag?0:b.dur],p=d("#mCSB_"+e.idx),n=d("#mCSB_"+e.idx+"_container"),l=n.parent(),u=k.callbacks.onTotalScrollOffset?h._arr.call(a,k.callbacks.onTotalScrollOffset):[0,0],B=k.callbacks.onTotalScrollBackOffset?h._arr.call(a,k.callbacks.onTotalScrollBackOffset):[0,0];e.trigger=
b.trigger;if(0!==l.scrollTop()||0!==l.scrollLeft())d(".mCSB_"+e.idx+"_scrollbar").css("visibility","visible"),l.scrollTop(0).scrollLeft(0);"_resetY"!==c||e.contentReset.y||(f("onOverflowYNone")&&k.callbacks.onOverflowYNone.call(a[0]),e.contentReset.y=1);"_resetX"!==c||e.contentReset.x||(f("onOverflowXNone")&&k.callbacks.onOverflowXNone.call(a[0]),e.contentReset.x=1);if("_resetY"!==c&&"_resetX"!==c){!e.contentReset.y&&a[0].mcs||!e.overflowed[0]||(f("onOverflowY")&&k.callbacks.onOverflowY.call(a[0]),
e.contentReset.x=null);!e.contentReset.x&&a[0].mcs||!e.overflowed[1]||(f("onOverflowX")&&k.callbacks.onOverflowX.call(a[0]),e.contentReset.x=null);k.snapAmount&&(c=h._snapAmount(c,k.snapAmount,k.snapOffset));switch(b.dir){case "x":var t=d("#mCSB_"+e.idx+"_dragger_horizontal"),v="left",q=n[0].offsetLeft,x=[p.width()-n.outerWidth(!1),t.parent().width()-t.width()],w=[c,0===c?0:c/e.scrollRatio.x],y=u[1],r=B[1],A=0<y?y/e.scrollRatio.x:0,E=0<r?r/e.scrollRatio.x:0;break;case "y":t=d("#mCSB_"+e.idx+"_dragger_vertical"),
v="top",q=n[0].offsetTop,x=[p.height()-n.outerHeight(!1),t.parent().height()-t.height()],w=[c,0===c?0:c/e.scrollRatio.y],y=u[0],r=B[0],A=0<y?y/e.scrollRatio.y:0,E=0<r?r/e.scrollRatio.y:0}0>w[1]||0===w[0]&&0===w[1]?w=[0,0]:w[1]>=x[1]?w=[x[0],x[1]]:w[0]=-w[0];a[0].mcs||(g(),f("onInit")&&k.callbacks.onInit.call(a[0]));clearTimeout(n[0].onCompleteTimeout);if(e.tweenRunning||!(0===q&&0<=w[0]||q===x[0]&&w[0]<=x[0]))h._tweenTo.call(null,t[0],v,Math.round(w[1]),m[1],b.scrollEasing),h._tweenTo.call(null,n[0],
v,Math.round(w[0]),m[0],b.scrollEasing,b.overwrite,{onStart:function(){b.callbacks&&b.onStart&&!e.tweenRunning&&(f("onScrollStart")&&(g(),k.callbacks.onScrollStart.call(a[0])),e.tweenRunning=!0,h._onDragClasses(t),e.cbOffsets=[k.callbacks.alwaysTriggerOffsets||q>=x[0]+y,k.callbacks.alwaysTriggerOffsets||q<=-r])},onUpdate:function(){b.callbacks&&b.onUpdate&&f("whileScrolling")&&(g(),k.callbacks.whileScrolling.call(a[0]))},onComplete:function(){b.callbacks&&b.onComplete&&("yx"===k.axis&&clearTimeout(n[0].onCompleteTimeout),
n[0].onCompleteTimeout=setTimeout(function(){f("onScroll")&&(g(),k.callbacks.onScroll.call(a[0]));f("onTotalScroll")&&w[1]>=x[1]-A&&e.cbOffsets[0]&&(g(),k.callbacks.onTotalScroll.call(a[0]));f("onTotalScrollBack")&&w[1]<=E&&e.cbOffsets[1]&&(g(),k.callbacks.onTotalScrollBack.call(a[0]));e.tweenRunning=!1;n[0].idleTimer=0;h._onDragClasses(t,"hide")},n[0].idleTimer||0))}})}},_tweenTo:function(a,c,b,d,g,e,k){function m(){r.stop||(q||l.call(),q=h._getTime()-t,p(),q>=r.time&&(r.time=q>r.time?q+v-(q-r.time):
q+v-1,r.time<q+1&&(r.time=q+1)),r.time<d?r.id=y(m):B.call())}function p(){0<d?(r.currVal=n(r.time,x,A,d,g),w[c]=Math.round(r.currVal)+"px"):w[c]=b+"px";z.call()}function n(a,b,c,d,e){switch(e){case "linear":case "mcsLinear":return c*a/d+b;case "mcsLinearOut":return a/=d,a--,c*Math.sqrt(1-a*a)+b;case "easeInOutSmooth":a/=d/2;if(1>a)return c/2*a*a+b;a--;return-c/2*(a*(a-2)-1)+b;case "easeInOutStrong":a/=d/2;if(1>a)return c/2*Math.pow(2,10*(a-1))+b;a--;return c/2*(-Math.pow(2,-10*a)+2)+b;case "easeInOut":case "mcsEaseInOut":a/=
d/2;if(1>a)return c/2*a*a*a+b;a-=2;return c/2*(a*a*a+2)+b;case "easeOutSmooth":return a/=d,a--,-c*(a*a*a*a-1)+b;case "easeOutStrong":return c*(-Math.pow(2,-10*a/d)+1)+b;default:return d=(a/=d)*a,e=d*a,b+c*(.499999999999997*e*d+-2.5*d*d+5.5*e+-6.5*d+4*a)}}a._malihuTween||(a._malihuTween={top:{},left:{}});k=k||{};var l=k.onStart||function(){},z=k.onUpdate||function(){},B=k.onComplete||function(){},t=h._getTime(),v,q=0,x=a.offsetTop,w=a.style,y,r=a._malihuTween[c];"left"===c&&(x=a.offsetLeft);var A=
b-x;r.stop=0;"none"!==e&&null!=r.id&&(u.requestAnimationFrame?u.cancelAnimationFrame(r.id):clearTimeout(r.id),r.id=null);(function(){v=1E3/60;r.time=q+v;y=u.requestAnimationFrame?u.requestAnimationFrame:function(a){p();return setTimeout(a,.01)};r.id=y(m)})()},_getTime:function(){return u.performance&&u.performance.now?u.performance.now():u.performance&&u.performance.webkitNow?u.performance.webkitNow():Date.now?Date.now():(new Date).getTime()},_stopTween:function(){this._malihuTween||(this._malihuTween=
{top:{},left:{}});this._malihuTween.top.id&&(u.requestAnimationFrame?u.cancelAnimationFrame(this._malihuTween.top.id):clearTimeout(this._malihuTween.top.id),this._malihuTween.top.id=null,this._malihuTween.top.stop=1);this._malihuTween.left.id&&(u.requestAnimationFrame?u.cancelAnimationFrame(this._malihuTween.left.id):clearTimeout(this._malihuTween.left.id),this._malihuTween.left.id=null,this._malihuTween.left.stop=1)},_delete:function(a){delete a},_mouseBtnLeft:function(a){return!(a.which&&1!==a.which)},
_pointerTouch:function(a){a=a.originalEvent.pointerType;return!(a&&"touch"!==a&&2!==a)},_isNumeric:function(a){return!isNaN(parseFloat(a))&&isFinite(a)}};d.fn.mCustomScrollbar=function(a){if(F[a])return F[a].apply(this,Array.prototype.slice.call(arguments,1));if("object"!==typeof a&&a)d.error("Method "+a+" does not exist");else return F.init.apply(this,arguments)};d.mCustomScrollbar=function(a){if(F[a])return F[a].apply(this,Array.prototype.slice.call(arguments,1));if("object"!==typeof a&&a)d.error("Method "+
a+" does not exist");else return F.init.apply(this,arguments)};d.mCustomScrollbar.defaults=M;u.mCustomScrollbar=!0;d(u).load(function(){d(".mCustomScrollbar").mCustomScrollbar()})})})(jQuery,window,document);