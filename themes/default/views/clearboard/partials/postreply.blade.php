@if (Auth::check())
    <div id="postreply">
        <img src="{{ Auth::user()->avatarUrl() }}" id="postreply-icon">
        <h2 id="postreply-header">Post Reply</h2>
        <div class="post">
            <div id="postreply-wrapper">
                <textarea id="postreply-box"></textarea>
            </div>
        </div>
    </div>
@endif