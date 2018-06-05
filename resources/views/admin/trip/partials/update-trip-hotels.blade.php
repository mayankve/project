<div class="panel-heading">
	Hotels
	<a class="addMore hotel-plus pull-right" row="hotel-row" style="padding: 0;"><i class="fa fa-plus" aria-hidden="true"></i></a>
</div>
<div class="panel-body">
	@if(count(old('hotels')))
		@foreach (old('hotels') as $key => $value)
			<div class="panel panel-success hotel_details">
				<div class="panel-heading">&nbsp;</div>
				<div class="panel-body">
					<div class="row">
						@include('admin.trip.partials.create-trip-hotels-fields', array('name' => 'hotels', 'hasName' => 'hotels', 'old' => true, 'key' => $key))
						{!! Form::hidden('hotels['.$key.'][hotel_id]', null, ['class' => 'form-control']) !!}
						<div class="col-md-12 remove-hotel-details-div">
							@if($key)
								<a href="javascript:void(0);" class="remove_hotel_details"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@else
		@if ( count($trip['hotels']) )
			@foreach ($trip['hotels'] as $value)
				<div class="panel panel-success hotel_details">
					<div class="panel-heading">&nbsp;</div>
					<div class="panel-body">
						<div class="row">
							@include('admin.trip.partials.create-trip-hotels-fields', array('name' => 'hotels', 'old' => false, 'key' => $loop->index))
							{!! Form::hidden('hotels['.$loop->index.'][hotel_id]', $value->id, ['class' => 'form-control']) !!}
							<div class="col-md-12 remove-hotel-details-div">
								@if($loop->index)
									<a href="javascript:void(0);" class="remove_hotel_details"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
								@endif
							</div>
						</div>
					</div>
				</div>
			@endforeach
		@endif
	@endif
</div>