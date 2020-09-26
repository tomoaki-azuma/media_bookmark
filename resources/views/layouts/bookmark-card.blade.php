@if ($my_bookmark)
<div class="bookmark-card-title py-1 px-2" v-cloak>
<a v-bind:href="'{{ $shared_url }}'+ bookmark.share_token" target="_blank" v-cloak>@{{ bookmark.title }}</a>
</div>
@else
<div class="bookmark-card-title-others py-1 px-2" v-cloak>
<a v-bind:href="'{{ $shared_url }}'+ bookmark.share_token" target="_blank" v-cloak>@{{ bookmark.title }}</a>
</div>
@endif
<div class="bookmark-card-body d-flex ml-2 mt-2">
    <div class="flex-fill" v-cloak>
        <div class="bookmark-card-text mt-2m ml-1" v-cloak>@{{ bookmark.comment }}</div>
        <div class="bookmark-card-footer d-flex my-2 ml-1" v-cloak>
            @if (!$my_bookmark)
            <div class="mr-3" v-cloak>editor: @{{ bookmark.user.name }}</div>
            @endif
            <div><i class="far fa-eye"></i>: @{{ bookmark.view_cnt }}</div>
            <div class="ml-3">
                <template v-if="favorites.includes(bookmark.id)" v-cloak>
                <i style="color: red;" class="fas fa-heart" v-cloak></i>: @{{ bookmark.favorite_cnt }}
                </template>
                <template v-else v-cloak>
                <i class="far fa-heart" v-cloak></i>: @{{ bookmark.favorite_cnt }}
                </template>
            </div>
            <div class="ml-3">
                <button type="" class="edit-button" data-toggle="modal" data-target="#share-modal" @click="create_share_data(bookmark)">
                Share
                </button>
            </div>
        </div>
    </div>
    @if ($my_bookmark)
    <div class="bookmark-card-icon mx-2" v-cloak>
        <a v-bind:href="'/bookmark/edit/'+bookmark.id" v-cloak>
            <i style="color: #494949" class="fas fa-angle-right fa-2x"></i>
        </a>
    </div>
    @else
    <div class="bookmark-card-icon mx-2" v-cloak>
        <template v-if="include_favorite(bookmark.id)">
            <i style="color: red;" class="fas fa-heart" @click="delete_favorite(bookmark.id)"></i>
        </template>
        <template v-else>
            <i class="fas fa-heart" @click="add_favorite(bookmark.id)"></i>
        </template>
    </div>
    @endif
</div>