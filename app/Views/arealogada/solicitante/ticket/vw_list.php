<?php

if (!empty($data['list']))
{ ?>
    <span class="badge badge-dark">
        <i class="fa-solid fa-list"></i> <?= count($data['list']) ?> Usuário(s)
    </span>

    <hr>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th style="width: 1%;">ID</th>
                <th>Nome</th>
                <th>Perfil</th>
                <th style="width: 5%;">Status</th>
                <th style="width: 1%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($data['list'] as $row)
                {
                    $status = ($row['sta_usua'] == 'A' ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>');
                    ?>
                    <tr>
                        <td><?= $row['id_usua']; ?></td>
                        <td><?= $row['nm_usua']; ?></td>
                        <td><?= $row['desc_perfil'] ?></td>
                        <td><?= $status ?></td>
                        <td>
                            <button 
                                class="btn btn-sm btn-info" 
                                onclick="abrirFormAtualizar(this);"
                                attr-id_usua="<?= $row['id_usua'] ?>" 
                                data-toggle="modal" 
                                data-target="#editModal"
                                <?= (session()->get('nm_usua') == $row['nm_usua'] ? 'disabled' : '') ?>
                            >
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
