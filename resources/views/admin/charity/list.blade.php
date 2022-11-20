@extends('admin.layout.index')
@section('content')
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="feather icon-book bg-c-blue"></i>
                <div class="d-inline">
                    <h4>Charity</h4>
                    <span>List</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class=" breadcrumb breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="/admin/charity/list"><i class="feather icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Charity</li>
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
                        <div class="card-block"> 
                            <a href="admin/charity/add" class="text-light ">
                                <button class=" btn btn-primary float-right mb-3 " >Add</button>
                            </a>
                            <button style="margin-bottom: 10px" data-url="{{ url('ajax/deleteall_charity') }}" class="btn btn-danger delete_all">Delete_all</button>
                            <a href="admin/charity/addvideo" class="text-light ">
                                <button class=" btn btn-primary float-right mb-3 mr-1" >Videos</button>
                            </a>
                            
                            <div class="dt-responsive table-responsive">
                                {{-- <table class="table table-bordered nowrap"> --}}
                                <table class="table table-bordered nowrap">
                                    <thead>
                                        <tr align="center">
                                        <th><input type="checkbox" id="master"></th>
                                            <th>Images</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($charity as $value)
                                        @if($value['image'] !=NULL)
                                        <tr align="center">
                                        <td><input type="checkbox" class="sub_chk" data-id="{!! $value['id'] !!}"></td>
                                            <td>
                                            <img width="300px" src="upload/charity/{!! $value['image'] !!}" alt="">
                                            </td>
                                            <td class="center"><a class="btn btn-warning " href="admin/charity/edit/{!! $value['id'] !!}">Edit</a></td>
                                            <td class="center "><a href="javascript:void(0)" data-url="{{ url('ajax/delete_charity', $value['id'] ) }}" class="btn btn-danger delete-charity">Delete</a></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                <button style="margin-bottom: 10px" data-url="{{ url('ajax/deleteall_charity_videos') }}" class="btn btn-danger delete_all_videos">Delete_all_videos</button>
                                <table class="table table-bordered nowrap ">
                                    <thead>
                                        <tr align="center">
                                        <th><input type="checkbox" id="master1"></th>
                                            <th>Videos</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($charity as $value)
                                        @if($value['path'] !=NULL)
                                        <tr align="center">
                                        <td><input type="checkbox" class="sub_chk1" data-id="{!! $value['id'] !!}"></td>
                                        <td><iframe style="height: 400px;" width="100%"  src="@if(isset($value['path'])) 
                                            https://www.youtube.com/embed/{!! $value['path'] !!} 
                                            @endif" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
                                            <td class="center"><a class="btn btn-warning " href="admin/charity/editvideo/{!! $value['id'] !!}">Edit</a></td>
                                            <td class="center "><a href="javascript:void(0)" data-url="{{ url('ajax/delete_charity_videos', $value['id'] ) }}" class="btn btn-danger delete-charity_videos">Delete</a></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $charity->links() !!}   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#master').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });
        $('.delete_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            if (allVals.length <= 0) {
                alert("Please select row.");
            } else {
                var check = confirm("Are you sure you want to delete this row?");
                if (check == true) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + join_selected_values,
                        success: function(data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                // alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                    $.each(allVals, function(index, value) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                }
            }
        });
    });
    //delete_all video
    $(document).ready(function() {
        $('#master1').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk1").prop('checked', true);
            } else {
                $(".sub_chk1").prop('checked', false);
            }
        });
        $('.delete_all_videos').on('click', function(e) {
            var allVals = [];
            $(".sub_chk1:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            if (allVals.length <= 0) {
                alert("Please select row.");
            } else {
                var check = confirm("Are you sure you want to delete this row?");
                if (check == true) {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + join_selected_values,
                        success: function(data) {
                            if (data['success']) {
                                $(".sub_chk1:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                // alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                    $.each(allVals, function(index, value) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                }
            }
        });
    });

    //delete ajax 
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete-charity').on('click', function() {
            var userURL = $(this).data('url');
            var trObj = $(this);
            if (confirm("Are you sure you want to remove it?") == true) {
                $.ajax({
                    url: userURL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        if (data['success']) {
                            // alert(data.success);
                            trObj.parents("tr").remove();
                        } else if (data['error']) {
                            alert(data.error);
                        }
                    }
                });
            }

        });
    });
    //delete ajax video
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete-charity_videos').on('click', function() {
            var userURL = $(this).data('url');
            var trObj = $(this);
            if (confirm("Are you sure you want to remove it?") == true) {
                $.ajax({
                    url: userURL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        if (data['success']) {
                            // alert(data.success);
                            trObj.parents("tr").remove();
                        } else if (data['error']) {
                            alert(data.error);
                        }
                    }
                });
            }

        });
    });
</script>
@endsection