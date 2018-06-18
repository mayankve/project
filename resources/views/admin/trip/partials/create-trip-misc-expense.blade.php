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
                    </div>
                @endif
            @endforeach
        @else
            @foreach($miscExpense as $key => $value)
            	<div class="col-md-12 misc-expense-default">
	                <div class="form-group">
	                    {!! Form::label('misc_expense['.$key.'][value]', $value) !!}
	                    {!! Form::hidden('misc_expense['.$key.'][label]', $value) !!}
	                    {!! Form::text('misc_expense['.$key.'][value]', null, ['class' => 'form-control']) !!}
	                </div>
                </div>
            @endforeach
            <div class="col-md-12">
                {!! Form::label('', 'Other') !!}
            </div>
            <div class="col-md-12 misc-expense-other">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('misc_expense['.count($miscExpense).'][label]', 'Title') !!}
                            {!! Form::text('misc_expense['.count($miscExpense).'][label]', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('misc_expense['.count($miscExpense).'][value]', 'Value') !!}
                            {!! Form::text('misc_expense['.count($miscExpense).'][value]', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4 action-expense-other" style="margin-top: 36px;">
                        <button type="button" class="btn add-expense-other"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>