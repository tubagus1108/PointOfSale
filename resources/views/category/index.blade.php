@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                @if(session('success'))
                    <div class="row pb-4" id="flash-message">
                        <div class="col-12">
                            <div class="alert alert-success outline alert-dismissible fade show" role="alert"><i data-feather="thumbs-up"></i>
                                <p>{{session('success')}}</p>
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                        </div>
                    </div>
                @endif
                <h5 class="text-center font-weight-bold">Managemet Category</h5>
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddCategory"> <i class="fa fa-plus"></i> </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="ui celled table table-striped" id="data-category">
                            <thead>
                                <tr class="text-center">
                                    <th width="50">#</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                    <th width="100px">Created At</th>
                                </tr>
                            </thead>
                        </table>   
                    </div>
                </div>
            </div>
        </div>
    </div>
     {{-- Modal Edit category --}}
     <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content" id="box_edit_category">
        </div>
        </div>
    </div>
    {{-- Modal Add Category --}}
    <div class="modal fade" id="AddCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('main-category-post') }}" method="post">@csrf
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Category</label>
                            <input type="text" class="form-control" name="name" placeholder="enter category">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" id="" name="description" rows="3" placeholder="enter description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Datatable
        $(function(){
            $('#data-category').DataTable({
                ajax: '{{route('category-datatable')}}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name'},
                    { data: 'description', name: 'description'},
                    { data: 'created_at', name: 'created_at'},
                    { data: 'action', name: 'action'},
                ],
                language: {
                searchPlaceholder: 'Search Category..',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
                destroy: true
                },  
                columnDefs:[
                    {
                        "targets" : [0,1,3,4],
                        "className": "text-center"
                    },
                ],              
                
                dom: 'Bfrtip',  
                buttons: [
                    {extend:'copy', className: 'bg-info text-white rounded-pill ml-2 border border-white'},
                    {extend:'excel', className: 'bg-success text-white rounded-pill border border-white'},
                    {extend:'pdf', className: 'bg-danger text-white rounded-pill border border-white'},
                    {extend:'print', className: 'bg-warning text-white rounded-pill border border-white'},
                ],
                "bDestroy": true,
                "processing": true,
                "serverSide": true, 
            });
        });
        editCategory = (link) => {
            $.ajax({
                url: link,
                success: function(response){
                    $('#box_edit_category').html(response)
                }
            })
        }
    </script>
@endsection