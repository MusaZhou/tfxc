/**
 * 
 */
function previewAndUploadImage(files, 
								bytes, 
								previewElement, 
								progressBarElement, 
								uploadKeyName, 
								csrfToken, 
								actionUrl){
	if (files && files[0]) {
		var file = files[0];
        var fileSize = file.size; // get file size
        var fileType = file.type.toLowerCase(); // get file type
        if($.inArray(fileType, ['image/jpg', 'image/png', 'image/jpeg', 'image/gif']) == -1){
			alert('不支持此文件格式');
			$(this).val('');
			return;
        }

        if( fileSize > (bytes)){
			alert('文件大小限制为' + bytes/1024 +'KB');
			$(this).val('');
			return;		
	    }
        
		var reader = new FileReader();
		reader.onload = function(event){
			previewElement.prop('src', event.target.result);
		};
		reader.readAsDataURL(file);
		
		progressBarElement.show();
		
		var formData = new FormData();
		formData.append(uploadKeyName, file);
		formData.append('_token', csrfToken);
		
		return $.ajax({
			  url: actionUrl,
			  type: "POST",
			  data: formData,
			  processData: false,  
			  contentType: false   
		});
	}
}

function startCountDownTime(deadline, enclosureElement){
	  var timeinterval = setInterval(function(){
	    var t = getTimeRemaining(deadline);
	    var days = ('0' + t.days).slice(-2);
	    var hours = ('0' + t.hours).slice(-2);
	    var minutes = ('0' + t.minutes).slice(-2);
	    var seconds = ('0' + t.seconds).slice(-2);
	    var remaingTimeString = '剩余' + days + '天' + hours + '时' + minutes + '分' + seconds + '秒';
	    enclosureElement.html(remaingTimeString);
	    
	    if(t.total<=0){
	      clearInterval(timeinterval);
	    }
	  },1000);
}

function getTimeRemaining(deadline){
	  var t = Date.parse(deadline) - Date.parse(new Date());
	  var seconds = Math.floor( (t/1000) % 60 );
	  var minutes = Math.floor( (t/1000/60) % 60 );
	  var hours = Math.floor( (t/(1000*60*60)) % 24 );
	  var days = Math.floor( t/(1000*60*60*24) );
	  return {
	    'total': t,
	    'days': days,
	    'hours': hours,
	    'minutes': minutes,
	    'seconds': seconds
	  };
}

function startCountDownTimeSingle(deadline){
	var timeinterval = setInterval(function(){
	    var t = getTimeRemaining(deadline);
	    var days = ('0' + t.days).slice(-2);
	    var hours = ('0' + t.hours).slice(-2);
	    var minutes = ('0' + t.minutes).slice(-2);
	    var seconds = ('0' + t.seconds).slice(-2);
	    var remaingTime = '<span class="text-gray">剩余时间：</span>' 
	    						+ '<span class="text-red">' + days + '</span><span class="text-black">天</span>' 
	    						+ '<span class="text-red">' + hours + '</span><span class="text-black">时</span>'
	    						+ '<span class="text-red">' + minutes + '</span><span class="text-black">分</span>'
	    						+ '<span class="text-red">' + seconds + '</span><span class="text-black">秒</span>'
      						;
	    $('.remainingString').empty();
	    $('.remainingString').html(remaingTime);
	    
	    if(t.total<=0){
	      clearInterval(timeinterval);
	    }
	  },1000);
}

$(function(){
	$('#change_password_form').submit(function(e){
		var result = changePasswordValidate();
		if(result){
			$('#passwodError').hide();
			return true;
		}else{
			$('#passwodError').show();
			return false;
		}
	});

	$('#passwodError').hide();
});

function changePasswordValidate(){
	var password = $.trim($('#password').val());
	var password_confirmation = $.trim($('#password_confirmation').val());

	if( password == '' || password_confirmation == ''){
		$('#passwodError').text('请完成必填项');
		return false;
	}
	
	if( password.length < 6){
		$('#passwodError').text('密码最少需要6位');
		return false;
	}
	
	if( password != password_confirmation){
		$('#passwodError').text('输入密码不一致');
		return false;
	}
	
	return true;
}