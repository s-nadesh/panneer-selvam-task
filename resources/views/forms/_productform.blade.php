


<form action="{{ $product->exists ? route('products.update', $product) : route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($product->exists)
        @method('PUT')
    @endif

    <div class="form-group">
        <label class="form-label" for="category_id">category_id</label>
        <select class="form-select form-select-sm mb-3 shadow-none" id="category_id" name="category_id">
            <option value="0" selected="">Open this select menu</option>
            @foreach($category as $row)
            <option value="{{$row->id}}" {{ old('category_id', optional($product)->category_id) == $row->id ? 'selected' : '' }}>{{$row->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label class="form-label" for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{old('name', optional($product)->name)}}">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="name">price:</label>
        <input type="text" class="form-control" id="price" name="price" placeholder="price" value="{{old('price', optional($product)->price)}}">
        @error('price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="name">quantity:</label>
        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="quantity" value="{{old('quantity', optional($product)->quantity)}}">
        @error('quantity')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="description">description</label>
        <textarea class="form-control" id="description" rows="5" name="description">{{ old('description', optional($product)->description) }}</textarea>
            
    </div>

    <div class="form-group">
        <label class="form-label" for="description">Tags</label>
        <input name='tags' value="{{ old('tags', isset($tags) ? json_encode($tags) : '[]') }}" id="tags">    
    </div>

    <div class="form-group">
        <label for="product_img" class="form-label custom-file-input">Choose file</label>
        <input class="form-control" type="file" id="product_img" name="product_img[]" multiple>
    </div>

    @if($product->exists && !empty($productimg))
        <div class="d-flex gap-3">
            @foreach($productimg as $row)
                <div class="form-group">
                    <img src="{{ asset('storage/product_img/'.$row->path) }}" width="80" class="img-thumbnail">
                </div>
            @endforeach
        </div>
    @endif

    
    <button class="btn btn-primary" type="submit">
        {{ $product->exists ? 'Update product' : 'Create product' }}
    </button>
</form>