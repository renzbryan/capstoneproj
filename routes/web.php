<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController, ChartController, ChatController, CommentController, FileSending, IarController, 
    InventoryController, ItemsController, LoginController, MessageController, OfficeController, 
    ProfileController, PropertyController, RLSDDSPController, StockController, TaskController, 
    UserController, UserTaskController, WMRController, WorkerAcc,RISController,ScitemController,FormCOntroller,PcitemController,DashboardController,
};
use App\Http\Livewire\PrintPreview;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Organized routes for the application
*/

// Public Routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Dashboard
Route::get('/admindashboard', [ChatController::class, 'index'])->name('admin.index')->middleware('admin');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // IAR Routes
    Route::resource('iar', IarController::class);
    Route::get('/item/{id}', [ItemsController::class, 'show'])->name('item.show');
    Route::get('/iar/{iar_id}/create-items', [ItemsController::class, 'addItemForm'])->name('items.create');
    Route::post('/iar/{iar_id}/create-items', [ItemsController::class, 'store'])->name('items.store');
    Route::get('/iar/{iar_id}/view-items', [ItemsController::class, 'index'])->name('items.index');
    Route::get('/iar/delete/{iar_id}', [IarController::class, 'deleteIar'])->name('delete.iar');
    
    // Archive Routes
    Route::get('/archived/iar', [IarController::class, 'archiveIar'])->name('archive.iar');
    Route::get('/archived/{iar_id}/iar/restore', [IarController::class, 'restoreIar'])->name('restore.iar');
    Route::get('/archived/{iar_id}/item', [ItemsController::class, 'showArchived'])->name('archive.item');

    // Stock Routes
    Route::resource('stock', StockController::class);
    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');


    // Inventory Routes
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

    // Property Routes
    Route::get('/property', [PropertyController::class, 'index'])->name('property.index'); // Restored Property Route

    // WMR Routes
    Route::get('/wmr', [WMRController::class, 'index'])->name('wmr.index');

    // Task Routes
    Route::get('/tasks', [TaskController::class, 'task'])->name('tasks.index');
    Route::get('/tasks/{user}/assign', [TaskController::class, 'assignForm'])->name('tasks.assignForm');
    Route::post('/tasks/{user}/assign', [TaskController::class, 'assignTask'])->name('tasks.assignTask');
    Route::get('/usertasks', [UserTaskController::class, 'index'])->name('usertasks.index');
    Route::get('/tasks/{task}/{type}', [UserTaskController::class, 'doTask'])->name('tasks.do');

    // Office Routes
    Route::get('/bfar-office/create', [OfficeController::class, 'createForm'])->name('bfar_office.create');
    Route::post('/bfar-office/store', [OfficeController::class, 'store'])->name('bfar_office.store');
    
    // Upload & File Routes
    Route::get('/upload', [FileSending::class, 'showUploadForm']);
    Route::post('/upload', [FileSending::class, 'upload']);
    
    // Miscellaneous Routes
    Route::get('/print-preview/{iarId}', PrintPreview::class)->name('print.preview.excel');
    Route::get('/chat', fn() => redirect()->route('chatify'))->name('chat.index')->middleware('auth');
    Route::post('/messages', [MessageController::class, 'store'])->middleware('auth');

    // Generate Reports & Settings
    Route::post('/generate-report', [AdminController::class, 'generate'])->name('generate.report');
    Route::get('/setting', [UserController::class, 'viewsetting'])->name('setting.index');

    // Updating Excel routes
    Route::get('/update-excel', [IarController::class, 'showForm'])->name('show.form');
    Route::post('/update-excel', [IarController::class, 'updateExcel'])->name('update.excel');
    Route::get('/test/printexcel/{iar_id}', [IarController::class, 'downloadExcel'])->name('export.excel');

    // Updating Item Designation
    Route::post('update-items-stock', [ItemsController::class, 'updateItemsStock'])->name('update.items.stock');
    Route::post('update-items-property', [ItemsController::class, 'updateItemsProperty'])->name('update.items.property');
    Route::post('update-items-wmr', [ItemsController::class, 'updateItemsWMR'])->name('update.items.wmr');


    //office
    Route::get('/bfar-office/create', [OfficeController::class, 'createForm'])->name('bfar_office.create');
    Route::post('/bfar-office/store', [OfficeController::class, 'store'])->name('bfar_office.store');
    Route::get('/get-office-code/{id}', [IarController::class, 'getOfficeCode']);

    //inventory
    Route::get('/inventory', [InventoryController::class, 'index']);

    //task
    Route::middleware('auth')->get('/tasks', [TaskController::class, 'task'])->name('tasks.index');
    Route::get('/tasks/{user}/assign', [TaskController::class, 'assignForm'])->name('tasks.assignForm');
    Route::post('/tasks/{user}/assign', [TaskController::class, 'assignTask'])->name('tasks.assignTask');


// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//usertask
Route::middleware('auth')->get('/usertasks', [UserTaskController::class, 'index'])->name('usertasks.index');
Route::get('/tasks/{task}/{type}', [UserTaskController::class, 'doTask'])->name('tasks.do');

Route::resources([
    'stock' => StockController::class,
]);

Route::get('/property', [PropertyController::class, 'index'])->name('property.index');
Route::get('/wmr', [WMRController::class, 'index'])->name('wmr.index');
Route::get('/stock', [StockController::class, 'index'])->name('stock.index');

Route::resources([
    'rlsddsp' => RLSDDSPController::class,
]);
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/iar/{iar_id}/create-items', [ItemsController::class, 'addItemForm'])->name('items.create');
Route::post('/iar/{iar_id}/create-items', [ItemsController::class, 'store'])->name('items.store');
Route::get('/iar/{iar_id}/view-items', [ItemsController::class, 'index'])->name('items.index');

Route::get('/worker', [WorkerAcc::class, 'index']);
Route::any('worker/register', [WorkerAcc::class, 'register'])->name('register');
Route::get('/test/printexcel/{iar_id}', [IarController::class, 'downloadExcel'])->name('export.excel');

Route::get('/iar/delete/{iar_id}', [IarController::class, 'deleteIar'])->name('delete.iar');

//archive
Route::get('/archived/iar', [IarController::class, 'archiveIar'])->name('archive.iar');
Route::get('/archived/{iar_id}/iar/restore', [IarController::class, 'restoreIar'])->name('restore.iar');
Route::get('/archived/{iar_id}/item', [ItemsController::class, 'showArchived'])->name('archive.item');



//logout
Route::any('/logout', [WorkerAcc::class, 'logout'])->name('logout');

Route::post('update-items-stock', [ItemsController::class, 'updateItemsStock'])->name('update.items.stock');
Route::post('update-items-property', [ItemsController::class, 'updateItemsProperty'])->name('update.items.property');
Route::post('update-items-wmr', [ItemsController::class, 'updateItemsWMR'])->name('update.items.wmr');


//office
Route::get('/bfar-office/create', [OfficeController::class, 'createForm'])->name('bfar_office.create');
Route::post('/bfar-office/store', [OfficeController::class, 'store'])->name('bfar_office.store');
Route::get('/get-office-code/{id}', [IarController::class, 'getOfficeCode']);

//inventory
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');


Route::get('/view-stock', 'StockController@viewStock')->name('view.stock');






// routes/web.php
Route::post('/generate-report', [AdminController::class, 'generate'])->name('generate.report');
Route::post('/insert-category', [ItemsController::class, 'insertcateg'])->name('category.insert');
Route::get('/setting', [UserController::class, 'viewsetting'])->name('setting.index');




Route::get('download/{file}', function ($file) {
    return Storage::download('app/' . $file);
})->name('download');


Route::get('/update-excel', [IarController::class, 'showForm'])->name('show.form');
Route::post('/update-excel', [IarController::class, 'updateExcel'])->name('update.excel');
Route::get('/chat', function() {
    return redirect()->route('chatify');
})->name('chat.index')->middleware('auth');
Route::post('/messages', [MessageController::class, 'store'])->middleware('auth');

});








require __DIR__.'/auth.php';

Route::get('/admindashboard', [ChatController::class, 'index'])->name('admin.index')->middleware('admin');


    // Other routes
    Route::get('/get-iar', [ChartController::class, 'getIar']);
Route::get('/get-inventory-data', [ChartController::class, 'getInventoryData']);
Route::get('/get-inventory-dates', [ChartController::class, 'getInventoryDates']);

// Comment Routes (Authenticated)
Route::middleware('auth')->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});



Route::resource('properties', PropertyController::class);


// Authentication Routes
require __DIR__.'/auth.php';

