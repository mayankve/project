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
		<div class="panel panel-success airline_details">
			<div class="panel-heading">&nbsp;</div>
			<div class="panel-body">
				<div class="row">
					@include('admin.trip.partials.create-trip-airlines-fields', array('name' => 'airline', 'hasName' => 'airline', 'old' => false))
					<div class="col-md-12 remove-airline-details-div"></div>
				</div>
			</div>
		</div>
	@endif
</div>