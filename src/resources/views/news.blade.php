<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Новости</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>
<body>
<div class="container">

    <h1 class="mb-3">Новости</h1>

    @foreach($news as $pieceOfNews)
        <div class="card mb-3">
            <div class="card-body">

                <div class="row">
                    <div class="col-10">
                        <h5 class="card-title mb-3">
                            {{ $pieceOfNews->title }}
                        </h5>
                    </div>
                    <div class="col-2 h6">
                        {{ $pieceOfNews->publication }}
                    </div>
                </div>

                <div class="row">

                    <div class="col-9">
                        <p class="card-text">
                            {{ $pieceOfNews->description }}
                        </p>

                        @foreach($pieceOfNews->tags as $tag)
                            <span class="tag badge bg-secondary mb-3">
                                {{ $tag->name }}
                            </span>

                        @endforeach

                        <div class="mb-3">
                            <a href="{{ $pieceOfNews->link }}" class="btn btn-dark">Подробнее</a>
                        </div>

                        <button class="like btn btn-primary"
                                data-value="{{ $pieceOfNews->id }}"
                                type="button" >
                            Нравится <span class="badge badge-primary">
                                {{ $pieceOfNews->likes_count }}
                            </span>
                        </button>

                        <button class="dislike btn btn-secondary"
                                data-value="{{ $pieceOfNews->id }}"
                                type="button">
                            Не нравится <span class="badge badge-secondary">
                                {{ $pieceOfNews->dislikes_count }}
                            </span>
                        </button>
                    </div>

                    <div class="col-3">
                        <img src="{{ asset('storage/' . $pieceOfNews->image_path) }}"
                             class="card-img-top" alt="{{ $pieceOfNews->title }}">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div>
        {{ $news->links() }}
    </div>
</div>
</body>
</html>

