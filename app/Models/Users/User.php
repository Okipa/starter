<?php

namespace App\Models\Users;

use App\Notifications\InitializePassword;
use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Okipa\MediaLibraryExt\ExtendsMediaAbilities;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\WelcomeNotification\ReceivesWelcomeNotification;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use Notifiable;
    use ReceivesWelcomeNotification;
    use InteractsWithMedia;
    use ExtendsMediaAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /** @SuppressWarnings(PHPMD.UnusedLocalVariable) */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('profile')
                    ->fit(Manipulations::FIT_CROP, 260, 350)
                    ->keepOriginalImageFormat()
                    ->nonQueued();
            });
    }

    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->keepOriginalImageFormat()
            ->nonQueued();
    }

    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify((new ResetPassword($token))->locale(app()->getLocale()));
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify((new VerifyEmail)->locale(app()->getLocale()));
    }

    public function sendWelcomeNotification(Carbon $validUntil): void
    {
        $this->notify((new InitializePassword($validUntil))->locale(app()->getLocale()));
    }
}
