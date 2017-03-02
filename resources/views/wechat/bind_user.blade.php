@extends('wechat_master')

@section('title', '会员绑定手机')

@section('content')
	<body>
		<div class="container-fluid header-container">
			<header class="bg-primary">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 text-center title">
						天方信诚-绑定手机
					</div>
				</div>
			</header>
		</div>
		<form name="bindForm" id="bindForm" action="/wechat/bind_user" method="POST" style="padding: 5px; font-size: 1.2em" class="border-form">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="phone">手机号码</label>
				<input type="text" class="form-control" id="phone" name="phone" placeholder="电话">
			</div>
			<div class="alert alert-danger" role="alert" id="error">{{ $errorMsg or '' }}</div>
			<button type="submit" class="btn btn-primary text-center center-block" style="font-size: 1em" onclick="register()">绑定</button>
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

			if($('#error').text() == ''){
				$('#error').hide();
			}
		});

		function validate(){
			var phone = $('#phone').val().trim();

			if(phone == ''){
				$('#error').text('请填完整');
				return false;
			}

			return true;
		}

		function register(){
		}
		
		</script>
@endsection