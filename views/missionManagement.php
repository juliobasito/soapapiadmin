 <table class="striped">
    <thead>
    <tr>
        <th data-field="id">#</th>
        <th data-field="title">Titre</th>
        <th data-field="user">Utilisateur</th>
        <th data-field="start">Date de début</th>
        <th data-field="end">Date de fin</th>
        <th data-field="startAdress">Addresse de prise</th>
        <th data-field="endAdress">Addresse de livraison</th>
        <th data-field="isFinish">Terminé</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($missions as $mission){
        ?>
        <tr>
            <td><?php echo $mission->getId() ; ?></td>
            <td><?php echo $mission->getTitle();?></td>
            <td><?php echo $mission->getUser()->getFirstName().' '.$mission->getUser()->getLastName();?></td>
            <td><?php echo $mission->getDateStart(); ?></td>
            <td><?php echo $mission->getDateEnd(); ?></td>
            <td><?php echo $mission->getStart()->getLocalisation();?></td>
            <td><?php echo $mission->getEnd()->getLocalisation(); ?></td>
            <td>
                <?php if($mission->getIsFinish()){ ?>
                    <i class="material-icons">done</i>
                <?php }
                else { ?>
                    <i class="material-icons">not_interested</i>
                <?php } ?>
            </td>
            <td>
                <?php if(!$mission->getIsFinish()){ ?>
                    <a href="endMission/<?php echo $mission->getId();?>" class="waves-effect waves-light btn blue lighten-1"><i class="material-icons">done_all</i></a>
                <a onclick="show('listUser')" class="waves-effect waves-light btn blue lighten-1">
                    <i class="material-icons">perm_identity</i>
                </a>
                <div id="listUser" class="collection" style="display:none">
                    <?php foreach ($users as $user){ ?>
                        <a href="affectMission?user=<?php echo $user->getId()?>&mission=<?php echo $mission->getId();?>" class="collection-item blue-text lighten-1"><?php echo $user->getLastName()." ".$user->getFirstName()?></a>
                    <?php } ?>
                </div>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<nav class="foot grey lighten-2">
    <div class="nav-wrapper">
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li onclick="show('add')"><a class="colorBlack">Créer une mission</a></li>
        </ul>
    </div>
</nav>
<!--POP UP AJOUTER UN UTILISATEUR-->
<div id="add" class="popUp" style="display: none;">
    <div class="row">
        <h4>Créer une mission:</h4>
    </div>
    <div class="row">
        <label id="labelTitle">Titre: </label><input type="text" maxlength="30" id="title">
    </div>
    <div class="row">
        <label>Description: </label><input type="text" id="content">
    </div>
    <div class="row">
        <div class="col s6">
            <label>Date de début</label><input type="date" id="dateStart">
        </div>
        <div class="col s6">
            <label>Heure de début</label><input type="time" id="timeStart">
        </div>
    </div>
    <div class="row">
        <div class="col s6">
            <label>Date de fin</label><input type="date" id="dateEnd">
        </div>
        <div class="col s6">
            <label>Heure de fin</label><input type="time" id="timeEnd">
        </div>
    </div>
    <div class="row">
        <div class="col s6">
            <label>Addresse de prise</label><input type="text" id="adressStart">
        </div>
        <div class="col s6">
            <label>Addresse de livraison</label><input type="text" id="adressEnd">
        </div>
    </div>
    <div class="row">
        <button class="waves-effect waves-light btn blue lighten-1" onclick="addMission()">Valider</button>
        <button class="waves-effect waves-light btn red lighten-1" onclick="show('add')">Annuler</button>
    </div>
</div>

<script>
    function show(id){
        var element = document.getElementById(id);
        if(element.style.display == "block"){
            element.style.display = "none";
        }
        else
            element.style.display = "block";
    }
    function addMission() {
        var title = document.getElementById("title");
        var content = document.getElementById("content");
        var dateStart = document.getElementById("dateStart");
        var timeStart = document.getElementById("timeStart");
        var dateEnd = document.getElementById("dateEnd");
        var timeEnd = document.getElementById("timeEnd");
        var adressStart = document.getElementById("adressStart");
        var adressEnd = document.getElementById("adressEnd");
        if(title.value!="" &&
            content.value != "" &&
            dateStart.value !="" &&
            timeStart.value != "" &&
            dateEnd.value != "" &&
            timeEnd.value != "" &&
            adressStart.value != "" &&
            adressEnd.value != ""
        ){
            var start = dateStart.value+" | "+timeStart.value;
            var end = dateEnd.value+" | "+timeEnd.value;
            document.location.href="addMission?title="+title.value+
                "&content="+content.value+
                "&dateStart="+start+
                "&dateEnd="+end+
                "&start="+adressStart.value+
                "&end="+adressEnd.value;


        }
    }
</script>