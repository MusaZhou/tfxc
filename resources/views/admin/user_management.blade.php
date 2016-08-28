@extends('admin_master')

@section('css')
	@parent
    <!-- DataTables CSS -->
    <link href="{{ URL::asset('css/dataTables/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ URL::asset('css/dataTables/responsive.dataTables.min.css') }}" rel="stylesheet">

@endsection

@section('content')
	
	<!--      Main Content          -->
	 <div class="row">
           	<div class="col-lg-12">
                <h1 class="page-header">客户</h1>
            </div>
     </div>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-lg-1">
                    <button type="button" class="btn btn-primary" onclick="goToAddUser()">
                    	<i class="fa fa-plus"> 添加用户</i>
                    </button>
                </div>
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            	用户列表
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="user_list">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>姓名</th>
                                            <th>手机号码</th>
                                            <th>职位</th>
                                            <th>单位</th>
                                            <th>驻地</th>
                                            <th>微信昵称</th>
                                            <th>邮箱</th>
                                            <th>性别</th>
                                            <th>会员</th>
                                            <th>备注</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach ( $userList as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->job }}</td>
                                            <td>{{ $user->organization }}</td>
                                            <td>{{ $user->location }}</td>
                                            <td>{{ $user->wechat_name }}</td>
                                            <th>{{ $user->email }}</th>
                                            <td>{{ $user->gender == 1 ? '男' : '女' }}</td>
                                            <td>{{ $user->isVip() ? '是' : '否' }}</td>
                                            <td>{{ $user->note }}</td>
                                          	<td>
                                          		<a href="/admin/edit_user/{{ $user->id }}">
                                          			<i class="fa fa-pencil-square-o fa-lg"></i>
                                          		</a>
                                          	</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
@endsection

@section('js')
	@parent
	
    <!-- DataTables JavaScript -->
    <script src="{{ URL::asset('js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('js/dataTables/dataTables.bootstrap.min.js') }}"></script>
	
    <script>
    
    $(document).ready(function() {
        $('#user_list').DataTable({
	        	"autoWidth": false,
	        	"columnDefs": [
	    	               { "width": "5%", "targets": 0},
	    	               { "width": "10%", "targets": 1},
	    	               { "width": "10%", "targets": 2},
	    	               { "width": "10%", "targets": 3},
	    	               { "width": "10%", "targets": 4},
	    	               { "width": "10%", "targets": 5},
	    	               { "width": "10%", "targets": 6},
	    	               { "width": "10%", "targets": 7},
	    	               { "width": "5%", "targets": 8},
	    	               { "width": "5%", "targets": 9},
	    	               { "width": "10%", "targets": 10},
	    	               { "width": "5%", "targets": 11},
	    	               ],
                responsive: true,
                "pageLength": 25,
                "order": [[0, "desc"]],
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

// 		$('#changePasswordSubmit').click(function(e){
// 			$('#changePasswordForm').submit();
// 		});

// 		$('#changePasswordForm').submit(function(e){
// 			var result = validateChangePassword();
// 			if(result){
// 				$('#errorChangePassword').hide();
// 				return true;
// 			}else{
// 				$('#errorChangePassword').show();
// 				return false;
// 			}
// 		});
		
// 		$('#errorChangePassword').hide();
    });

// 	function validateChangePassword(){
// 		var password = $('#changePasswordPassword').val().trim();
// 		var confirmPassword = $('#changePasswordConfirmPassword').val().trim();

// 		if(password == '' || confirmPassword == ''){
// 			$('#errorChangePassword').text('请完成必填项');
// 			return false;
// 		}

// 		if(password != confirmPassword){
// 			$('#errorChangePassword').text('密码不相同');
// 			return false;
// 		}

// 		return true;
// 	}

// 	function changePassword(mobile, userId){
// 		$('#changePasswordUserId').val(userId);
// 		$('#changePasswordMobile').text(mobile);
// 	}

	function checkAllNormalUser(){
		$('input[name="normalUserIdCheck[]"]').prop('checked', true);
	}

	function uncheckAllNormalUser(){
		$('input[name="normalUserIdCheck[]"]').prop('checked', false);
	}

	function sendMessage(){
		var normalUserIdElements = $('input[name="normalUserIdCheck[]"]:checked').get() || [];
		var shopUserIdElements = $('input[name="shopUserIdCheck[]"]:checked').get() || [];
		var exhibitionUserIdElements = $('input[name="exhibitionUserIdCheck[]"]:checked').get() || [];

		var userIdElements = (normalUserIdElements.concat(shopUserIdElements)).concat(exhibitionUserIdElements);
		
// 		var userIdElements = [];
		
// 		normalUserIdElements.each(function(){
// 			userIdElements.push($(this));
// 		});

// 		shopUserIdElements.each(function(){
// 			userIdElements.push($(this));
// 		});

// 		exhibitionUserIdElements.each(function(){
// 			userIdElements.push($(this));
// 		});
		
		if(userIdElements.length == 0){
			bootbox.alert('请选择发送用户');
			return;
		}else if(userIdElements.length > 500){
			bootbox.alert('最大选择500人');
		}else{
			var userIds = [];
			$(userIdElements).each(function(){
				userIds.push($(this).val());
			});
			
			bootbox.prompt("消息内容:", function(result) {                
	    		  if (result !== null) {                                             
	    			  $.ajax({
	    					url: '/send_user_message',
	    					method: 'POST',
	    					data: { 
	    							content: result,
	    							userIds: userIds,
	    							_token: "{{ csrf_token() }}",
	    							 }
	    				}).done(function(data){
	    					if(data == 1){
	    						bootbox.alert("发送成功");
	    					}else{
								bootbox.alert("回复失败");
	        				}
	    				});                             
	    		  } 
	    		});
		}
	}

	function sendMessageToAll(){
			
		bootbox.prompt("发送给所有用户的消息:", function(result) {                
    		  if (result !== null) {                                             
    			  $.ajax({
    					url: '/send_broadcast_user_message',
    					method: 'POST',
    					data: { 
    							content: result,
    							_token: "{{ csrf_token() }}",
    							 }
    				}).done(function(data){
    					if(data == 1){
    						bootbox.alert("发送成功");
    					}else{
							bootbox.alert("回复失败");
        				}
    				});                             
    		  } 
    		});
	}
    </script>
@endsection
