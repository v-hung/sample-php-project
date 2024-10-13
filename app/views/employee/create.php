<?php include_once ROOTPATH . '/app/views/layout/header.php'; ?>

<div class="container">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/" class="nav-link">Companies</a></li>
        </ul>
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/company/<?= $company_code ?>/edit" class="nav-link">Employees</a></li>
        </ul>
    </header>
</div>

<div class="container py-3">
    <h1 class="text-center mb-2">Employee New</h1>
    <form action="/employee" method="POST">
        <input type="hidden" name="company_code" value="<?= $company_code ?>" required>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
    
<?php include_once ROOTPATH . '/app/views/layout/footer.php'; ?>