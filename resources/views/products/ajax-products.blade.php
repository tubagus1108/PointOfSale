<form action="{{ route('products-edit-execute') }}" enctype="multipart/form-data" method="POST">@csrf
    <div class="modal-header" >
        <h5 class="modal-title" id="exampleModalLabel">Edit Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body" id="box_edit_products">
            {{-- Data will be sent --}}
            <input type="hidden" name="id" value="{{$data['id']}}">
            <div class="form-group">
                <label for="">Code : </label>
                <input type="text" name="code" required class="form-control" value="{{$data['code']}}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="">Name : </label>
                <input type="text" name="name" required class="form-control" value="{{$data['name']}}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="">Description : </label>
                <input type="text" name="description" required class="form-control" value="{{$data['description']}}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="">Stok : </label>
                <input type="text" name="stock" required class="form-control" value="{{$data['stock']}}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="">Price : </label>
                <input type="text" name="price" required class="form-control" value="{{$data['price']}}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="">Images : </label>
                <input type="file" name="photo" class="form-control">
                @if (!empty($data->photo))
                    <hr>
                    <img src="{{ $data['photo'] }}"
                        alt="{{ $data->name }}"
                        width="150px" height="150px">
                @endif
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
