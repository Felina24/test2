@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product_show.css') }}">
@endsection

@section('content')
<main class="main">
    <div class="link">
        <a href="{{ route('products.index') }}">商品一覧</a> > {{ $product->name }}
    </div>

    <div class="content">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <div class="product-left">
                <div class="product-image">
                    <img id="preview-image" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="file-upload">
                        <input type="file" id="image" name="image" accept="image/*">
                        <p>{{ basename($product->image) }}</p>
                        @error('image')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="basic-info">
                    <div class="form-group">
                        <label for="name">商品名</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">値段</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                        @error('price')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>季節</label>
                        <div class="radio-group">
                            @foreach(['春','夏','秋','冬'] as $season)
                                <label>
                                    <input type="checkbox" name="season[]" value="{{ $season }}"
                                        {{ in_array($season, old('season', $product->seasons->pluck('name')->toArray())) ? 'checked' : '' }}>
                                    {{ $season }}
                                </label>
                            @endforeach
                        </div>
                        @error('season')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="product-bottom">
                <div class="form-group">
                    <label for="description">商品説明</label>
                    <textarea id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="button-group">
                    <a href="{{ route('products.index') }}" class="btn btn-back">戻る</a>
                    <button type="submit" class="btn btn-submit">変更を保存</button>
                </div>
            </div>
        </form>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="margin-top:10px;">
            @csrf
            <button type="submit" class="btn btn-delete" onclick="return confirm('本当に削除しますか？')">🗑</button>
        </form>
    </div>
</main>

<script>
document.getElementById('image').addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
        const preview = document.getElementById('preview-image');
        preview.src = URL.createObjectURL(file);
    }
});
</script>
@endsection
