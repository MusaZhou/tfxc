@extends('wechat_master')

@section('title', '活动报名')

@section('content')
		<div class="container-fluid header-container">
			<header class="bg-primary">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-1 text-center" onclick="goToActivityDetail({{ $activity->id }})">
							<li class="fa fa-angle-left fa-2x"></li>
						</div>
						<div class="col-xs-10 text-center title">
							活动报名
						</div>
					</div>
				</div>
			</header>
		</div>
		<div class="container-fluid content">
			<div class="row text-center activity-title">
				{{ $activity->name }}
			</div>
			<div class="row text-center" style="margin-top: 100px; font-size: 1.5em; margin-bottom: 20px;">
				报名费用<span id="amount">{{ $price }}</span>元
			</div>
			<div class="row" style="margin-left: 10px; margin-right: 10px">
				<input type="text" class="form-control" id="note" name="note" placeholder="备注">
			</div>
			<div class="row" style="margin-top: 20px;">
				<button type="button" class="btn btn-primary btn-lg text-center center-block" style="font-size: 1.5em" onclick="paySubscribeActivity()">支付报名</button>
			</div>
		</div>
@endsection

@section('js')
	@parent
		<script type="text/javascript">
		$(function(){
			
		});

		function paySubscribeActivity(){
			location.href="/wechat/subscribe_activity/{{ $activity->id }}";
		}
		</script>
@endsection