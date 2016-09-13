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
		<h3 class="text-center text-success">支付金额:<span class="text-primary">{{ $amount }}元</span></h3>
		<button type="button" class="btn btn-primary btn-block" onclick="makePayment()" style="margin-top: 20px">确认</button>
@endsection

@section('js')
	@parent
		<script type="text/javascript">
		$(function(){
			
		});
		
		</script>
@endsection