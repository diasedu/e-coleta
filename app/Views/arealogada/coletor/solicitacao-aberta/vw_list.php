<span class="badge badge-dark">
    <i class="fa-solid fa-list"></i> <?= count($list) ?> Ticket(s)
</span>

<?php
    if ($level == 'ERROR')
    {
        echo '<b>' . $msg . '</b>'; 
        exit;
    }
?>

<table class="table table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Ticket</th>
        <th scope="col">Nome</th>
        <th scope="col">Data</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php
        foreach ($list as $row)
        { ?>
        <tr>
            <td><?= $row['id_ticket'] ?></td>
            <td><?= $row['nm_ticket'] ?></td>
            <td><?= $row['dt_incl_ticket'] ?></td>
            <td><?= $row['nm_sta_ticket'] ?></td>
            <td>
            <button 
                class="btn btn-sm btn-info" 
                onclick="ver(this)" 
                attr-id_ticket="<?= $row['id_ticket'] ?>" 
                data-toggle="tooltip" 
                data-placement="top" 
                title="Visualize mais informações sobre o ticket."
            >
                <i class="fa-solid fa-eye"></i>
            </button>
            </td>
        </tr>
        <?php
        }
    ?>
    
    </tbody>
</table>