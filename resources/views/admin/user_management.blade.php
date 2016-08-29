@extends('admin_master')

@section('css')
	@parent
    <!-- DataTables CSS -->
    <link href="{{ URL::asset('css/dataTables/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ URL::asset('css/dataTables/responsive.dataTables.min.css') }}" rel="stylesheet">

@endsection

@section('content')
	<!-- Add User Modal -->
	<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="addUserLabel">添加用户</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="alert alert-danger" role="alert" id="errorAddUser"></div>
	        <form id="addUserForm" name="addUserForm" role="form" action="/admin/add_user" method="post">
	      		{{ csrf_field() }}
	      		<div class="form-group">
	      			<label>手机号码 * </label>
	      			<input id="addUserPhone" name="phone" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>姓名 </label>
	      			<input id="addUserName" name="name" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>职位 </label>
	      			<input id="addUserJob" name="job" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>单位 </label>
	      			<input id="addUserOrganization" name="organization" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>驻地 </label>
	      			<input id="addUserLocation" name="location" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>邮箱 </label>
	      			<input id="addUserEmail" name="email" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>性别 </label>
	      			<select id="addUserGender" name="gender" class="form-control" type="select">
	      				<option value="1">男</option>
	      				<option value="2">女</option>
	      			</select>
	      		</div>
	      		<div class="form-group">
	      			<label>备注 </label>
	      			<input id="addUserNote" name="note" class="form-control" type="text"/>
	      		</div>
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
	        <button type="button" class="btn btn-primary" id="addUserSubmit" onclick="addUser()">确定</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!-- Edit User Modal -->
	<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="editUserLabel">编辑用户</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="alert alert-danger" role="alert" id="errorEditUser"></div>
	        <form id="editUserForm" name="editUserForm" role="form" action="/admin/edit_user" method="post">
	      		{{ csrf_field() }}
	      		<input id="editUserId", name="userId" type="hidden"/>
	      		<div class="form-group">
	      			<label>手机号码 * </label>
	      			<input id="editUserPhone" name="phone" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>姓名 </label>
	      			<input id="editUserName" name="name" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>职位 </label>
	      			<input id="editUserJob" name="job" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>单位 </label>
	      			<input id="editUserOrganization" name="organization" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>驻地 </label>
	      			<input id="editUserLocation" name="location" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>邮箱 </label>
	      			<input id="editUserEmail" name="email" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>性别 </label>
	      			<select id="editUserGender" name="gender" class="form-control" type="select">
	      				<option value="1">男</option>
	      				<option value="2">女</option>
	      			</select>
	      		</div>
	      		<div class="form-group">
	      			<label>备注 </label>
	      			<input id="editUserNote" name="note" class="form-control" type="text"/>
	      		</div>
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
	        <button type="button" class="btn btn-primary" id="editUserSubmit" onclick="editUser()">确定</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!--      Main Content          -->
	 <div class="row">
           	<div class="col-lg-12">
                <h1 class="page-header">客户</h1>
            </div>
     </div>
            <div class="row" style="margin: 5px;">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                    	添加用户
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showEditUser()">
                    	编辑用户信息
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
                                        	<th></th>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach ( $userList as $user)
                                        <tr>
                                        	<td><input type="radio" name="userRadio" value="{{$user->id}}"></td>
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
    
    $(function() {
        var columnDefArray = [
							   { "width": "5%", "targets": 0},
    	    	               { "width": "5%", "targets": 1},
    	    	               { "width": "10%", "targets": 2},
    	    	               { "width": "10%", "targets": 3},
    	    	               { "width": "10%", "targets": 4},
    	    	               { "width": "10%", "targets": 5},
    	    	               { "width": "5%", "targets": 6},
    	    	               { "width": "10%", "targets": 7},
    	    	               { "width": "15%", "targets": 8},
    	    	               { "width": "5%", "targets": 9},
    	    	               { "width": "5%", "targets": 10},
    	    	               { "width": "10%", "targets": 11},
    	    	               ];
        
    	initializeDataTable($('#user_list'), columnDefArray, 25, [[1, "desc"]]);
		
		$('#errorAddUser').hide();
		$('#errorEditUser').hide();
    });

    function addUser(){
        var result = validateAddUser();

        if(result){
        	$('#errorAddUser').hide();
        	$('#addUserForm').submit();
       	}else{
           	$('#errorAddUser').show();
       	}
    }

	function validateAddUser(){
		var phone = $('#addUserPhone').val().trim();

		if(phone == ''){
			$('#errorAddUser').text('请填写电话');
			return false;
		}

		return true;
	}

	function showEditUser(){
        var checkedUser = $('input[name="userRadio"]:checked');
		if(checkedUser.length == 0){
			bootbox.alert('请选择用户');
		}else{
			var userId = checkedUser.val();

			$.ajax({
				url: '/admin/get_user_info_by_id',
				method: 'GET',
				data: { 
						userId: userId,
						_token: "{{ csrf_token() }}",
						 },
				dataType: 'JSON',
			}).done(function(response){
				if(response.status == 1){
					$('#editUserId').val(response.data.id);
					$('#editUserName').val(response.data.name);
					$('#editUserPhone').val(response.data.phone);
					$('#editUserJob').val(response.data.job);
					$('#editUserOrganization').val(response.data.organization);
					$('#editUserLocation').val(response.data.location);
					$('#editUserEmail').val(response.data.email);
					$('#editUserGender').val(response.data.gender);
					$('#editUserNote').val(response.data.note);

					$('#editUserModal').modal();
				}
			});
		}
    }

	function editUser(){
        var result = validateEditUser();

        if(result){
        	$('#errorEditUser').hide();
        	$('#editUserForm').submit();
       	}else{
           	$('#errorEditUser').show();
       	}
    }

	function validateEditUser(){
		var phone = $('#editUserPhone').val().trim();

		if(phone == ''){
			$('#errorEditUser').text('请填写电话');
			return false;
		}

		return true;
	}

    </script>
@endsection
