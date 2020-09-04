@if ($my_bookmark)
<div class="bookmark-card-title p-1 pl-2">
<a v-bind:href="'{{ $shared_url }}'+ bookmark.share_token" target="_blank">@{{ bookmark.title }}</a>
</div>
@else
<div class="bookmark-card-title-others p-1 pl-2">
<a v-bind:href="'{{ $shared_url }}'+ bookmark.share_token" target="_blank">@{{ bookmark.title }}</a>
</div>
@endif

<div class="bookmark-card-body d-flex ml-2 mt-2">
    <div class="flex-fill">
        <div class="bookmark-card-text mt-2m ml-1">@{{ bookmark.comment }}</div>
        <div class="bookmark-card-footer d-flex my-2 ml-1">
            @if (!$my_bookmark)
            <div class="mr-3">editor: @{{ bookmark.user.name }}</div>
            @endif
            <div><i class="far fa-eye"></i>: @{{ bookmark.view_cnt }}</div>
            <div class="ml-3"><i class="far fa-heart"></i>: @{{ bookmark.favorite_cnt }}</div>
            <div class="ml-3">
                <button type="" class="edit-button" data-toggle="modal" data-target="#share-modal" @click="create_share_data(bookmark)">
                Share
                </button>
            </div>
        </div>
    </div>
    @if ($my_bookmark)
    <div class="bookmark-card-icon mx-2">
        <a v-bind:href="'/bookmark/edit/'+bookmark.id">
            <i class="fas fa-angle-right fa-2x"></i>
        </a>
    </div>
    @else
    <div class="bookmark-card-icon mx-2">
        <template v-if="include_favorite(bookmark.id)">
            <i style="color: red;" class="fas fa-heart" @click="delete_favorite(bookmark.id)"></i>
        </template>
        <template v-else>
            <i class="fas fa-heart" @click="add_favorite(bookmark.id)"></i>
        </template>
    </div>
    @endif
</div>