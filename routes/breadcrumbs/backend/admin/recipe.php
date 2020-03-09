<?php

Breadcrumbs::for('admin.patient.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Administración de Pacientes', route('admin.patient.index'));
});

Breadcrumbs::for('admin.patient.deleted', function ($trail) {
    $trail->parent('admin.patient.index');
    $trail->push('Pacientes Eliminados', route('admin.patient.deleted'));
});

Breadcrumbs::for('admin.patient.create', function ($trail) {
    $trail->parent('admin.patient.index');
    $trail->push('Crear Paciente', route('admin.patient.create'));
});

Breadcrumbs::for('admin.patient.edit', function ($trail, $id) {
    $trail->parent('admin.patient.index');
    $trail->push('Actualizar Paciente', route('admin.patient.edit', $id));
});

