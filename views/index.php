<div class="row">
    <div class="col s12 m4">
        <div class="card blue-grey darken-1 cardDisplay">
            <div class="card-content white-text">
                <span class="card-title">Nombre de camion(s) affecté(s)</span>
                <h2><?php echo $nbAffectedTruck ?></h2>
            </div>
        </div>
    </div>

    <div class="col s12 m4">
        <div class="card blue-grey darken-1 cardDisplay">
            <div class="card-content white-text">
                <span class="card-title">Nombre de camion(s) libre(s)</span>
                <h2><?php echo $nbNotAffectedTruck ?></h2>
            </div>
        </div>
    </div>

    <div class="col s12 m4">
        <div class="card blue-grey darken-1 cardDisplay">
            <div class="card-content white-text">
                <span class="card-title">Nombre d'utilisateur(s)</span>
                <p>Total: <?php echo $nbUser; ?></p>
                <p>Par camion : <?php echo $userTruck; ?></p>
            </div>
        </div>
    </div>

    <div class="col s12 m4">
        <div class="card blue-grey darken-1 cardDisplay">
            <div class="card-content white-text">
                <span class="card-title">Nombre de mission(s)</span>
                <p>En cours: <?php echo $nbMissionActive; ?></p>
                <p>Terminés: <?php echo $nbMissionNotActive; ?></p>
            </div>
        </div>
    </div>


</div>

