<form method="POST">
  <legend>New user</legend>

  <label>
    Username:
    <input type="text" name="name" />
  </label>
  <label>
    Email:
    <input type="email" name="email" />
  </label>
  <label>
    Signature:
    <textarea name="signature"></textarea>
  </label>
  <label>
    Date of birth:
    <input type="date" name="date_of_birth" />
  </label>

  <input type="submit" />
</form>

<table>
  <thead>
    <tr>
      <th>id</th>
      <th>name</th>
      <th>email</th>
      <th>signature</th>
      <th>date of birth</th>
  </thead>
  <tbody>
    <?php foreach ($this->users as $user): ?>
      <tr>
        <td><?= $user->get_id() ?></td>
        <td><?= $user->get_name() ?></td>
        <td><?= $user->get_email() ?></td>
        <td><?= $user->get_signature() ?></td>
        <td><?= $user->get_date_of_birth()->format('Y-m-d') ?></td>
      <tr>
    <?php endforeach ?>
  </tbody>
</table>
