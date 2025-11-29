<h1>Edit User</h1>

<form action="<?= BASE_URL ?>User/update/<?= $data['user']['id'] ?>" method="POST">
    Name: <input type="text" name="name" value="<?= $data['user']['name'] ?>"><br>
    Email: <input type="email" name="email" value="<?= $data['user']['email'] ?>"><br>
    Age: <input type="number" name="age" value="<?= $data['user']['age'] ?>"><br>

    <button type="submit">Update</button>
</form>
