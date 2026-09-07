<h1>Test del Blog</h1>
<p>Total de posts: {{ $posts->count() }}</p>
<ul>
    @foreach($posts as $post)
        <li>{{ $post->title }}</li>
    @endforeach
</ul>