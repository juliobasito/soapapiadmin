<div class="container">
    <table class="striped">
        <thead>
        <tr>
            <th data-field="id">#</th>
            <th data-field="marque">Modèle</th>
            <th data-field="marque">Catégorie</th>
            <th data-field="marque">Permis</th>
            <th data-field="entreprise">Entreprise</th>
            <th data-field="utilisateur">Utilisateur</th>
            <th data-field="state">Etat</th>
            <th data-field="ct">Contrôle technique</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($trucks as $truck){
        ?>
        <tr>
            <td><?php echo $truck->getId() ; ?></td>
            <td><?php echo $truck->getBrand().' '.$truck->getModel();?></td>
            <td><?php echo $truck->getCategory()->getName();?></td>
            <td><?php echo $truck->getCategory()->getFormation();?></td>
            <td><?php echo $truck->getCompany()->getName(); ?></td>
            <td><?php echo $truck->getUser()->getFirstName().' '.$truck->getUser()->getLastName();?></td>
            <td><?php echo $truck->getState();?></td>
            <td><?php echo $truck->getCt();?></td>
            <td>
                <a href="foundTruck/<?php echo $truck->getId();?>" class="waves-effect waves-light btn blue lighten-1"><i class="material-icons">my_location</i></a>
                <a class="waves-effect waves-light btn blue lighten-1" onclick="showUpdate(<?php echo $truck->getId();?>)"><i class="material-icons">mode_edit</i></a>
                <a href="deleteTruck/<?php echo $truck->getId();?>" class="waves-effect waves-light btn blue lighten-1"><i class="material-icons">delete</i></a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<nav class="foot grey lighten-2">
    <div class="nav-wrapper">
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li onclick="show('add')"><a class="colorBlack">Ajouter un camion</a></li>
            <li><a href="foundTrucks" class="colorBlack">Localiser tous les camions</a></li>
            <li onclick="show('affect')"><a class="colorBlack">Affecter un camion</a></li>
        </ul>
    </div>
</nav>
<!--POP UP AJOUTER UN CAMION-->
<div id="add" class="popUp" style="display: none;">
    <div class="row">
        <h4>Ajouter un camion :</h4>
    </div>
    <div class="row">
        <label id="labelMarque">Marque: </label><input type="text" maxlength="30" id="brand">
    </div>
    <div class="row">
        <label id="labelModel">Modèle: </label><input type="text" maxlength="30" id="model">
    </div>
    <div class="row">
        <select style="display:block;" id="company">
            <option selected disabled value="0">Companie</option>
            <?php foreach($companys as $company){ ?>
                <option value="<?php echo $company->getId(); ?>"><?php echo $company->getName(); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="row">
        <select style="display:block;" id="category">
            <option selected disabled value="0">Catégorie</option>
            <?php foreach ($categorys as $category){ ?>
                <option value="<?php echo $category->getId();?>"><?php echo $category->getName(); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="row">
        <button class="waves-effect waves-light btn blue lighten-1" onclick="addTruck()">Valider</button>
        <button class="waves-effect waves-light btn red lighten-1" onclick="show('add')">Annuler</button>
    </div>
</div>
<!--POP UP AFFECTER UN CAMION-->
<div id="affect" class="popUp" style="display: none;">
    <div class="row">
        <h4>Affecter un camion :</h4>
    </div>
    <div class="row">
        <select style="display:block;" id="user">
            <option selected disabled value="0">Utilisateur</option>
            <?php foreach ($users as $user){ ?>
                <option value="<?php echo $user->getId();?>"><?php echo $user->getFirstName().' '.$user->getLastName(); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="row">
        <select style="display:block;" id="truck">
            <option selected disabled value="0">Camion</option>
            <?php foreach ($trucks as $truck){ ?>
                <option value="<?php echo $truck->getId();?>"><?php echo $truck->getId().'-'.$truck->getBrand().'_'.$truck->getModel(); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="row">
        <button class="waves-effect waves-light btn blue lighten-1" onclick="affectTruck()">Valider</button>
        <button class="waves-effect waves-light btn red lighten-1" onclick="show('affect')">Annuler</button>
    </div>
</div>
<!--POP UP MODIFIER UN CAMION-->
<div id="update" class="popUp" style="display: none;">
    <div class="row">
        <h4>Modifier un camion :</h4>
    </div>
    <input id="idTruck" hidden>
    <div class="row">
        <select style="display:block;" id="companyU">
            <option selected disabled value="0">Entreprise</option>
            <?php foreach ($companys as $company){ ?>
                <option value="<?php echo $company->getId();?>"><?php echo $company->getName(); ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="row">
        <select style="display:block;" id="localisationU">
            <option selected disabled value="0">Localisation</option>
            <?php foreach ($companys as $company){ ?>
                <option value="<?php echo $company->getId();?>"><?php echo $company->getName();?></option>
            <?php } ?>
        </select>
    </div>
    <div class="row">
        <select style="display:block;" id="stateU">
            <option selected disabled value="0">Etat</option>
            <option value="OK">OK</option>
            <option value="Accident">Accident</option>
            <option value="Urgence">Urgence</option>
            <option value="NC">NC</option>
        </select>
    </div>
    <div class="row">
        <label>Date contrôle technique</label><input type="date" id="ct">
    </div>
    <div class="row">
        <button class="waves-effect waves-light btn blue lighten-1" onclick="updateTruck()">Valider</button>
        <button class="waves-effect waves-light btn red lighten-1" onclick="showUpdate()">Annuler</button>
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
    function addTruck() {
        var brand = document.getElementById("brand");
        var model = document.getElementById("model");
        var company = document.getElementById("company");
        var category = document.getElementById("category");
        var isTrue = true;
        if(brand.value.length < 3 || brand.value.length > 30) {
            document.getElementById("labelMarque").style.color = "red";
            isTrue = false;
        }
        if(model.value.length < 3 || model.value.length > 30) {
            document.getElementById("labelModel").style.color = "red";
            isTrue = false;
        }
        if(company.value == "0"){
            company.style.color = "red";
            isTrue = false;
        }
        if(category.value == "0"){
            category.style.color = "red";
            isTrue = false;
        }

        if(isTrue){
            document.location.href="addTruck?brand="+ brand.value+ "&model="+ model.value +"&company="+ company.value +"&category="+ category.value;
        }
    }
    function affectTruck(){
        var user = document.getElementById("user");
        var truck= document.getElementById("truck");
        if(user.value.length != 0)
            document.location.href="affectTruck?truck="+truck.value+"&user="+user.value;
    }
    function showUpdate(id){
        var update = document.getElementById("update");
        if(update.style.display =="none")
            update.style.display = "block";
        else
            update.style.display = "none";
        document.getElementById("idTruck").value = id;
    }
    function updateTruck() {
        var idTruck = document.getElementById("idTruck");
        var company = document.getElementById("companyU");
        var localisation = document.getElementById("localisationU");
        var state = document.getElementById("stateU");
        var ct = document.getElementById("ct");
        if(company.value != "0" && localisation.value != "0" && state.value != "0")
            document.location.href="updateTruck?truck="+idTruck.value+"&company="+company.value+"&localisation="+localisation.value+"&state="+state.value+"&ct="+ct.value;
    }
</script>