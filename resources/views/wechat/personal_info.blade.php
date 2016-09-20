@extends('wechat_master')

@section('title', '个人中心')

@section('content')
		<div class="container-fluid header-container">
			<header class="bg-primary">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 text-center title">
						个人中心
					</div>
				</div>
			</header>
		</div>
		<div class="container-fluid content border-form" style="margin-top: 50px; font-size: 1em">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3">
					<img src="/image_download/{{ $user->head_image_url }}" class="img-circle" style="width:100%; height:100%">
				</div> 
			</div>
			<div class="row">
				<div class="col-xs-5 text-left item-label">姓名</div>
				<div class="col-xs-7 item-content" id="userName">{{ $user->name }}</div>
			</div>
			<div class="row">
				<div class="col-xs-5 text-left item-label">电话</div>
				<div class="col-xs-7 item-content" id="phone">{{ $user->phone }}</div>
			</div>
			<div class="row">
				<div class="col-xs-5 text-left item-label">职位</div>
				<div class="col-xs-7 item-content" id="job">{{ $user->job }}</div>
			</div>
			<div class="row">
				<div class="col-xs-5 text-left item-label">单位</div>
				<div class="col-xs-7 item-content" id="organization">{{ $user->organization }}</div>
			</div>
			<div class="row">
				<div class="col-xs-5 text-left item-label">驻地</div>
				<div class="col-xs-7 item-content" id="location">{{ $user->location }}</div>
			</div>
			<div class="row">
				<div class="col-xs-5 text-left item-label">邮箱</div>
				<div class="col-xs-7 item-content" id="email">{{ $user->email }}</div>
			</div>
			<div class="row">
				<div class="col-xs-5 text-left item-label">会员有效期</div>
				<?php $vipPeriod = $user->currentVipPeriod();?>
				@if(!empty($vipPeriod))
				<div class="col-xs-7 item-content" id="vipPeriod">{{ $vipPeriod->start_date.'~'.$vipPeriod->end_date }}</div>
				@endif
			</div>
			<div class="row">
				<button type="button" class="btn btn-primary text-center center-block" style="font-size: 1.3em; margin-top: 10px;" onclick="register()">注册正式会员</button>
			</div>
		</div>
@endsection

@section('js')
	@parent
	   
		<script type="text/javascript">
		$(function(){
			location.href="/wechat/show_vip_register";
		});
		
		</script>
@endsection