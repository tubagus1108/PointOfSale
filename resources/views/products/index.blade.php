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
                <h5 class="text-center font-weight-bold">Managemet Products</h5>
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddProduct"> <i class="fa fa-plus"></i> </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="ui celled table table-striped" id="data-products">
                            <thead>
                                <tr class="text-center">
                                    <th width="50">#</th>
                                    <th>Images</th>
                                    <th>Code</th>
                                    <th>Product name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th width="100px">Last Update</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
     {{-- Modal Edit category --}}
     <div class="modal fade" id="editProducts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content" id="box_edit_products">
        </div>
        </div>
    </div>
    {{-- Modal Add Product --}}
    <div class="modal fade" id="AddProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('main-products-post') }}" enctype="multipart/form-data" method="POST">@csrf
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Product Code</label>
                            <input type="text" name="code" required
                                maxlength="10"
                                class="form-control {{ $errors->has('code') ? 'is-invalid':'' }}">
                            <p class="text-danger">{{ $errors->first('code') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Product name</label>
                            <input type="text" name="name" required
                                class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="description"
                                cols="5" rows="5"
                                class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}"></textarea>
                            <p class="text-danger">{{ $errors->first('description') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Stock</label>
                            <input type="number" name="stock" required
                                class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}">
                            <p class="text-danger">{{ $errors->first('stock') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" name="price" required
                                class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                            <p class="text-danger">{{ $errors->first('price') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="category_id" id="category_id"
                                required class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                <option value="">Pilih</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('category_id') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Photo</label>
                            <input type="file" name="photo" class="form-control" required>
                            <p class="text-danger">{{ $errors->first('photo') }}</p>
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
            $('#data-products').DataTable({
                ajax: '{{ route('main-products-datatable') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'photo', name: 'photo'},
                    { data: 'code', name: 'code'},
                    { data: 'name', name: 'name'},
                    { data: 'stock', name: 'stock'},
                    { data: 'price', name: 'price'},
                    { data: 'category_id', name: 'category_id'},
                    { data: 'update_at', name: 'update_at'},
                    { data: 'action', name: 'action'},
                ],
                language: {
                searchPlaceholder: 'Search Product..',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
                destroy: true
                },
                columnDefs:[
                    {
                        "targets" : [0,2,3,4,6,7,8],
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
        editProducts = (link) => {
            $.ajax({
                url: link,
                success: function(response){
                    $('#box_edit_products').html(response)
                }
            })
        }
    </script>
@endsection
