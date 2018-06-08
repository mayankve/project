<div class="panel-heading">
	Included Activity
	<a class="addMore include-plus pull-right" row="included-activity-row" style="padding: 0;"><i class="fa fa-plus" aria-hidden="true"></i></a>
</div>
<div class="panel-body">
	@if(count(old('included_activity')))
		@foreach (old('included_activity') as $key => $value)
			<div class="panel panel-success activities_details">
				<div class="panel-heading">&nbsp;</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('included_activity.'.$key.'.activity_name') ? 'has-error' : ''}}">
								{!! Form::label('included_activity['.$key.'][activity_name]', 'Activity Name') !!}
								{!! Form::text('included_activity['.$key.'][activity_name]', null, ['class' => 'form-control']) !!}
								@if($errors->has('included_activity.'.$key.'.activity_name'))
									<span class="help-block">{{ $errors->first('included_activity.'.$key.'.activity_name') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('included_activity.'.$key.'.activity_detail') ? 'has-error' : ''}}">
								{!! Form::label('included_activity['.$key.'][activity_detail]', 'Activity Detail') !!}
								{!! Form::text('included_activity['.$key.'][activity_detail]', null, ['class' => 'form-control']) !!}
								@if($errors->has('included_activity.'.$key.'.activity_detail'))
									<span class="help-block">{{ $errors->first('included_activity.'.$key.'.activity_detail') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('included_activity.'.$key.'.activity_cost') ? 'has-error' : ''}}">
								{!! Form::label('included_activity['.$key.'][activity_cost]', 'Activity Cost') !!}
								{!! Form::number('included_activity['.$key.'][activity_cost]', null, ['class' => 'form-control']) !!}
								@if($errors->has('included_activity.'.$key.'.activity_cost'))
									<span class="help-block">{{ $errors->first('included_activity.'.$key.'.activity_cost') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('included_activity.'.$key.'.activity_our_cost') ? 'has-error' : ''}}">
								{!! Form::label('included_activity['.$key.'][activity_our_cost]', 'Activity Our Cost') !!}
								{!! Form::number('included_activity['.$key.'][activity_our_cost]', null, ['class' => 'form-control']) !!}
								@if($errors->has('included_activity.'.$key.'.activity_our_cost'))
									<span class="help-block">{{ $errors->first('included_activity.'.$key.'.activity_our_cost') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('included_activity.'.$key.'.activity_due_date') ? 'has-error' : ''}}">
								{!! Form::label('included_activity['.$key.'][activity_due_date]', 'Due Date') !!}
								{!! Form::date('included_activity['.$key.'][activity_due_date]', null, ['class' => 'form-control']) !!}
								@if($errors->has('included_activity.'.$key.'.activity_due_date'))
									<span class="help-block">{{ $errors->first('included_activity.'.$key.'.activity_due_date') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('included_activity.'.$key.'.activity_reserve_type') ? 'has-error' : ''}}">
								{!! Form::label('included_activity['.$key.'][activity_reserve_type]', 'Reserve Type') !!}
								{!! Form::select('included_activity['.$key.'][activity_reserve_type]', array(0 => 'Flat', 1 => 'Percentage'), null, ['class' => 'form-control']) !!}
								@if($errors->has('included_activity.'.$key.'.key'))
									<span class="help-block">{{ $errors->first('included_activity.'.$key.'.key') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('included_activity.'.$key.'.activity_reserve_amount') ? 'has-error' : ''}}">
								{!! Form::label('included_activity['.$key.'][activity_reserve_amount]', 'Reserve Amount') !!}
								{!! Form::number('included_activity['.$key.'][activity_reserve_amount]', null, ['class' => 'form-control']) !!}
								@if($errors->has('included_activity.'.$key.'.activity_reserve_amount'))
									<span class="help-block">{{ $errors->first('included_activity.'.$key.'.activity_reserve_amount') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								{!! Form::label('included_activity['.$key.'][activity_image]', 'Activity Image') !!}
								{!! Form::file('included_activity['.$key.'][activity_image]', ['class' => 'form-control']) !!}
							</div>
						</div>
						{!! Form::hidden('included_activity['.$key.'][activity_id]', null, ['class' => 'form-control']) !!}
					</div>
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="button" name="included_activity[{{$key}}][activity_add_hotel]" class="btn btn-success add_activities_hotel" value="Add activity">Add More Hotel</button>
						</div>
					</div>
					@foreach ($value['activity_hotels'] as $key1 => $value1)
						<div class="activities_hotels">
							<div class="row">
								<div class="col-md-12">
									Activity Hotel <hr>
								</div>
							</div>
							<div class="row">
								@include('admin.trip.partials.create-trip-hotels-fields', array('name' => 'included_activity['.$key.'][activity_hotels]', 'hasName' => 'included_activity.'.$key.'.activity_hotels', 'old' => true, 'key' => $key1))
								{!! Form::hidden('included_activity['.$key.'][activity_hotels]['.$key1.'][hotel_id]', null, ['class' => 'form-control']) !!}
								<div class="col-md-12 remove-activity-hotels-div">
									@if($key1)
										<a href="javascript:void(0);" class="remove_activity_hotels"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
									@endif
								</div>
							</div>
						</div>
					@endforeach
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="button" name="included_activity['.$key.'][activity_add_airline]" class="btn btn-success add_activities_airline" value="Add airline">Add More Airline</button>
						</div>
					</div>
					@foreach ($value['activity_airlines'] as $key2 => $value2)
						<div class="activities_airlines">
							<div class="row">
								<div class="col-md-12">
									Activity Airline <hr>
								</div>
							</div>
							<div class="row">
								@include('admin.trip.partials.create-trip-airlines-fields', array('name' => 'included_activity['.$key.'][activity_airlines]', 'hasName' => 'included_activity.'.$key.'.activity_airlines', 'old' => true, 'key' => $key2))
								{!! Form::hidden('included_activity['.$key.'][activity_airlines]['.$key2.'][airline_id]', null, ['class' => 'form-control']) !!}
								<div class="col-md-12 remove-activity-airline-div">
									@if($key2)
										<a href="javascript:void(0);" class="remove_activity_airline"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
									@endif
								</div>
							</div>
						</div>
					@endforeach
					<div class="row">
						<div class="col-md-12 remove-activities-details-div">
							@if($key)
								<a href="javascript:void(0);" class="remove_activities_details"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@else
		@if ( count($trip['included_activity']) )
			@foreach ($trip['included_activity'] as $key => $value)
				<div class="panel panel-success activities_details">
					<div class="panel-heading">&nbsp;</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('included_activity['.$key.'][activity_name]', 'Activity Name') !!}
									{!! Form::text('included_activity['.$key.'][activity_name]', null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('included_activity['.$key.'][activity_detail]', 'Activity Detail') !!}
									{!! Form::text('included_activity['.$key.'][activity_detail]', null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('included_activity['.$key.'][activity_cost]', 'Activity Cost') !!}
									{!! Form::number('included_activity['.$key.'][activity_cost]', null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('included_activity['.$key.'][activity_our_cost]', 'Activity Our Cost') !!}
									{!! Form::number('included_activity['.$key.'][activity_our_cost]', null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('included_activity['.$key.'][activity_due_date]', 'Due Date') !!}
									{!! Form::date('included_activity['.$key.'][activity_due_date]', null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('included_activity['.$key.'][activity_reserve_type]', 'Reserve Type') !!}
									{!! Form::select('included_activity['.$key.'][activity_reserve_type]', array(0 => 'Flat', 1 => 'Percentage'), null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('included_activity['.$key.'][activity_reserve_amount]', 'Reserve Amount') !!}
									{!! Form::number('included_activity['.$key.'][activity_reserve_amount]', null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('included_activity['.$key.'][activity_image]', 'Activity Image') !!}
									{!! Form::file('included_activity['.$key.'][activity_image]', ['class' => 'form-control']) !!}
								</div>
							</div>
							{!! Form::hidden('included_activity['.$key.'][activity_id]', $value->id, ['class' => 'form-control']) !!}
						</div>
						<div class="row">
							<div class="col-md-12 text-right">
								<button type="button" name="included_activity[{{$key}}][activity_add_hotel]" class="btn btn-success add_activities_hotel" value="Add activity">Add More Hotel</button>
							</div>
						</div>
						@if ( count($value['activity_hotels']) )
							@foreach ($value['activity_hotels'] as $key1 => $value1)
								<div class="activities_hotels">
									<div class="row">
										<div class="col-md-12">
											Activity Hotel <hr>
										</div>
									</div>
									<div class="row">
										@include('admin.trip.partials.create-trip-hotels-fields', array('name' => 'included_activity['.$key.'][activity_hotels]', 'old' => false, 'key' => $key1))
										{!! Form::hidden('included_activity['.$key.'][activity_hotels]['.$key1.'][hotel_id]', $value1->id, ['class' => 'form-control']) !!}
										<div class="col-md-12 remove-activity-hotels-div">
											@if($key1)
												<a href="javascript:void(0);" class="remove_activity_hotels"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
											@endif
										</div>
									</div>
								</div>
							@endforeach
						@else
							<div class="activities_hotels">
								<div class="row">
									<div class="col-md-12">
										Activity Hotel <hr>
									</div>
								</div>
								<div class="row">
									@include('admin.trip.partials.create-trip-hotels-fields', array('name' => 'included_activity['.$key.'][activity_hotels]', 'old' => false, 'key' => 0))
									<div class="col-md-12 remove-activity-hotels-div"></div>
								</div>
							</div>
						@endif
						<div class="row">
							<div class="col-md-12 text-right">
								<button type="button" name="included_activity[{{$key}}][activity_add_airline]" class="btn btn-success add_activities_airline" value="Add airline">Add More Airline</button>
							</div>
						</div>
						@if ( count($value['activity_airlines']) )
							@foreach ($value['activity_airlines'] as $key2 => $value2)
								<div class="activities_airlines">
									<div class="row">
										<div class="col-md-12">
											Activity Airline <hr>
										</div>
									</div>
									<div class="row">
										@include('admin.trip.partials.create-trip-airlines-fields', array('name' => 'included_activity['.$key.'][activity_airlines]', 'old' => false, 'key' => $key2))
										{!! Form::hidden('included_activity['.$key.'][activity_airlines]['.$key2.'][airline_id]', $value2->id, ['class' => 'form-control']) !!}
										<div class="col-md-12 remove-activity-airline-div">
											@if($key2)
												<a href="javascript:void(0);" class="remove_activity_airline"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
											@endif
										</div>
									</div>
								</div>
							@endforeach
						@else
							<div class="activities_airlines">
								<div class="row">
									<div class="col-md-12">
										Activity Airline <hr>
									</div>
								</div>
								<div class="row">
									@include('admin.trip.partials.create-trip-airlines-fields', array('name' => 'included_activity['.$key.'][activity_airlines]', 'old' => false, 'key' => 0))
									<div class="col-md-12 remove-activity-airline-div"></div>
								</div>
							</div>
						@endif
						<div class="row">
							<div class="col-md-12 remove-activities-details-div">
								@if($key)
									<a href="javascript:void(0);" class="remove_activities_details"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
								@endif
							</div>
						</div>
					</div>
				</div>
			@endforeach
		@endif
	@endif
</div>