@if( route('user.band') !== request()->url() || route('login') !== request()->url() || route('register') !== request()->url())
    <div class="">
        <div class="list-group m-0 rounded-0">
{{--            {{ route('login') === request()->url() }}--}}
            <div class="mb-2"><h4>Categories</h4></div>
            <a class="list-group-item {{ request()->url() === route('page.index') ? 'active' : '' }}" href="{{ route('page.index') }}">All Categories</a>
            @forelse($categories as $category)
                <a class="list-group-item {{ request()->url() === route('page.category',$category->slug) ? 'active' : '' }}" href="{{ route('page.category',$category->slug) }}">{{$category->slug}}</a>
            @empty
                <a class="list-group-item" href="{{ route('page.category',$category->slug) }}">{{$category->slug}}</a>
            @endforelse
        </div>
    </div>
@endif
{{--@if( route('page.detail',$category->slug) )--}}
{{--    <div class="my-2 mt-4"><h4>Recent Posts</h4></div>--}}
{{--    <div class="">--}}
{{--        @forelse($recentPosts as $post)--}}
{{--        <div class="list-group m-0 rounded-0">--}}
{{--            <a class="list-group-item text-decoration-none {{ request()->url() === route('page.detail',$post->slug) ? 'active' : '' }}" href="{{ route('page.detail',$post->slug) }}">{{ $post->title }}</a>--}}
{{--        </div>--}}
{{--        @empty--}}
{{--            <a class="list-group-item" href="{{ route('page.index') }}">Home</a>--}}
{{--        @endforelse--}}
{{--    </div>--}}
{{--    </div>--}}
{{--@endif--}}
