$(function() {
    
	altair_login_page.init()
	}
);
    
	var $login_card=$("#login_card"), 
	    $login_form=$("#login_form"), 
	    $login_help=$("#login_help"), 
	    $login_password_reset=$("#login_password_reset");
    
	    altair_login_page= {
    init: function() {
    
	    	var i=function() {
    
	    		$login_form.is(": visible")?($login_form.hide(), $login_help.show()):($login_form.show(), $login_help.hide(), $("#login_help_show").fadeIn("400"));
}
, o=function() {
    $login_form.hide(), $login_help.hide(), $login_password_reset.show();
}
;
    $("#login_help_show").on("click", function(o) {
    o.preventDefault(), $(this).hide(), altair_md.card_show_hide($login_card, void 0, i, void 0);
}
), $("#login_help_close").on("click", function(o) {
    o.preventDefault(), altair_md.card_show_hide($login_card, void 0, i, void 0);
}
), $("#login_password_reset_show").on("click", function(i) {
    i.preventDefault(), altair_md.card_show_hide($login_card, void 0, o, void 0);
}
);
}};