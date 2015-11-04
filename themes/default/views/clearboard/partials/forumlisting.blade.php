<div class="listing-entry">
    <img src="{{ theme_asset('img/unread.png') }}" alt="" class="listing-forum-hasread">
    <div>
        <div class="listing-entry-name">
            <a href="{{ url('forum/' . $forum->id . '-' . urlencode(str_replace(' ', '_', $forum->name))) }}">{{ $forum->name }}</a>
        </div>
        <br>
        <div class="listing-entry-desc">
            {{ $forum->description }}
        </div>
    </div>
</div>