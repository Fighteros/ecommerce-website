
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><?php echo lang('nav-brand');?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navy navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#"><?php echo lang('cat-col'); ?><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#"> <?php echo lang('users-col');?> </a></li>
                <li class="nav-item"><a class="nav-link" href="#"> <?php echo lang('items-col');?> </a></li>
                <li class="nav-item"><a class="nav-link" href="#"> <?php echo lang('stats-col');?> </a></li>
                <li class="nav-item"><a class="nav-link" href="#"> <?php echo lang('logs-col');?> </a></li>
            </ul>
            <ul class="nav navbar-nav pull-right">
                <li class="nav-item Active dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo ucfirst($_SESSION['Username']) ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><?php echo lang('profile-col');?></a>
                        <a class="dropdown-item" href="#"><?php echo lang('settings-col');?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><?php echo lang('logout-col');?></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
