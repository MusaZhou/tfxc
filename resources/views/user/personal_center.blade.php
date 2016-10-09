<!DOCTYPE html>
<html lang="zh">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>天方信诚-会员中心</title>

		<!-- Bootstrap Core CSS -->
		<link href="{{ URL::asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

		<!-- Custom Fonts -->
		<link href="{{ URL::asset('css/font-awesome/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
		
		<!-- DataTables CSS -->
		<link href="{{ URL::asset('css/dataTables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">

		<!-- DataTables Responsive CSS -->
		<link href="{{ URL::asset('css/dataTables/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css">
		
		<style>
			.dataTables_wrapper {
									position: relative;
									clear: both;
									margin: 10px;
								}
		</style>
	</head>

	<body>
		<nav class="navbar navbar-default">
		  <div class="container-fluid bg-primary">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tfxc-navbar-collapse" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar">a</span>
				<span class="icon-bar">b</span>
				<span class="icon-bar">c</span>
			  </button>
			  <a class="navbar-brand" href="#" style="font-size: 2em; font-weight: bold;color: white">天方信诚 - 会员中心</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="tfxc-navbar-collapse">
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="/" style="color: white">官网</a></li>
				<li><a href="/user/logout" style="color: white">退出账户</a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		
		<!-- edit profile -->
		<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="editProfileLabel">编辑个人信息</h4>
			  </div>
			  <div class="modal-body">
				<div class="alert alert-danger" role="alert" id="errorEditProfile"></div>
				<form id="editProfileForm" name="editProfileForm" role="form" action="/user/update_profile" method="post">
					{{ csrf_field() }}
					<div class="form-group">
						<label>姓名 *</label>
						<input id="profileName" name="name" class="form-control" value="{{ $user->name }}"/>
					</div>
					<div class="form-group">
						<label>电话 *</label>
						<input id="profilePhone" name="phone" class="form-control" value="{{ $user->phone }}"/>
					</div>
					<div class="form-group">
						<label>邮箱 *</label>
						<input id="profileEmail" name="email" class="form-control" value="{{ $user->email }}"/>
					</div>
					@if($user->isVip())
					<div class="form-group">
						<label>职位</label>
						<input id="profileJob" name="job" class="form-control" value="{{ $user->job }}"/>
					</div>
					<div class="form-group">
						<label>单位</label>
						<input id="profileOrganization" name="organization" class="form-control" value="{{ $user->organization }}"/>
					</div>
					<div class="form-group">
						<label>驻地</label>
						<input id="profileLocation" name="location" class="form-control" value="{{ $user->location }}"/>
					</div>
					<div class="form-group">
						<label>性别</label>
						<select id="profileGender" name="gender" class="form-control">
							<option value="1">男</option>
							<option value="2">女</option>
						</select>
					</div>
					@endif
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary" id="editProfileSubmit" onclick="updateProfile()">确定</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- change password modal-->
		<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="changePasswordLabel">修改登录密码</h4>
			  </div>
			  <div class="modal-body">
				<div class="alert alert-danger" role="alert" id="errorChangePassword"></div>
				<form id="changePasswordForm" name="changePasswordForm" role="form" action="/user/update_password" method="post">
					{{ csrf_field() }}
					<input id="userId" name="userId" type="hidden"/>
					<div class="form-group">
						<label>旧密码 *</label>
						<input type="password" id="oldPassword" name="oldPassword" class="form-control"/>
					</div>
					<div class="form-group">
						<label>新密码 *</label>
						<input type="password" id="newPassword" name="newPassword" class="form-control"/>
					</div>
					<div class="form-group">
						<label>再次输入新密码 *</label>
						<input type="password" id="confirmNewPassword" name="confirmNewPassword" class="form-control"/>
					</div>
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary" id="changePasswordSubmit" onclick="updatePassword()">确定</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- apply vip user modal -->
		<div class="modal fade" id="applyVipUserModal" tabindex="-1" role="dialog" aria-labelledby="applyVipUserLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">申请正式会员</h4>
			  </div>
			  <div class="modal-body">
				<div class="alert alert-danger" role="alert" id="errorApplyVipUser"></div>
				<form id="applyVipUserForm" name="applyVipUserForm" role="form" action="/user/apply_vip_user" method="post">
					{{ csrf_field() }}
					<input id="userId" name="userId" type="hidden"/>
					<div class="form-group">
						<label>职位 *</label>
						<input id="vipJob" name="job" class="form-control"/>
					</div>
					<div class="form-group">
						<label>单位 *</label>
						<input id="vipOrganization" name="organization" class="form-control"/>
					</div>
					<div class="form-group">
						<label>驻地 *</label>
						<input id="vipLocation" name="location" class="form-control"/>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-lg-4 col-md-4 text-left">
								<label>支付金额(<span id="vip_register_price" class="text-danger">{{ $vipPrice }}</span>元)</label>
							</div>
							<div class="col-lg-2 col-md-2 col-lg-offset-6 col-md-offset-6">
								<button class="btn btn-primary" onclick="readyPayVipRegistration(event)">支付</button>
							</div>
						</div>
						<div class="row vipPayRow" style="margin-top: 10px;">
							<div class="col-lg-3 col-md-3">
								<img src="{{ URL::asset('images/WePayLogo.png') }}" style="width: 100%;">
							</div>
							<div class="col-lg-6 col-md-6" id="vipQRImageRow">
								<!--  <img id="wepayVipQRImage" src="" class="img-rounded" style="width: 100%;">-->
							</div>
							<div class="col-lg-3 col-md-3">
								<button class="btn btn-primary" onclick="finishPay()">支付已完成</button>
							</div>
						</div>
						<div class="row vipPayRow">
							<div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
								<img src="{{ URL::asset('images/wepay_scan_description.png') }}" style="width: 100%;">
							</div>
						</div>
					</div>
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
<!-- 				<button type="button" class="btn btn-primary" id="applyVipUserSubmit">确定</button> -->
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- activity detail modal -->
		<div class="modal fade" id="activityDetailModal" tabindex="-1" role="dialog" aria-labelledby="activityDetailLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-center" id="activityDetailTitle">宁夏中阿金融论坛</h4>
			  </div>
			  <div class="modal-body">
				<div class="alert alert-danger" role="alert" id="errorActivityDetail"></div>
				<div>
					<input type="hidden" id="activityDetailId">
					<div id="activityDetailContent" class="center-block" style="height:500px; overflow-y: auto; word-wrap: break-word;">
					</div>
					<div class="row priceRow">
						<div class="col-lg-4 col-md-4 text-left">
							<label>支付金额(<span id="activityDetailPrice" class="text-danger"></span>元)</label>
						</div>
						<div class="col-lg-2 col-md-2 col-lg-offset-6 col-md-offset-6">
							<button class="btn btn-primary" onclick="readyPayActivity(event)">支付</button>
						</div>
					</div>
					<div class="row activityPayRow" style="margin-top: 10px;">
						<div class="col-lg-3 col-md-3">
							<img src="{{ URL::asset('images/WePayLogo.png') }}" style="width: 100%;">
						</div>
						<div class="col-lg-6 col-md-6" id="activityQRImageRow">
						</div>
						<div class="col-lg-3 col-md-3">
							<button class="btn btn-primary" onclick="finishPay()">支付已完成</button>
						</div>
					</div>
					<div class="row activityPayRow">
						<div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
							<img src="{{ URL::asset('images/wepay_scan_description.png') }}" style="width: 100%;">
						</div>
					</div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
<!-- 				<button type="button" class="btn btn-primary" id="subscribeActivitySubmit">确定</button> -->
			  </div>
			</div>
		  </div>
		</div>
	
		<div id="wrapper" class="container-fluid">
			<!-- row 1: current activity and profile-->
			<div class="row">
				<div class="col-lg-7 col-md-7">
					<div class="panel panel-primary"style="margin-top: 100px">
					  <div class="panel-heading">
						 <h3 class="panel-title">当前活动</h3>
					  </div>
						  <!--<div class="dataTable_wrapper">-->
							  <table class="table table-striped table-bordered table-hover" id="current_activities_table">
								<thead>
									<tr>
										<th>ID</th>
										<th>活动名称</th>
										<th>时间</th>
										<th>地点</th>
										<th>详情</th>
									</tr>
								</thead>
								<tbody>
									@foreach($activityList as $activity)
									<?php
											$startDate = (new DateTime($activity->start_time))->format('Y-m-d');
											$city = $activity->city;
											//$province = $city->province;
									?>
									<tr>
										<td>{{ $activity->id }}</td>
										<td>{{ $activity->name }}</td>
										<td>{{ $startDate }}</td>
										<td>{{ $city->name }}</td>
										<td><a class="btn btn-primary" onclick="viewActivityDetail({{ $activity->id }}, false)">详情</a></td> 
									</tr>
									@endforeach
								</tbody>
							</table>
						<!--</div>-->
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-md-offset-1 col-lg-offset-1">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="row">
								<div class="col-lg-12 col-md-12 text-left">
									<h1>{{ $user->name }}</h1>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-md-12 text-left">
									<h3>{{ $user->phone }}</h3>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-md-12 text-left">
									<h4>{{ $user->email }}</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-md-4 text-right">
									<h4>编号</h4>
								</div>
								<div class="col-lg-8 col-md-8 text-left">
									<h4>{{ $user->id }}</h4>
								</div>
							</div>
							@if($user->isVip())
							<div class="row">
								<div class="col-lg-4 col-md-4 text-right">
									<h4>职位</h4>
								</div>
								<div class="col-lg-8 col-md-8 text-left">
									<h4>{{ $user->job }}</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-md-4 text-right">
									<h4>单位</h4>
								</div>
								<div class="col-lg-8 col-md-8 text-left">
									<h4>{{ $user->organization }}</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-md-4 text-right">
									<h4>驻地</h4>
								</div>
								<div class="col-lg-8 col-md-8 text-left">
									<h4>{{ $user->location }}</h4>
								</div>
							</div>
<!-- 							<div class="row"> -->
<!-- 								<div class="col-lg-4 col-md-4 text-right"> -->
<!-- 									<h4>性别</h4> -->
<!-- 								</div> -->
<!-- 								<div class="col-lg-8 col-md-8 text-left"> -->
<!-- 									<h4>{{ $user->gender == 1 ? '男' : '女' }}</h4> -->
<!-- 								</div> -->
<!-- 							</div> -->
							<?php 
								$currentVipPeriod = $user->currentVipPeriod();
							?>
							<div class="row">
								<div class="col-lg-4 col-md-4 text-right">
									<h4>会员</h4>
								</div>
								<div class="col-lg-8 col-md-8 text-left">
									<h4>{{ $currentVipPeriod->start_date.' ~ '.$currentVipPeriod->end_date }}</h4>
								</div>
							</div>
							@endif
						</div>
						<div class="col-lg-5 col-md-5" style="margin-top: 10px">
							<div class="row" style="margin-top: 5px">
								@if(starts_with($user->head_image_url, 'http'))
									<img src="{{ $user->head_image_url }}" class="img-rounded img-responsive center-block" style="width: 100%; height: auto;" id="headImage">
								@else
									<img src="/image_download/{{ $user->head_image_url }}" class="img-rounded img-responsive center-block" style="width: 100%; height: auto;" id="headImage">
								@endif
							</div>
							<div class="row" id="headImageProgressRow">
								<div class="progress">
								  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
								    <span class="sr-only">100% Complete</span>
								  </div>
								</div>
							</div>
							<div class="row" style="margin-top: 5px">
								<button type="button" class="btn btn-primary btn-block" onclick="openImageBrowser()">编辑头像</button>
								<input type="file" name="headImageFile" id="headImageFile" style="display:none">
							</div>
							<div class="row" style="margin-top: 5px">
								<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editProfileModal">编辑个人信息</button>
							</div>
							<div class="row" style="margin-top: 5px">
								<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#changePasswordModal">修改登录密码</button>
							</div>
							@if(!$user->isVip())
							<div class="row" style="margin-top: 5px">
								<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#applyVipUserModal">注册正式会员</button>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
			
			<!-- row 2: my activities -->
			<div class="row">
				<div class="col-lg-8 col-md-8">
					<div class="panel panel-primary">
					  <div class="panel-heading">
						 <h3 class="panel-title">我参加的活动</h3>
					  </div>
					  <div class="panel-body">
						  <div class="dataTable_wrapper">
								<table class="table table-striped table-bordered table-hover" id="my_activities_table">
									<thead>
										<tr>
											<th>ID</th>
											<th>活动名称</th>
											<th>时间</th>
											<th>地点</th>
											<th>价格</th>
											<th>报名时间</th>
											<th>活动详情</th>
											<th>活动状态</th>
										</tr>
									</thead>
									<tbody>
										@foreach($myActivityList as $myActivity)
										<?php 
											//$startDate = (new DateTime($myActivity->start_time))->format('Y-m-d');
											$activityOrder = $user->getActivityOrder($myActivity->id);
											error_log('order id:'.$activityOrder->id);
											$paymentDate = (new DateTime($activityOrder->payment_time))->format('Y-m-d');
											$city = $myActivity->city;
											//$province = $city->province;
											$startTime = $myActivity->start_time;
											$endTime = $myActivity->end_time;
											$now = date('Y-m-d H:i:s');
											
											error_log('city:'.$city->name);
										?>
										<tr>
											<td>{{ $myActivity->id }}</td>
											<td>{{ $myActivity->name }}</td>
											<td>{{ $myActivity->start_time }}</td>
											<td>{{ $city->name }}</td>
											<td>{{ $activityOrder->price }}元</td>
											<td>{{ $paymentDate }}</td>
											<td><a class="btn btn-primary" onclick="viewActivityDetail({{ $myActivity->id }}, true)">详情</a></td> 
											<td>{{ $startTime > $now ? '即将开始' : ( $endTime > $now ? '正在进行' : '已经结束') }}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- jQuery -->
		<script src="{{ URL::asset('js/jquery/jquery.min.js') }}"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script>
		
		<!-- bootbox -->
		<script src="{{ URL::asset('js/bootbox/bootbox.min.js') }}"></script>
		
		<!-- DataTables JavaScript -->
		<script src="{{ URL::asset('js/dataTables/jquery.dataTables.min.js') }}"></script>
		<script src="{{ URL::asset('js/dataTables/dataTables.bootstrap.min.js') }}"></script>
		
		<!-- Utilities -->
		<script src="{{ URL::asset('js/util.js') }}"></script>
		
		<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}});
		</script>
		
		<script>
			var gender = {{ $user->gender or 1}};
			var oldPasswordCheck = false;
			
			$(function(){
				$('.current_activities_table').DataTable({
						"autoWidth": false,
						"columnDefs": [
								   { "width": "5%", "targets": 0},
								   { "width": "45%", "targets": 1},
								   { "width": "20%", "targets": 2},
								   { "width": "20%", "targets": 3},
								   { "width": "10%", "targets": 4},
								   ],
						responsive: true,
						"paging": false,
						"order": [[0, "asc"]],
						"searching": false,
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
				
				var columnDefs = [
								   { "width": "5%", "targets": 0},
								   { "width": "30%", "targets": 1},
								   { "width": "15%", "targets": 2},
								   { "width": "10%", "targets": 3},
								   { "width": "10%", "targets": 4},
								   { "width": "10%", "targets": 5},
								   { "width": "10%", "targets": 6},
								   { "width": "10%", "targets": 7},
							   ];
							   
				initializeDataTable($('#my_activities_table'), columnDefs, 5, [[1, "desc"]]);
				
				$('#errorEditProfile').hide();
				$('#errorChangePassword').hide();
				$('#errorApplyVipUser').hide();
				$('#errorActivityDetail').hide();
				$('#headImageProgressRow').hide();
				$('.vipPayRow').hide();
				$('.activityPayRow').hide();

				$('#profileGender').val(gender);
				$('#profileGender').change();

				$('#oldPassword').blur(function(){
					var oldPassword = $('#oldPassword').val().trim();
					if(oldPassword == ''){
						return;
					}

					$.ajax({
							url: '/user/check_password',
							method: 'POST',
							data: {
									password: oldPassword,
									_token: '{{ csrf_token() }}', 
									}
					}).done(function(response){
						if(response.status == 1){
							oldPasswordCheck = true;
							$('#errorChangePassword').hide();
						}else{
							oldPasswordCheck = false;
							$('#errorChangePassword').text('旧密码不正确');
							$('#errorChangePassword').show();
						}
					});
				});

				$('#headImageFile').change(function(){
					var imageElement = $('#headImage');
					var progressBarElement = $('#headImageProgressRow');
					var files = this.files;
					var fileSize = 5 * 1024 * 1024; // 5MB

					var result = previewAndUploadImage(files, fileSize, imageElement, progressBarElement, 'headImage', '{{ csrf_token() }}', '/user/upload_head_image');
					if(result != null && result !== undefined){
						result.done(function(response){
							if(response != 1){
								bootbox.alert('图片上传失败');
							}else{
								progressBarElement.hide();
							}
						}).fail(function(response){
							bootbox.alert('图片上传失败');
						});
					}
				});
			});

			function updateProfile(){
				if(validateProfile()){
					$('#errorEditProfile').hide();
					$('#editProfileForm').submit();
				}else{
					$('#errorEditProfile').show();
				}
			}

			function validateProfile(){
				var name = $('#profileName').val().trim();
				var phone = $('#profilePhone').val().trim();
				var email = $('#profileEmail').val().trim();

				if(name == '' || phone == '' || email == ''){
					$('#errorEditProfile').text('请完成必填项');
					return false;
				}

				return true;
			}

			function updatePassword(){
				if(validatePassword()){
					$('#errorChangePassword').hide();
					$('#changePasswordForm').submit();
				}else{
					$('#errorChangePassword').show();
				}
			}

			function validatePassword(){
				var oldPassword = $('#oldPassword').val().trim();
				var newPassword = $('#newPassword').val().trim();
				var confirmNewPassword = $('#confirmNewPassword').val().trim();

				if(oldPassword == '' || newPassword == '' || confirmNewPassword == ''){
					$('#errorChangePassword').text('请完成必填项');
					return false;
				}

				if(!oldPasswordCheck){
					$('#errorChangePassword').text('旧密码不正确');
					return false;
				}

				if(newPassword != confirmNewPassword){
					$('#errorChangePassword').text('两次新密码输入不一致');
					return false;
				}

				return true;
			}

			function openImageBrowser(){
				$('#headImageFile').click();
			}

			function readyPayVipRegistration(event){
				var job = $('#vipJob').val().trim();
				var organization = $('#vipOrganization').val().trim();
				var location = $('#vipLocation').val().trim();

				if(job == '' || organization == '' || location == ''){
					$('#errorApplyVipUser').text('请完成必填项');
					$('#errorApplyVipUser').show();
				}else{
					$('#errorApplyVipUser').hide();
					$.ajax({
						url: '/user/wepay_prepare_vip_register',
						method: 'POST',
						data: {
								_token: '{{ csrf_token() }}',
								job: job,
								organization: organization,
								location: location
							}
					}).done(function(response){
						if(response.status == 1){
// 							$('#wepayVipQRImage').prop('src', '/image_download/' + response.qrImageUrl);
							$('#vipQRImageRow').html(response.qrSVGContent);
							$('.vipPayRow').show();
						}
					});
				}

				event.preventDefault();
			}

			function viewActivityDetail(activityId, subscribed){
				$('.activityPayRow').hide();
				$.ajax({
					url: '/user/get_activity_detail_by_id',
					method: 'GET',
					data: {
							_token: '{{ csrf_token() }}',
							activityId: activityId,
							}
				}).done(function(response){
					if(response.status == 1){
						var title = response.data.title;
						var content = response.data.content;
						var price = response.data.price;

						$('#activityDetailId').val(activityId);
						$('#activityDetailTitle').text(title);
						$('#activityDetailContent').html(content);
						$('#activityDetailPrice').text(price);

						if(subscribed){
							$('.priceRow').hide();
						}else{
							$('.priceRow').show();
						}
						$('#activityDetailModal').modal();
					}
				});
			}

			function readyPayActivity(event){
				var activityId = $('#activityDetailId').val();

				$.ajax({
					url: '/user/wepay_prepare_subscribe_activity',
					method: 'POST',
					data: {
							_token: '{{ csrf_token() }}',
							activityId: activityId,
						}
				}).done(function(response){
					if(response.status == 1){
						$('#activityQRImageRow').html(response.qrSVGContent);
						$('.activityPayRow').show();
					}
				});

				event.preventDefault();
			}

			function finishPay(){
				location.reload();
			}
		</script>
	</body>

</html>