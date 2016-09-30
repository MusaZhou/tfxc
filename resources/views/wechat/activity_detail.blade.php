@extends('wechat_master')

@section('title', '活动详情')

@section('content')
		<div class="container-fluid header-container">
			<header class="bg-primary">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-1 text-center" onclick="goToActivityList()">
							<li class="fa fa-angle-left fa-2x"></li>
						</div>
						<div class="col-xs-10 text-center title">
							活动详情
						</div>
					</div>
				</div>
			</header>
		</div>
		<div class="container-fluid content">
			<div class="row text-center activity-title">
				{{ $activity->name }}
			</div>
			<div class="row">
				<div id="activityContent" class="activity-content">
				  {!! $activity->content !!}
				</div>
			</div>
			<div class="row">
				<button type="button" class="btn btn-primary text-center center-block" style="font-size: 1em" onclick="goToSubscribeActivity({{ $activity->id }})">报名</button>
			</div>
		</div>
@endsection

@section('js')
	@parent
		<script type="text/javascript">
		$(function(){
			
		});

		function goToActivityList(){
			location.href="/wechat/activity_list";
		}

		function goToSubscribeActivity(activityId){
			location.href="/wechat/subscribe_activity/" + activityId;
		}
		</script>
@endsection