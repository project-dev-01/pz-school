<div class="row">
    <div class="col-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv">
                        {{ __('messages.BulletinBoard') }}
                        <h4>
                </li>
            </ul>

            <div class="card-body">
                <div class="row">
                    <?php
                    if (!empty($bulletinBorad_data)) {
                        foreach ($bulletinBorad_data as $file) {
                            $image_url = config('constants.image_url') . '/' . config('constants.branch_id') . '/admin-documents/buletin_files/' . $file['file'];
                    ?>
                            <div class="col-xl-4">
                                <div class="card mb-1 shadow-none border">
                                    <div class="p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title bg-danger text-primary rounded">
                                                        <i class="fe-file" style="color: #fff;"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col pl-0">
                                                <a href="{{ config('constants.image_url') . '/' . config('constants.branch_id') . '/admin-documents/buletin_files/' . $file['file'] }}" class="text-muted font-weight-bold" style="color: #eb0e17!important;"><?php echo $file['file']; ?>
                                                    <p class="mb-0"> {{ __('messages.preview') }}</p>
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <!-- Button -->
                                                <a href="{{ config('constants.image_url') . '/' . config('constants.branch_id') . '/admin-documents/buletin_files/' . $file['file'] }}" class="btn btn-link btn-lg text-muted" style="color: black;" download>
                                                    <i class="dripicons-download" style="color: black;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                    <?php
                        }
                    } else {
                        // If no files are available
                        echo '<div class="col-12 text-center">No files available.</div>';
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>