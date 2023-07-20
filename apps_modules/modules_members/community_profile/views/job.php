<!-- navbar -->
<?php $this->load->view($template['partials_navbar_business']); ?>

<?php if(empty($community->status_privacy) || !empty($checkusers_profile)) { ?>
<?php if (!empty($jobs)) : ?>
<div class="container mb-4">
    <div class="p-4 msn-widget rounded-3">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <div class="d-flex align-items-center">
                    <img src="<?php echo theme_user_locations(); ?>images/icons/cleaning-service.svg" class="border-gray-2 bg-light rounded-3 border border-1 p-3" >
                </div>
                <div class="flex-grow-1 ms-3">
                    <div class="row">
                        <span class="text-prussianblue fw-bold">Cleaning Service</span>
                    </div>
                    <div class="row">
                        <small class="text-muted">Chaterine</small>
                    </div>
                    <div class="row">
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td><small><span class="material-icons">place</span> Abcd, South Jakarta</small></td>
                                    <td><small><span class="material-icons">business</span> Local Service</small></td>
                                    <td><small><span class="material-icons">engineering</span> 1 - 5 years</small></td>
                                </tr>
                                <tr>
                                    <td><small><span class="material-icons">shopping_bag</span> Full-time</small></td>
                                    <td><small><span class="material-icons">attach_money</span> IDR50.000/hour</small></td>
                                    <td><small><span class="material-icons">calendar_today</span> Posted Today</small></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="align-items-center d-flex">
                <button class="btn btn-danger px-4">Manage Job</button>
                </div>
            </div>
            <hr style="border: 1px solid #007bff;">
            <h6 class="text-lg-left mt-4 mb-4 text-primary">List Applicants</h6>
            <hr>
            <div class="row align-items-center">
                <div class="col-1 text-center">
                    <img src="<?php echo theme_user_locations(); ?>images/users/user7.png" class="rounded-circle" >
                </div>
                <div class="col-9">
                    <table class="table table-borderless table-sm text-center">
                        <tbody>
                            <tr>
                                <td><small class="text-muted">Applicant Name</small></td>
                                <td><small class="text-muted">Match</small></td>
                                <td><small class="text-muted">Applied On</small></td>
                                <td><small class="text-muted">Phone Number</small></td>
                                <td><small class="text-muted">E-mail</small></td>
                                <td><small class="text-muted">Status</small></td>
                            </tr>
                            <tr>
                                <td><small>Edward D. Roger</small></td>
                                <td><small>70%</small></td>
                                <td><small>07/10/2020</small></td>
                                <td><small>+62 80123456789</small></td>
                                <td><small>edward@gmail.co.id</small></td>
                                <td><small>Interviewed</small></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-2">
                    <button class="btn btn-prussianblue fw-bold">View CV</button>
                    <button class="btn btn-prussianblue fw-bold">Hire</button>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-1 text-center">
                    <img src="<?php echo theme_user_locations(); ?>images/users/user8.png" class="rounded-circle" >
                </div>
                <div class="col-9">
                    <div class="row">
                        <table class="table table-borderless table-sm text-center">
                            <tbody>
                                <tr>
                                    <td><small class="text-muted">Applicant Name</small></td>
                                    <td><small class="text-muted">Match</small></td>
                                    <td><small class="text-muted">Applied On</small></td>
                                    <td><small class="text-muted">Phone Number</small></td>
                                    <td><small class="text-muted">E-mail</small></td>
                                    <td><small class="text-muted">Status</small></td>
                                </tr>
                                <tr>
                                    <td><small>Zendaya M. Stoermer</small></td>
                                    <td><small>76%</small></td>
                                    <td><small>12/08/2020</small></td>
                                    <td><small>+62 80123456789</small></td>
                                    <td><small>zendaya@gmail.co.id</small></td>
                                    <td><small>CV Analysis</small></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-2 justify-content-center">
                    <button class="btn btn-prussianblue fw-bold">View CV</button>
                    <button class="btn btn-prussianblue fw-bold">Hire</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-4">
    <div class="p-4 bg-white">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">
                    <img src="<?php echo theme_user_locations(); ?>images/icons/baby-sitter.svg" class="border-gray-2 bg-light rounded-3 border border-1 p-3" >
                </div>
                <div class="flex-grow-1 ms-3">
                    <div class="row">
                        <span class="text-prussianblue fw-bold">Babysitter</span>
                    </div>
                    <div class="row">
                            <small class="text-muted">Chaterine</small>
                    </div>
                    <div class="row">
                    <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td><small><span class="material-icons">place</span> Abcd, South Jakarta</small></td>
                                    <td><small><span class="material-icons">business</span> Local Service</small></td>
                                    <td><small><span class="material-icons">engineering</span> 1 - 5 years</small></td>
                                </tr>
                                <tr>
                                    <td><small><span class="material-icons">shopping_bag</span> Full-time</small></td>
                                    <td><small><span class="material-icons">attach_money</span> IDR50.000/hour</small></td>
                                    <td><small><span class="material-icons">calendar_today</span> Posted Today</small></td>
                                </tr>
                            </tbody>
                            </table>
                    </div>
                </div>
                <div class="flex-shrink-0 text-center d-flex align-items-center">
                    <button class="btn btn-danger px-4">Manage Job</button>
                </div>
            </div>
            <hr style="border: 1px solid #007bff;">
            <h6 class="text-lg-left mt-4 mb-4 text-primary">List Applicants</h6>
            <hr>
            <div class="row align-items-center">
                <div class="col-1 text-center">
                    <img src="<?php echo theme_user_locations(); ?>images/users/user9.png" class="rounded-circle" >
                </div>
                <div class="col-9">
                    <div class="row">
                    <table class="table table-borderless table-sm text-center">
                            <tbody>
                                <tr>
                                    <td><small class="text-muted">Applicant Name</small></td>
                                    <td><small class="text-muted">Match</small></td>
                                    <td><small class="text-muted">Applied On</small></td>
                                    <td><small class="text-muted">Phone Number</small></td>
                                    <td><small class="text-muted">E-mail</small></td>
                                    <td><small class="text-muted">Status</small></td>
                                </tr>
                                <tr>
                                    <td><small>Jacob Williams</small></td>
                                    <td><small>80%</small></td>
                                    <td><small>23/09/2020</small></td>
                                    <td><small>+62 80123456789</small></td>
                                    <td><small>jacob@gmail.co.id</small></td>
                                    <td><small>Offer</small></td>
                                </tr>
                            </tbody>
                            </table>
                    </div>
                </div>
                <div class="col-2 justify-content-center">
                    <button class="btn btn-prussianblue fw-bold">View CV</button>
                    <button class="btn btn-prussianblue fw-bold">Hire</button>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-1 text-center">
                    <img src="<?php echo theme_user_locations(); ?>images/users/user10.png" class="rounded-circle" >
                </div>
                <div class="col-9">
                    <div class="row">
                    <table class="table table-borderless table-sm text-center">
                            <tbody>
                                <tr>
                                    <td><small class="text-muted">Applicant Name</small></td>
                                    <td><small class="text-muted">Match</small></td>
                                    <td><small class="text-muted">Applied On</small></td>
                                    <td><small class="text-muted">Phone Number</small></td>
                                    <td><small class="text-muted">E-mail</small></td>
                                    <td><small class="text-muted">Status</small></td>
                                </tr>
                                <tr>
                                    <td><small>Hayley Nichole A.</small></td>
                                    <td><small>72%</small></td>
                                    <td><small>15/11/2020</small></td>
                                    <td><small>+62 80123456789</small></td>
                                    <td><small>hayley@gmail.co.id</small></td>
                                    <td><small>CV Sent</small></td>
                                </tr>
                            </tbody>
                            </table>
                    </div>
                </div>
                <div class="col-2 justify-content-center">
                    <button class="btn btn-prussianblue fw-bold">View CV</button>
                    <button class="btn btn-prussianblue fw-bold">Hire</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php else: ?>

<div class="container mb-4">
    <div class="p-4 bg-white">
        <div class="card-body d-flex flex-column align-items-center">
			<img class="mx-auto mb-3 w-100" src="public/themes/user/images/empty/job.png" alt="no-job-offered">
			<span class="text-mutex fw-semi fs-18 mb-3">You does not have any open job vacancies yet</span>
			<a href="<?php echo site_url('jobs/create/') ?>" class="btn btn-danger mb-3 fw-bold px-4">Create Job</a>
        </div>
    </div>
</div>
<?php endif; ?>

<?php } else { ?>
    <div class="container mb-4">
        <div class="row">
            <div class="col mx-auto">
                <div class="mb-4 rounded-3 msn-widget">
                    <div class="text-center p-md-4 p-2">
                        This account is Private
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
