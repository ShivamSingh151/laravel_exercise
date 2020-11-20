<div class="page-wrapper">
        <div class="container-fluid">

            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="txt-dark">Router Management</h5>
                </div>
            </div>

            <div class="row">

                 <div class="panel-heading">
                    {!! Form::open(array('route' => 'router.index', 'class'=>'', 'files'=> true, 'method' => 'get') ) !!}
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="form-wrap">
                                    <form class="form-horizontal">
                                        <div class="form-group mb-0">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label mb-10">Domain</label>
                                                        {!! Form::text('domain', $params['domain'], array('class'=>'form-control', 'id'=>'domain','placeholder'=>'domain name')) !!}
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="control-label mb-10">Loopback</label>
                                                        {!! Form::text('loopback', $params['loopback'], array('class'=>'form-control', 'id'=>'loopback', 'placeholder'=>'loopback')) !!}
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="control-label mb-10">Mac</label>
                                                        {!! Form::text('mac', $params['mac'], array('class'=>'form-control', 'id'=>'mac', 'placeholder'=>'mac')) !!}
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="col-sm-4 mt-30">
                                                            {{ Form::button('<span class="btn-text">search</span> <span class="btn-label"><i class="fa fa-search"></i> </span>', ['type' => 'submit', 'class' => 'form-control btn btn-info btn-rounded btn-lable-wrap left-label'] )  }}
                                                        </div>
                                                        <div class="col-sm-4 mt-30">
                                                            <a id="index" class="form-control btn btn-danger btn-rounded btn-lable-wrap left-label pt-10" href="{{URL::route('router.index')}}">
                                                                <span class="btn-text">reset</span> <span class="btn-label"><i class="fa fa-close"></i> </span>
                                                            </a>
                                                        </div>
                                                        <div class="col-sm-4 mt-30">
                                                            <a style="color:red;" class="form-control btn btn-success btn-rounded btn-lable-wrap left-label pt-10" href="{{URL::route('router.create')}}">
                                                                <span class="btn-text">Add Router</span> <span class="btn-label"><i class="fa fa-plus"></i> </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap mt-40">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Doamin Name</th>
                                    <th>Loopback</th>
                                    <th>Mac</th>
                                    <!-- <th>Status</th> -->
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($items as $key => $item)
                                    <tr>
                                        <td>{{ ($items->firstItem() + $key)}}</td>
                                        <td>{{ $item->domain }}</td>
                                        <td>{{ $item->loopback }}</td>
                                        <td>{{ $item->mac }}</td>
                                        <!-- <td>
                                            @if($item->status == 1)
                                                <button type="button" class="btn btn-sm btn-rounded btn-primary">Active</button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-rounded btn-danger">InActive</button>
                                            @endif
                                        </td> -->
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ URL::route('router.edit', $item->id) }}" class="mr-25" data-toggle="tooltip" data-original-title="Edit">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <span class="col-md-6">Showing {{$items->firstItem()}} to {{$items->lastItem()}} of  {{$items->total()}} entries</span>
                                <span class="col-md-6">{!! $items->appends($params)->render() !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
