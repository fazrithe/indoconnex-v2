<div class="modal" tabindex="-1" id="modal_share">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="text-black" id="myModalLabel">Share</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column align-items-center">
                    <span class="fw-bold fs-12 text-muted mb-3">Share this link via</span>
                    <span class="flex-row align-items-center d-flex gap-2 mb-3">
                        <button class="btn d-flex align-items-center flex-column social_share" data-type="linkedin" id="share_li" data-url="" data-utm_source="linkedin" data-utm_medium="share_post" data-utm_campaign="sharing">
                            <i class="fab fa-linkedin fa-2x fa-fw mb-3 text-linkedin"></i>
                            LinkedIn
                        </button>
                        <button class="btn d-flex align-items-center flex-column social_share" data-type="fb" id="share_fb" data-url="" data-utm_source="facebook" data-utm_medium="share_post" data-utm_campaign="sharing">
                            <i class="fab fa-facebook fa-2x fa-fw mb-3 text-facebook"></i>
                            Facebook
                        </button>
                        <button class="btn d-flex align-items-center flex-column social_share" data-type="whatsapp" id="share_wa" data-url="" data-utm_source="whatsapp" data-utm_medium="share_post" data-utm_campaign="sharing">
                            <i class="fab fa-whatsapp fa-2x fa-fw mb-3 text-whatsapp"></i>
                            Whatsapp
                        </button>
                        <button class="btn d-flex align-items-center flex-column social_share" data-type="twitter" id="share_tw" data-url="" data-utm_source="twitter" data-utm_medium="share_post" data-utm_campaign="sharing">
                            <i class="fab fa-twitter fa-2x fa-fw mb-3 text-twitter"></i>
                            Twitter
                        </button>
                    </span>
                    <div class="mb-3 gap-2 justify-content-center vstack align-items-center">
                        <span class="text-muted">or copy this link</span>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="share-link"><span class="material-icons md-14 text-danger">link</span></span>
                            <input id="share-url" type="text" class="form-control" aria-label="Share Link" aria-describedby="share-link" readonly>
                            <button class="btn btn-danger" type='button' role="button" id="copyUrl" data-clipboard-target="#share-url" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-trigger="manual" >Copy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>