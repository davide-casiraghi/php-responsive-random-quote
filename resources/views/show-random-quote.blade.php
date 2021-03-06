<div class="quoteOfTheDay">
    @if(!$quoteText)
        <div class="alert alert-warning" role="alert">
          No quotes found in the DB. 
        </div>    
    @else
        <div class="text">
            <img class="start-quote" src="/vendor/responsive-quotes/assets/images/start-quote-teal.png" alt="Start Quote">
            {{--<div class="start-quote">"</div>--}}
            {{$quoteText}}
            <img class="end-quote" src="/vendor/responsive-quotes/assets/images/end-quote-teal.png" alt="End Quote">
            {{--<div class="end-quote">"</div>--}}
        </div>
        <cite>{{$quoteAuthor}}</cite>
    @endif
</div>
