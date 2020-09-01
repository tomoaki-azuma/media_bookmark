<div id="contents-footer" class="d-flex justify-content-around py-1">
    @if ($current == 'home')
        <img class="" src="{{ asset('storage').'/common/home-selected.png' }}" alt="">
    @else
        <a href="/home">
            <img class="" src="{{ asset('storage').'/common/footer-home.png' }}" alt="">
        </a>
    @endif

    @if ($current == 'favorite')
        <img class="" src="{{ asset('storage').'/common/favorite-selected.png' }}" alt="">
    @else
        <a href="/bookmark/my_favorite">
        <img class="" src="{{ asset('storage').'/common/footer-favorite.png' }}" alt="">
        </a>
    @endif


    @if ($current == 'search')
        <img class="" src="{{ asset('storage').'/common/search-selected.png' }}" alt="">
    @else
        <a href="/bookmark/search_init">
        <img class="" src="{{ asset('storage').'/common/footer-search.png' }}" alt="">
        </a>
    @endif

    @if ($current == 'profile')
        <img class="" src="{{ asset('storage').'/common/profile-selected.png' }}" alt="">
    @else
        <a href="/user">
        <img class="" src="{{ asset('storage').'/common/footer-profile.png' }}" alt="">
        </a>
    @endif
</div>