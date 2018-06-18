<div class="panel-heading">Misc Expense</div>
<div class="panel-body">
    <div class="row misc-expense">
        @if(count(old('misc_expense')))
            @foreach (old('misc_expense') as $key => $value)
                @if(count($miscExpense) >= $loop->iteration)
                	<div class="col-md-12 misc-expense-default">
                		<div class="form-group {{ $errors->has('misc_expense.'.$key.'.value') ? 'has-error' : ''}}">
	                        {!! Form::label('misc_expense['.$key.'][label]', $value['label']) !!}
	                        {!! Form::hidden('misc_expense['.$key.'][label]') !!}
	                        {!! Form::text('misc_expense['.$key.'][value]', null, ['class' => 'form-control']) !!}
	                        @if($errors->has('misc_expense.'.$key.'.value'))
	                            <span class="help-block">{{ $errors->first('misc_expense.'.$key.'.value') }}</span>
	                        @endif
	                    </div>
	                    {!! Form::hidden('misc_expense['.$key.'][misc_id]', null, ['class' => 'form-control']) !!}
                	</div>

                	@if(count($miscExpense) == $loop->iteration)
                        <div class="col-md-12">
                            {!! Form::label('', 'Other') !!}
                        </div>
                    @endif
                @else
                    <div class="col-md-12 misc-expense-other">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('misc_expense.'.$key.'.label') ? 'has-error' : ''}}">
                                    {!! Form::label('misc_expense['.($key).'][label]', 'Title') !!}
                                    {!! Form::text('misc_expense['.($key).'][label]', null, ['class' => 'form-control']) !!}
                                    @if($errors->has('misc_expense.'.$key.'.label'))
                                        <span class="help-block">{{ $errors->first('misc_expense.'.$key.'.label') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('misc_expense.'.$key.'.value') ? 'has-error' : ''}}">
                                    {!! Form::label('misc_expense['.($key).'][value]', 'Value') !!}
                                    {!! Form::text('misc_expense['.($key).'][value]', null, ['class' => 'form-control']) !!}
                                    @if($errors->has('misc_expense.'.$key.'.value'))
                                        <span class="help-block">{{ $errors->first('misc_expense.'.$key.'.value') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 action-expense-other" style="margin-top: 36px;">
                            	@if((count($miscExpense)+1) == $loop->iteration)
									<button type="button" class="btn add-expense-other"><i class="fa fa-plus" aria-hidden="true"></i></button>
								@else
									<button type="button" class="btn remove-expense-other"><i class="fa fa-minus" aria-hidden="true"></i></button>
		                    	@endif
                            </div>
                        </div>
                        {!! Form::hidden('misc_expense['.$key.'][misc_id]', null, ['class' => 'form-control']) !!}
                    </div>
                @endif
            @endforeach
        @else
        	@if ( count($trip['misc_expense']) )
				@foreach ($trip['misc_expense'] as $value)
					@if(count($miscExpense) >= $loop->iteration)
						<div class="col-md-12 misc-expense-default">
							<div class="form-group">
        	                    {!! Form::label('misc_expense['.$loop->index.'][value]', $value['label']) !!}
        	                    {!! Form::hidden('misc_expense['.$loop->index.'][label]') !!}
        	                    {!! Form::text('misc_expense['.$loop->index.'][value]', null, ['class' => 'form-control']) !!}
        	                </div>
        	                {!! Form::hidden('misc_expense['.$loop->index.'][misc_id]', $value->id, ['class' => 'form-control']) !!}
						</div>

						@if(count($miscExpense) == $loop->iteration)
	                        <div class="col-md-12">
	                            {!! Form::label('', 'Other') !!}
	                        </div>
	                    @endif
					@else
						<div class="col-md-12 misc-expense-other">
			                <div class="row">
			                    <div class="col-md-4">
			                        <div class="form-group">
			                            {!! Form::label('misc_expense['.$loop->index.'][label]', 'Title') !!}
			                            {!! Form::text('misc_expense['.$loop->index.'][label]', null, ['class' => 'form-control']) !!}
			                        </div>
			                    </div>
			                    <div class="col-md-4">
			                        <div class="form-group">
			                            {!! Form::label('misc_expense['.$loop->index.'][value]', 'Value') !!}
			                            {!! Form::text('misc_expense['.$loop->index.'][value]', null, ['class' => 'form-control']) !!}
			                        </div>
			                    </div>
			                    <div class="col-md-4 action-expense-other" style="margin-top: 36px;">
			                    	@if((count($miscExpense)+1) == $loop->iteration)
										<button type="button" class="btn add-expense-other"><i class="fa fa-plus" aria-hidden="true"></i></button>
									@else
										<button type="button" class="btn remove-expense-other"><i class="fa fa-minus" aria-hidden="true"></i></button>
			                    	@endif
			                    </div>
			                </div>
			                {!! Form::hidden('misc_expense['.$loop->index.'][misc_id]', $value->id, ['class' => 'form-control']) !!}
			            </div>
					@endif
				@endforeach
        	@endif
        @endif
    </div>
</div>