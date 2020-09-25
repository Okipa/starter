<?php

use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;

if (Features::enabled(Features::updateProfileInformation())) {
    Route::put(Lang::uri('admin/user/profile-information'), [ProfileInformationController::class, 'update'])
        ->name('profile.information.post')
        ->middleware(['auth']);
}
