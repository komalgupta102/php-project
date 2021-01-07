$(document).ready(function(){
 $('.header').height($(window).height());

 $(".navbar a").click(function(){
 	$("body,html").animate({
 		scrollTop:$("#" + $(this).data('value')).offset().top
 	},1000)
  
 })

//register form post api
$('#register-form').submit(function(event) {
        // get the form data
        var formData = {
            'name'              : $('input[name=name]').val(),
            'email'             : $('input[name=email]').val(),
            'password'    : $('input[name=password]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'process/register.php', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
           	encode          : true
        })
            // using the done promise callback
            .done(function(data) {
            	if(data.success){
                //set session
                 $.ajax({
                    url: "helpers/sendgrid.php",
                    data: { 'name': formData.name, 'email': formData.email, 'password': formData.password}
                }).done(function(data1){
                    alert(data.message);
                    window.location.href = 'login';
                })
            }else{
                    alert(data.message);
                }
            });

        // stop the form from submitting the normal way and refreshing the page
         event.preventDefault();
    });

//login form post api
$('#login-form').submit(function(event) {
      //  var store = store || {};

    /*
     * Sets the jwt to the store object
     */
        // store.setJWT = function(data){
        //     this.JWT = data;
        // }
        // get the form data
        var formData = {
            'email'             : $('input[name=email]').val(),
            'password'    : $('input[name=password]').val()
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'process/login.php', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
        })
            // using the done promise callback
            .done(function(data) {
                if(data.success){
                //set session
                 $.ajax({
                    url: "helpers/session.php",
                    data: { user_id: data.data.user_id }
                }).done(function(){
                    window.location.href = 'admin';
                })
                //     store.setJWT(data.token)
              //      window.location.href = 'admin';
                }else{
                    alert(data.message);
                }
            });

        // stop the form from submitting the normal way and refreshing the page
         event.preventDefault();
    });
})

