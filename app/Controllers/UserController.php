<?php


namespace App\Controllers;


use Core\Services\Database\Db;

class UserController
{
    protected $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function view()
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $user = $this->db->rawOne($sql, [
            ':id' => $_GET['id']
        ])[0];

        /*foreach ($user as $key => $value) {
            echo $key . ': ' . $value . '<br>';
        }*/

        echo $user['description'];
    }

    public function edit()
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $user = $this->db->rawOne($sql, [
            ':id' => $_GET['id']
        ])[0];

        ob_start();
        ?>

        <form method="post" action="/user/update">
            <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
            <textarea name="description"><?php echo $user['description'] ?? '' ?></textarea>
            <br><br>
            <input type="submit">
        </form>

        <?php

        $content = ob_get_contents();
        ob_get_clean();

        echo $content;
    }

    public function update()
    {
        $this->db->query("UPDATE users SET description='" . htmlentities($_POST['description']) . "'   WHERE id = " . $_POST['id']);
        header('Location: /user/edit?id=' . $_POST['id']);
    }
}