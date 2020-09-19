
<div class="modal fade" id="share-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="mt-1 mr-1"> 
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="mx-4">
                <div class="text-center my-2">
                    <div class="function-title">Media Bookmarkをシェア</div>
                </div>
                <div class="my-3">
                    <div><u>URLでシェア</u></div>
                    <div class="ml-2">
                    <input id="copy-target" class="form-control-plaintext" type="text" v-bind:value=shared_url readonly>
                    </div>
                    <div class="text-right"><img src="{{ asset('storage').'/common/ic_clipboard.png' }}" alt="" @click="copy_clipboard()"></div>
                </div>
                <div class="my-3">
                    <div class="ml-2">QR Codeでシェア</div>
                    <div class="text-center my-2"><img v-bind:src="qr_code_url" width="150" height="150" alt="" title="" /></div>
                </div>
                <div class="my-3">
                    <div class="ml-2">SNSでシェア</div>
                    <div class="" id="tweet-area"></div>
                </div>
            </div>
        </div>
    </div>
</div>
