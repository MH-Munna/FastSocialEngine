{php comm_id=$id type_id=$type salt_id=$salt }
    $com=$comm_id;
        $type='$type_id$salt_id';
        include(__DIR__.'/../../../htdocs/comments/index.php');
{/php}