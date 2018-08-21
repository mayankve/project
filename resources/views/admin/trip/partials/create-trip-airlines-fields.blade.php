@if($old)
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.airline_name') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][airline_name]', 'Airline Name') !!}
			{!! Form::select($name.'['.$key.'][airline_name]', $airlinesPluck, null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.airline_name'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.airline_name') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'['.$key.'][airline_departure_location]', 'Departure Location') !!}
			{!! Form::text($name.'['.$key.'][airline_departure_location]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.airline_departure_date') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][airline_departure_date]', 'Departure Date') !!}
			{!! Form::date($name.'['.$key.'][airline_departure_date]', null, ['class' => 'form-control airline_departure_date']) !!}
			@if($errors->has($hasName.'.'.$key.'.airline_departure_date'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.airline_departure_date') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.airline_departure_time') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][airline_departure_time]', 'Departure Time') !!}
			{!! Form::time($name.'['.$key.'][airline_departure_time]', null, ['class' => 'form-control time']) !!}
			@if($errors->has($hasName.'.'.$key.'.airline_departure_time'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.airline_departure_time') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.airline_layovers') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][airline_layovers]', 'Layovers (MM)') !!}
			{!! Form::number($name.'['.$key.'][airline_layovers]', null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.airline_layovers'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.airline_layovers') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.airline_baggage_allowance') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][airline_baggage_allowance]', 'Baggage Allowance (Kg)') !!}
			{!! Form::number($name.'['.$key.'][airline_baggage_allowance]', null, ['class' => 'form-control', 'step' => '0.01']) !!}
			@if($errors->has($hasName.'.'.$key.'.airline_baggage_allowance'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.airline_baggage_allowance') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.airline_our_cost') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][airline_our_cost]', 'Our Cost') !!}
			{!! Form::number($name.'['.$key.'][airline_our_cost]', null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.airline_our_cost'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.airline_our_cost') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.airline_cost') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][airline_cost]', 'Cost') !!}
			{!! Form::number($name.'['.$key.'][airline_cost]', null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.airline_cost'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.airline_cost') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.airline_due_date') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][airline_due_date]', 'Due Date') !!}
			{!! Form::date($name.'['.$key.'][airline_due_date]', null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.airline_due_date'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.airline_due_date') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.airline_reserve_type') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][airline_reserve_type]', 'Reserve Type') !!}
			{!! Form::select($name.'['.$key.'][airline_reserve_type]', array(0 => 'Flat', 1 => 'Percentage'), null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.airline_reserve_type'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.airline_reserve_type') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.airline_reserve_amount') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][airline_reserve_amount]', 'Reserve Amount') !!}
			{!! Form::number($name.'['.$key.'][airline_reserve_amount]', null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.airline_reserve_amount'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.airline_reserve_amount') }}</span>
			@endif
		</div>
	</div>
@else
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'['.$key.'][airline_name]', 'Airline Name') !!}
			{!! Form::select($name.'['.$key.'][airline_name]', $airlinesPluck, null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'['.$key.'][airline_departure_location]', 'Departure Location') !!}
			{!! Form::text($name.'['.$key.'][airline_departure_location]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'['.$key.'][airline_departure_date]', 'Departure Date') !!}
			{!! Form::date($name.'['.$key.'][airline_departure_date]', null, ['class' => 'form-control airline_departure_date']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'['.$key.'][airline_departure_time]', 'Departure Time') !!}
			{!! Form::time($name.'['.$key.'][airline_departure_time]', null, ['class' => 'form-control time']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'['.$key.'][airline_layovers]', 'Layovers (MM)') !!}
			{!! Form::number($name.'['.$key.'][airline_layovers]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'['.$key.'][airline_baggage_allowance]', 'Baggage Allowance (Kg)') !!}
			{!! Form::number($name.'['.$key.'][airline_baggage_allowance]', null, ['class' => 'form-control', 'step' => '0.01']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'['.$key.'][airline_our_cost]', 'Our Cost') !!}
			{!! Form::number($name.'['.$key.'][airline_our_cost]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'['.$key.'][airline_cost]', 'Cost') !!}
			{!! Form::number($name.'['.$key.'][airline_cost]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'['.$key.'][airline_due_date]', 'Due Date') !!}
			{!! Form::date($name.'['.$key.'][airline_due_date]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'['.$key.'][airline_reserve_type]', 'Reserve Type') !!}
			{!! Form::select($name.'['.$key.'][airline_reserve_type]', array(0 => 'Flat', 1 => 'Percentage'), null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'['.$key.'][airline_reserve_amount]', 'Reserve Amount') !!}
			{!! Form::number($name.'['.$key.'][airline_reserve_amount]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
@endif