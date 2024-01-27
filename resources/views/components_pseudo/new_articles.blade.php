@foreach($new_articles as $new_article)
    @component('components_workspace.dummy_article_item', ['dummy_article' => $new_article])
    @endcomponent
@endforeach
