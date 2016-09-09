@extends('wechat_master')

@section('title', '当前活动')

@section('content')
		<div class="container-fluid header-container">
			<header class="bg-primary">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 text-center title">
						当前活动
					</div>
				</div>
			</header>
		</div>
		<table class="table" style="margin-top: 20px">
			<thead>
				<tr>
					<th style="width: 40%">活动名称</th>
					<th style="width: 20%">地点</th>
					<th style="width: 25%">时间</th>
					<th style="width: 15%"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($activityList as $activity)
				<tr>
					<td style="text-align: left">{{ $activity->name }}</td>
					<td style="text-align: center">{{ $activity->city->name }}</td>
					<?php 
						$startDate = new DateTime($activity->start_time);
					?>
					<td style="text-align: center">{{ $startDate->format('Y-m-d') }}</td>
					<td style="text-align: center">
						<button type="button" class="btn btn-primary btn-sm" onclick="viewActivityDetail({{ $activity->id }})">详情</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
@endsection

@section('js')
	@parent
		<script type="text/javascript">
		$(function(){
			
		});

		function viewActivityDetail(activityId){
			location.href="/wechat/activity_detail/" + activityId;
		}
		</script>
@endsection