<div class="row">
    <div class="col-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <h4 class="navv">
                        {{ __('messages.ShortcutLinks') }}
                        <h4>
                </li>
            </ul>
            <div class="card-body">
                <div class="col-12">
                    <div class="row">
                        <?php
                        if (!empty($shortcut_links)) {
                            // Iterate through shortcut data and generate links
                            foreach ($shortcut_links as $shortcut) {
                        ?>
                                <div class="col-3">
                                    <!-- <a href="{{ $shortcut['links'] }}" data-toggle="collapse">
                                            <i class="fa fa-share" aria-hidden="true" style="color: blue;"></i>
                                            <span>{{ $shortcut['sidebar_name'] }}</span>
                                        </a> -->
                                    <!-- <a href="{{ url('/admin/attendance/employee_entry') }}" target="_blank"> -->
                                    <a href="{{ $shortcut['links'] }}" target="_blank">
                                        <i class="fa fa-share" aria-hidden="true" style="color: blue;"></i>
                                        <span>{{ $shortcut['sidebar_name'] }}</span>
                                    </a>
                                </div>
                        <?php
                            }
                        } else {
                            // Display a message or take alternative action when no shortcuts are available
                            echo '<div class="col-12  text-center">No shortcuts available.</div>';
                        }
                        ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>