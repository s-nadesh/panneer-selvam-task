


<form action="{{ $category->exists ? route('categorys.update', $category) : route('categorys.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($category->exists)
        @method('PUT')
    @endif

    <div class="form-group">
        <label class="form-label" for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{old('name', $category->name)}}">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="category_img" class="form-label custom-file-input">Choose file</label>
        <input class="form-control" type="file" id="category_img" name="category_img">
    </div>

    @if($category->exists && !empty($category->category_img))
        <div class="form-group">
            <img src="{{ asset('storage/category_imgs/'.$category->category_img) }}" width="150" class="img-thumbnail">
        </div>
    @endif

    
    <button class="btn btn-primary" type="submit">
        {{ $category->exists ? 'Update category' : 'Create category' }}
    </button>
</form>