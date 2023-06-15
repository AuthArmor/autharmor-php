$(document).ready(function () {
	$("form").bind("keypress", function (e) {  
		if (e.keyCode == 13) {  
			return false;  
		}  
	});
});

/* Show/Hide tab content based on tab click  */
jQuery( document ).on( 'click', '.tablinks', function(event){
	$('.error').remove();
 	var flag = $(this).data('class');
 	$('.tablinks').removeClass('active');
 	$('.tabcontent').hide();
 	$('#'+flag).show();
 	$(this).addClass('active');
});

/* Login button click - open popup with auth methods list based on registration  */
jQuery( document ).on( 'click', '.button', function(event){
    event.preventDefault();
    $('.error').remove();
    if( $(".login-username").val() != '' ){
        var button = $(this);
        var username = $(".login-username").val();
        var data = { 'username' : username, 'flag' : 'check_login_type' }; 

        $.ajax({
            type: "POST",
            url: "ajax-calls.php",
            data: data,
            success: function (data) {
                $(button).prop("disabled", false);
                var response = JSON.parse(data);
                if( response.status_code == 200 ){
                    $("#myPopup").toggleClass("show");
                    $(".popup").toggle();
                    $(".login-register-demo-main").toggleClass("bgcolor");
                    $("#myPopup").html(response.message);
                }else{
                     $(".login-username").after( "<div class='error'>"+response.errorMessage+"</div>" );
                }
            },
            error: function (e) {
                $( button ).after( "<div class='response-data'>"+e.responseText+"</div>" );
                $(button).prop("disabled", false);
            }
        });
        
    } else {
        $(".login-username").after( "<div class='error'>Username is a required field.</div>" );
    }
});

/* Register button click - open popup with auth methods list  */
jQuery( document ).on( 'click', '.register-button', function(event){
	$('.error').remove();
	if( $(".register-username").val() != '' ){
    	$("#myPopup-register").toggleClass("show");
    	$(".popup-register").toggle();
	    $(".login-register-demo-main").toggleClass("bgcolor");
	} else {
		$(".register-username").after( "<div class='error'>Username is a required field.</div>" );
	}
});

/* Based on selected auth method do the register/login process */
jQuery( document ).on( 'click', '.auth-method', function(event){
 	var flag = $(this).data('action-type');
 	var selected_method = $(this).data('class');
 	if( selected_method == 'login' ){
        var field = 'login-username'; // fieldname
 	}
 	else if( selected_method == 'register' ){
        var field = 'register-username'; // fieldname
 	}
 	var field_val = $("."+field).val();

    event.preventDefault();
	var button = $(this);
	var main_wrapper = $(this).closest('.login-register-demo');
    var data = { 'username' : field_val, 'flag' : flag }; 
    
    $(button).prop("disabled", true); // disabled the submit button
    $('.response-data', main_wrapper).remove();
    $.ajax({
        type: "POST",
        url: "ajax-calls.php",
        data: data,		            
	    beforeSend: function() {
			$(".auth-methods-list").css('pointer-events','none');
	    },
        success: function (data) {
            $(button).prop("disabled", false);
            var response = JSON.parse(data);
            if( response.status_code == 200 ){
            	if( selected_method == 'login' ){
        			$(".popup").hide();
                	$(".popuptext").removeClass('show');
                    if( flag == 'login_authenticator' ){
	        			$(".popup-success").show();
	                	$(".popuptext-success").html( response.message );
	                	$(".popuptext-success").addClass('show');
                    	setTimeout(function() {
	                        get_user_info_login_authenticator(field_val,main_wrapper,button);
		                }, 1000);
                    } else if ( flag == 'login_webauthn' ){
                        const SDK = new AuthArmorWebAuthn({
                            webauthnClientId: webauthnClientId,
                          });
                        const payload = SDK.get(response);
                        payload.finally(() => {
                            loading = false;
                        }).then((result) => {
                            login_webauthn_finish_call(result,main_wrapper,button);
                        }).catch((error) => {
                            $(".popup-success").show();
		                	$(".popuptext-success").html( '<div class="popuptext-main"><p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p><div class="orange">The operation either timed out or was not allowed.</div></div>' );
		                	$(".popuptext-success").addClass('show');
                        });
                    }else{                    	
	        			$(".popup-success").show();
	                	$(".popuptext-success").html( response.message );
	                	$(".popuptext-success").addClass('show');
                    }
                }
			 	else if( selected_method == 'register' ){
			 		if( flag == 'register_authenticator' ){
                        $(".popuptext-success-register").html( response.message );
                        $(".popuptext-success-register").addClass('show');
                        $(".popup-success-register").toggle();
                        get_user_info_authenticator(field_val,main_wrapper,button);
			 		} else if ( flag == 'register_webauthn' ) {
                        const SDK = new AuthArmorWebAuthn({
                            webauthnClientId: webauthnClientId,
                          });
                        const payload = SDK.create(response);

                        payload.finally(() => {
                            loading = false;
                        }).then((result) => {
                            register_webauthn_finish_call(result,main_wrapper,button);
                        }).catch((error) => {
                            $(".popup-success-register").show();
		                	$(".popuptext-success-register").html( '<div class="popuptext-main"><p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p><div class="orange">The operation either timed out or was not allowed.</div></div>' );
		                	$(".popuptext-success-register").addClass('show');
                        });
                    }else{
                		$(".popuptext-success-register").html( response.message );
                		$(".popuptext-success-register").addClass('show');
        				$(".popup-success-register").toggle();
                	}
                	$(".popuptext-register").removeClass('show');
        			$(".popup-register").hide();
			 	}
            } else {
            	if( selected_method == 'login' ){
    				$(".popup").toggle();
    			}
			 	else if( selected_method == 'register' ){
    				$(".popup-register").toggle();
    			}
            	$("."+field).after( "<div class='error'>"+response.errorMessage+"</div>" );
            }
            if( selected_method == 'login' ){
            	$(".popuptext").removeClass('show');
            }
			else if( selected_method == 'register' ){
				$(".popuptext-register").removeClass('show');
			}
			$(".auth-methods-list").css('pointer-events','');
        },
        error: function (e) {
        	if( selected_method == 'login' ){
            	$(".popuptext").removeClass('show');
            }
			else if( selected_method == 'register' ){
				$(".popuptext-register").removeClass('show');
			}
            $(button).prop("disabled", false);
			$(".auth-methods-list").css('pointer-events','');
        }
    });
});

/* After SDK created and get the payload success, do the webauthn user finish process */
function register_webauthn_finish_call(payload,main_wrapper,button){
    $('.response-data', main_wrapper).remove();
    var data = { 'payload' : payload, 'flag' : 'register_webauthn_finish_call' }; 

    $.ajax({
        type: "POST",
        url: "ajax-calls.php",
        data: data,
        success: function (data) {
            var response = JSON.parse(data);
            if( response.status_code == 200 ){
        		$(".popuptext-success-register").html( response.message );
        		$(".popuptext-success-register").addClass('show');
				$(".popup-success-register").toggle();
            }else{
        		$(".popuptext-success-register").html( response.errorMessage );
        		$(".popuptext-success-register").addClass('show');
				$(".popup-success-register").toggle();
            }
        },
        error: function (e) {
            $(".popuptext-success-register").html( e.responseText );
            $( button ).prop("disabled", false);
        }
    });
}

/* get the payload success from SDK, do the webauthn user login finish process */
function login_webauthn_finish_call(payload,main_wrapper,button){
    $('.response-data', main_wrapper).remove();
    var data = { 'payload' : payload, 'flag' : 'login_webauthn_finish_call' }; 

    $.ajax({
        type: "POST",
        url: "ajax-calls.php",
        data: data,
        success: function (data) {
            var response = JSON.parse(data);
            if( response.status_code == 200 ){
        		$(".popuptext-success").html( response.message );
        		$(".popuptext-success").addClass('show');
				$(".popup-success").toggle();
            }else{
        		$(".popuptext-success").html( response.errorMessage );
        		$(".popuptext-success").addClass('show');
				$(".popup-success").toggle();
            }
        },
        error: function (e) {
            $(".popuptext-success").html( e.responseText );
            $( button ).prop("disabled", false);
        }
    });
}

/* Automatically check if user is created ( scan QR successfully ) and displayed message */
function get_user_info_authenticator( username, main_wrapper, button )
{
    $('.response-data', main_wrapper).remove();
    var data = { 'username' : username, 'flag' : 'check_user_status_by_username' }; 

    $.ajax({
        type: "POST",
        url: "ajax-calls.php",
        data: data,
        success: function (data) {
            var response = JSON.parse(data);
            $(".popuptext-success-register").html( response.message );
        },
        error: function (e) {
            $(".popuptext-success-register").html( e.responseText );
            $( button ).prop("disabled", false);
        }
    });
}

/* Automatically check if user is logged in ( scan QR successfully ) and displayed message */
function get_user_info_login_authenticator( username, main_wrapper, button )
{
    $('.response-data', main_wrapper).remove();
    var auth_request_id = $(".auth_request_id",main_wrapper).val();
    var auth_validation_token = $(".auth_validation_token",main_wrapper).val();
    var data = { 'username' : username, 'auth_request_id' : auth_request_id, 'auth_validation_token' : auth_validation_token, 'flag' : 'check_user_status_by_username_login' }; 

    $.ajax({
        type: "POST",
        url: "ajax-calls.php",
        data: data,
        success: function (data) {
            var response = JSON.parse(data);
            $(".popuptext-success").html( response.message );
        },
        error: function (e) {
            $(".popuptext-success-register").html( e.responseText );
            $( button ).prop("disabled", false);
        }
    });
}

jQuery( document ).on( 'click', '.show_qr', function(event){
    $(".qr-code-image-show").show();
    $(".authenticator-response-first").hide();
});

jQuery( document ).on( 'click', '.hide-popup-qrcode-btn', function(event){
    $(".qr-code-image-show").hide();
    $(".authenticator-response-first").show();
});

jQuery( document ).on( 'click', '.popuptext-close', function(event){	
	$( this ).closest(".popuptext-main").parent().removeClass('show');
	$( this ).closest(".popuptext-main").parent().parent().hide();
});