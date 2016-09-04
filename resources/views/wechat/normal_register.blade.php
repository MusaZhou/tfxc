@extends('wechat_master')

@section('title', '注册会员')

@section('content')
	<body>
		<div class="container-fluid header-container">
			<header class="bg-primary">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 text-center title">
						注册会员
					</div>
				</div>
			</header>
		</div>
		<form style="padding: 5px; font-size: 1.5em" class="border-form">
			<div class="form-group">
				<label for="userName">姓名</label>
				<input type="text" class="form-control" id="userName" name="userName" placeholder="姓名">
			</div>
			<div class="form-group">
				<label for="userName">电话</label>
				<input type="text" class="form-control" id="phone" name="phone" placeholder="电话">
			</div>
			<button type="submit" class="btn btn-primary text-center center-block" style="font-size: 1em">注册</button>
		</form>
@endsection

@section('js')
	@parent
		<script type="text/javascript">
		$(function(){
			
		});
		
		</script>
@endsection