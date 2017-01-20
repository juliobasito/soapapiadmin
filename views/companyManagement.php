<div class="container">
    <table class="striped">
        <thead>
        <tr>
            <th data-field="id">#</th>
            <th data-field="name">Nom</th>
            <th data-field="adress">Addresse</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($companys as $company){
            ?>
            <tr>
                <td><?php echo $company->getId() ; ?></td>
                <td><?php echo $company->getName();?></td>
                <td><?php echo $company->getAdress();?></td>
                <td>
                    <a class="waves-effect waves-light btn blue lighten-1" onclick="showUpdate('<?php echo $company->getId();?>')"><i class="material-icons">mode_edit</i></a>
                    <a href="deleteCompany/<?php echo $company->getId(); ?>" class="waves-effect waves-light btn blue lighten-1"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<nav class="foot grey lighten-2">
    <div class="nav-wrapper">
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li onclick="show('add')"><a class="colorBlack">Créer une entreprise</a></li>
        </ul>
    </div>
</nav>

<!--POP UP AJOUTER UNE ENTREPRISE-->
<div id="add" class="popUp" style="display: none;">
    <div class="row">
        <h4>Créer une entreprise:</h4>
    </div>
    <div class="row">
        <label id="labelName">Nom: </label><input type="text" maxlength="30" id="name">
    </div>
    <div class="row">
        <label id="labelAddress">Addresse: </label><input type="text" id="address">
    </div>
    <div class="row">
        <div class="col s6">
            <label id="labelPositionX">Latitude</label><input type="number" id="positionX">
        </div>
        <div class="col s6">
            <label id="labelPositionY">Longitude</label><input type="number" id="positionY">
        </div>
    </div>
    <div class="row">
        <button class="waves-effect waves-light btn blue lighten-1" onclick="addCompany()">Valider</button>
        <button class="waves-effect waves-light btn red lighten-1" onclick="show('add')">Annuler</button>
    </div>
</div>
<!--POP UP MODIFIER UNE ENTREPRISE-->
<div id="update" class="popUp" style="display: none;">
    <input type="text" id="idU" hidden>
    <div class="row">
        <h4>Modifier une entreprise:</h4>
    </div>
    <div class="row">
        <label id="labelName">Nom: </label><input type="text" maxlength="30" id="nameU">
    </div>
    <div class="row">
        <label id="labelAddress">Addresse: </label><input type="text" id="addressU">
    </div>
    <div class="row">
        <div class="col s6">
            <label id="labelPositionX">Latitude</label><input type="number" id="positionXU">
        </div>
        <div class="col s6">
            <label id="labelPositionY">Longitude</label><input type="number" id="positionYU">
        </div>
    </div>
    <div class="row">
        <button class="waves-effect waves-light btn blue lighten-1" onclick="updateCompany()">Valider</button>
        <button class="waves-effect waves-light btn red lighten-1" onclick="showUpdate(0)">Annuler</button>
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
    function showUpdate(id){
        var element = document.getElementById("update");
        document.getElementById('idU').value = id;
        if(element.style.display == "block"){
            element.style.display = "none";
        }
        else
            element.style.display = "block";
    }
    function addCompany() {
       var name = document.getElementById("name");
       var address = document.getElementById("address");
       var positionX = document.getElementById("positionX");
       var positionY = document.getElementById("positionY");
       if(name.value != "" &&
           address.value != ""&&
           positionX.value != ""&&
           positionY.value != ""
       ){
           document.location.href="addCompany?name="+name.value+
               "&address="+address.value+
               "&positionX="+positionX.value+
               "&positionY="+positionY.value;
       }
    }
    function updateCompany(){
        var name = document.getElementById("nameU");
        var address = document.getElementById("addressU");
        var positionX = document.getElementById("positionXU");
        var positionY = document.getElementById("positionYU");
        if(name.value != "" ||
            address.value != ""||
            positionX.value != ""||
            positionY.value != ""
        ) {
            var href = 'updateCompany?id='+document.getElementById('idU').value;
            if(name.value != "")
                href += '&name='+name.value;
            if(address.value != "")
                href += '&address='+address.value;
            if(positionX.value != "")
                href += "&positionX="+positionX.value;
            if(positionY.value != "")
                href += "&positionY="+positionY.value;
            document.location.href = href;
        }
    }
</script>