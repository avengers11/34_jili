@extends('admin.layout.main')
@section('admin_title', 'Settings Page')
@section('master')

<form method="POST" action="{{ route('ManageSubmit') }}">

    <div class="row">

       <div class="col-12">
            @if (session()->has('st'))
                <div class="alert @if(session()->get('st') == true) alert-success @else alert-danger @endif alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('msg') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
       </div>

        <div class="col-lg-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Games Property</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-label-left input_mask">
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3">Game Status</label>
                            <div class="col-md-9 col-sm-9">
                                <select class="form-control" name="st">
                                    <option value="{{ $dataType->st }}">
                                        @if ($dataType->st == 0)
                                        OFF
                                        @else
                                        ON
                                        @endif
                                    </option>
                                    <option class="@if($dataType->st==0) d-none @endif" value="0">OFF</option>
                                    <option class="@if($dataType->st==1) d-none @endif" value="1">ON</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3">Game Run</label>
                            <div class="col-md-9 col-sm-9">
                                <select class="form-control" name="run">
                                    <option value="{{ $dataType->run }}">
                                        @if ($dataType->run == 0)
                                        Manual
                                        @else
                                        Auto
                                        @endif
                                    </option>
                                    <option class="@if($dataType->run==0) d-none @endif" value="0">Manual</option>
                                    <option class="@if($dataType->run==1) d-none @endif" value="1">Auto</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3">Next Win</label>
                            <div class="col-md-9 col-sm-9">
                                <select class="form-control text-capitalize" name="nextwin">
                                    <option value="{{ $dataType->nextwin }}">{{ $dataType->nextwin }}</option>
                                    <option class="@if($dataType->nextwin=="board1") d-none @endif" value="board1">board1</option>
                                    <option class="@if($dataType->nextwin=="board2") d-none @endif" value="board2">board2</option>
                                    <option class="@if($dataType->nextwin=="board3") d-none @endif" value="board3">board3</option>
                                    <option class="@if($dataType->nextwin=="board4") d-none @endif" value="board4">board4</option>
                                </select>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Game winning rate</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Win 5x</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" class="form-control" placeholder="Win 5x" value="{{ $dataType->x5 }}" name="x5" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Min Win</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" class="form-control" placeholder="Min Win" value="{{ $dataType->min }}" name="min" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Mid Win</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" class="form-control" placeholder="Mid Win" value="{{ $dataType->mid }}" name="mid" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Max Win</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" class="form-control" placeholder="Max Win" value="{{ $dataType->max }}" name="max" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <button style="width: 100%" type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </div>

</form>


@endsection
