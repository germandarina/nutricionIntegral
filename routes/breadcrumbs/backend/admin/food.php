<?php

Breadcrumbs::for('admin.food.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Administración de Alimentos', route('admin.food.index'));
});

Breadcrumbs::for('admin.food.deleted', function ($trail) {
    $trail->parent('admin.food.index');
    $trail->push('Alimentos Eliminados', route('admin.food.deleted'));
});

Breadcrumbs::for('admin.food.create', function ($trail) {
    $trail->parent('admin.food.index');
    $trail->push('Crear Alimentos', route('admin.food.create'));
});

Breadcrumbs::for('admin.food.edit', function ($trail, $id) {
    $trail->parent('admin.food.index');
    $trail->push('Actualizar Alimentos', route('admin.food.edit', $id));
});
