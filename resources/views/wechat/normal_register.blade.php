@extends('wechat_master')

@section('title', '注册会员')

@section('content')
	<body>
		<div class="container-fluid header-container">
			<header class="bg-primary">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 text-center title">
						注册会员
					</div>
				</div>
			</header>
		</div>
		<form name="registerForm" id="registerForm" action="/wechat/register_normal_user" method="POST" style="padding: 5px; font-size: 1.2em" class="border-form">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="userName">姓名</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="姓名">
			</div>
			<div class="form-group">
				<label for="userName">电话</label>
				<input type="phone" class="form-control" id="phone" name="phone" placeholder="电话">
			</div>
			<div class="form-group">
				<label>邮箱</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="邮箱">
			</div>
			<div class="alert alert-danger" role="alert" id="error"></div>
			<button type="submit" class="btn btn-primary text-center center-block" style="font-size: 1em" onclick="register()">注册</button>
		</form>
@endsection

@section('js')
	@parent
		<script type="text/javascript">
		$(function(){
			$('#registerForm').submit(function(){
				if(validate()){
					$('#error').hide();
					return true;
				}else{
					$('#error').show();
					return false;
				}	
			});

			$('#error').hide();
		});

		function validate(){
			var name = $('#name').val().trim();
			var phone = $('#phone').val().trim();
			var email = $('#email').val().trim();

			if(name == '' || phone == '' || email == ''){
				$('#error').text('请填完整');
				return false;
			}

			return true;
		}

		function register(){
		}
		
		</script>
@endsection