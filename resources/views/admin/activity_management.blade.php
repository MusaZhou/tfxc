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
	
	<!-- Add Activity Order Modal -->
	<div class="modal fade" id="addActivityOrderModal" tabindex="-1" role="dialog" aria-labelledby="addActivityOrderLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="addActivityOrderLabel">添加活动报名</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="alert alert-danger" role="alert" id="errorAddActivityOrder"></div>
	        <form id="addActivityOrderForm" name="addActivityOrderForm" role="form" action="/admin/add_activity_order" method="post">
	      		{{ csrf_field() }}
	      		<div class="form-group">
	      			<lable style="font-weight: bold">活动名称: <span id="addActivityOrderActivityName"></span></lable>
	      			<input id="addActivityOrderActivityId" name="activityId" type="hidden"/>
	      		</div>
	      		<div class="form-group">
	      			<label>用户 *</label>
	      			<select id="addActivityOrderUserId" name="userId" class="form-control">
	      				@foreach($userList as $user)
	      				<option value="{{ $user->id }}">{{ $user->id.'.'.$user->name.'.'.$user->phone }}</option>
	      				@endforeach
	      			</select>
	      		</div>
	      		<div class="form-group">
	      			<label>支付方式  *</label>
	      			<select id="addActivityOrderPaymentTypeId" name="paymentTypeId" class="form-control">
	      				@foreach($paymentTypeList as $paymentType)
	      				<option value="{{ $paymentType->id }}">{{ $paymentType->name }}</option>
	      				@endforeach
	      			</select> 
	      		</div>
	      		<div class="form-group">
	      			<label>支付金额  *</label>
	      			<input id="addActivityOrderPrice" name="price" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>支付时间  *</label>
	      			<p>
		      			<input type="text" class="date" id="addActivityOrderPaymentDate" name="paymentDate"/>
	      				<input type="text" class="time" id="addActivityOrderPaymentTime" name="paymentTime"/>
	      			</p>
	      		</div>
	      		<div class="form-group">
	      			<label>备注  </label>
	      			<input id="addActivityOrderNote" name="note" class="form-control" type="text"/>
	      		</div>
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
	        <button type="button" class="btn btn-primary" id="addActivityOrderSubmit" onclick="addActivityOrder()">确定</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!-- Edit Activity Order Modal -->
	<div class="modal fade" id="editActivityOrderModal" tabindex="-1" role="dialog" aria-labelledby="editActivityOrderLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="editActivityOrderLabel">编辑活动报名</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="alert alert-danger" role="alert" id="errorEditActivityOrder"></div>
	        <form id="editActivityOrderForm" name="editActivityOrderForm" role="form" action="/admin/edit_activity_order" method="post">
	      		{{ csrf_field() }}
	      		<div class="form-group">
	      			<lable style="font-weight: bold">活动名称: <span id="editActivityOrderActivityName"></span></lable>
	      			<input id="editActivityOrderActivityId" name="activityId" type="hidden"/>
	      			<input id="editActivityOrderId" name="activityOrderId" type="hidden"/>
	      		</div>
	      		<div class="form-group">
	      			<label>用户 *</label>
	      			<select id="editActivityOrderUserId" name="userId" class="form-control">
	      				@foreach($userList as $user)
	      				<option value="{{ $user->id }}">{{ $user->id.'.'.$user->name.'.'.$user->phone }}</option>
	      				@endforeach
	      			</select>
	      		</div>
	      		<div class="form-group">
	      			<label>支付方式  *</label>
	      			<select id="editActivityOrderPaymentTypeId" name="paymentTypeId" class="form-control">
	      				@foreach($paymentTypeList as $paymentType)
	      				<option value="{{ $paymentType->id }}">{{ $paymentType->name }}</option>
	      				@endforeach
	      			</select> 
	      		</div>
	      		<div class="form-group">
	      			<label>支付金额  *</label>
	      			<input id="editActivityOrderPrice" name="price" class="form-control" type="text"/>
	      		</div>
	      		<div class="form-group">
	      			<label>支付时间  *</label>
	      			<p>
		      			<input type="text" class="date" id="editActivityOrderPaymentDate" name="paymentDate"/>
	      				<input type="text" class="time" id="editActivityOrderPaymentTime" name="paymentTime"/>
	      			</p>
	      		</div>
	      		<div class="form-group">
	      			<label>备注  </label>
	      			<input id="editActivityOrderNote" name="note" class="form-control" type="text"/>
	      		</div>
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
	        <button type="button" class="btn btn-primary" id="editActivityOrderSubmit" onclick="editActivityOrder()">确定</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<!-- Edit User Activity Price Modal -->
	<div class="modal fade" id="editUserActivityPriceModal" tabindex="-1" role="dialog" aria-labelledby="editUserActivityPriceLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="editUserActivityPriceLabel">修改用户活动价格</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="alert alert-danger" role="alert" id="errorEditUserActivityPrice"></div>
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
                                            <th>单位</th>
                                            <th>微信昵称</th>
                                            <th>邮箱</th>
                                            <th>会员</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach ( $userList as $user)
                                        <tr>
                                        	<td><input type="radio" name="userRadio" value="{{$user->id}}"></td>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->organization }}</td>
                                            <td>{{ $user->wechat_name }}</td>
                                            <th>{{ $user->email }}</th>
                                            <td>{{ $user->isVip() ? '是' : '否' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
	      	</div>
	      	<div class="row">
	      		<div class="col-lg-2">
	      			<label>标准价格:<span class="text-success" id="standardActivityPriceUser">100元</span></label>
	      		</div>
	      		<div class="col-lg-2">
	      			<label>修改为:</label>
	      		</div>
	      		<div class="col-lg-2">
	      			<input type="text" class="form-control" id="userActivityPrice" name="userActivityPrice" placeholder="0.00">
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
	        <button type="button" class="btn btn-primary" id="editUserActivityPriceSubmit" onclick="editUserActivityPrice()">确定</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!--      Main Content          -->
	 <div class="row">
           	<div class="col-lg-12">
                <h1 class="page-header">活动</h1>
            </div>
     </div>
            <div class="row" style="margin: 5px;">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" onclick="showAddActivity()">
                    	添加活动
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showEditActivity()">
                    	编辑活动信息
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showDeleteActivity()">
                    	删除活动
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showActivityOrder()">
                    	报名信息
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showAddActivityOrder()">
                    	添加活动报名
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showChangeUserActivityPrice()">
                    	修改用户活动价格
                    </button>
                </div>
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            	活动列表
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="activity_list">
                                    <thead>
                                        <tr>
                                        	<th></th>
                                            <th>ID</th>
                                            <th>名称</th>
                                            <th>描述</th>
                                            <th>价格</th>
                                            <th>开始时间</th>
                                            <th>结束时间</th>
                                            <th>地址</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach ( $activityList as $activity)
                                        <tr>
                                        	<td><input type="radio" name="activityRadio" value="{{$activity->id}}"></td>
                                            <td>{{ $activity->id }}</td>
                                            <td id="activityNameTD_{{ $activity->id }}">{{ $activity->name }}</td>
                                            <td>{{ $activity->description }}</td>
                                            <td id="activityPriceTD_{{ $activity->id }}">{{ $activity->price }}</td>
                                            <td>{{ $activity->start_time }}</td>
                                            <td>{{ $activity->end_time }}</td>
                                            <td>{{ $activity->address }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row activity_order_row" style="margin: 5px;">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary" onclick="showEditActivityOrder()">
                    	编辑活动报名
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showDeleteActivityOrder()">
                    	删除活动报名
                    </button>
                </div>
            </div>
            <!-- /.row -->
            
            <div class="row activity_order_row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            	活动报名列表
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="activity_order_list">
                                    <thead>
                                        <tr>
                                        	<th></th>
                                            <th>ID</th>
                                            <th>活动名称</th>
                                            <th>姓名</th>
                                            <th>电话</th>
                                            <th>价格</th>
                                            <th>支付方式</th>
                                            <th>支付时间</th>
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
    var activityOrderTable;
    var selectedActivityId;
    
    $(function() {
        // activity table defination
        var columnDefArray_activity = [
							   { "width": "5%", "targets": 0, "orderable": false,},
    	    	               { "width": "5%", "targets": 1},
    	    	               { "width": "20%", "targets": 2},
    	    	               { "width": "20%", "targets": 3},
    	    	               { "width": "10%", "targets": 4},
    	    	               { "width": "10%", "targets": 5},
    	    	               { "width": "10%", "targets": 6},
    	    	               { "width": "20%", "targets": 7},
    	    	               ];
        
    	initializeDataTable($('#activity_list'), columnDefArray_activity, 25, [[1, "desc"]]);

    	// activity order table defination
    	
    	var columnDefArray_activityOrder = [
							   { "width": "5%", 
								 "targets": 0, 
								 "orderable": false, 
								 "data": "id",
								 "render": function(data, type, full, meta){
												return '<input type="radio" name="activityOrderRadio" value="' + data + '">'
											}
								},
    	    	               { "width": "5%", "targets": 1, "data": "id",},
    	    	               { "width": "20%", "targets": 2, "data": "activityName",},
    	    	               { "width": "10%", "targets": 3, "data": "userName",},
    	    	               { "width": "10%", "targets": 4, "data": "userPhone",},
    	    	               { "width": "10%", "targets": 5, "data": "price",},
    	    	               { "width": "10%", "targets": 6, "data": "paymentType",},
    	    	               { "width": "10%", "targets": 7, "data": "paymentTime",},
    	    	               { "width": "20%", "targets": 8, "data": "note",},
    	    	               ];
        
    	activityOrderTable = initializeAjaxDataTable($('#activity_order_list'), columnDefArray_activityOrder, 25, [[1, "desc"]]);

		var columnDefArray_userList = [
		                               {"width": "10%", "targets": 0},
		                               {"width": "5%", "targets": 1},
		                               {"width": "10%", "targets": 2},
		                               {"width": "15%", "targets": 3},
		                               {"width": "15%", "targets": 4},
		                               {"width": "15%", "targets": 5},
		                               {"width": "20%", "targets": 6},
		                               {"width": "10%", "targets": 7},
		                               ];
        
		initializeDataTable($('#user_list'), columnDefArray_userList, 5, [[1, "asc"]], false);
		
		$('#errorAddActivityOrder').hide();
		$('#errorEditActivityOrder').hide();
		$('#errorEditUserActivityPrice').hide();

		$('.time').timepicker({
			'timeFormat': 'H:i',
			});

		$('.date').datepicker({ 
			'format': 'yyyy-mm-dd',
			'language': 'zh-CN',
			});

		$('.activity_order_row').hide();
    });

	function showEditActivity(){
        var checkedActivity = $('input[name="activityRadio"]:checked');
		if(checkedActivity.length == 0){
			bootbox.alert('请选择活动');
		}else{
			var activityId = checkedActivity.val();
			location.href = "/admin/show_edit_activity/" + activityId; 
		}
    }

	function showDeleteActivity(){
		var checkedActivity = $('input[name="activityRadio"]:checked');
		if(checkedActivity.length == 0){
			bootbox.alert('请选择活动');
		}else{
			var activityId = checkedActivity.val();

			bootbox.confirm('确定要删除活动吗?', function(result){
				if(result){
					$.ajax({
						url: '/admin/delete_activity',
						method: 'POST',
						data: { 
								activityId: activityId,
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

	function showActivityOrder(){
		var checkedActivity = $('input[name="activityRadio"]:checked');
		if(checkedActivity.length == 0){
			bootbox.alert('请选择活动');
		}else{
			var activityId = checkedActivity.val();

			activityOrderTable.ajax.url('/admin/get_activity_order_table_data/' + activityId).load();

			$('.activity_order_row').show();
		}
	}

	function showAddActivityOrder(){
		var checkedActivity = $('input[name="activityRadio"]:checked');
		if(checkedActivity.length == 0){
			bootbox.alert('请选择活动');
		}else{
			var activityId = checkedActivity.val();
			var activityName = $('#activityNameTD_' + activityId).text();
			
			$('#addActivityOrderActivityId').val(activityId);
			$('#addActivityOrderActivityName').text(activityName);

			$('#addActivityOrderModal').modal();
		}
	}

	function addActivityOrder(){
		var result = validateAddActivityOrder();

        if(result){
        	$('#errorAddActivityOrder').hide();
        	$('#addActivityOrderForm').submit();
       	}else{
           	$('#errorAddActivityOrder').show();
       	}
	}

	function validateAddActivityOrder(){
		var userId = $('#addActivityOrderUserId').val();
		var paymentTypeId = $('#addActivityOrderPaymentTypeId').val();
		var price = $('#addActivityOrderPrice').val().trim();
		var paymentDate = $('#addActivityOrderPaymentDate').val().trim();
		var paymentTime = $('#addActivityOrderPaymentTime').val().trim();

		if(userId == undefined || paymentTypeId == undefined || price == '' || paymentDate == '' || paymentTime == ''){
			$('#errorAddActivityOrder').text('请填写必填项');
			return false;
		}

		if(price != '' && !$.isNumeric(price)){
			$('#errorAddActivityOrder').text('价格需为数字');
			return false;
		}

		return true;
	}

	function showEditActivityOrder(){
        var checkedActivityOrder = $('input[name="activityOrderRadio"]:checked');
		if(checkedActivityOrder.length == 0){
			bootbox.alert('请选择活动报名');
		}else{
			var activityOrderId = checkedActivityOrder.val();

			$.ajax({
				url: '/admin/get_activity_order_by_id/' + activityOrderId,
				method: 'GET',
				dataType: 'JSON',
			}).done(function(response){
				if(response.status == 1){
					$('#editActivityOrderId').val(response.data.id);
					$('#editActivityOrderActivityId').val(response.data.activityId);
					$('#editActivityOrderActivityName').text(response.data.activityName);
					$('#editActivityOrderUserId').val(response.data.userId);
					$('#editActivityOrderPaymentTypeId').val(response.data.paymentTypeId);
					$('#editActivityOrderPrice').val(response.data.price);
					
					var paymentDateTime = response.data.paymentDateTime.split(' ');
					
					$('#editActivityOrderPaymentDate').val(paymentDateTime[0]);
					$('#editActivityOrderPaymentTime').val(paymentDateTime[1]);
					
					$('#editActivityOrderNote').val(response.data.note);

					$('#editActivityOrderModal').modal();
				}
			});
		}
    }

	function editActivityOrder(){
		var result = validateEditActivityOrder();

        if(result){
        	$('#errorEditActivityOrder').hide();
        	$('#editActivityOrderForm').submit();
       	}else{
           	$('#errorEditActivityOrder').show();
       	}
	}

	function validateEditActivityOrder(){
		var userId = $('#editActivityOrderUserId').val();
		var paymentTypeId = $('#editActivityOrderPaymentTypeId').val();
		var price = $('#editActivityOrderPrice').val().trim();
		var paymentDate = $('#editActivityOrderPaymentDate').val().trim();
		var paymentTime = $('#editActivityOrderPaymentTime').val().trim();

		if(userId == undefined || paymentTypeId == undefined || price == '' || paymentDate == '' || paymentTime == ''){
			$('#errorEditActivityOrder').text('请填写必填项');
			return false;
		}

		if(price != '' && !$.isNumeric(price)){
			$('#errorEditActivityOrder').text('价格需为数字');
			return false;
		}

		return true;
	}

	function showDeleteActivityOrder(){
		var checkedActivityOrder = $('input[name="activityOrderRadio"]:checked');
		if(checkedActivityOrder.length == 0){
			bootbox.alert('请选择活动');
		}else{
			var activityOrderId = checkedActivityOrder.val();

			bootbox.confirm('确定要删除活动吗?', function(result){
				if(result){
					$.ajax({
						url: '/admin/delete_activity_order',
						method: 'POST',
						data: { 
								activityOrderId: activityOrderId,
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

	function showAddActivity(){
		location.href="/admin/show_add_activity";
	}

	function showChangeUserActivityPrice(){
		var checkedActivity = $('input[name="activityRadio"]:checked');
		if(checkedActivity.length == 0){
			bootbox.alert('请选择活动');
		}else{
			selectedActivityId = checkedActivity.val();
			var activityStandardPrice = $('#activityPriceTD_' + selectedActivityId).text().trim();
			$('#standardActivityPriceUser').text(activityStandardPrice + '元');
			$('#editUserActivityPriceModal').modal();
		}
		
	}

	function editUserActivityPrice(){
		var changePrice = $('#userActivityPrice').val().trim();
		var checkedUser = $('input[name="userRadio"]:checked');
		if(checkedUser.length == 0){
			bootbox.alert('请选择用户');
		}else if(changePrice == '' || !$.isNumeric(changePrice) || changePrice < 0.1){
			bootbox.alert('价格必须是数字');
		}else{
			userId = checkedUser.val();
		}
	}
    </script>
@endsection
