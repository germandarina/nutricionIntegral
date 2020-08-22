<div class="row">
    <div class="col-sm-4">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Valores</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ html()->label('Energia (Kcal)')
                     ->class('col-md-12 form-control-label')
                     ->for('energia_kcal') }}
                    </td>
                    <td>
                        {{ html()->text('energia_kcal')
                                ->class('form-control numeric3Digits')
                                ->placeholder('Energia Kcal')
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td> {{ html()->label('Proteínas (g)')
                     ->class('col-md-12 form-control-label')
                     ->for('proteina') }}
                    </td>
                    <td>
                        {{ html()->text('proteina')
                            ->class('form-control numeric3Digits')
                            ->placeholder('Proteínas')
                            ->attribute('maxlength', 191)
                            ->required()
                            ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Grasa (g)')
                            ->class('col-md-12 form-control-label')
                            ->for('grasa_total') }}
                    </td>
                    <td>

                        {{ html()->text('grasa_total')
                                 ->class('form-control numeric3Digits')
                                 ->placeholder('Grasa Total')
                                 ->attribute('maxlength', 191)
                                 ->required()
                                 ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Carbo Totales (g)')
                            ->class('col-md-12 form-control-label')
                            ->for('carbohidratos_totales') }}
                    </td>
                    <td>
                        {{ html()->text('carbohidratos_totales')
                           ->class('form-control numeric3Digits')
                           ->placeholder('Carbohidratos Totales')
                           ->attribute('maxlength', 191)
                           ->required()
                           ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Colesterol (mg)')
                           ->class('col-md-12 form-control-label')
                           ->for('colesterol') }}
                    </td>
                    <td>

                        {{ html()->text('colesterol')
                            ->class('form-control numeric3Digits')
                            ->placeholder('Colesterol')
                            ->attribute('maxlength', 191)
                            ->required()
                            ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Carbo Disp (g)')
                          ->class('col-md-12 form-control-label')
                          ->for('carbohidratos_disponibles') }}

                    </td>
                    <td>
                        {{ html()->text('carbohidratos_disponibles')
                           ->class('form-control numeric3Digits')
                           ->placeholder('Carbohidratos Disp')
                           ->attribute('maxlength', 191)
                           ->required()
                           ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Fibra (g)')
                           ->class('col-md-12 form-control-label')
                           ->for('fibra') }}
                    </td>
                    <td>
                        {{ html()->text('fibra')
                          ->class('form-control numeric3Digits')
                          ->placeholder('Fibra')
                          ->attribute('maxlength', 191)
                          ->required()
                          ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('A. Grasos Satu (g)')
                            ->class('col-md-12 form-control-label')
                            ->for('ac_grasos_saturados') }}

                    </td>
                    <td>
                        {{ html()->text('ac_grasos_saturados')
                            ->class('form-control numeric3Digits')
                            ->placeholder('Ac Grasos Satu')
                            ->attribute('maxlength', 191)
                            ->required()
                            ->autofocus() }}
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="col-sm-4">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Valores</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ html()->label('A. Grasos Mono (g)')
                            ->class('col-md-12 form-control-label')
                            ->for('ac_grasos_monoinsaturados') }}

                    </td>
                    <td>
                        {{ html()->text('ac_grasos_monoinsaturados')
                                 ->class('form-control numeric3Digits')
                                 ->placeholder('Ac Grasos Mono')
                                 ->attribute('maxlength', 191)
                                 ->required()
                                 ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('A. Grasos Poli (g)')
                           ->class('col-md-12 form-control-label')
                           ->for('ac_grasos_poliinsaturados') }}

                    </td>
                    <td>  {{ html()->text('ac_grasos_poliinsaturados')
                        ->class('form-control numeric3Digits')
                        ->placeholder('Ac Grasos Poli')
                        ->attribute('maxlength', 191)
                        ->required()
                        ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Energia (Kj)')
                            ->class('col-md-12 form-control-label')
                            ->for('energia_kj') }}

                    </td>
                    <td>{{ html()->text('energia_kj')
                         ->class('form-control numeric3Digits')
                         ->placeholder('Energia Kj')
                         ->attribute('maxlength', 191)
                         ->required()
                         ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Agua (g)')
                          ->class('col-md-12 form-control-label')
                          ->for('agua') }}

                    </td>
                    <td>
                        {{ html()->text('agua')
                           ->class('form-control numeric3Digits')
                           ->placeholder('Agua')
                           ->attribute('maxlength', 191)
                           ->required()
                           ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Vitamina C (mg)')
                            ->class('col-md-12 form-control-label')
                            ->for('vitamina_c') }}

                    </td>
                    <td>
                        {{ html()->text('vitamina_c')
                            ->class('form-control numeric3Digits')
                            ->placeholder('Vitamina C')
                            ->attribute('maxlength', 191)
                            ->required()
                            ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Sodio (mg)')
                            ->class('col-md-12 form-control-label')
                            ->for('sodio') }}

                    </td>
                    <td>
                        {{ html()->text('sodio')
                           ->class('form-control numeric3Digits')
                           ->placeholder('Sodio')
                           ->attribute('maxlength', 191)
                           ->required()
                           ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td> {{ html()->label('Potasio (mg)')
                     ->class('col-md-12 form-control-label')
                     ->for('potasio') }}
                    </td>
                    <td>
                        {{ html()->text('potasio')
                               ->class('form-control numeric3Digits')
                               ->placeholder('Potasio')
                               ->attribute('maxlength', 191)
                               ->required()
                               ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Calcio (mg)')
                            ->class('col-md-12 form-control-label')
                            ->for('calcio') }}

                    </td>
                    <td>
                        {{ html()->text('calcio')
                               ->class('form-control numeric3Digits')
                               ->placeholder('Calcio')
                               ->attribute('maxlength', 191)
                               ->required()
                               ->autofocus() }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-4">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Valores</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ html()->label('Fósforo (mg)')
                          ->class('col-md-12 form-control-label')
                          ->for('fosforo') }}

                    </td>
                    <td>
                        {{ html()->text('fosforo')
                           ->class('form-control numeric3Digits')
                           ->placeholder('Fósforo')
                           ->attribute('maxlength', 191)
                           ->required()
                           ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Hierro (mg)')
                           ->class('col-md-12 form-control-label')
                           ->for('hierro') }}

                    </td>
                    <td>
                        {{ html()->text('hierro')
                           ->class('form-control numeric3Digits')
                           ->placeholder('Hierro')
                           ->attribute('maxlength', 191)
                           ->required()
                           ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Zinc (mg)')
                            ->class('col-md-12 form-control-label')
                            ->for('zinc') }}
                    </td>
                    <td>
                        {{ html()->text('zinc')
                           ->class('form-control numeric3Digits')
                           ->placeholder('Zinc')
                           ->attribute('maxlength', 191)
                           ->required()
                           ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Cenizas (g)')
                            ->class('col-md-12 form-control-label')
                            ->for('cenizas') }}
                    </td>
                    <td>
                        {{ html()->text('cenizas')
                           ->class('form-control numeric3Digits')
                           ->placeholder('Cenizas')
                           ->attribute('maxlength', 191)
                           ->required()
                           ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Tiamina (mg)')
                             ->class('col-md-12 form-control-label')
                             ->for('tiamina') }}

                    </td>
                    <td>
                        {{ html()->text('tiamina')
                          ->class('form-control numeric3Digits')
                          ->placeholder('Tiamina')
                          ->attribute('maxlength', 191)
                          ->required()
                          ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Rivoflavina (mg)')
                            ->class('col-md-12 form-control-label')
                            ->for('rivoflavina') }}

                    </td>
                    <td>
                        {{ html()->text('rivoflavina')
                                ->class('form-control numeric3Digits')
                                ->placeholder('Rivoflavina')
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{ html()->label('Niacina (mg)')
                           ->class('col-md-12 form-control-label')
                           ->for('niacina') }}
                    </td>
                    <td>
                        {{ html()->text('niacina')
                           ->class('form-control numeric3Digits')
                           ->placeholder('Niacina')
                           ->attribute('maxlength', 191)
                           ->required()
                           ->autofocus() }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
