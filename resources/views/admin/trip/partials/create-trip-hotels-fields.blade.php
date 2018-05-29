@if($old)
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.hotel_name') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][hotel_name]', 'Hotel Name') !!}
			{!! Form::text($name.'['.$key.'][hotel_name]', null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.hotel_name'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.hotel_name') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.hotel_type') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][hotel_type]', 'Type') !!}
			{!! Form::text($name.'['.$key.'][hotel_type]', null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.hotel_type'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.hotel_type') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.hotel_cost') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][hotel_cost]', 'Cost') !!}
			{!! Form::number($name.'['.$key.'][hotel_cost]', null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.hotel_cost'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.hotel_cost') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.hotel_solo_cost') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][hotel_solo_cost]', 'Solo Cost') !!}
			{!! Form::number($name.'['.$key.'][hotel_solo_cost]', null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.hotel_solo_cost'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.hotel_solo_cost') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.hotel_our_cost') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][hotel_our_cost]', 'Our Cost') !!}
			{!! Form::number($name.'['.$key.'][hotel_our_cost]', null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.hotel_our_cost'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.hotel_our_cost') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.hotel_our_solo_cost') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][hotel_our_solo_cost]', 'Our Solo Cost') !!}
			{!! Form::number($name.'['.$key.'][hotel_our_solo_cost]', null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.hotel_our_solo_cost'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.hotel_our_solo_cost') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.hotel_due_date') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][hotel_due_date]', 'Due Date') !!}
			{!! Form::date($name.'['.$key.'][hotel_due_date]', null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.hotel_due_date'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.hotel_due_date') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.hotel_reserve_type') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][hotel_reserve_type]', 'Reserve Type') !!}
			{!! Form::select($name.'['.$key.'][hotel_reserve_type]', array(0 => 'Flat', 1 => 'Percentage'), null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.hotel_reserve_type'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.hotel_reserve_type') }}</span>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has($hasName.'.'.$key.'.hotel_reserve_amount') ? 'has-error' : ''}}">
			{!! Form::label($name.'['.$key.'][hotel_reserve_amount]', 'Reserve Amount') !!}
			{!! Form::number($name.'['.$key.'][hotel_reserve_amount]', null, ['class' => 'form-control']) !!}
			@if($errors->has($hasName.'.'.$key.'.hotel_reserve_amount'))
				<span class="help-block">{{ $errors->first($hasName.'.'.$key.'.hotel_reserve_amount') }}</span>
			@endif
		</div>
	</div>
@else
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'[0][hotel_name]', 'Hotel Name') !!}
			{!! Form::text($name.'[0][hotel_name]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'[0][hotel_type]', 'Type') !!}
			{!! Form::text($name.'[0][hotel_type]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'[0][hotel_cost]', 'Cost') !!}
			{!! Form::number($name.'[0][hotel_cost]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'[0][hotel_solo_cost]', 'Solo Cost') !!}
			{!! Form::number($name.'[0][hotel_solo_cost]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'[0][hotel_our_cost]', 'Our Cost') !!}
			{!! Form::number($name.'[0][hotel_our_cost]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'[0][hotel_our_solo_cost]', 'Our Solo Cost') !!}
			{!! Form::number($name.'[0][hotel_our_solo_cost]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'[0][hotel_due_date]', 'Due Date') !!}
			{!! Form::date($name.'[0][hotel_due_date]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'[0][hotel_reserve_type]', 'Reserve Type') !!}
			{!! Form::select($name.'[0][hotel_reserve_type]', array(0 => 'Flat', 1 => 'Percentage'), null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label($name.'[0][hotel_reserve_amount]', 'Reserve Amount') !!}
			{!! Form::number($name.'[0][hotel_reserve_amount]', null, ['class' => 'form-control']) !!}
		</div>
	</div>
@endif