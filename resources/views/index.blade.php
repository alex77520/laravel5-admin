
@extends('layouts.admin')

@section('content')
    <p>This is my body content.</p>
    <?php
        echo "<pre>";
        echo $user->id;
        echo "====================";
        //var_dump($user);
        //print_r($currentRolePermission);
        //print_r($allStaticModule);
        //print_r($currentOwnRole);
        echo "</pre>";
    ?>


@endsection