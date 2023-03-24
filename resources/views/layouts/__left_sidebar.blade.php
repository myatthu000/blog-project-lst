<div class="bg-white p-3">
    <span class="fw-bold d-inline-block opacity-50 mb-1">General</span>

    <div class="list-group rounded-0">
        <a href="{{ route('home') }}" class="list-group-item  border border-0 list-group-item-action {{ request()->url() == route('home') ? 'active' : '' }}" aria-current="true">
            Home
        </a>
    </div>

{{--    <div class="list-group rounded-0">--}}
{{--        <a href="{{ route('home') }}" class="list-group-item  border border-0 list-group-item-action" aria-current="true">--}}
{{--            Filter--}}
{{--        </a>--}}
{{--    </div>--}}
    <div class="list-group rounded-0">
        <a href="{{ route('photo.index') }}" class="list-group-item  border border-0 list-group-item-action {{ request()->url() == route('photo.index') ? 'active' : '' }}" aria-current="true">
            Gallery
        </a>
    </div>
    <div class="list-group rounded-0">
        <a href="{{ route('post.trash') }}" class="list-group-item  border border-0 list-group-item-action {{ request()->url() ==  route('post.trash') ? 'active' : '' }}" aria-current="true">
             Trash <i class="bi bi-trash3 text-danger"></i>
{{--            {{ request()->url() }}--}}
        </a>
    </div>

    <span class="fw-bold d-inline-block opacity-50 mt-3 mb-1">Post Management</span>
    <div class="list-group rounded-0">
        <a href="{{ route('post.index') }}" class="list-group-item  border border-0 list-group-item-action {{ request()->url() == route('post.index')  ? 'active' : '' }}" aria-current="true">
            Post List
        </a>
    </div>
    <div class="list-group rounded-0">
        <a href="{{ route('post.create') }}" class="list-group-item  border border-0 list-group-item-action {{ request()->url() == route('post.create') ? 'active' : '' }}" aria-current="true">
            Post Create
        </a>
    </div>
    <span class="fw-bold d-inline-block opacity-50 mt-3 mb-1">Category Management</span>
    <div class="list-group rounded-0">
        <a href="{{ route('category.index') }}" class="list-group-item  border border-0 list-group-item-action {{ request()->url() == route('category.index') ? 'active' : '' }}" aria-current="true">
            Category List
        </a>
    </div>
    <div class="list-group rounded-0">
        <a href="{{ route('category.create') }}" class="list-group-item  border border-0 list-group-item-action {{ request()->url() == route('category.create') ? 'active' : '' }}" aria-current="true">
            Category Create
        </a>
    </div>
    <span class="fw-bold d-inline-block opacity-50 mt-3 mb-1">User Management</span>
    @admin
    <div class="list-group rounded-0">
        <a href="{{ route('user.index') }}" class="list-group-item  border border-0 list-group-item-action {{ request()->url() == route('user.index')  ? 'active' : '' }}" aria-current="true">
            User List
        </a>
    </div>
    @endadmin
    <div class="list-group rounded-0">
        <a href="{{ route('management.setting') }}" class="list-group-item  border border-0 list-group-item-action {{ request()->url() == route('management.setting')  ? 'active' : '' }}"
           aria-current="true">
            Settings
        </a>
    </div>
</div>
