<?php
$navlinks = array('Home' => '', 'Admin' => 'admin');
?>

<nav>
    <ul style="list-style-type: none; display: flex; gap: 20px;">
        <?php foreach ($navlinks as $key => $value) : ?>
            <li>
                <a href=<?php echo BASE_URL . $value ?>><?= $key ?></a>
            </li>
        <?php endforeach
        ?>
    </ul>
</nav>