<?php

Breadcrumbs::for('admin.classification.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Administración de Clasificaciones', route('admin.classification.index'));
});

Breadcrumbs::for('admin.classification.deleted', function ($trail) {
    $trail->parent('admin.classification.index');
    $trail->push('Clasificaciones Eliminados', route('admin.classification.deleted'));
});

Breadcrumbs::for('admin.classification.create', function ($trail) {
    $trail->parent('admin.classification.index');
    $trail->push('Crear Clasificación', route('admin.classification.create'));
});

Breadcrumbs::for('admin.classification.edit', function ($trail, $id) {
    $trail->parent('admin.classification.index');
    $trail->push('Actualizar Clasificación', route('admin.classification.edit', $id));
});
