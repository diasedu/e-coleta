<?php

if (!empty($data['list']))
{ ?>
    <span class="badge badge-dark">
        <i class="fa-solid fa-list"></i> <?= count($data['list']) ?> registro(s)
    </span>

    <hr>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th style="width: 1%;">ID</th>
                <th>Nome</th>
                <th style="width: 5%;">Status</th>
                <th style="width: 1%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($data['list'] as $row)
                {
                    $status = ($row['staTipoCol'] == 'A' ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>');
                    ?>
                    <tr>
                        <td><?= $row['idTipoCol']; ?></td>
                        <td><?= $row['nmTipoCol']; ?></td>
                        <td><?= $status ?></td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="abrirFormAtualizar(this)" attr-idTipoCol="<?= $row['idTipoCol'] ?>" data-toggle="tooltip" data-placement="top" title="Editar o registro.">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
    <?php
}
