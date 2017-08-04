<div class="tweet" id="{{$item['id']}}">
   <blockquote>
      <img src="{{$item['content']['user']['avatar']}}" alt="$item['content']['user']['screen_name']">
      <p>{{$item['content']['user']['screen_name']}}</p>
      <p>{{$item['content']['text']}}</p>

      @if(! is_null($item['content']['media']))
         @foreach($item['content']['media'] as $i)
            <img src="{{$i['media_url']}}" alt="">
         @endforeach
      @endif
   </blockquote>
</div>
