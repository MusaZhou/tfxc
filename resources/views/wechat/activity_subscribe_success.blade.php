@extends('wechat_master')

@section('title', '活动报名')

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
		<h2 class="text-center text-success">谢谢您, 已成功报名活动, 可以去个人中心查看自己的活动详情</h2>
		<a type="button" class="btn btn-primary center-block" href="/wechat/personal_activity_history">活动详情</a>
@endsection

@section('js')
	@parent
		<script type="text/javascript">
		$(function(){
		});
		
		</script>
@endsection