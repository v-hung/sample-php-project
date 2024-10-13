<?php include_once ROOTPATH . '/app/views/layout/header.php'; ?>

<div class="container py-3">
    <h1 class="text-center mb-2">Company List</h1>
    <a href="/company/create" class="btn btn-primary">New Company</a>
    <table class="table">
        <thead>
            <tr>
                <th>Company Id</th>
                <th>Company Code</th>
                <th>Company Name</th>
                <th>Employee Count</th>
                <th style="width:0"></th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($companies)): ?>
                <tr>
                    <td colspan="3">No companies found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($companies as $company): ?>
                    <tr>
                        <td><?= $company['id'] ?></td>
                        <td><?= $company['code'] ?></td>
                        <td><?= $company['name'] ?></td>
                        <td><?= $company['employee_count'] ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="/company/<?= $company['code'] ?>/edit" class="btn btn-outline-primary btn-sm">Edit</a>
                                <form action="/company/<?= $company['id'] ?>" role="form" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="code" value="<?= $company['code'] ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Remove</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <form action="/send-mail" method="get">
        <button type="submit" class="btn btn-outline-primary">Send email</button>
    </form>
</div>
    
<?php include_once ROOTPATH . '/app/views/layout/footer.php'; ?>