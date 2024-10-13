<?php include_once ROOTPATH . '/app/views/layout/header.php'; ?>

<div class="container">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/" class="nav-link">Companies</a></li>
        </ul>
    </header>
</div>

<div class="container py-3">
    <h1 class="text-center mb-2">Company New</h1>
    <form action="/company" method="POST">
        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    
</div>
    
<?php include_once ROOTPATH . '/app/views/layout/footer.php'; ?>
