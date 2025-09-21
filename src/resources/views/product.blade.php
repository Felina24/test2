@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
<main class="main">
    <h2 class="title">
        @if(request('keyword'))
        "{{ request('keyword') }}"の商品一覧
        @else
        商品一覧
    @endif
    </h2>

    <div class="add-btn">
        <a href="{{ route('products.register') }}">+ 商品を追加</a>
    </div>

    <div class="content">
        <div class="sidebar">
            <form action="{{ route('products.index') }}" method="GET" class="search-form">
                <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
                <button type="submit" class="btn-search">検索</button>

                <div class="sort">
                    <label>価格順で表示</label>
                    <select name="sort" onchange="this.form.submit()">
                        <option value="">価格で並べ替え</option>
                        <option value="asc" {{ request('sort')=='asc' ? 'selected' : '' }}>安い順</option>
                        <option value="desc" {{ request('sort')=='desc' ? 'selected' : '' }}>高い順</option>
                    </select>
                </div>
            </form>

            @if(request('sort'))
                <div class="tag">
                    並び替え: {{ request('sort') == 'asc' ? '安い順' : '高い順' }}
                    <a href="{{ route('products.index', array_merge(request()->except('sort'))) }}" class="reset-tag">×</a>
                </div>
            @endif
        </div>

        <div class="product-area">
            <div class="product-list">
                @forelse($products as $product)
                    <div class="product-card">
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </a>
                        <p class="name">{{ $product->name }}</p>
                        <p class="price">¥{{ number_format($product->price) }}</p>
                    </div>
                @empty
                    <p>該当する商品がありません。</p>
                @endforelse
            </div>

            <div class="pagination">
                {{ $products->links('vendor.pagination.numbers') }}
            </div>
        </div>
    </div>
</main>
@endsection