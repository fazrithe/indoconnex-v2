 <!-- Modal -->
 <div class="modal fade" id="product-detail" tabindex="-1" aria-labelledby="product-detailLabel" aria-hidden="true" data-bs-focus="false">
    <div class="modal-dialog modal-xl overflow-hidden">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="card border-0">
                    <div class="row g-3">
                        <div class="col-12 col-md-6 bg-light rounded-3">
                            <div class="row">
                                <img id="product-detail-img" class="ratio ratio-4x3" src="" alt="" srcset="">
							</div>
                            <div class="row g-2">
                                <div class="col rounded-3 ">
                                    <img class="ratio ratio-4x3" src="" alt="" srcset="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 rounded-3">
                        
                            <div class="card h-100 border-0">
                                <div class="card-header bg-transparent border-0 ">
                                    <div class="d-flex flex-row mb-4">
                                        <div class="d-flex flex-column">
                                            <span id="product-detail-name" class="text-black fw-semi fs-16"></span>
                                            <div class="d-flex flex-row">
                                                <span id="product-detail-status" class="text-muted bg-light" style="padding: .35em .65em;border-radius: 50rem !important;"></span>
                                                <span id="product-detail-cat" class="text-muted" style="padding: .35em .65em;border-radius: 50rem !important;"></span>
                                            </div>
											<span class="text-prussianblue fw-semi fs-18" data-currency="" id="product-detail-price"></span>
                                        </div>
                                        <div class="ms-auto">

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body mb-4 flex-column d-flex overflow-y-scroll" style="max-height:350px">
                                    <span id="product-detail-desc" class="text-break text-pre-wrap text-black fs-12 mb-4">
                                    </span>
                                    <span class="text-prussianblue fw-semi fs-18 d-none" id="product-detail-table">
                                        <table id="" class="table table-muted table-striped table-hover">
                                            <thead>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Price</th>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </span>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <div class="mt-4 d-flex flex-row align-items-start">
                                        <a href="" target="_blank" rel="">
                                            <img src="" alt="" id="product-detail-seller-img" class="feed-user-img me-2">
                                        </a>
                                        <div class="flex-column d-flex">
                                            <a href="" target="_blank" rel="" class="text-prussianblue fw-bold fs-16" id="product-detail-seller"></a>
                                            <span class="text-muted" id="product-detail-location"></span>
                                            <div class="d-flex flex-row align-items-center">
                                                <span class="material-icons text-gray md-20">email</span>
                                                <div class="d-flex flex-column ms-4">
                                                    <span class="text-gray fw-bold fs-14">Email</span>
                                                    <span class="text-black" id="product-detail-email">-</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center">
                                                <span class="material-icons text-gray md-20">phone</span>
                                                <div class="d-flex flex-column ms-4">
                                                    <span class="text-gray fw-bold fs-14">Phone Number</span>
                                                    <span class="text-black" id="product-detail-phone">-</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mt-3">
                                                <input type="hidden" id="itemName" value="">
                                                <button class="btn btn-danger" id="btn-send-message-to-seller" onclick=""><i class="fas fa-paper-plane"></i> Message</button>
                                            </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

