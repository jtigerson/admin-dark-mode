
//console.log(" ADMIN_DARK_MOD ");
//console.log(ADMIN_DARK_MOD.css_url);



var cookieAPI = {
    createCookie: function(name, value, days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
        } else var expires = "";
        document.cookie = name + "=" + value + expires + "; path=/";
    },

    readCookie: function(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    },

    eraseCookie: function(name) {
        // http://www.sitepoint.com/3-things-about-cookies-you-may-not-know/
        this.createCookie(name, "", -1);
    }

};

jQuery(document).ready(function($){

	var add_dark_mode_css = function(){
		var head  = document.getElementsByTagName('head')[0];
	    var link  = document.createElement('link');
	    link.id   = 'dark-mod-css-id',
	    link.rel  = 'stylesheet';
	    link.type = 'text/css';
	    link.href = ADMIN_DARK_MOD.css_url;
	    link.media = 'all';
	    head.appendChild(link);
	};

	var remove_dark_mode_css = function (){
		$("#dark-mod-css-id").remove();
	};

	var drk = cookieAPI.readCookie('DRKMOD') ;
	console.log('LOAD:'+drk);
	if ( drk == true ){
		add_dark_mode_css();
	}

	$("#drk-on-off-btn").click(function(){

		var drk = cookieAPI.readCookie('DRKMOD') ;
		console.log(drk);
		if ( drk == '' ){
			add_dark_mode_css();
		    cookieAPI.createCookie('DRKMOD', '1', 1);
		}else{
			remove_dark_mode_css();
			cookieAPI.createCookie('DRKMOD', '', 1)
		}

	});

});

