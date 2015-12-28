<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
//use Laracasts\TestDummy\Factory as TestDummy;

class CreateRolePermission extends Seeder
{
    public function run()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'Usuario Administrador';
        $admin->description = 'Este usuario tiene acceso total a todas las características de administración del sistema';
        $admin->save();

        $director = new Role();
        $director->name = 'director';
        $director->display_name = 'Usuario Director de Academia';
        $director->description = 'Este usuario tiene acceso total a todas las características de administración de su academia';
        $director->save();

        $dancer = new Role();
        $dancer->name = 'dancer';
        $dancer->display_name = 'Usuario Bailarín de Academia';
        $dancer->description = 'Este usuario tiene acceso total a todas las características de administración de su cuenta como bailarín';
        $dancer->save();

        $jury = new Role();
        $jury->name = 'jury';
        $jury->display_name = 'Usuario Jurado';
        $jury->description = 'Este usuario tiene acceso total a todas las características de administración como jurado';
        $jury->save();

        $addCategory = new Permission();
        $addCategory->name = 'add-category';
        $addCategory->display_name = "Crear categoría";
        $addCategory->save();

        $editCategory = new Permission();
        $editCategory->name = 'edit-category';
        $editCategory->display_name = "Editar categoría";
        $editCategory->save();

        $deleteCategory = new Permission();
        $deleteCategory->name = 'delete-category';
        $deleteCategory->display_name = "Eliminar categoría";
        $deleteCategory->save();
        
        $addLevel = new Permission();
        $addLevel->name = 'add-level';
        $addLevel->display_name = "Crear nivel";
        $addLevel->save();

        $editLevel = new Permission();
        $editLevel->name = 'edit-level';
        $editLevel->display_name = "Editar nivel";
        $editLevel->save();

        $deleteLevel = new Permission();
        $deleteLevel->name = 'delete-level';
        $deleteLevel->display_name = "Eliminar nivel";
        $deleteLevel->save();

        $addCompetitionType = new Permission();
        $addCompetitionType->name = 'add-competition-type';
        $addCompetitionType->display_name = "Crear tipo de competencia";
        $addCompetitionType->save();

        $editCompetitionType = new Permission();
        $editCompetitionType->name = 'edit-competition-type';
        $editCompetitionType->display_name = "Editar tipo de competencia";
        $editCompetitionType->save();

        $deleteCompetitionType = new Permission();
        $deleteCompetitionType->name = 'delete-competition-type';
        $deleteCompetitionType->display_name = "Eliminar tipo de competencia";
        $deleteCompetitionType->save();

        $addCompetitionCategory = new Permission();
        $addCompetitionCategory->name = 'add-competition-category';
        $addCompetitionCategory->display_name = "Crear categorías de competencia";
        $addCompetitionCategory->save();

        $editCompetitionCategory = new Permission();
        $editCompetitionCategory->name = 'edit-competition-category';
        $editCompetitionCategory->display_name = "Editar categorías de competencia";
        $editCompetitionCategory->save();

        $deleteCompetitionCategory = new Permission();
        $deleteCompetitionCategory->name = 'delete-competition-category';
        $deleteCompetitionCategory->display_name = "Eliminar categorías de competencia";
        $deleteCompetitionCategory->save();

        $confirmPay = new Permission();
        $confirmPay->name = 'confirm-pay';
        $confirmPay->display_name = "Confirmar pago";
        $confirmPay->save();

        $refusePay = new Permission();
        $refusePay->name = 'refuse-pay';
        $refusePay->display_name = "Rechazar pago";
        $refusePay->save();

        /*
         * --------------- Dancer ---------------------
         */

        $homeOwnDancer = new Permission();
        $homeOwnDancer->name = 'home-own-dancer';
        $homeOwnDancer->display_name = "Ver bailarines de su academia";
        $homeOwnDancer->save();

        $addDancer = new Permission();
        $addDancer->name = 'add-dancer';
        $addDancer->display_name = "Agregar bailarín";
        $addDancer->save();

        $editDancer = new Permission();
        $editDancer->name = 'edit-dancer';
        $editDancer->display_name = "Editar bailarín";
        $editDancer->save();

        $editOwnDancer = new Permission();
        $editOwnDancer->name = 'edit-own-dancer';
        $editOwnDancer->display_name = "Editar sus bailarines";
        $editOwnDancer->save();

        $deleteDancer = new Permission();
        $deleteDancer->name = 'delete-dancer';
        $deleteDancer->display_name = "Eliminar bailarín";
        $deleteDancer->save();

        $deleteOwnDancer = new Permission();
        $deleteOwnDancer->name = 'delete-own-dancer';
        $deleteOwnDancer->display_name = "Eliminar sus bailarines";
        $deleteOwnDancer->save();

        /*
         * --------------- Competitor ---------------------
         */
        $homeOwnCompetitor = new Permission();
        $homeOwnCompetitor->name = 'home-own-competitor';
        $homeOwnCompetitor->display_name = "Ver competidores de su academia";
        $homeOwnCompetitor->save();
        
        $addCompetitor = new Permission();
        $addCompetitor->name = 'add-competitor';
        $addCompetitor->display_name = "Agregar competidor";
        $addCompetitor->save();

        $showCompetitor = new Permission();
        $showCompetitor->name = 'show-competitor';
        $showCompetitor->display_name = "Ver competidor";
        $showCompetitor->save();

        $showOwnCompetitor = new Permission();
        $showOwnCompetitor->name = 'show-own-competitor';
        $showOwnCompetitor->display_name = "Ver su competidor";
        $showOwnCompetitor->save();

        $editCompetitor = new Permission();
        $editCompetitor->name = 'edit-competitor';
        $editCompetitor->display_name = "Editar competidor";
        $editCompetitor->save();

        $editOwnCompetitor = new Permission();
        $editOwnCompetitor->name = 'edit-own-competitor';
        $editOwnCompetitor->display_name = "Editar su competidor";
        $editOwnCompetitor->save();

        $deleteCompetitor = new Permission();
        $deleteCompetitor->name = 'delete-competitor';
        $deleteCompetitor->display_name = "Eliminar competidor";
        $deleteCompetitor->save();

        $deleteOwnCompetitor = new Permission();
        $deleteOwnCompetitor->name = 'delete-own-competitor';
        $deleteOwnCompetitor->display_name = "Eliminar su competidor";
        $deleteOwnCompetitor->save();

        /*
         * --------------- Payment ---------------------
         */
        $homeOwnPayment = new Permission();
        $homeOwnPayment->name = 'home-own-payment';
        $homeOwnPayment->display_name = "Ver pagos de su academia";
        $homeOwnPayment->save();

        $addPayment = new Permission();
        $addPayment->name = 'add-payment';
        $addPayment->display_name = "Agregar pagos";
        $addPayment->save();

        $showPayment = new Permission();
        $showPayment->name = 'show-payment';
        $showPayment->display_name = "Ver pagos";
        $showPayment->save();

	    $showOwnPayment = new Permission();
	    $showOwnPayment->name = 'show-own-payment';
	    $showOwnPayment->display_name = "Ver pagos propios";
	    $showOwnPayment->save();

        $editPayment = new Permission();
        $editPayment->name = 'edit-payment';
        $editPayment->display_name = "Editar pagos";
        $editPayment->save();

	    $editOwnPayment = new Permission();
	    $editOwnPayment->name = 'edit-own-payment';
	    $editOwnPayment->display_name = "Editar pagos propios";
	    $editOwnPayment->save();

        $deletePayment = new Permission();
        $deletePayment->name = 'delete-payment';
        $deletePayment->display_name = "Eliminar pagos";
        $deletePayment->save();

	    $deleteOwnPayment = new Permission();
	    $deleteOwnPayment->name = 'delete-own-payment';
	    $deleteOwnPayment->display_name = "Eliminar pagos propios";
	    $deleteOwnPayment->save();

        /*
         * --------------- Result ---------------------
         */
        $homeOwnResult = new Permission();
        $homeOwnResult->name = 'home-own-result';
        $homeOwnResult->display_name = "Ver resultados de su academia";
        $homeOwnResult->save();

        $addResult = new Permission();
        $addResult->name = 'add-result';
        $addResult->display_name = "Agregar resultados";
        $addResult->save();

        $showResult = new Permission();
        $showResult->name = 'show-result';
        $showResult->display_name = "Ver resultados";
        $showResult->save();

        $editResult = new Permission();
        $editResult->name = 'edit-result';
        $editResult->display_name = "Editar resultados";
        $editResult->save();

        $deleteResult = new Permission();
        $deleteResult->name = 'delete-result';
        $deleteResult->display_name = "Eliminar resultados";
        $deleteResult->save();

	    /*
         * --------------- Academy ---------------------
         */
	    $homeOwnAcademy = new Permission();
	    $homeOwnAcademy->name = 'home-own-academy';
	    $homeOwnAcademy->display_name = "Ver academias de su academia";
	    $homeOwnAcademy->save();

	    $homeAcademy = new Permission();
	    $homeAcademy->name = 'home-academy';
	    $homeAcademy->display_name = "Ver academias";
	    $homeAcademy->save();
	    
	    $addAcademy = new Permission();
	    $addAcademy->name = 'add-academy';
	    $addAcademy->display_name = "Agregar academias";
	    $addAcademy->save();

	    $showAcademy = new Permission();
	    $showAcademy->name = 'show-academy';
	    $showAcademy->display_name = "Ver academias";
	    $showAcademy->save();

	    $editAcademy = new Permission();
	    $editAcademy->name = 'edit-academy';
	    $editAcademy->display_name = "Editar academias";
	    $editAcademy->save();

        $editOwnAcademy = new Permission();
        $editOwnAcademy->name = 'edit-own-academy';
        $editOwnAcademy->display_name = "Editar su academia";
        $editOwnAcademy->save();

	    $deleteAcademy = new Permission();
	    $deleteAcademy->name = 'delete-academy';
	    $deleteAcademy->display_name = "Eliminar academias";
	    $deleteAcademy->save();

	    $admin->attachPermissions([
		    $addCategory, $editCategory, $deleteCategory,
		    $addLevel, $editLevel, $deleteLevel,
		    $addCompetitionType, $editCompetitionType, $deleteCompetitionType,
		    $addCompetitionCategory, $editCompetitionCategory, $deleteCompetitionCategory,
		    $confirmPay, $refusePay, $addPayment, $editPayment, $deletePayment, $showPayment,
		    $homeAcademy, $showAcademy, $addAcademy, $editAcademy, $deleteAcademy,
	    ]);

        $director->attachPermissions([
            $addDancer, $editOwnDancer, $deleteOwnDancer, $homeOwnDancer,
            $homeOwnAcademy, $editOwnAcademy,
            $addCompetitor, $editOwnCompetitor, $deleteOwnCompetitor,
            $addPayment, $editOwnPayment, $deleteOwnPayment
        ]);
    }
}
