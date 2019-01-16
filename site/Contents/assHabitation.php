
<div class="bg-light spacer p-b-0">
    <?php
     include_once '.\php\ClientManager.php';
     include_once '.\php\AppartementManager.php';
     include_once '.\php\ContratManager.php';
     include_once '.\php\CourtierManager.php';
    ?>

    <h3>
    nombre de clients : <?php echo count($listClients) ; ?> <br>
    nombre d'appartements : <?php echo count($listAppartements) ; ?> <br>
    nombre de contrats : <?php echo count($listContrats) ; ?> <br>
    nombre de courtiers : <?php echo count($listCourtiers) ; ?> <br>
    </h3>

</div>