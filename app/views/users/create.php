<h1>Create User</h1>

<form action="<?= BASE_URL ?>User/store" method="POST">
    Name: <input type="text" name="name" value="<?= $data['old']['name'] ?? '' ?>">
    <span style="color:red;"><?= $data['errors']['name'] ?? '' ?></span><br>

    Email: <input type="email" name="email" value="<?= $data['old']['email'] ?? '' ?>">
    <span style="color:red;"><?= $data['errors']['email'] ?? '' ?></span><br>

    Age: <input type="number" name="age" value="<?= $data['old']['age'] ?? '' ?>">
    <span style="color:red;"><?= $data['errors']['age'] ?? '' ?></span><br>

    <button type="submit">Save</button>
</form>
