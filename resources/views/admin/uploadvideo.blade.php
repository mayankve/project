@extends('admin.layouts.dashboard')
@section('title', 'Dashboard')

@section('content')

<style type="text/css">
    .form-title {
        background-color: #e3e3e3;
        /* margin-bottom: 40px; */
        text-transform: uppercase;
    }
</style>

<div class="pageContainer">
    <div class="dashboardHeader">
        <div class="row">
            <div class="col-sm-6 text-left">
                <div class="sidebar_toggle">
                    <i class="fa fa-chevron-right" data-unicode="f00a"></i>
                </div>
                <ol class="breadcrumb">
                    <li>
                        <a class="desh-title" href="#">Dashboard</a>
                    </li>
                    <li class="active">
                        <a>
                             Upload-trip-video   </a>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 text-right">
                <h3 class="userName">
                    Welcome {{ Auth::user()->name }}
				</h3>
            </div>
        </div>
    </div>
    <div class="clearfix create-trip">
        <div class="panel panel-primary">
            <div class="panel-heading white-bg">
                <h3 class="panel-title">Upload Trip's Video</h3>
                <div class="panel-tools">
                </div>
            </div>
        </div>
	@if ($message = Session::get('error'))
			<div class="alert alert-danger alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>	
					<p>{{ $message }}</p>
			</div>
	@endif
	{!! Form::open(['url' => 'admin/store_video', 'files' => true, 'id' => 'form-create-trip', 'method'=>'post']) !!}

	@if(Session::has('message'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
	@endif
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-fluid">
                <div class="row-box">
                    <div class="col-md-12">
                        <br/>
                        <div class="row">
                            <div class="col-md-6  cust-input-group">
										<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
										{!! Form::label('name', 'Trip') !!}               
										{!! Form::select('tripname', $tripDetail, null, ['class' => 'form-control']) !!}
										@if($errors->has('name'))
										<span class="help-block">{{ $errors->first('name') }}</span>
										@endif
									</div>
                            </div>
                            <div class="col-md-6  cust-input-group">
							
                               <div class="form-group {{ $errors->has('video') ? 'has-error' : ''}}">
									{!! Form::label('Upload Trip Video', 'Upload Trip Video') !!}
									{!! Form::file('video', ['class' => 'form-control']) !!}
									@if($errors->has('video'))
									<span class="help-block">{{ $errors->first('video') }}</span>
									@endif
								</div>                

								</div>


                        </div>
                        <div class="row ">     
                            <div class="col-md-6  cust-input-group">
							
						<div class="form-group {{ $errors->has('about_trip') ? 'has-error' : ''}}">
								{!! Form::label('about_trip', 'About Trip') !!}
								{!! Form::textarea('about_trip', null, ['class' => 'form-control']) !!}
								<!--<textarea class="form-control" name="about_trip" wrap="soft" ></textarea>-->
								@if($errors->has('about_trip'))
								<span class="help-block">{{ $errors->first('about_trip') }}</span>
								@endif
						</div>                 

								</div>

                        </div>
                        <div class="row ">     
                            <div class="col-md-12 text-right ">
                                 {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}      </div>

                        </div>
                    </div>
                </div>     
                <div id="progress" class="help-block">
                    <div class="progress progress-info progress-striped">
                        <div class="bar"></div>
                    </div>
                    <p></p>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <script type="text/javascript">
        $('.confirmation').on('click', function () {
            return confirm('Are you sure?');
        });
    </script>
</div>

@endsection