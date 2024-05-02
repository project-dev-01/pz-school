<div class="row">
    <div class="col-12">
        <div class="card">
        <ul class="nav nav-tabs" style="display: inline-block;">
                    <li class="nav-item d-flex justify-content-between align-items-center">
                                <!-- Button placed on the left side -->
                                <h4 class="navv">
                                {{ __('messages.ShortcutLinks') }}
                                </h4>
                                <!-- Up and Down Arrows -->
                                <button class="btn btn-link collapse-button" type="button" id="collapseButton4" aria-expanded="true" aria-controls="toDoList">
                                    <b><i class="mdi mdi-chevron-up rounded-circle" style="font-size: 14px; border: 1px solid white; 
                         background: white; color: blue;width: 25px;padding:-1px"></i></b>
                                </button>
                            </li>
                        </ul>
        
            <div class="card-body collapse show">
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
                            echo '<div class="col-12  text-center"> '.__('messages.noshortcutLinks').'</div>';
                        }
                        ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>