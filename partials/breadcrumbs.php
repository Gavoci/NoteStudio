<div class="card rounded-4 shadow-sm my-3">
            <div class="card-body">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <?php
                        $url = $_SERVER['REQUEST_URI'];
                        $urlSegments = explode('/', $url);
                        $breadcrumbPath = '';

                        foreach ($urlSegments as $segment) {
                            if ($segment !== '') {
                                $breadcrumbPath .= '/' . $segment;
                                echo '<li class="breadcrumb-item"><a href="' . $breadcrumbPath . '">' . ucfirst(str_replace('.php', '', $segment)) . '</a></li>';
                            }
                        }
                        ?>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?php echo ucfirst(basename($_SERVER['SCRIPT_FILENAME'], '.php')); ?>
                        </li>
                    </ol>

                </nav>
            </div>
        </div>