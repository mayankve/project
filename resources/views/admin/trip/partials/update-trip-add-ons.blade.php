<div class="panel-heading">
	Add ons/Upgrades
	<a class="addMore addon-plus pull-right" row="addons-row" style="padding: 0;"><i class="fa fa-plus" aria-hidden="true"></i></a>
</div>
<div class="panel-body">
	@if(count(old('addon')))
		@foreach (old('addon') as $key => $value)
			<div class="panel panel-success add_on_details">
				<div class="panel-heading">&nbsp;</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('addon.'.$key.'.addons_name') ? 'has-error' : ''}}">
								{!! Form::label('addon['.$key.'][addons_name]', 'Add ons Name') !!}
								{!! Form::text('addon['.$key.'][addons_name]', null, ['class' => 'form-control']) !!}
								@if($errors->has('addon.'.$key.'.addons_name'))
									<span class="help-block">{{ $errors->first('addon.'.$key.'.addons_name') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('addon.'.$key.'.addons_detail') ? 'has-error' : ''}}">
								{!! Form::label('addon['.$key.'][addons_detail]', 'Add ons Detail') !!}
								{!! Form::text('addon['.$key.'][addons_detail]', null, ['class' => 'form-control']) !!}
								@if($errors->has('addon.'.$key.'.addons_detail'))
									<span class="help-block">{{ $errors->first('addon.'.$key.'.addons_detail') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('addon.'.$key.'.addons_cost') ? 'has-error' : ''}}">
								{!! Form::label('addon['.$key.'][addons_cost]', 'Add ons Cost') !!}
								{!! Form::number('addon['.$key.'][addons_cost]', null, ['class' => 'form-control']) !!}
								@if($errors->has('addon.'.$key.'.addons_cost'))
									<span class="help-block">{{ $errors->first('addon.'.$key.'.addons_cost') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('addon.'.$key.'.addons_our_cost') ? 'has-error' : ''}}">
								{!! Form::label('addon['.$key.'][addons_our_cost]', 'Add ons Our Cost') !!}
								{!! Form::number('addon['.$key.'][addons_our_cost]', null, ['class' => 'form-control']) !!}
								@if($errors->has('addon.'.$key.'.addons_our_cost'))
									<span class="help-block">{{ $errors->first('addon.'.$key.'.addons_our_cost') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('addon.'.$key.'.addons_due_date') ? 'has-error' : ''}}">
								{!! Form::label('addon['.$key.'][addons_due_date]', 'Due Date') !!}
								{!! Form::date('addon['.$key.'][addons_due_date]', null, ['class' => 'form-control']) !!}
								@if($errors->has('addon.'.$key.'.addons_due_date'))
									<span class="help-block">{{ $errors->first('addon.'.$key.'.addons_due_date') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('addon.'.$key.'.addons_reserve_type') ? 'has-error' : ''}}">
								{!! Form::label('addon['.$key.'][addons_reserve_type]', 'Reserve Type') !!}
								{!! Form::select('addon['.$key.'][addons_reserve_type]', array(0 => 'Flat', 1 => 'Percentage'), null, ['class' => 'form-control']) !!}
								@if($errors->has('addon.'.$key.'.addons_reserve_type'))
									<span class="help-block">{{ $errors->first('addon.'.$key.'.addons_reserve_type') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('addon.'.$key.'.addons_reserve_amount') ? 'has-error' : ''}}">
								{!! Form::label('addon['.$key.'][addons_reserve_amount]', 'Reserve Amount') !!}
								{!! Form::number('addon['.$key.'][addons_reserve_amount]', null, ['class' => 'form-control']) !!}
								@if($errors->has('addon.'.$key.'.addons_reserve_amount'))
									<span class="help-block">{{ $errors->first('addon.'.$key.'.addons_reserve_amount') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								{!! Form::label('addon['.$key.'][addons_image]', 'Add ons Image') !!}
								{!! Form::file('addon['.$key.'][addons_image]', ['class' => 'form-control']) !!}
							</div>
						</div>
						
						
						
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('addon.'.$key.'.addons_maximum_spots') ? 'has-error' : ''}}">
								{!! Form::label('addon['.$key.'][addons_maximum_spots]', 'Maximum spots') !!}
								{!! Form::number('addon['.$key.'][addons_maximum_spots]', null, ['class' => 'form-control']) !!}
								@if($errors->has('addon.'.$key.'.addons_maximum_spots'))
									<span class="help-block">{{ $errors->first('addon.'.$key.'.addons_maximum_spots') }}</span>
								@endif
							</div>
						</div>
					
					<div class="col-md-4">
							<div class="form-group {{ $errors->has('addon.'.$key.'.addons_minimum_spots') ? 'has-error' : ''}}">
								{!! Form::label('addon['.$key.'][addons_minimum_spots]', 'Minimum spots') !!}
								{!! Form::number('addon['.$key.'][addons_minimum_spots]', null, ['class' => 'form-control']) !!}
								@if($errors->has('addon.'.$key.'.addons_minimum_spots'))
									<span class="help-block">{{ $errors->first('addon.'.$key.'.addons_minimum_spots') }}</span>
								@endif
							</div>
						</div>
					
					<div class="col-md-4">
							<div class="form-group {{ $errors->has('addon.'.$key.'.addons_maximum_wating_spots') ? 'has-error' : ''}}">
								{!! Form::label('addon['.$key.'][addons_maximum_wating_spots]', 'Minimum waiting spots') !!}
								{!! Form::number('addon['.$key.'][addons_maximum_wating_spots]', null, ['class' => 'form-control']) !!}
								@if($errors->has('addon.'.$key.'.addons_maximum_wating_spots'))
									<span class="help-block">{{ $errors->first('addon.'.$key.'.addons_maximum_wating_spots') }}</span>
								@endif
							</div>
						</div>
						
						{!! Form::hidden('addon['.$key.'][addon_id]', null, ['class' => 'form-control']) !!}
					</div>
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="button" name="addon[{{$key}}][addons_add_hotel]" class="btn btn-success addon_more_hotel" value="Add hotel">Add More Hotel</button>
						</div>
					</div>
					@foreach ($value['addons_hotels'] as $key1 => $value1)
						<div class="addon_hotels">
							<div class="row">
								<div class="col-md-12">
									Add ons Hotel <hr>
								</div>
							</div>
							<div class="row">
								@include('admin.trip.partials.create-trip-hotels-fields', array('name' => 'addon['.$key.'][addons_hotels]', 'hasName' => 'addon.'.$key.'.addons_hotels', 'old' => true, 'key' => $key1))
								{!! Form::hidden('addon['.$key.'][addons_hotels]['.$key1.'][hotel_id]', null, ['class' => 'form-control']) !!}
								<div class="col-md-12 remove-addon-hotels-div">
									@if($key1)
										<a href="javascript:void(0);" class="remove_addon_hotels"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
									@endif
								</div>
							</div>
						</div>
					@endforeach
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="button" name="addon[{{$key}}][addons_add_airline]" class="btn btn-success add_addon_airline" value="Add airline">Add More Airline</button>
						</div>
					</div>
					@foreach ($value['addons_airlines'] as $key2 => $value2)
						<div class="addon_airlines">
							<div class="row">
								<div class="col-md-12">
									Add ons Airline <hr>
								</div>
							</div>
							<div class="row">
								@include('admin.trip.partials.create-trip-airlines-fields', array('name' => 'addon['.$key.'][addons_airlines]', 'hasName' => 'addon.'.$key.'.addons_airlines', 'old' => true, 'key' => $key2))
								{!! Form::hidden('addon['.$key.'][addons_airlines]['.$key2.'][airline_id]', null, ['class' => 'form-control']) !!}
								<div class="col-md-12 remove-addon-airlines-div">
									@if($key2)
										<a href="javascript:void(0);" class="remove_addon_airline"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
									@endif
								</div>
							</div>
						</div>
					@endforeach
					<div class="row">
						<div class="col-md-12 remove-addon-plus-details-div">
							@if($key)
								<a href="javascript:void(0);" class="remove_addon_plus_details"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@else
		@if ( count($trip['addon']) )
			@foreach ($trip['addon'] as $key => $value)
				<div class="panel panel-success add_on_details">
					<div class="panel-heading">&nbsp;</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('addon['.$key.'][addons_name]', 'Add ons Name') !!}
									{!! Form::text('addon['.$key.'][addons_name]', null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('addon['.$key.'][addons_detail]', 'Add ons Detail') !!}
									{!! Form::text('addon['.$key.'][addons_detail]', null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('addon['.$key.'][addons_cost]', 'Add ons Cost') !!}
									{!! Form::number('addon['.$key.'][addons_cost]', null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('addon['.$key.'][addons_our_cost]', 'Add ons Our Cost') !!}
									{!! Form::number('addon['.$key.'][addons_our_cost]', null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('addon['.$key.'][addons_due_date]', 'Due Date') !!}
									{!! Form::date('addon['.$key.'][addons_due_date]', null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('addon['.$key.'][addons_reserve_type]', 'Reserve Type') !!}
									{!! Form::select('addon['.$key.'][addons_reserve_type]', array(0 => 'Flat', 1 => 'Percentage'), null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('addon['.$key.'][addons_reserve_amount]', 'Reserve Amount') !!}
									{!! Form::number('addon['.$key.'][addons_reserve_amount]', null, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label('addon['.$key.'][addons_image]', 'Add ons Image') !!}
									{!! Form::file('addon['.$key.'][addons_image]', ['class' => 'form-control']) !!}
								</div>
							</div>
							
					<div class="col-md-4">
						<div class="form-group">
							{!! Form::label('addon['.$key.'][addons_maximum_spots]', 'Maximum spots') !!}
							{!! Form::number('addon['.$key.'][addons_maximum_spots]', null, ['class' => 'form-control']) !!}
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							{!! Form::label('addon['.$key.'][addons_minimum_spots]', 'Minimum spots') !!}
							{!! Form::number('addon['.$key.'][addons_minimum_spots]', null, ['class' => 'form-control']) !!}
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							{!! Form::label('addon['.$key.'][addons_maximum_wating_spots]', 'Minimum Waiting spots') !!}
							{!! Form::number('addon['.$key.'][addons_maximum_wating_spots]', null, ['class' => 'form-control']) !!}
						</div>
					</div>
							
							{!! Form::hidden('addon['.$key.'][addon_id]', $value->id, ['class' => 'form-control']) !!}
						</div>
						<div class="row">
							<div class="col-md-12 text-right">
								<button type="button" name="addon[{{$key}}][addons_add_hotel]" class="btn btn-success addon_more_hotel" value="Add hotel">Add More Hotel</button>
							</div>
						</div>
						@if ( count($value['addons_hotels']) )
							@foreach ($value['addons_hotels'] as $key1 => $value1)
								<div class="addon_hotels">
									<div class="row">
										<div class="col-md-12">
											Add ons Hotel <hr>
										</div>
									</div>
									<div class="row">
										@include('admin.trip.partials.create-trip-hotels-fields', array('name' => 'addon['.$key.'][addons_hotels]', 'old' => false, 'key' => $key1))
										{!! Form::hidden('addon['.$key.'][addons_hotels]['.$key1.'][hotel_id]', $value1->id, ['class' => 'form-control']) !!}
										<div class="col-md-12 remove-addon-hotels-div">
											@if($key1)
												<a href="javascript:void(0);" class="remove_addon_hotels"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
											@endif
										</div>
									</div>
								</div>
							@endforeach
						@else
							<div class="addon_hotels">
								<div class="row">
									<div class="col-md-12">
										Add ons Hotel <hr>
									</div>
								</div>
								<div class="row">
									@include('admin.trip.partials.create-trip-hotels-fields', array('name' => 'addon['.$key.'][addons_hotels]', 'old' => false, 'key' => 0))
									<div class="col-md-12 remove-addon-hotels-div"></div>
								</div>
							</div>
						@endif
						<div class="row">
							<div class="col-md-12 text-right">
								<button type="button" name="addon[{{$key}}][addons_add_airline]" class="btn btn-success add_addon_airline" value="Add airline">Add More Airline</button>
							</div>
						</div>
						@if ( count($value['addons_airlines']) )
							@foreach ($value['addons_airlines'] as $key2 => $value2)
								<div class="addon_airlines">
									<div class="row">
										<div class="col-md-12">
											Add ons Airline <hr>
										</div>
									</div>
									<div class="row">
										@include('admin.trip.partials.create-trip-airlines-fields', array('name' => 'addon['.$key.'][addons_airlines]', 'old' => false, 'key' => $key2))
										{!! Form::hidden('addon['.$key.'][addons_airlines]['.$key2.'][airline_id]', $value2->id, ['class' => 'form-control']) !!}
										<div class="col-md-12 remove-addon-airlines-div">
											@if($key2)
												<a href="javascript:void(0);" class="remove_addon_airline"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
											@endif
										</div>
									</div>
								</div>
							@endforeach
						@else
							<div class="addon_airlines">
								<div class="row">
									<div class="col-md-12">
										Add ons Airline <hr>
									</div>
								</div>
								<div class="row">
									@include('admin.trip.partials.create-trip-airlines-fields', array('name' => 'addon[0][addons_airlines]', 'old' => false, 'key' => 0))
									<div class="col-md-12 remove-addon-airlines-div"></div>
								</div>
							</div>
						@endif
						<div class="row">
							<div class="col-md-12 remove-addon-plus-details-div"></div>
						</div>
					</div>
				</div>	
			@endforeach
		@endif
	@endif
</div>