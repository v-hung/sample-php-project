<?php include_once ROOTPATH . '/app/views/layout/header.php'; ?>

<div class="container">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="/" class="nav-link">Companies</a></li>
        </ul>
    </header>
</div>

<div class="container py-3">
    <h1 class="text-center mb-2">Company Edit</h1>
    <form action="/company" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="<?= $company['id'] ?>" required>
        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" name="code" value="<?= $company['code'] ?>" disabled required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $company['name'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<div class="container py-3">
    <h1 class="text-center mb-2">Employee List</h1>
    <a href="/employee/create?company_code=<?= $company['code'] ?>" class="btn btn-primary">New Employee</a>
    <table class="table">
        <thead>
            <tr>
                <th>Employee Id</th>
                <th>Employee Name</th>
                <th>Employee Email</th>
                <th style="width:0"></th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($employees)): ?>
                <tr>
                    <td colspan="3">No employees found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?= $employee['id'] ?></td>
                        <td><?= $employee['name'] ?></td>
                        <td><?= $employee['email'] ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="/employee/<?= $employee['id'] ?>/edit?company_code=<?= $company['code'] ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                                <form action="/employee/<?= $employee['id'] ?>" role="form" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="company_code" value="<?= $company['code'] ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Remove</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
    
<?php include_once ROOTPATH . '/app/views/layout/footer.php'; ?>
