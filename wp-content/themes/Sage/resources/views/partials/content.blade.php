<article @php post_class() @endphp>
        @include('partials/entry-thumbnail')
      <header>
        <h2 class="entry-title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
        @include('partials/entry-meta')
      </header>
      <div class="entry-summary" style="max-width: 680px;">
        @php the_excerpt() @endphp
      </div>   
</article>
