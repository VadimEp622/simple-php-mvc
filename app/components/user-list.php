<?php
require_once __DIR__ . '/../config/db-conn.php';
require_once __DIR__ . '/../services/utils.services.php';
require_once __DIR__ . '/../models/user.model.php';


$current_cmp = 'user-list';
$current_route = get_current_route_name();

try {
    $res[$current_cmp]['users'] = fetch_users($conn);
    if (count($res[$current_cmp]['users']) < 1) {
        $res[$current_cmp]['error']   = true;
        $res[$current_cmp]['message'] = "No users found!";
    }
} catch (Exception $e) {
    $res[$current_cmp]['error']   = true;
    $res[$current_cmp]['message'] = "Users list fetch failed!";
}
?>

<section class="container my-5">
    <h3>User list</h3>
    <?php if ($res[$current_cmp]['error']) : ?>
        <div class="d-flex gap-2">
            <p style="color: red;"><?= $res[$current_cmp]['message'] ?></p>
            <?php if (isset($res[$current_cmp]['users']) && count($res[$current_cmp]['users']) < 1) : ?>
                <form action="operations/users/populate.php" method="post">
                    <input type="hidden" name="current_route" value="<?= $current_route ?>">
                    <button>Populate demo users</button>
                </form>
            <?php endif ?>
        </div>
    <?php else : ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Full name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Age</th>
                        <th scope="col">Phone</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($res[$current_cmp]['users'] as $value) : ?>
                        <tr>
                            <th scope="row"><?= $value['id'] ?></th>
                            <td><?= $value['full_name'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td><?= $value['age'] ?></td>
                            <td><?= $value['phone_number'] ?></td>
                            <td>
                                <form action="actions/users/delete" method="post" class="d-flex justify-content-center">
                                    <input type="hidden" name="current_route" value="<?= $current_route ?>">
                                    <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</section>