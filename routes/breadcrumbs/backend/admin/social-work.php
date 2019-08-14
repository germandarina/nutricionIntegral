<?php

Breadcrumbs::for('admin.social-work.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Administración de Obras Sociales', route('admin.social-work.index'));
});

Breadcrumbs::for('admin.social-work.deleted', function ($trail) {
    $trail->parent('admin.social-work.index');
    $trail->push('Obras Sociales Eliminados', route('admin.social-work.deleted'));
});

Breadcrumbs::for('admin.social-work.create', function ($trail) {
    $trail->parent('admin.social-work.index');
    $trail->push('Crear Obra Social', route('admin.social-work.create'));
});

Breadcrumbs::for('admin.social-work.edit', function ($trail, $id) {
    $trail->parent('admin.social-work.index');
    $trail->push('Actualizar Obra Social', route('admin.social-work.edit', $id));
});
