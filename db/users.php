<?php
namespace forum\db\users;

use lib\db;
use forum\models\User;

$user_create_query = db\lazy_prepare(<<<SQL
    INSERT INTO users (name, email, signature, date_of_birth)
    VALUES (:name, :email, :signature, :date_of_birth);
SQL
);

$user_update_query = db\lazy_prepare(<<<SQL
    UPDATE users
    SET name = :name
        email = :email
        signature = :signature
        date_of_birth = :date_of_birth
    WHERE id = :id;
SQL
);

$user_find_query = db\lazy_prepare(<<<SQL
    SELECT * FROM users
    WHERE id = :id;
SQL
);

$user_get_all_query = db\lazy_prepare(<<<SQL
    SELECT * FROM users
SQL
);

function create(User $user): int {
    global $user_create_query;
    db\execute($user_create_query(), [
        ':name' => $user->get_name(),
        ':email' => $user->get_email(),
        ':signature' => $user->get_signature(),
        ':date_of_birth' => $user->get_date_of_birth()
            ->format(\DateTime::RFC3339),
    ]);
    $id = db\last_insert_id();
    $user->set_id($id);
    return $id;
}

function update(User $user): void {
    global $user_update_query;
    db\execute($user_update_query(), [
        ':name' => $user->get_name(),
        ':email' => $user->get_email(),
        ':signature' => $user->get_signature(),
        ':date_of_birth' => $user->get_date_of_birth(),
    ]);
}

function find(int $id): ?User {
    global $user_find_query;
    $result = db\query($user_find_query(), [':id' => $id]);
    if (!$result) {
        return null;
    }

    return User::from_array($result);
}

function get_all(): iterable {
    global $user_get_all_query;
    $result = db\query_all($user_get_all_query());

    foreach ($result as $row) {
        yield User::from_array($row);
    }

    return $result->getReturn();
}
