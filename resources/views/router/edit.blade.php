<div class="page-wrapper">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Edit Router</h5>
                </div>
            </div>
            <!-- /Title -->
            @if ($errorMsg = Session::get('errorMsg'))<span class="help-block has-error"> {{ $errorMsg }}</span> @endif
            <!-- Row -->
            <div class="row">
                {!! Form::open(['route' => ['router.update', $item->id], 'method' => 'PATCH', 'class'=>'form']) !!}
                <div class="col-md-6">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Product Information</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-wrap">
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="domain">Domain Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                    {!! Form::text('domain', $item->domain, array('class'=>'form-control', 'id'=>'domain', 'placeholder'=>'name'))!!}
                                                </div>
                                                @error('domain')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="loopback">Loopback (IP Address)</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                    {!! Form::text('loopback', $item->loopback, array('required', 'class'=>'form-control', 'id'=>'loopback','placeholder'=>'xxx.xxx.xxx.xxx'))!!}
                                                </div>
                                                @error('loopback')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="mac">MAC Address</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                    {!! Form::text('mac', $item->mac, array('required', 'class'=>'form-control', 'id'=>'mac','placeholder'=>'xx-xx-xx-xx-xx-xx'))!!}
                                                </div>
                                                @error('mac')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="status">Status</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                    @if($item->status)
                                                        <input type="checkbox" id="status" name="status" value="1" checked>
                                                    @else
                                                        <input type="checkbox" id="status" name="status" value="0">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success mr-10">Update</button>
                                                <button type="submit" class="btn btn-default">Cancel</button>
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
            <!-- /Row -->
        </div>
    </div>
