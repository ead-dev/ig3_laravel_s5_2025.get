<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::namespace('App\Http\Controllers\Util')
    ->prefix('util')
    ->name('util.')
    ->group(function(){
        Route::get('region/departements','SearchController@getDepartementsByRegionId')->name('region.departements');
        Route::get('departement/arrondissements','SearchController@getArrondissementsByDepartementId')->name('departement.arrondissements');
        Route::get('arrondissement/villages','SearchController@getVillagesByArrondissementId')->name('arrondissement.villages');
        Route::get('arrondissement/cooperatives','SearchController@getCooperativesByArrondissementId')->name('arrondissement.cooperatives');
        Route::get('cooperative/calendar_items','SearchController@getCalendarItemsByCooperativeId')->name('cooperative.calendar_items');
        Route::get('prevision','SearchController@getPrevisionById')->name('prevision');
    });

Route::namespace('App\Http\Controllers\Admin')
    ->prefix('admin')
    ->middleware(['auth','admin'])
    ->name('admin.')
    ->group(function(){
        Route::get('dashboard','DashboardController@index')->name('dashboard');
        Route::get('dashboard/data','DashboardController@getData')->name('dashboard.data');
        Route::get('dashboard/livraison','DashboardController@getLivraisons')->name('dashboard.livraisons');
        Route::resource('regions','RegionController');
        Route::resource('cooperatives','CooperativeController');
        Route::resource('departements','DepartementController');
        Route::resource('arrondissements','ArrondissementController');
        Route::resource('villages','VillageController');
        Route::resource('exploitants','ExploitantController');
        Route::resource('banks','BankController');
        Route::resource('users','UserController');
        Route::get('user/disable/{id}','UserController@disable')->name('user.disable');
        Route::get('user/enable/{id}','UserController@enable')->name('user.enable');
        Route::resource('pays','PayController');
        Route::resource('clients','ClientController');
        Route::resource('contrats','ContratController');
        Route::resource('livraisons','LivraisonController');
        Route::resource('precommandes','PrecommandeController');
        Route::resource('previsions','PrevisionController');
        Route::get('calendar/data','PrevisionController@getCalendarData')->name('calendar.data');
        Route::get('invoice/validate/{token}','OrderController@agree')->name('invoice.validate');
        Route::resource('invoices','OrderController');
        Route::resource('protocoles','ProtocoleController');
        Route::get('operateurs/{token}','UserController@getOperateur')->name('operateurs.show');
        Route::post('operateurs','UserController@saveOperateur')->name('operateurs.store');
        Route::post('operateur/cooperative','UserController@linkOperateurToCooperative')->name('operateur.cooperative');
        Route::get('operateurs','UserController@getOperateurs')->name('operateurs.index');
        Route::get('rbassins','UserController@getRbassins')->name('rbassins.index');
        Route::get('rbassins/{token}','UserController@getRbassin')->name('rbassins.show');
        Route::post('rbassins','UserController@saveRbassin')->name('rbassins.store');
        Route::post('rbassin/departement','UserController@linkRbassinToDepartement')->name('rbassin.departement');
        Route::get('protocole/calendar/{token}','ProtocoleController@generateCalendar')->name('protocole.calendar');
        Route::post('protocole/calendar/item','ProtocoleController@setCalendarItem')->name('protocole.calendar.item');
        Route::get('protocole/calendar/item/{token}','ProtocoleController@showCalendarItem')->name('protocole.calendar.item.show');
        Route::post('protocole/livraison/init','ProtocoleController@initLivraison')->name('protocole.livraison.init');
        Route::resource('saisons','SaisonController');
        Route::get('saison/close/{id}','SaisonController@close')->name('saison.close');
    });

Route::namespace('App\Http\Controllers\RBassin')
    ->prefix('rbassin')
    ->middleware(['auth','rbassin'])
    ->name('rbassin.')
    ->group(function(){
        Route::get('dashboard','DashboardController@index')->name('dashboard');
        Route::get('dashboard/data','DashboardController@getData')->name('dashboard.data');
        Route::get('dashboard/livraison','DashboardController@getLivraisons')->name('dashboard.livraisons');
        Route::resource('regions','RegionController');
        Route::resource('cooperatives','CooperativeController');
        Route::resource('departements','DepartementController');
        Route::resource('arrondissements','ArrondissementController');
        Route::resource('villages','VillageController');
        Route::resource('banks','BankController');
        Route::resource('users','UserController');
        Route::resource('previsions','PrevisionController');
        Route::get('prevision/details/{day}','PrevisionController@getDetails')->name('provision.details');
        Route::post('prevision/save','PrevisionController@save')->name('prevision.save');
        Route::get('calendar/data','PrevisionController@getCalendarData')->name('calendar.data');
        Route::resource('clients','ClientController');
        Route::resource('contrats','ContratController');
        Route::resource('protocoles','ProtocoleController');
        
        //Route::get('protocole/calendar/{token}','ProtocoleController@generateCalendar')->name('protocole.calendar');
        Route::get('cooperative/calendar/{token}','CooperativeController@generateCalendar')->name('cooperative.calendar');
        Route::post('calendar/item/village','ProtocoleController@setCalendarItemVillage')->name('calendar.village');
        Route::post('protocole/calendar/item','ProtocoleController@setCalendarItem')->name('protocole.calendar.item');
        Route::get('protocole/calendar/item/{token}','ProtocoleController@showCalendarItem')->name('protocole.calendar.item.show');
        Route::post('protocole/livraison/init','ProtocoleController@initLivraison')->name('protocole.livraison.init');
        Route::resource('saisons','SaisonController');
        Route::resource('members','MemberController');
    });

Route::namespace('App\Http\Controllers\Operateur')
    ->prefix('operateur')
    ->middleware(['auth','operateur'])
    ->name('operateur.')
    ->group(function(){
        Route::get('dashboard','DashboardController@index')->name('dashboard');
        Route::get('dashboard/data','DashboardController@getData')->name('dashboard.data');
        Route::get('dashboard/livraison','DashboardController@getLivraisons')->name('dashboard.livraisons');
        Route::resource('precommandes','PrecommandeController');
        Route::resource('cooperatives','CooperativeController');
        Route::resource('saisons','SaisonController');
        Route::resource('clients','ClientController');
        Route::resource('contrats','ContratController');
        Route::resource('previsions','PrevisionController');
        Route::get('calendar/data','PrevisionController@getCalendarData')->name('calendar.data');
        Route::resource('invoices','OrderController');
        Route::get('commande/generate/{tork}','PrecommandeController@generate')->name('commande.generate');
       // Route::resource('livraisons','LivraisonController');
        Route::resource('protocoles','ProtocoleController');
        Route::get('protocole/calendar/{token}','ProtocoleController@generateCalendar')->name('protocole.calendar');
        Route::post('protocole/calendar/item','ProtocoleController@setCalendarItem')->name('protocole.calendar.item');
        Route::get('protocole/calendar/item/{token}','ProtocoleController@showCalendarItem')->name('protocole.calendar.item.show');
        Route::post('protocole/livraison/init','ProtocoleController@initLivraison')->name('protocole.livraison.init');

    });

Route::namespace('App\Http\Controllers\Cooperative')
    ->prefix('cooperative')
    ->middleware(['auth','cooperative'])
    ->name('cooperative.')
    ->group(function(){
        Route::get('dashboard','DashboardController@index')->name('dashboard');
        Route::resource('exploitants','ExploitantController');
        Route::resource('livraisons','LivraisonController');
        Route::get('livraison/accept/{token}','LivraisonController@accept')->name('livraison.accept');
        Route::post('livraison/validate','LivraisonController@valider')->name('livraison.validate');
        Route::resource('protocoles','ProtocoleController');
        Route::resource('members','MemberController');
        Route::get('protocole/calendar/{token}','ProtocoleController@generateCalendar')->name('protocole.calendar');
        Route::post('protocole/calendar/item','ProtocoleController@setCalendarItem')->name('protocole.calendar.item');
        Route::get('protocole/calendar/item/{token}','ProtocoleController@showCalendarItem')->name('protocole.calendar.item.show');
        Route::post('protocole/livraison/init','ProtocoleController@initLivraison')->name('protocole.livraison.init');
        Route::resource('invoices','OrderController');
        Route::post('invoice/part','OrderController@addPart')->name('invoice.part.add');
        Route::post('part/paiement','OrderController@addPaiementPart')->name('invoice.part.paiement');
        Route::resource('paiements','PaiementController');
    });


Route::namespace('App\Http\Controllers\Client')
    ->prefix('client')
    ->middleware(['auth','client'])
    ->name('client.')
    ->group(function(){
        Route::get('dashboard','DashboardController@index')->name('dashboard');
        Route::resource('livraisons','LivraisonController');
        Route::post('livraison/validate','LivraisonController@valider')->name('livraison.validate');
        Route::resource('contrats','ContratController');
        Route::resource('precommandes','PrecommandeController');
        Route::get('precommande/cancel/{token}','PrecommandeController@cancel')->name('precommande.cancel');
       // Route::get('protocole/calendar/{token}','ProtocoleController@generateCalendar')->name('protocole.calendar');
       Route::get('invoice/validate/{token}','OrderController@agree')->name('invoice.validate');
        Route::resource('invoices','OrderController');

    });

Route::namespace('App\Http\Controllers\Bank')
    ->prefix('bank')
    ->middleware(['auth','bank'])
    ->name('bank.')
    ->group(function(){
        Route::get('dashboard','DashboardController@index')->name('dashboard');
        Route::get('dashboard/data','DashboardController@getData')->name('dashboard.data');
        Route::get('dashboard/livraison','DashboardController@getLivraisons')->name('dashboard.livraisons');
        Route::resource('livraisons','LivraisonController');
        Route::get('livraison/validate/{token}','LivraisonController@valider')->name('livraison.validate');
        Route::resource('contrats','ContratController');
        Route::resource('invoices','OrderController');
        Route::resource('commandes','CommandeController');
        Route::resource('protocoles','ProtocoleController');
        Route::resource('paiements','PaiementController');

    });


Route::get('/home',[HomeController::class,'index'])->name('home')->middleware('auth');
Route::get('/profile',[HomeController::class,'getProfile'])->name('profile')->middleware('auth');
Route::post('/profile',[HomeController::class,'storeProfile'])->name('profile.store')->middleware('auth');
Route::post('/logout',[HomeController::class,'logout'])->name('logout')->middleware('auth');
