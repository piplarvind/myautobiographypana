// ==============================================
// My Autobiography Login Alpha Release
// ==============================================

// Configurations. For more information Dear Shalu check Mail
var bgColor        = "#630460";
var LockWallpaper  = "back1.jpg";
var WeekDays       = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
var Months         = new Array("january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december");
var MonthSeparator = "of";

var UserEnterMessage = "To enter Your Autobiography, Please use your Credentials";
var RememberMeLabel  = "Remember me";
var LoadingMessage   = "Login.. Please Wait."
var ErrorMessage     = "Username and password are not correct.";
var ErrorBotonLabel  = "Accept";

var ColorBar    = new Array ("#014051", "#c50577", "#006731", "#22236c", "#000000", "#c2161d", "#f7941d", "#630460");
var Backgrounds = new Array ("back1.jpg","back2.jpg","back3.jpg","back4.jpg","back5.jpg","back6.jpg","back7.jpg","back8.jpg","back9.jpg");

var TimeOut = 10;





// Function to control the login.  1= Correct  0= Incorrect
// The validation is in the "loginCheck.php" file
function isCorrect(IsCorrect)
{
	if(IsCorrect == 1)
	{	   
		window.location.replace('/welcome'); 
		return false;
	}
	else
	{
		UnLoading();
	}
}

// Function to change the color
// Just send the HTML color code to the function. 
// Example: ChangeColor('#4b0049');
function ChangeColor(HTMLcolor)
{
	$("body").css("background",HTMLcolor);
	$("#botLogIn").css("background-color", HTMLcolor);
	$(".color").css("background", HTMLcolor);	
	$("#botTryAgain").css("background-color", HTMLcolor);
	$("#txtCurrentColor").val(HTMLcolor);

}


// Function to change the wallpaper
// Just send the name and extension of the image
// Example: ChangeWallpaper('back1.jpg')
function ChangeWallpaper(URLimage)
{
	$("#BackgroundUp").css("background-image","url(media/front/UI-1-media/img/system/"+ URLimage +")");
	$("#txtCurrentBack").val(URLimage);
}


// =======================================================================
// Working code.. dear Shalu do not touch... unless you understand what you are doing here in the below section..this just to make it responsive
// =======================================================================

// ======================== Redirects to index.mobile.html if is a mobile phone
(function(a){(jQuery.browser=jQuery.browser||{}).mobile=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);
if(jQuery.browser.mobile == true){
	//window.location = "index.mobile.html";
	//window.location = "home";
}


$(".loginMessage").text(UserEnterMessage);

content = '<div id="BackgroundUp"></div>';
$("body").append(content);
// $(".LoginBox").show();

content  = '<input type="hidden" id="HiddenPass" name="HiddenPass"/>';
//content += '<div class="squaredTwo"><input type="checkbox" value="None" id="squaredTwo" name="chkRemember"/><label for="squaredTwo" class="color"></label></div><input type="hidden" id="txtRememberMe" name="txtRememberMe" value="0"/><span class="lblRemember">'+ RememberMeLabel +'</span>';
content += '<input type="hidden" id="txtCurrentColor" name="txtCurrentColor"/>';
content += '<input type="hidden" id="txtCurrentBack" name="txtCurrentBack"/>';
$("#signin_frm").append(content);

content = '<div class="boxLoading"><img src="media/front/UI-1-media/img/system/login/loading82.gif"><span>'+LoadingMessage+'</span></div>';
content += '<div class="loginFail"><span class="OrangeSpan">'+ ErrorMessage +'</span><br/><br/><button id="botTryAgain">'+ ErrorBotonLabel +'</button></div>';
$(".LoginBox").append(content);

$("body").css("background",bgColor);
$("#botLogIn").css("background-color", bgColor);
$(".color").css("background", bgColor);
$("#botTryAgain").css("background-color", bgColor);

$("#BackgroundUp").css("background-image","url(media/front/UI-1-media/img/system/"+ LockWallpaper +")");
$("#txtCurrentColor").val(bgColor);
$("#txtCurrentBack").val(LockWallpaper);


// Lock background configuration
// content = '<img src="img/picture.png" id="OptionBack">';
content = '<div id="DivBacks">';
for(i=0; i<Backgrounds.length ;i++)
{
	content += '<div class="boxBack"><img src="media/front/UI-1-media/img/system/mini'+ Backgrounds[i] +'"/>'+ Backgrounds[i] +'</div>';
}
content += '</div>';

$("body").append(content);

// .Lock Background configuration


// Create the ColorBar tool
content = '<div id="DivColors">';
for(i=0; i<ColorBar.length ;i++)
{
	content += '<div class="boxColor">'+ ColorBar[i] +'</div>';
}
content += '</div>';

$("body").append(content);
// .Create the ColorBar tool

var Seeing  = 0;
var Save    = "";
var Open    = 0;
var OnError = 0;
var Checked = 0;

var BarOpen = 0;
var BacOpen = 0;

var TimeOutTempo = TimeOut;

// creating the div for time
var content = '<div class="MetroBox"><span id="MetroTime">hh:mm</span><br/><span id="MetroDate"><br/>day, dd of mm</span></div>';
$("#BackgroundUp").append(content);

// Time
NowTime();

// Timer tick
setInterval(function()
	{
		NowTime();
	},1000);


function NowTime()
{

	var now = new Date();
	// alert(WeekDays[now.getDay()]);

	$("#MetroDate").text(WeekDays[now.getDay()] + ", " + now.getDate() + " " + MonthSeparator + " " + Months[now.getMonth()]);
	var min = now.getMinutes();
	if(min < 10)
	{
		min = "0" + now.getMinutes();
	}
	else
	{
		min =  now.getMinutes();
	}
	$("#MetroTime").text(now.getHours()+ ":" + min);

	// Closing if reach timeout

	if(Open==1)
	{
		// alert(TimeOutTempo);
		if(TimeOutTempo ==0)
		{
			$("body").focus();
			$("#BackgroundUp").removeClass("fadeOutUpBig");
			$("#BackgroundUp").addClass("fadeInDownBig").delay(100).queue(function()
            {  
                $("#BackgroundUp").clearQueue();
				Open = 0;
            });
            TimeOutTempo = TimeOut;
		}
		else
		{
			TimeOutTempo = TimeOutTempo -1;
		}
	}
	else
	{
		TimeOutTempo = TimeOut;
	}



}


// javascript special functions
$("#BackgroundUp").click(function(){

//IE fix
if($.browser.msie)
{
	$("#BackgroundUp").hide();
}

	$(".LoginBox").show();

	$(this).removeClass("fadeInDownBig");
	$(this).addClass("animated fadeOutUpBig");
	// $("#txtUser").focus();
	Open=1;

	if(BacOpen==1)
	{
		$("#DivBacks").removeClass("animated fadeIn quick");
		$("#DivBacks").addClass("animated fadeOut quick").delay(300).queue(function(){
			$(this).clearQueue();
			$(this).hide();
		});
		
		BacOpen=0;
	}
});

$("#txtUser").keyup(function(){

	var User = $(this).val();

	if(User.length <1)
		User = UserEnterMessage;

	$("h2").text(User);

});




// Simple input validation
// If you need more parameter values, you can modify this function
/*$("#botLogIn").click(function(){
	alert('asnd');
	var User = $.trim($("#txtUser").val());
	var Pass = $("#txtPassword").val();
	var web=window.location.protocol+"/"+window.location.host+"/";

	if(User.length <1)
	{
		$("#txtUser").focus();
		return false;
	}
		
	if(Pass.length <1)
	{
		$("#txtPassword").focus();
		return false;
	}


	if(OnError==1)
	{
		$("#botTryAgain").click();
	}
	else
	{
		
		/*$.ajax({
		url:web+'common/register/user_login',	
		context:'user='+user+'&pass='+pass,
		}).done(function(){
			
		});*/
		//Loading();	
		//$(this).submit();
	//}

//});*/


function Loading()
{
	$(".fields").hide();
	$(".boxLoading").addClass("animated fadeIn quick");
	$(".boxLoading").show()
	//UnLoading();
	//$(".boxLoading").hide(); 
	// setInterval($(".boxLoading").show(),5000);
}

function UnLoading()
{
	$(".boxLoading").hide();
	$(".loginFail").show();
	
}


$(".seePass").mousedown(function(){

	Save = $("#txtPassword").val();

	$("#txtPassword").replaceWith('<input id="txtVisible" type="text" value="'+ Save +'" placeholder="Password"/>');

});

$(".seePass").mouseup(function(){

	Save = $("#txtVisible").val();
	
	$("#txtVisible").replaceWith('<input id="txtPassword" type="password" value="'+ Save +'"  placeholder="Password"/>');

});

$(".seePass").mouseout(function(){

	$(this).mouseup();

});


$("#txtUser").keypress(function(e){

	TimeOutTempo = TimeOut;
	var code = (e.keyCode ? e.keyCode : e.which);
	 if(code == 13) { 
	   	$("#botLogIn").click();
	 }

});

$("#txtPassword").keypress(function(e){

	TimeOutTempo = TimeOut;
	var code = (e.keyCode ? e.keyCode : e.which);
	 if(code == 13) { 
	   	$("#botLogIn").click();
	 }

});


// Open and close with ESC and ENTER Button
$("body").keyup(function(e){


	if (e.keyCode == 27) { 
		$("#txtUser").val("");
		$("#txtPassword").val("");


		if(Open==1)
		{
			//IE fix
			if($.browser.msie)
			{
				$("#BackgroundUp").show();
			}

			$("body").focus();
			$("#BackgroundUp").removeClass("fadeOutUpBig");
			$("#BackgroundUp").addClass("fadeInDownBig").delay(100).queue(function()
            {  
                $("#BackgroundUp").clearQueue();
				Open = 0;
            });

		}
		else
		{
			$("#BackgroundUp").click();

		}

	}
	else
	{
		if (e.keyCode == 13 && Open == 0) 
		{
			$("#BackgroundUp").click();
		}
	}
	
});


// Accept button if the user type a word
$("#botTryAgain").click(function(){

	TimeOutTempo = TimeOut;

	$(".loginFail").delay(300).queue(function(){

		OnError=0;

		$("#txtPassword").val("");
		$("#txtPassword").focus();

		$(".loginFail").clearQueue();
		$(".loginFail").hide();

		$(".fields").addClass("animated fadeIn quick");
		$(".fields").show();

	});

});

// commented by rasika on 27/12
//
//$(document).ready(function() {
//  
//  
//
//
//
//  	$("#signin_frm").submit(function()     //Name of the summited form.
//        {
//			
//			var User = $.trim($("#txtUser").val());
//			var Pass = $("#txtPassword").val();
//		
//	
//			
//        	Save = $("#txtPassword").val();
//			$("#HiddenPass").val(Save);
// 	
//        	if(OnError==1)
//        	{
//        		$("#botTryAgain").click();
//        		return false;
//        	}
//
//
//          $.ajax({
//            type:     "POST",             //Keep this value as POST. (is the form type) 
//            url:      "user_login",         //URL is the page that use the summited information
//            dataType: "html",             //Keep the dataType to HTML.
//            data:$(this).serialize(),     //Serialize the procedure. 
//            beforeSend:function(){         //This function is triggered before send the information
//                    
//			//loading();
//            },
//            success:function(response){   //This function is triggered after the "sendcomment.php" is processed.
//			
//               if(response !=1)
//               {
//				  /*Loading();
//				  alert('dfsdf');return false; */ 
//               	  OnError = 1;
//               	  $(".loginFail").addClass("animated fadeIn quick");
//               	  $(".loginFail").show();
//				  return false;
//               }
//			   else
//				{
//					//window.setInterval(function(){
//  					/// call your function here
//  					//loading();
//					//}, 50);
//					//alert('dfsdf');return false;
//				}
//
//               isCorrect(response);		  // see "loginCheck.php" to get a better idea about response
//            }
//
//          })
//          return false;                   //This line avoid the form refresh.
//        })
//
//});

// Style correction for firefox
	var ua = $.browser;
  	if ( ua.mozilla ) 
  	{
    	$("#botLogIn").css("top", "-32");
    	$(".seePass").css("top", "-24");
  	}

 $("#squaredTwo").click(function(){

 	if(Checked==0)
 	{
 		$("#txtRememberMe").val("1");
 		Checked=1;
 	}
 	else
 	{
 		$("#txtRememberMe").val("0");
 		Checked=0;
 	}
 	

 });


// Function that create the color bar engine
$("#OptionColor").click(function(){

	TimeOutTempo = TimeOut;
	if (BarOpen==0)
	{
		$("#DivColors").addClass("animated fadeIn quick");
		$("#DivColors").show();
		BarOpen=1;
	}
	else
	{
		$("#DivColors").removeClass("fadeIn quick");
		$("#DivColors").addClass("fadeOut quick").delay(300).queue(function(){
			$(this).hide();
		});
		BarOpen=0;
	}
});

$("#OptionBack").click(function(){
	
	$(".LoginBox").hide();

	if(Open == 1)
	{
		Open = 0;
		$("#BackgroundUp").addClass("fadeInDownBig").delay(100).queue(function()
        {  
            $("#BackgroundUp").clearQueue();
        });

        //IE fix
		if($.browser.msie)
		{
			$("#BackgroundUp").show();
		}
	}



	if(BacOpen == 0)
	{
		$("#DivBacks").addClass("animated fadeIn quick");
		$("#DivBacks").show();
		BacOpen=1;
	}
	else
	{	
		$("#DivBacks").removeClass("fadeIn quick")
		$("#DivBacks").addClass("fadeOut quick").delay(300).queue(function(){
			$(this).clearQueue();
			$(this).hide();
		});
		
		BacOpen=0;
	}
	

});


 $('.boxColor').each(function(index) 
 {
 	var Color = $(this).text();
    $(this).css("background-color", Color);
});


$(".boxBack").click(function(){
	$("#LoginBox").hide();
	var BackImg = $(this).text();
	$("#BackgroundUp").css("background-image","url(media/front/UI-1-media/img/system/"+ BackImg +")");
	$("#txtCurrentBack").val(BackImg);
});


$(".boxColor").click(function(){

	var Color = $(this).text();
	TimeOutTempo = TimeOut;
	
	$("body").css("background",Color);
	$("#botLogIn").css("background-color", Color);
	$(".color").css("background", Color);	
	$("#botTryAgain").css("background-color", Color);

	$("#txtCurrentColor").val(Color);
});


$(document).ready(function() {
$("#signin_frm").validate({
         errorElement:"div",
        rules: {
           
          user_email: {
                required: true
                //email: true,
//                remote: {
//                    url: j('#base_url').val() + "chk-email-duplicate",
//                    method: 'post'
//                }
            },
            user_password:
                    {
                        required: true,
                        minlength: 5
                        /* password_strenth:true */
                    }
        },
        messages:{
           user_email:
                    {
                        required: "Please enter your email.",
     //                   email: "Please enter valid email address.",
//                        remote: "This email address is already registered with site."
                    },
            user_password:
                    {
                        required: "Please enter your password.",
                        minlength: "Please enter atleast 5 character." 
                    }
          },
       submitHandler: function(){
		j('#btn_submit').attr('disabled', 'disabled');
                form.submit();
         }
     });
       });

