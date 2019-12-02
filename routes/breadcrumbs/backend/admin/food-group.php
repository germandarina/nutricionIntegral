<?php

Breadcrumbs::for('admin.food-group.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Administración de Grupo de Alimentos', route('admin.food-group.index'));
});

Breadcrumbs::for('admin.food-group.deleted', function ($trail) {
    $trail->parent('admin.food-group.index');
    $trail->push('Grupo de Alimentos Eliminados', route('admin.food-group.deleted'));
});

Breadcrumbs::for('admin.food-group.create', function ($trail) {
    $trail->parent('admin.food-group.index');
    $trail->push('Crear Grupo de Alimentos', route('admin.food-group.create'));
});

Breadcrumbs::for('admin.food-group.edit', function ($trail, $id) {
    $trail->parent('admin.food-group.index');
    $trail->push('Actualizar Grupo de Alimentos', route('admin.food-group.edit', $id));
});
