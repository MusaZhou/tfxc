@extends('wechat_master')

@section('title', '支付')

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
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
		$(function(){
			wx.config({!! $js->config(array('chooseWXPay'), true) !!});

			wx.ready(function(){
				
			});
		});

		function makePayment(){
			wx.chooseWXPay({
    		    timestamp: {{ $config['timestamp'] }},
    		    nonceStr: '{{ $config['nonceStr'] }}',
    		    package: '{{ $config['package'] }}',
    		    signType: '{{ $config['signType'] }}',
    		    paySign: '{{ $config['paySign'] }}', // 支付签名
    		    success: function (res) {
        		    @if($orderType == 1)
    		        	location.href="/wechat/show_vip_register_success";
    		        @elseif($orderType == 2)
    		        	location.href="/wechat/show_activity_subscribe_success";
    		        @endif
    		    },
    		    fail: function(res) {
					alert('支付失败');
					window.history.back();
        		}
    		});
		}
		</script>
@endsection