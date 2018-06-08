<div class="panel-heading">
	Airlines
	<a class="addMore airline-plus pull-right" row="airline-row" style="padding: 0;"><i class="fa fa-plus" aria-hidden="true"></i></a>
</div>
<div class="panel-body">
	@if(count(old('airline')))
		@foreach (old('airline') as $key => $value)
			<div class="panel panel-success airline_details">
				<div class="panel-heading">&nbsp;</div>
				<div class="panel-body">
					<div class="row">
						@include('admin.trip.partials.create-trip-airlines-fields', array('name' => 'airline', 'hasName' => 'airline', 'old' => true, 'key' => $key))
						{!! Form::hidden('airline['.$key.'][airline_id]', null, ['class' => 'form-control']) !!}
						<div class="col-md-12 remove-airline-details-div">
							@if($key)
								<a href="javascript:void(0);" class="remove_airline_details"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@else
		@if ( count($trip['airline']) )
			@foreach ($trip['airline'] as $value)
				<div class="panel panel-success airline_details">
					<div class="panel-heading">&nbsp;</div>
					<div class="panel-body">
						<div class="row">
							@include('admin.trip.partials.create-trip-airlines-fields', array('name' => 'airline', 'old' => false, 'key' => $loop->index))
							{!! Form::hidden('airline['.$loop->index.'][airline_id]', $value->id, ['class' => 'form-control']) !!}
							<div class="col-md-12 remove-airline-details-div">
								@if($loop->index)
									<a href="javascript:void(0);" class="remove_airline_details"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
								@endif
							</div>
						</div>
					</div>
				</div>
			@endforeach
		@endif
	@endif
</div>