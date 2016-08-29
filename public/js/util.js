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

function initializeDataTable(tableElement, columnDefArray, itemPerPage, orderArray){
	
	var dataTable = tableElement.DataTable({
    	"autoWidth": false,
    	"columnDefs": columnDefArray,
        responsive: true,
        "pageLength": itemPerPage,
        "order": orderArray,
        language:{
        	"decimal":        "",
            "emptyTable":     "目前没有数据",
            "info":           "显示 _START_ 到 _END_ 共 _TOTAL_ 条数据",
            "infoEmpty":      "显示 0 到 0 共 0 条数据",
            "infoFiltered":   "(从 _MAX_ 条数据中过滤)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "显示 _MENU_ 条数据",
            "loadingRecords": "加载中...",
            "processing":     "处理中...",
            "search":         "搜索:",
            "zeroRecords":    "没有找到结果",
            "paginate": {
                "first":      "首页",
                "last":       "末页",
                "next":       "下一页",
                "previous":   "前一页"
            },
            "aria": {
                "sortAscending":  ": 激活升序排列",
                "sortDescending": ": 激活降序排列"
            }
   		},
	});
	
	return dataTable;
}

function initializeAjaxDataTable(tableElement, columnDefArray, itemPerPage, orderArray){
	
	var dataTable = tableElement.DataTable({
		"ajax": { dataSrc: 'data' , url: '/emptyTableData'},
		"autoWidth": false,
    	"columnDefs": columnDefArray,
        responsive: true,
        "pageLength": itemPerPage,
        "order": orderArray,
        language:{
        	"decimal":        "",
            "emptyTable":     "目前没有数据",
            "info":           "显示 _START_ 到 _END_ 共 _TOTAL_ 条数据",
            "infoEmpty":      "显示 0 到 0 共 0 条数据",
            "infoFiltered":   "(从 _MAX_ 条数据中过滤)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "显示 _MENU_ 条数据",
            "loadingRecords": "加载中...",
            "processing":     "处理中...",
            "search":         "搜索:",
            "zeroRecords":    "没有找到结果",
            "paginate": {
                "first":      "首页",
                "last":       "末页",
                "next":       "下一页",
                "previous":   "前一页"
            },
            "aria": {
                "sortAscending":  ": 激活升序排列",
                "sortDescending": ": 激活降序排列"
            }
   		},
	});
	
	return dataTable;
}