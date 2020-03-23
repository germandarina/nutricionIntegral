<?php

Breadcrumbs::for('admin.recipe.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Administración de Recetas', route('admin.recipe.index'));
});

Breadcrumbs::for('admin.recipe.deleted', function ($trail) {
    $trail->parent('admin.recipe.index');
    $trail->push('Recetas Eliminadas', route('admin.recipe.deleted'));
});

Breadcrumbs::for('admin.recipe.create', function ($trail) {
    $trail->parent('admin.recipe.index');
    $trail->push('Crear Receta', route('admin.recipe.create'));
});

Breadcrumbs::for('admin.recipe.edit', function ($trail, $id) {
    $trail->parent('admin.recipe.index');
    $trail->push('Actualizar Receta', route('admin.recipe.edit', $id));
});

