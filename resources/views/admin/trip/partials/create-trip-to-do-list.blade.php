<div class="panel-heading">
	Trip to Do/Packing list
	<a class="addMore todo-plus pull-right" row="todo-row" style="padding: 0;"><i class="fa fa-plus" aria-hidden="true"></i></a>
</div>
<div class="panel-body">
	@if(count(old('to_do')))
		@foreach (old('to_do') as $key => $value)
			<div class="panel panel-success todo_details">
				<div class="panel-heading">&nbsp;</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group {{ $errors->has('to_do.'.$key.'.todo_name') ? 'has-error' : ''}}">
								{!! Form::label('to_do['.$key.'][todo_name]', 'Do/Packing') !!}
								{!! Form::text('to_do['.$key.'][todo_name]', null, ['class' => 'form-control']) !!}
								@if($errors->has('to_do.'.$key.'.todo_name'))
									<span class="help-block">{{ $errors->first('to_do.'.$key.'.todo_name') }}</span>
								@endif
							</div>
						</div>
						<div class="col-md-12 remove-todo-details-div">
							@if($key)
								<a href="javascript:void(0);" class="remove_todo_details"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@else
		<div class="panel panel-success todo_details">
			<div class="panel-heading">&nbsp;</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							{!! Form::label('to_do[0][todo_name]', 'Do/Packing') !!}
							{!! Form::text('to_do[0][todo_name]', null, ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="col-md-12 remove-todo-details-div"></div>
				</div>
			</div>
		</div>
	@endif
</div>