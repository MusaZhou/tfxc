@extends('wechat_master')

@section('title', '注册正式会员')

@section('content')
		<div class="container-fluid header-container">
			<header class="bg-primary">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 text-center title">
						天方信诚-注册正式会员
					</div>
				</div>
			</header>
		</div>
		<form id="vipRegisterForm" name="vipRegisterForm" action="/wechat/register_vip_user" method="POST" style="padding: 5px; font-size: 1.2em" class="border-form">
			{{ csrf_field() }}
			<label>姓名: <span id="userName">{{ $user->name }}</span></label><br/>
			<label>电话: <span id="phone">{{ $user->phone }}</span></label>
			<div class="form-group">
				<label>职位</label>
				<input type="text" class="form-control" id="job" name="job" placeholder="职位">
			</div>
			<div class="form-group">
				<label>单位</label>
				<input type="text" class="form-control" id="organization" name="organization" placeholder="单位">
			</div>
			<div class="form-group">
				<label>驻地</label>
				<input type="text" class="form-control" id="location" name="location" placeholder="驻地">
			</div>
			<label class="text-danger">一年期会费为{{ $price }}元</label>
			<div class="alert alert-danger" role="alert" id="error"></div>
			<button type="submit" class="btn btn-primary text-center center-block" style="font-size: 1em" >支付注册</button>
		</form>
@endsection

@section('js')
	@parent
		<script type="text/javascript">
		$(function(){
			$('#vipRegisterForm').submit(function(){
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
			var job = $('#job').val().trim();
			var organization = $('#organization').val().trim();
			var location = $('#location').val().trim();
		
			if(job == '' || organization == '' || location == ''){
				$('#error').text('请填完整');
				return false;
			}
		
			return true;
		}
		</script>
@endsection