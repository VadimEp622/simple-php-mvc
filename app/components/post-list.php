<?php
require_once __DIR__ . '/../config/db-conn.php';
require_once __DIR__ . '/../services/utils.services.php';
require_once __DIR__ . '/../models/post.model.php';


$current_cmp = 'post-list';


try {
    $res[$current_cmp]['posts'] = fetch_posts($conn);
    if (count($res[$current_cmp]['posts']) < 1) {
        $res[$current_cmp]['error']   = true;
        $res[$current_cmp]['message'] = "No posts found!";
    }
} catch (Exception $e) {
    $res[$current_cmp]['error']   = true;
    $res[$current_cmp]['message'] = "Posts list fetch failed!";
}

?>

<section class="container my-5">
    <h3>Post list</h3>
    <?php if ($res[$current_cmp]['error']) : ?>
        <div class="d-flex gap-2">
            <p style="color: red;"><?= $res[$current_cmp]['message'] ?></p>
        </div>
    <?php else : ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Forum</th>
                    <th scope="col">Poster Email</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($res[$current_cmp]['posts'] as $value) : ?>
                    <tr>
                        <th scope="row"><?= $value['id'] ?></th>
                        <td><?= $value['title'] ?></td>
                        <td><?= $value['content'] ?></td>
                        <td><?= $value['forum_title'] ?></td>
                        <td><?= $value['poster_email'] ?></td>
                        <td>
                            <form action="actions/posts/delete" method="post" class="d-flex justify-content-center">
                                <input type="hidden" name="current_route" value=<?= get_current_route_name() ?>>
                                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</section>