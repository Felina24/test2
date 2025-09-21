@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<main class="main">
    <h2>商品登録</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="form-group">
            <label for="name">商品名　<span class="required">必須</span></label>
            <input type="text" id="name" name="name" required value="{{ old('name') }}"placeholder="商品名を入力">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">値段　<span class="required">必須</span></label>
            <input type="number" id="price" name="price" required value="{{ old('price') }}"placeholder="値段を入力">
            @error('price')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">商品画像　<span class="required">必須</span></label>
            <input type="file" id="image" name="image" accept="image/*" required onchange="previewImage(event)">
            @error('image')
                <div class="error">{{ $message }}</div>
            @enderror
            <div id="preview">
                <img id="preview-img" src="" alt="プレビュー" style="display:none; max-width:200px; margin-top:10px;">
            </div>
        </div>

        <div>季節　<span class="required">必須</span><span class="multiple">複数選択可</span></div>
        <div class="radio-group">
            <div class="radio-group">
                <label><input type="checkbox" name="season[]" value="春" {{ (is_array(old('season')) && in_array('春', old('season'))) ? 'checked' : '' }}> 春</label>
                <label><input type="checkbox" name="season[]" value="夏" {{ (is_array(old('season')) && in_array('夏', old('season'))) ? 'checked' : '' }}> 夏</label>
                <label><input type="checkbox" name="season[]" value="秋" {{ (is_array(old('season')) && in_array('秋', old('season'))) ? 'checked' : '' }}> 秋</label>
                <label><input type="checkbox" name="season[]" value="冬" {{ (is_array(old('season')) && in_array('冬', old('season'))) ? 'checked' : '' }}> 冬</label>
            </div>
            @error('season')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">商品説明　<span class="required">必須</span></label>
            <textarea id="description" name="description" rows="5" required placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="button-group">
            <a href="{{ route('products.index') }}" class="btn btn-back">戻る</a>
            <button type="submit" class="btn btn-submit">登録</button>
        </div>
    </form>
</main>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('preview-img');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
