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
		<h2 class="text-center text-success">谢谢！您已注册为正式会员</h2>
		<a type="button" class="btn btn-primary center-block" href="/wechat/activity_list">活动列表</a>
@endsection

@section('js')
	@parent
		<script type="text/javascript">
		$(function(){
			
		});
		
		</script>
@endsection