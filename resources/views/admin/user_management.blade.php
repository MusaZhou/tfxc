@extends('admin_master')

@section('css')
	@parent
    <!-- DataTables CSS -->
    <link href="{{ URL::asset('css/dataTables/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ URL::asset('css/dataTables/responsive.dataTables.min.css') }}" rel="stylesheet">
    
    <!-- Date Time picker -->
	<link href="{{ URL::asset('css/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/jquery-timepicker/jquery.timepicker.css') }}" rel="stylesheet">

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
	
	<!-- Add Vip Period Modal -->
	<div class="modal fade" id="addVipPeriodModal" tabindex="-1" role="dialog" aria-labelledby="addVipPeriodLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="addVipPeriodLabel">添加正式会员注册记录</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="alert alert-danger" role="alert" id="errorAddVipPeriod"></div>
	        <form id="addVipPeriodForm" name="addVipPeriodForm" role="form" action="/admin/add_vip_period" method="post">
	      		{{ csrf_field() }}
	      		<div class="form-group">
	      			<lable style="font-weight: bold">用户: <span id="addVipPeriodUser"></span></lable>
	      			<input id="addVipPeriodUserId" name="userId" type="hidden"/>
	      		</div>
	      		<div class="form-group">
	      			<label>支付方式  *</label>
	      			<select id="addVipPeriodPaymentTypeId" name="paymentTypeId" class="form-control">
	      				@foreach($paymentTypeList as $paymentType)
	      				<option value="{{ $paymentType->id }}">{{ $paymentType->name }}</option>
	      				@endforeach
	      			</select> 
	      		</div>
	      		<div class="form-group">
	      			<label>支付金额  *</label>
	      			<input id="addVipPeriodPrice" name="price" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>支付时间  *</label>
	      			<p id="addVipPeriodPaymentDateTime">
		      			<input type="text" class="date" id="addVipPeriodPaymentDate" name="paymentDate"/>
	      				<input type="text" class="time" id="addVipPeriodPaymentTime" name="paymentTime"/>
	      			</p>
	      		</div>
	      		<div class="form-group">
	      			<label>会员有效期  *</label>
	      			<p>
		      			<input type="text" class="date" id="addVipPeriodStartDate" name="startDate"/> 到
		      			<input type="text" class="date" id="addVipPeriodEndDate" name="endDate"/>
	      			</p>
	      		</div>
	      		<div class="form-group">
	      			<label>备注  </label>
	      			<input id="addVipPeriodNote" name="note" class="form-control" type="text"/>
	      		</div>
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
	        <button type="button" class="btn btn-primary" id="addVipPeriodSubmit" onclick="addVipPeriod()">确定</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!-- Edit Vip Period Modal -->
	<div class="modal fade" id="editVipPeriodModal" tabindex="-1" role="dialog" aria-labelledby="editVipPeriodLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="editVipPeriodLabel">编辑正式会员注册记录</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="alert alert-danger" role="alert" id="errorEditVipPeriod"></div>
	        <form id="editVipPeriodForm" name="editVipPeriodForm" role="form" action="/admin/edit_vip_period" method="post">
	      		{{ csrf_field() }}
	      		<div class="form-group">
	      			<lable style="font-weight: bold">用户: <span id="editVipPeriodUserName"></span></lable>
	      			<input id="editVipPeriodUserId" name="userId" type="hidden"/>
	      			<input id="editVipPeriodId" name="vipPeriodId" type="hidden"/>
	      		</div>
	      		<div class="form-group">
	      			<label>支付方式  *</label>
	      			<select id="editVipPeriodPaymentTypeId" name="paymentTypeId" class="form-control">
	      				@foreach($paymentTypeList as $paymentType)
	      				<option value="{{ $paymentType->id }}">{{ $paymentType->name }}</option>
	      				@endforeach
	      			</select> 
	      		</div>
	      		<div class="form-group">
	      			<label>支付金额  *</label>
	      			<input id="editVipPeriodPrice" name="price" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>支付时间  *</label>
	      			<p id="editVipPeriodPaymentDateTime">
		      			<input type="text" class="date" id="editVipPeriodPaymentDate" name="paymentDate"/>
	      				<input type="text" class="time" id="editVipPeriodPaymentTime" name="paymentTime"/>
	      			</p>
	      		</div>
	      		<div class="form-group">
	      			<label>会员有效期  *</label>
	      			<p>
		      			<input type="text" class="date" id="editVipPeriodStartDate" name="startDate"/>到
		      			<input type="text" class="date" id="editVipPeriodEndDate" name="endDate"/>
	      			</p>
	      		</div>
	      		<div class="form-group">
	      			<label>备注  </label>
	      			<input id="editVipPeriodNote" name="note" class="form-control" type="text"/>
	      		</div>
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
	        <button type="button" class="btn btn-primary" id="editVipPeriodSubmit" onclick="editVipPeriod()">确定</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!--      Main Content          -->
	 <div class="row">
           	<div class="col-lg-12">
                <h1 class="page-header">用户</h1>
            </div>
     </div>
     		<div class="row" style="margin: 5px;">
     			<div class="col-lg-1 col-lg-offset-9 text-left"><label>VIP注册标准费用</label></div>
     			<div class="col-lg-1 text-center">{{ $standardVipPrice }}元</div>
     			<div class="col-lg-1"><button type="button" class="btn btn-default" onclick="editVipStandardPrice()"> 编辑</button></div>
     		</div>
            <div class="row" style="margin: 5px;">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                    	添加用户
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showEditUser()">
                    	编辑用户信息
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showVipPeriod()">
                    	正式会员注册记录
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showAddVipPeriod()">
                    	添加正式会员注册记录
                    </button>
                    <button type="button" class="btn btn-primary" onclick="editUserVipPrice()">
                    	修改用户vip注册费用
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
                                            <td id="userNameTD_{{ $user->id }}">{{ $user->name }}</td>
                                            <td id="userPhoneTD_{{ $user->id }}">{{ $user->phone }}</td>
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
            
            <div class="row vip_period_row" style="margin: 5px;">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" onclick="showEditVipPeriod()">
                    	编辑正式会员注册记录
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showDeleteVipPeriod()">
                    	删除正式会员注册记录
                    </button>
                </div>
            </div>
            <!-- /.row -->
            
            <div class="row vip_period_row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            	正式会员注册记录
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="vip_period_list">
                                    <thead>
                                        <tr>
                                        	<th></th>
                                            <th>ID</th>
                                            <th>用户名</th>
                                            <th>电话</th>
                                            <th>价格</th>
                                            <th>支付方式</th>
                                            <th>支付时间</th>
                                            <th>开始时间</th>
                                            <th>结束时间</th>
                                            <th>备注</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
	
	<!-- Date Time Picker -->
	<script src="{{ URL::asset('js/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ URL::asset('js/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js') }}"></script>
	<script src="{{ URL::asset('js/jquery-timepicker/jquery.timepicker.min.js') }}"></script>
	<script src="{{ URL::asset('js/datepair/datepair.min.js') }}"></script>
	<script src="{{ URL::asset('js/datepair/jquery.datepair.min.js') }}"></script>
	
    <script>
    var vipPeriodTable;
    
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

		// vip period table defination
    	
    	var columnDefArray_vipPeriod = [
							   { "width": "5%", 
								 "targets": 0, 
								 "orderable": false, 
								 "data": "id",
								 "render": function(data, type, full, meta){
												return '<input type="radio" name="vipPeriodRadio" value="' + data + '">'
											}
								},
    	    	               { "width": "5%", "targets": 1, "data": "id",},
    	    	               { "width": "10%", "targets": 2, "data": "userName",},
    	    	               { "width": "10%", "targets": 3, "data": "userPhone",},
    	    	               { "width": "10%", "targets": 4, "data": "price",},
    	    	               { "width": "10%", "targets": 5, "data": "paymentType",},
    	    	               { "width": "10%", "targets": 6, "data": "paymentTime",},
    	    	               { "width": "10%", "targets": 7, "data": "startDate",},
    	    	               { "width": "10%", "targets": 8, "data": "endDate",},
    	    	               { "width": "20%", "targets": 9, "data": "note",},
    	    	               ];
        
    	vipPeriodTable = initializeAjaxDataTable($('#vip_period_list'), columnDefArray_vipPeriod, 25, [[1, "desc"]]);
		
		$('#errorAddUser').hide();
		$('#errorEditUser').hide();
		$('#errorAddVipPeriod').hide();
		$('#errorEditVipPeriod').hide();

		$('.time').timepicker({
			'timeFormat': 'H:i',
			});

		$('.date').datepicker({ 
			'format': 'yyyy-mm-dd',
			'language': 'zh-CN',
			});
		
		$('#addVipPeriodPaymentDateTime').datepair();
		$('#editVipPeriodPaymentDateTime').datepair();

		$('.vip_period_row').hide();
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

	function showVipPeriod(){
		var checkedUser = $('input[name="userRadio"]:checked');
		if(checkedUser.length == 0){
			bootbox.alert('请选择用户');
		}else{
			var userId = checkedUser.val();

			vipPeriodTable.ajax.url('/admin/get_vip_period_table_data/' + userId).load();

			$('.vip_period_row').show();
		}
	}

	function showAddVipPeriod(){
		var checkedUser = $('input[name="userRadio"]:checked');
		if(checkedUser.length == 0){
			bootbox.alert('请选择用户');
		}else{
			var userId = checkedUser.val();
			var userName = $('#userNameTD_' + userId).text();
			var userPhone = $('#userPhoneTD_' + userId).text();
			
			$('#addVipPeriodUserId').val(userId);
			$('#addVipPeriodUser').text(userName + ' ' + userPhone);

			$('#addVipPeriodModal').modal();
		}
	}

	function addVipPeriod(){
		var result = validateAddVipPeriod();

        if(result){
        	$('#errorAddVipPeriod').hide();
        	$('#addVipPeriodForm').submit();
       	}else{
           	$('#errorAddVipPeriod').show();
       	}
	}

	function validateAddVipPeriod(){
		var paymentTypeId = $('#addVipPeriodPaymentTypeId').val();
		var price = $('#addVipPeriodPrice').val().trim();
		var paymentDate = $('#addVipPeriodPaymentDate').val().trim();
		var paymentTime = $('#addVipPeriodPaymentTime').val().trim();
		var startDate = $('#addVipPeriodStartDate').val().trim();
		var endDate = $('#addVipPeriodEndDate').val().trim();

		if(paymentTypeId == undefined || price == '' || paymentDate == '' || paymentTime == ''
			|| startDate == '' || endDate == ''){
			$('#errorAddVipPeriod').text('请填写必填项');
			return false;
		}

		if(price != '' && !$.isNumeric(price)){
			$('#errorAddVipPeriod').text('价格需为数字');
			return false;
		}

		return true;
	}

	function showEditVipPeriod(){
        var checkedVipPeriod = $('input[name="vipPeriodRadio"]:checked');
		if(checkedVipPeriod.length == 0){
			bootbox.alert('请选择注册记录');
		}else{
			var vipPeriodId = checkedVipPeriod.val();

			$.ajax({
				url: '/admin/get_vip_period_by_id/' + vipPeriodId,
				method: 'GET',
				dataType: 'JSON',
			}).done(function(response){
				if(response.status == 1){
					$('#editVipPeriodId').val(response.data.id);
					$('#editVipPeriodUserId').val(response.data.userId);
					$('#editVipPeriodUserName').text(response.data.userName + ' ' + response.data.userPhone);
					$('#editVipPeriodPaymentTypeId').val(response.data.paymentTypeId);
					$('#editVipPeriodPrice').val(response.data.price);
					
					var paymentDateTime = response.data.paymentDateTime.split(' ');
					
					$('#editVipPeriodPaymentDate').val(paymentDateTime[0]);
					$('#editVipPeriodPaymentTime').val(paymentDateTime[1]);

					$('#editVipPeriodStartDate').val(response.data.startDate);
					$('#editVipPeriodEndDate').val(response.data.endDate);
					
					$('#editVipPeriodNote').val(response.data.note);

					$('#editVipPeriodModal').modal();
				}
			});
		}
    }

	function editVipPeriod(){
		var result = validateEditVipPeriod();

        if(result){
        	$('#errorEditVipPeriod').hide();
        	$('#editVipPeriodForm').submit();
       	}else{
           	$('#errorEditVipPeriod').show();
       	}
	}

	function validateEditVipPeriod(){
		var paymentTypeId = $('#editVipPeriodPaymentTypeId').val();
		var price = $('#editVipPeriodPrice').val().trim();
		var paymentDate = $('#editVipPeriodPaymentDate').val().trim();
		var paymentTime = $('#editVipPeriodPaymentTime').val().trim();
		var startDate = $('#editVipPeriodStartDate').val().trim();
		var endDate = $('#editVipPeriodEndDate').val().trim();

		if(paymentTypeId == undefined || price == '' || paymentDate == '' || paymentTime == ''
			|| startDate == '' || endDate == ''){
			$('#errorEditVipPeriod').text('请填写必填项');
			return false;
		}

		if(price != '' && !$.isNumeric(price)){
			$('#errorEditVipPeriod').text('价格需为数字');
			return false;
		}

		return true;
	}

	function showDeleteVipPeriod(){
		var checkedVipPeriod = $('input[name="vipPeriodRadio"]:checked');
		if(checkedVipPeriod.length == 0){
			bootbox.alert('请选择注册记录');
		}else{
			var vipPeriodId = checkedVipPeriod.val();

			bootbox.confirm('确定要删除注册记录吗?', function(result){
				if(result){
					$.ajax({
						url: '/admin/delete_vip_period',
						method: 'POST',
						data: { 
								vipPeriodId: vipPeriodId,
								_token: "{{ csrf_token() }}",
								 },
						dataType: 'JSON',
					}).done(function(response){
						if(response.status == 1){
							location.reload();
						}
					});
				}
			});
		}
	}

	function editVipStandardPrice(){
		bootbox.prompt("VIP注册标准费用", function(result) {
			if(result == null){
				return;
			}else if(!$.isNumeric(result)){
				bootbox.alert('费用只能是数字');
			}else{
				$.ajax({
					url: '/admin/update_vip_standard_price',
					method: 'POST',
					data: { 
							price: result,
							_token: "{{ csrf_token() }}",
							 },
					dataType: 'JSON',
				}).done(function(response){
					if(response.status == 1){
						location.reload();
					}else{
						bootbox.alert('更新失败');
					}
				});
			}
		});
	}

	function editUserVipPrice(){
		var checkedUser = $('input[name="userRadio"]:checked');
		if(checkedUser.length == 0){
			bootbox.alert('请选择用户');
		}else{
			var userId = checkedUser.val();
			
			bootbox.prompt("VIP注册费用(2小时内有效)", function(result) {
				if(result == null){
					return;
				}else if(!$.isNumeric(result)){
					bootbox.alert('费用只能是数字');
				}else{
					$.ajax({
						url: '/admin/update_user_vip_price',
						method: 'POST',
						data: { 
								price: result,
								userId: userId,
								_token: "{{ csrf_token() }}",
								 },
						dataType: 'JSON',
					}).done(function(response){
						if(response.status == 1){
							bootbox.alert('修改成功(2小时有效)');
						}else{
							bootbox.alert('更新失败');
						}
					});
				}
			});
		}
	}

    </script>
@endsection
