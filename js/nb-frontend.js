function getCookie(name) {
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    }
    else
    {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
        end = dc.length;
        }
    }
    return unescape(dc.substring(begin + prefix.length, end));
}

function nb_setCookie(cookieName, cookieValue, nDays, cookie_expire ) {
    var today = new Date();
    var expire = new Date();
    if (nDays == null || nDays == 0)
        nDays = 1;
    expire.setTime(today.getTime() + 3600000 * cookie_expire);
    document.cookie = cookieName + "=" + escape(cookieValue) + ";expires=" + expire.toGMTString();
}
    
// jQuery(document).ready(function($){
//     var heights = $(".common-class").map(function ()
//     {
//         return $(this).height();
//     }).get(),
//     maxHeight = Math.max.apply(null, heights);
//     $('.common-class').height(maxHeight);
// });