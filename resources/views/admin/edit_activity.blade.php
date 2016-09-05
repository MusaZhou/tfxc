@extends('admin_master')

@section('css')
	@parent
	<!-- Date Time picker -->
	<link href="{{ URL::asset('css/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/jquery-timepicker/jquery.timepicker.css') }}" rel="stylesheet">
@endsection

@section('head')
	@include('UEditor::head');
@endsection

@section('content')

	<div class="row">
   		<div class="col-lg-12">
    		<h1 class="page-header">编辑活动</h1>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">活动详情</div>
				<div class="panel-body">
					
					<div class="row">
						<form role="form" action="/admin/edit_activity" method="post" enctype="multipart/form-data" id="editActivityForm">
							{{ csrf_field() }}
							<div class="col-lg-8">
								<input id="activityId", name="activityId" type="hidden" value="{{ $activity->id }}"/>
								<div class="form-group">
					      			<label>活动名称 *</label>
					      			<input id="name" name="name" class="form-control" type="text" value="{{ $activity->name }}"/>
					      		</div>
					      		<div class="form-group">
					      			<label>简要描述 </label>
					      			<input id="description" name="description" class="form-control" type="text" value="{{ $activity->description }}"/>
					      		</div>
					      		<div class="form-group">
					      			<label>价格/人 *</label>
					      			<input id="price" name="price" class="form-control" type="text" value="{{ $activity->price }}"/>
					      		</div>
					      		<div class="form-group">
					      			<label>省份 *</label>
					      			<select id="province" name="province" class="form-control">
					      				@foreach($provinceList as $province)
					      				<option value="{{ $province->id }}">{{ $province->name }}</option>
					      				@endforeach
					      			</select>
					      		</div>
					      		<div class="form-group">
					      			<label>城市 *</label>
					      			<select id="city" name="city" class="form-control">
					      			</select>
					      		</div>
					      		<div class="form-group">
					      			<label>详细地址 *</label>
					      			<input id="address" name="address" class="form-control" type="text" value="{{ $activity->address }}"/>
					      		</div>
					      		<div class="form-group">
					      			<label>活动时间</label>
					      			<p id="activityTime">
					      				<input type="text" class="date start" id="startDate" name="startDate"/>
					      				<input type="text" class="time start" id="startTime" name="startTime"/> 到
					      				<input type="text" class="date end" id="endDate" name="endDate"/>
					      				<input type="text" class="time end" id="endTime" name="endTime"/>
					      			</p>
					      		</div>
								
								<div class="alert alert-danger" role="alert" id="error"></div>
								<div class="row profile_row" style="margin-top: 50px" align-text="right">
									<button id="submit" name="submit" type="submit" class="btn btn-primary btn-lg" style="margin-left:20px">保存</button>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="row  profile_row">
									<div class="col-lg-12" style="height: 700px">
										<script id="container" name="content" type="text/plain" style="height: 500px">
											{!! $activity->content !!}
  									 	</script>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	@parent
    <!-- Date Time Picker -->
	<script src="{{ URL::asset('js/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ URL::asset('js/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js') }}"></script>
	<script src="{{ URL::asset('js/jquery-timepicker/jquery.timepicker.min.js') }}"></script>
	<script src="{{ URL::asset('js/datepair/datepair.min.js') }}"></script>
	<script src="{{ URL::asset('js/datepair/jquery.datepair.min.js') }}"></script>
	
	<script>
	var ue;
	var provinceId = {{ $activity->city->province->id }};
	var cityId = {{ $activity->city_id }};
	var startDateTime = '{{ $activity->start_time }}';
	var endDateTime = '{{ $activity->end_time }}';
	
	$(function(){
		ue = UE.getEditor('container',{
			toolbars:[
						['undo', 'redo', 'bold', 'underline', 'strikethrough', 'superscript', 'subscript', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'rowspacingtop', 'rowspacingbottom', 'lineheight', ],
						['paragraph', 'fontfamily', 'fontsize',  'indent', 'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify'],
						['link', 'unlink', 'imagenone', 'imageleft', 'imageright', 'imagecenter', 'simpleupload', 'emotion', 'horizontal', 'date', 'time',  'searchreplace'],
					
					]
		});

		ue.ready(function(){
			ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
		});

		$('#editActivityForm').submit(function(e){
			var result = validate();
			if(result){
				$('#error').hide();
				return true;
			}else{
				$('#error').show();
				return false;
			}
		});

		$('#province').change(function(){
			
			var provinceId = $(this).val();
			if( provinceId === undefined ){
				return;
			}
			
			$.ajax({
				data:{ 
					provinceId: provinceId,
					_token: "{{ csrf_token() }}"
					 },
				dataType: "json",
				method: "GET",
				url: "/admin/get_cities_by_province"
				}).done(function(response){
						$('#city').empty();
						if(response.status == 1){
							var cities = response.data.cities;
							jQuery.each(cities, function(key, value){
									var id = value.id;
									var name = value.name;
									var newOption = $('<option value="' + id + '">' + name + '</option>');
									$('#city').append(newOption);
								});
							if(cityId != null){
								$('#city').val(cityId);
								$('#city').change();
							}
						}else{
							bootbox.alert('获取城市列表失败');
						}
					});
		});

		$('#province').val(provinceId);
		$('#province').change();

		$('.time').timepicker({
			'timeFormat': 'H:i',
			});

		$('.date').datepicker({ 
			'format': 'yyyy-mm-dd',
			'language': 'zh-CN',
			});
		
		$('#activityTime').datepair();

		var startDateTimeArray = startDateTime.split(' ');
		var endDateTimeArray = endDateTime.split(' ');
		
		$('#startDate').val(startDateTimeArray[0]);
		$('#startTime').val(startDateTimeArray[1]);
		$('#endDate').val(endDateTimeArray[0]);
		$('#endTime').val(endDateTimeArray[1]);
		
		$('#error').hide();
	});
	
	function validate(){
		var name = $('#name').val().trim();
		var price = $('#price').val().trim();
		var cityId = $('#city').val();
		var address = $('#address').val().trim();
		var content = ue.getContent();
		
		
		if(name == '' || content == '' || price == '' || address == '' || cityId == undefined || cityId == null){
			
			$('#error').text('请完成必填项');
			return false;
		}

		if(!$.isNumeric(price)){
			$('#error').text('价格需为数字');
			return false;
		}
		
		return true;
	}
	
	</script>
@endsection