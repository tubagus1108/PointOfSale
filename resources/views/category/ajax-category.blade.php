<form action="{{ route('category-edit-execute') }}" method="POST">@csrf
    <div class="modal-header" >
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body" id="box_edit_category">
            {{-- Data will be sent --}}
            <input type="hidden" name="id" value="{{$data['id']}}">
            <div class="form-group">
                <label for="">Name : </label>
                <input type="text" name="name" required class="form-control" value="{{$data['name']}}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="">description : </label>
                <input type="text" name="description" required class="form-control" value="{{$data['description']}}">
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