


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

    <div class="form-group">
        <label class="form-label" for="description">Tags</label>
        <input name='tags' value="{{ old('tags', isset($tags) ? json_encode($tags) : '[]') }}" id="tags">    
    </div>

    @if(isset($category->images->first()->path) && !empty($category->images->first()->path))
        <div class="form-group">
            <img src="{{ asset('storage/category_imgs/'.$category->images->first()->path) }}" width="150" class="img-thumbnail">
        </div>
    @endif

    
    <button class="btn btn-primary" type="submit">
        {{ $category->exists ? 'Update category' : 'Create category' }}
    </button>
</form>