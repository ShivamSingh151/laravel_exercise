<div class="page-wrapper">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Router Management</h5>
                </div>
           </div>
            @if ($errorMsg = Session::get('errorMsg'))<span class="help-block has-error"> {{ $errorMsg }}</span> @endif
            <div class="row">
                {!! Form::open(array('route' => 'router.store','method'=>'POST')) !!}
                <div class="col-md-6">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Field(*) Are Required</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-wrap">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 mb-10">Domain Name<span class="text-danger"> *</span></label>
                                                <div class="input-group">
                                                    {!! Form::text('domain', null, array('placeholder' => 'www.example.com','class' => 'form-control', 'required' => true)) !!}
                                                    <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                    @error('domain')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 mb-10">Loopback (IP Address)<span class="text-danger"> *</span></label>
                                                <div class="input-group">
                                                    {!! Form::text('loopback', null, array('placeholder' => 'xxx.xxx.xxx.xxx','class' => 'form-control', 'required' => true)) !!}
                                                    <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                    @error('loopback')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 mb-10">MAC Address<span class="text-danger"> *</span></label>
                                                <div class="input-group">
                                                    {!! Form::text('mac', null, array('placeholder' => 'xx-xx-xx-xx-xx-xx','class' => 'form-control', 'required' => true)) !!}
                                                    <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                    @error('mac')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success mr-10">Submit</button>
                                                <a href="{{ route('router.index')}}" class="btn btn-default">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>