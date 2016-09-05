@extends('wechat_master')

@section('title', '活动记录')

@section('content')
		<div class="container-fluid header-container">
			<header class="bg-primary">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 text-center title">
						活动记录
					</div>
				</div>
			</header>
		</div>
		<table class="table" style="margin-top: 20px">
			<thead>
				<tr>
					<th style="width: 50%">活动名称</th>
					<th style="width: 25%">时间</th>
					<th style="width: 25%">费用</th>
				</tr>
			</thead>
			<tbody>
				@foreach($activityList as $activity)
				<tr>
					<td style="text-align: left">{{ $activity->name }}</td>
					<?php 
						$startDate = new DateTime($activity->start_time);
					?>
					<td style="text-align: center">{{ $startDate->format('Y-m-d') }}</td>
					<td style="text-align: center">{{ $user->getActivityOrder($activity->id)->price }}元</td>
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
		
		</script>
@endsection