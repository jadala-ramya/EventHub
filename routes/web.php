<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OrganizerDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrganizerRequestController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\OrganizerRequestController as AdminOrganizerRequestController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

Route::get('/index', function () {
    return view('index');
});

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    if (auth()->user()->role === 'organizer') {
        return redirect()->route('organizer.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Organizer Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/organizer/dashboard', [OrganizerDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('organizer.dashboard');

/*
|--------------------------------------------------------------------------
| User Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/user/dashboard', [EventController::class, 'userDashboard'])
    ->name('user.dashboard');

/*
|--------------------------------------------------------------------------
| Event Routes
|--------------------------------------------------------------------------
*/

Route::get('/events/create', [EventController::class, 'create'])
    ->middleware('auth')
    ->name('events.create');

Route::post('/events/store', [EventController::class, 'store'])
    ->middleware('auth')
    ->name('events.store');

Route::get('/events/{event}', [EventController::class, 'show'])
    ->middleware('auth')
    ->name('events.show');

Route::get('/events/{event}/edit', [EventController::class, 'edit'])
    ->middleware('auth')
    ->name('events.edit');

Route::put('/events/{event}', [EventController::class, 'update'])
    ->middleware('auth')
    ->name('events.update');

Route::delete('/events/{event}', [EventController::class, 'destroy'])
    ->middleware('auth')
    ->name('events.destroy');

/*
|--------------------------------------------------------------------------
| Booking Routes
|--------------------------------------------------------------------------
*/

Route::post('/book/{event}', [BookingController::class, 'store'])
    ->middleware('auth')
    ->name('book.event');
Route::get('/book/{event}', function ($event) {
    return redirect()->route('events.show', $event);
})->middleware('auth');

Route::get('/my-bookings', [BookingController::class, 'myBookings'])
    ->middleware('auth')
    ->name('my.bookings');

Route::get('/organizer/bookings', [BookingController::class, 'organizerBookings'])
    ->middleware('auth')
    ->name('organizer.bookings');

Route::get('/ticket/{booking}', [BookingController::class, 'ticket'])
    ->middleware('auth')
    ->name('ticket.show');

Route::get('/search-events', [EventController::class, 'searchPage'])
    ->middleware('auth')
    ->name('search.events');

Route::post('/book/{id}', [BookingController::class, 'book']);
Route::get('/book/{id}', function ($id) {
    return redirect()->route('events.show', $id);
})->middleware('auth');

Route::post('/seat/book/{seatId}', [BookingController::class, 'bookSeat'])
    ->name('seat.book');
Route::get('/seat/book/{seatId}', [BookingController::class, 'getSeatBook'])
    ->middleware('auth')
    ->name('seat.book.get');

/*
|--------------------------------------------------------------------------
| Organizer Request Routes
|--------------------------------------------------------------------------
*/

Route::get('/user/become-organizer', [OrganizerRequestController::class, 'create'])
    ->name('user.become.organizer.page');

Route::post('/become-organizer', [OrganizerRequestController::class, 'store'])
    ->middleware('auth')
    ->name('become.organizer');

Route::get('/organizer/request/approved/{id}', [OrganizerRequestController::class, 'approved'])
    ->middleware('auth')
    ->name('organizer.request.approved');

Route::post('/organizer/request/complete/{id}', [OrganizerRequestController::class, 'complete'])
    ->middleware('auth')
    ->name('organizer.request.complete');

/*
|--------------------------------------------------------------------------
| Check Organizer Email (for verification code field)
|--------------------------------------------------------------------------
*/

Route::get('/check-organizer-email', function (Request $request) {
    $email = $request->query('email');
    $exists = \App\Models\OrganizerRequest::where('contact_email', $email)
                ->where('status', 'approved')
                ->exists();
    return response()->json(['is_approved_organizer' => $exists]);
})->name('check.organizer.email');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('admin.dashboard');

Route::get('/admin/approve/{id}', [AdminDashboardController::class, 'approve'])
    ->middleware('auth')
    ->name('admin.approve');

Route::get('/admin/reject/{id}', [AdminDashboardController::class, 'reject'])
    ->middleware('auth')
    ->name('admin.reject');

Route::delete('/admin/users/delete/{id}', [AdminDashboardController::class, 'deleteUser'])
    ->middleware('auth')
    ->name('admin.delete.user');

Route::delete('/admin/events/delete/{id}', [AdminDashboardController::class, 'deleteEvent'])
    ->name('admin.delete.event');

Route::get('/admin/events/close/{id}', [AdminDashboardController::class, 'closeBooking'])
    ->name('admin.close.booking');

Route::get('/admin/events/open/{id}', [AdminDashboardController::class, 'openBooking'])
    ->name('admin.open.booking');

/*
|--------------------------------------------------------------------------
| Admin Organizer Request Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/organizer-requests', [AdminOrganizerRequestController::class, 'index'])
    ->middleware('auth')
    ->name('admin.organizer_requests.index');

Route::post('/admin/organizer-requests/{id}/approve', [AdminOrganizerRequestController::class, 'approve'])
    ->middleware('auth')
    ->name('admin.organizer_requests.approve');

Route::post('/admin/organizer-requests/{id}/reject', [AdminOrganizerRequestController::class, 'reject'])
    ->middleware('auth')
    ->name('admin.organizer_requests.reject');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth')
    ->name('profile.show');

Route::post('/profile/update', [ProfileController::class, 'updateProfile'])
    ->middleware('auth')
    ->name('profile.update');

Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
    ->middleware('auth')
    ->name('password.update');

/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze/Jetstream)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';