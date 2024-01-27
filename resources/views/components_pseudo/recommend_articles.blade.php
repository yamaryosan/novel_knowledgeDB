@foreach($dummy_articles as $dummy_article)
    @component('components_workspace.dummy_article_item', ['dummy_article' => $dummy_article])
    @endcomponent
@endforeach
