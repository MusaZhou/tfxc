@extends('wechat_master')

@section('title', '注册正式会员')

@section('content')
		<div class="container-fluid header-container">
			<header class="bg-primary">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 text-center title">
						注册正式会员
					</div>
				</div>
			</header>
		</div>
		<form style="padding: 5px; font-size: 1.5em" class="border-form">
			<label>姓名: <span id="userName"> </span></label><br/>
			<label>电话: <span id="phone"> </span></label>
			<div class="form-group">
				<label>职位</label>
				<input type="text" class="form-control" id="job" name="job" placeholder="职位">
			</div>
			<div class="form-group">
				<label>单位</label>
				<input type="text" class="form-control" id="organization" name="organization" placeholder="单位">
			</div>
			<div class="form-group">
				<label>驻地</label>
				<input type="text" class="form-control" id="location" name="location" placeholder="驻地">
			</div>
			<label class="text-danger">一年会费为{{ $vipAmount }}元</label>
			<button type="submit" class="btn btn-primary text-center center-block" style="font-size: 1em" onclick="register()">支付注册</button>
		</form>
@endsection

@section('js')
	@parent
		<script type="text/javascript">
		$(function(){
			
		});
		
		</script>
@endsection