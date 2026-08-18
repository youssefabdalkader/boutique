<?php

return [

    [
        'permission' => 'category.view',
        'title' => 'Categories',
        'icon' => 'fas fa-fw fa-cog',
        'route' => 'admin.category.index',
    ],

    [
        'permission' => 'product.view',
        'title' => 'Products',
        'icon' => 'fas fa-fw fa-box',
        'route' => 'admin.product.index',
    ],

    [
        'permission' => 'tag.view',
        'title' => 'Tags',
        'icon' => 'fas fa-fw fa-tag',
        'route' => 'admin.tag.index',
    ],
    [
        'permission' => 'role.view',
        'title' => 'Roles',
        'icon' => 'fas fa-fw fa-user-tag',
        'route' => 'admin.role.index',
    ],

    [
        'permission' => 'permission.view',
        'title' => 'Permissions',
        'icon' => 'fas fa-fw fa-lock',
        'route' => 'admin.permission.index',
    ],

];
