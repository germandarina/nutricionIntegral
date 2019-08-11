<?php

Breadcrumbs::for('admin.employee.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Administración de Empleados', route('admin.employee.index'));
});

Breadcrumbs::for('admin.employee.deleted', function ($trail) {
    $trail->parent('admin.employee.index');
    $trail->push('Empleados Eliminados', route('admin.employee.deleted'));
});

Breadcrumbs::for('admin.employee.create', function ($trail) {
    $trail->parent('admin.employee.index');
    $trail->push('Crear Empleado', route('admin.employee.create'));
});

Breadcrumbs::for('admin.employee.edit', function ($trail, $id) {
    $trail->parent('admin.employee.index');
    $trail->push('Actualizar Empleado', route('admin.employee.edit', $id));
});
