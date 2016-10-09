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
		<h4 class="text-center text-success">{{ $error }}</h4>
@endsection

@section('js')
	@parent
		<script type="text/javascript">
		$(function(){
		});
		
		</script>
@endsection