<?php
require 'insert.php';
require 'update.php';
require 'delete.php';
require 'select.php';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple PDO CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">

  <h2 class="mb-4">Simple PDO CRUD</h2>

  <?php
    $editUser = null;
    if (isset($_GET['edit'])) {
      $customer_id = $_GET['edit'];
      $stmt = $pdo->prepare("SELECT * FROM customer WHERE customer_id = ?");
      $stmt->execute([$customer_id]);
      $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
    }
  ?>

  <!-- FORM -->
  <h5><?= $editUser ? 'Update User' : 'Add User' ?></h5>

  <form method="POST" class="mb-4" style="max-width: 400px;">

    <?php if (!empty($editUser)): ?>
      <input type="hidden" name="customer_id" value="<?= $editUser['customer_id'] ?>">
    <?php endif; ?>

    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="<?= !empty($editUser) ? $editUser['name'] : '' ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="<?= !empty($editUser) ? $editUser['email'] : '' ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Product</label>
      <input type="text" name="product" class="form-control" placeholder="Product" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Amount</label>
      <input type="number" step="0.01" name="amount" class="form-control" placeholder="Amount" required>
    </div>

    <?php if (!empty($editUser)): ?>
      <button type="submit" name="update" class="btn btn-warning">Update</button>
      <a href="landing.php" class="btn btn-secondary">Cancel</a>
    <?php else: ?>
      <button type="submit" name="add" class="btn btn-primary">Add</button>
    <?php endif; ?>

  </form>

  <hr>

  <!-- TABLE -->
  <h5>User List</h5>

  <table class="table table-dark table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($customer as $user): ?>
      <tr>
        <td><?= $user['customer_id'] ?></td>
        <td><?= $user['first_name'] ?> <?= $user['last_name'] ?></td>
        <td><?= $user['phone_number'] ?></td>
        <td>
          <a href="?edit=<?= $user['customer_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="?delete=<?= $user['customer_id'] ?>" class="btn btn-sm btn-danger">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>