@extends('wechat_master')

@section('title', '注册会员')

@section('content')
		<div class="container-fluid header-container">
			<header class="bg-primary">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 text-center title">
						天方信诚
					</div>
				</div>
			</header>
		</div>
		<h2 class="text-center text-success">谢谢您的关注，注册成功</h2>
		<h5 style="padding: 5px">电脑端初始登录密码为<span class="text-danger">{{ $password }}</span>，请您登录并且更换密码</h5>
		<h5 style="padding: 5px">电脑端网址为{{ config('app.url').'/user' }}</h5>
		<a type="button" class="btn btn-primary center-block" href="/wechat/activity_list">活动列表</a>
@endsection

@section('js')
	@parent
		<script type="text/javascript">
		$(function(){
		});
		
		</script>
@endsection