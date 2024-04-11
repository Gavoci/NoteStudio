<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container">
            <a class="navbar-brand" href="index.php">NoteStudio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Notes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="new_notes.php">New Notes</a></li>
                            <li><a class="dropdown-item" href="notes_lists.php">Notes List</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="new_category.php">New Category</a></li>
                            <li><a class="dropdown-item" href="categories_list.php">Categories List</a></li>
                        </ul>
                    </li>

                    <?php
                    if ($_SESSION['user_role'] == 1) {
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="admin_notes_list.php">Notes List</a></li>
                                <li><a class="dropdown-item" href="admin_categories_list.php">Categories List</a></li>
                                <li><a class="dropdown-item" href="admin_users_list.php">User List</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                API's
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="http://localhost/NoteStudio-main/api/notes">API Notes</a></li>
                                <li><a class="dropdown-item" href="http://localhost/NoteStudio-main/api/categories">API Categories</a></li>
                                <li><a class="dropdown-item" href="http://localhost/NoteStudio-main/api/users">API Users</a></li>
                            </ul>
                        </li>
                        <?php
                    } elseif ($_SESSION['user_role'] == 2) {
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Tenants
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="new_tenant.php">New Tenant</a></li>
                                <li><a class="dropdown-item" href="update_tenant.php">Tenants List</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="admin_notes_list.php">Notes List</a></li>
                                <li><a class="dropdown-item" href="admin_categories_list.php">Categories List</a></li>
                                <li><a class="dropdown-item" href="admin_users_list.php">User List</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                API's
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="http://localhost/NoteStudio-main/api/notes">API Notes</a></li>
                                <li><a class="dropdown-item" href="http://localhost/NoteStudio-main/api/categories">API Categories</a></li>
                                <li><a class="dropdown-item" href="http://localhost/NoteStudio-main/api/users">API Users</a></li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="dropdown">
                    <button class="btn btn-light border dropdown-toggle text-capitalize" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill"></i>
                        <?= $_SESSION['user_name'] ?>
                    </button>
                    <ul class="dropdown-menu p-2">
                        <li><a class="dropdown-item" href="editUserprofile.php"><i
                                    class="bi bi-pencil-square me-2"></i>Edit Profile </a></li>
                        <li><a class="dropdown-item" href="php/user_logout.php"><i
                                    class="bi bi-box-arrow-left me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
