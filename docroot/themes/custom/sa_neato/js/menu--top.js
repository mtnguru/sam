!function(e){"use strict";Drupal.menuTopC=function(){var n=function(){var n=document.getElementById("js-centered-more");if(e(n).length>0){var t=e(window).width(),u=e(n).offset().left,o=t-u;o<330&&(e("#js-centered-more .submenu .submenu").removeClass("fly-out-right"),e("#js-centered-more .submenu .submenu").addClass("fly-out-left")),o>330&&(e("#js-centered-more .submenu .submenu").removeClass("fly-out-left"),e("#js-centered-more .submenu .submenu").addClass("fly-out-right"))}var r=e("#js-centered-navigation-mobile-menu").unbind();e("#js-centered-navigation-menu").removeClass("show"),r.on("click",function(n){n.preventDefault(),e("#js-centered-navigation-menu").slideToggle(function(){e("#js-centered-navigation-menu").is(":hidden")&&e("#js-centered-navigation-menu").removeAttr("style")})})};return{init:n}},Drupal.behaviors.menuTop={attach:function(n,t){e(n).find("#site-header").once("menuTopAttached").each(function(){Drupal.menuTop||(Drupal.menuTop=Drupal.menuTopC()),Drupal.menuTop.init(this)})}}}(jQuery);
//# sourceMappingURL=maps/menu--top.js.map
