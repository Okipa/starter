<?php

namespace App\Models\Users;

use App\Notifications\InitializePassword;
use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Okipa\MediaLibraryExt\ExtendsMediaAbilities;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\WelcomeNotification\ReceivesWelcomeNotification;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use ReceivesWelcomeNotification;
    use InteractsWithMedia;
    use ExtendsMediaAbilities;

    /** @var array $fillable */
    protected $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'password'];

    /** @var array $hidden */
    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'];

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_pictures')
            ->acceptsMimeTypes(['image/webp', 'image/jpeg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('top-nav')
                    ->fit(Manipulations::FIT_CROP, 20, 20)
                    ->format('webp');
                $this->addMediaConversion('card')
                    ->fit(Manipulations::FIT_CROP, 250, 250)
                    ->withResponsiveImages()
                    ->format('webp');
            });
    }

    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->format('webp');
    }

    public function getFullNameAttribute(): string
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
