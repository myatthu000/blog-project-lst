<div class="bg-white p-3">
    <h3 class="">Header</h3>
    <hr>
    <div class="">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam consequuntur dolorem et iste, libero quisquam quod recusandae repellendus ullam veniam.
    </div>
    <div class="mt-2 d-flex justify-content-between align-items-center">
        <div class="">
                <span class="fw-bolder">
                    <a class="text-black text-decoration-none text-decoration-underline" href="">Author</a>
                </span>
            <span class="ms-2 fw-bolder">
                    <a class="text-black text-decoration-none text-decoration-underline" href="">Date</a>
                </span>
        </div>
        <div class="">
            <a href="" class="">See More >>></a>
        </div>
    </div>
</div>



<li>
    <form class="d-none" id="{{ $user->id }}_band_user" action="{{ route('user.band') }}" method="post">
        @csrf
        @method('post')
    </form>
    <button form="{{ $user->id }}_band_user" class="btn btn-danger dropdown-item">Band User</button>
</li>
<li>
    <form class="d-none" id="{{ $user->id }}_admin_user" action="{{ route('user.role') }}" method="post">
        @csrf
        @method('post')
    </form>
    <button form="{{ $user->id }}_admin_user" class="btn btn-danger dropdown-item">Make Admin</button>
</li>
<li>
    <form class="d-none" id="{{ $user->id }}_editor_user" action="{{ route('user.role') }}" method="post">
        @csrf
        @method('post')
    </form>
    <button form="{{ $user->id }}_editor_user" class="btn btn-danger dropdown-item">Make Editor</button>
</li>
<li>
    <form class="d-none" id="{{ $user->id }}_author_user" action="{{ route('user.role') }}" method="post">
        @csrf
        @method('post')
    </form>
    <button form="{{ $user->id }}_editor_user" class="btn btn-danger dropdown-item">Make Author</button>
</li>
