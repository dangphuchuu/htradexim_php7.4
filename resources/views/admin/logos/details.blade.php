@extends('admin.layout.index')
@section('content')
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="feather icon-info bg-c-blue"></i>
                <div class="d-inline">
                    <h4>Logos</h4>
                    {{-- <span></span> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class=" breadcrumb breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="/admin/logos"><i class="feather icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Logos</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Logos</h5>
                        </div>
                        <div class="card-block">
                            @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $arr)
                                    {{$arr}}<br>
                                @endforeach

                            </div>
                            @endif
                            <form action="admin/logos" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-1 col-form-label">Logos</label>
                                    <div class="col-sm-11">
                                        @if(isset($logos['image']))
                                        <img src="upload/logos/{{ $logos['image'] }}" width="300px" alt="">
                                        @else
                                        <img src="upload/logos/logo1.jpg" width="300px" alt="">
                                        @endif
                                        <br>
                                        <input type="file" name="Image" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-1"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary m-b-0">Update</button>
                                    </div>
                                </div>
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
@endsection