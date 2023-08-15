
<?php

    use App\Http\Controllers\CommentController;
    use App\Http\Controllers\ImageController;
    use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
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

Route::get('/', [\App\Http\Controllers\FrontController::class, 'index'])->name('home');
Route::get('{id}/image', [\App\Http\Controllers\FrontController::class, 'image'])->name('home.image');
Route::post('comment/save', [CommentController::class, 'store'])->name('comment.save');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('image', ImageController::class);
    Route::resource('comment', CommentController::class);
});

require __DIR__.'/auth.php';
