<?php

Breadcrumbs::for('admin.plan.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Administración de Planes', route('admin.plan.index'));
});

Breadcrumbs::for('admin.plan.deleted', function ($trail) {
    $trail->parent('admin.plan.index');
    $trail->push('Planes Eliminados', route('admin.plan.deleted'));
});

Breadcrumbs::for('admin.plan.create', function ($trail) {
    $trail->parent('admin.plan.index');
    $trail->push('Crear Plan', route('admin.plan.create'));
});

Breadcrumbs::for('admin.plan.edit', function ($trail, $id) {
    $trail->parent('admin.plan.index');
    $trail->push('Actualizar Plan', route('admin.plan.edit', $id));
});
