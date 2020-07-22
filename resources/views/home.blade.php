@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="app">
            <h4>Edit MBM</h4>
            <div class="card mb-5">
                
                <div class="card-header">
                    <div class="d-flex row">
                        <div class="mr-auto"><i class="fas fa-search mx-2"></i><input type="text"></div>
                        <div class="mr-3"><a href="/bookmark/create"><button class="btn btn-primary btn-sm">New MBM</button></a></div>
                    </div>
                    
                </div>
                <div class="card-block p-0">
                    <table class="table table-bordered table-sm m-0">
                        <thead class="bg-warning">
                            <tr>
                                <th class="text-center">Title</th>
                                <th class="text-center">Comment</th>
                                <th class="text-center">Create Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="bookmark in bookmarks">
                                <tr>
                                    <td>@{{ bookmark.title }}</td>
                                    <td>@{{ bookmark.comment }}</td>
                                    <td class="text-right">@{{ date_format(bookmark.created_at) }}</td>
                                    <td class="text-center"><a v-bind:href="'/bookmark/edit/'+bookmark.id"><i class="fas fa-edit"></a></i>
                                        <a v-bind:href="'/bookmark/destroy/'+bookmark.id"><i class="fas fa-trash-alt"></a></i>
                                    </td>
                                </tr>
                            </template>
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('vuepart')
<script>
    let vm = new Vue({
        el: '#app',
        data: {
            bookmarks: []
        },
        methods: {
            date_format: function(date) {
                d = new Date(date);
                console.log(d);
                return d.getFullYear() + '/' + (d.getMonth()+1) + '/' + d.getDate();
            }
        },
        created: function() {
            axios
                .get('/bookmark/user/{{ $auth->id }}')
                .then( response => {
                    this.bookmarks = response.data;
                })    
                .catch(function(error) {
                    console.log(error);
                });
        }
    })
</script>
@endsection
