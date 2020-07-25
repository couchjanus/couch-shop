@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Edit product') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ __('product name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ __('name Field Required') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ __('product price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ __('price Field Required') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="description">{{ __('description') }}</label>
                <textarea class="form-control" name="description" id="description" required>
                {{ $product->description }}</textarea>
                <span class="help-block">{{ __('description Field Required') }}</span>
            </div>

            <div class="form-group">
                <label for="recommended">{{ __('Is recommended?') }}</label>
                <input class="form-control" type="checkbox" name="recommended" id="recommended" {{ ($product->recommended == 1)?'checked':'' }}>
                <span class="help-block">{{ __('Recommended Product') }}</span>
            </div>
            
            <div class="form-group">

            <div class="mx-auto" style="width: 30%;"><img src="{{ $product->cover }}"></div>

              <div class="mx-auto uploader">
                <input id="file-upload" type="file" name="cover" accept="image/*" onchange="readURL(this);">
                <label for="file-upload" id="file-drag">
                    <img id="file-image" src="#" alt="Preview" class="hidden">
                    <div id="start">
                        <i class="fas fa-download" aria-hidden="true"></i>
                        <div>Change This Image</div>
                        <div id="notimage" class="hidden">Please select an image</div>
                        <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                        <br>
                        <span class="text-danger">{{ $errors->first('cover') }}</span>
                    </div>
                </label>
              </div>
            </div>
            
            <div class="form-group">
                <label class="required" for="category">{{ __('Category') }}</label>
                <select class="form-control select2" name="category_id" id="category" required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ ($product->category_id == $id) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                <span class="help-block">{{ __('Category Field Required') }}</span>
            </div>
            <div class="form-group">
                <label for="status" class= 'control-label'>Select status</label>
                <select name="status" class="form-control select2" id='status'>
                    @foreach(['active', 'pending', 'idle'] as $value)
                        <option value="{{ $value }}"
                            {{ ($product->status == $value) ? 'selected':'' }}  />
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
    function readURL(input, id) {
        id = id || '#file-image';
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $(id).attr('src', e.target.result);
            };
    
            reader.readAsDataURL(input.files[0]);
            $('#file-image').removeClass('hidden');
            $('#start').hide();
        }
    }
</script>
@endpush